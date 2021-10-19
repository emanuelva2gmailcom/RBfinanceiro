<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Entity\Lancamento;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;
use Cake\Event\EventInterface;
use Cake\Core\Configure;

/**
 * Lancamentos Controller
 *
 * @property \App\Model\Table\LancamentosTable $Lancamentos
 * @method \App\Model\Entity\Lancamento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LancamentosController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('FormProtection');
    }

    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);

        $this->FormProtection->setConfig('unlockedActions', ['post', 'getTablePainel']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function getPainel($lancamentos)
    {

        $totals = [
            'entrada' => [
                'entradas' => [],
                'total' => 0
            ],
            'saida' => [
                'saidas' => [],
                'total' => 0
            ],
            'total' => 0
        ];
        foreach ($lancamentos as $lancamento) :
            if ($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada') {
                // array_push($totals['entrada']['entradas'], $lancamento);
                $totals['entrada']['total'] += $lancamento->valor;
                $totals['total'] += $lancamento->valor;
            } else {
                // array_push($totals['saida']['saidas'], $lancamento);
                $totals['saida']['total'] -= $lancamento->valor;
                $totals['total'] -= $lancamento->valor;
            }
        endforeach;

        return $totals;
    }

    public function getTablePainel()
    {
        $renovados = $this->getrenovado();
        $query = "tipo = 'REALIZADO' or tipo = 'PREVISTO'";
        $totals = [
            'entrada' => 0,
            'saida' => 0,
            'total' => 0
        ];
        if ($this->request->is('post')) {
            $request = $this->request->getData();
            switch ($request[0]) {
                case 'REALIZADO':
                    $query = "tipo = 'REALIZADO'";
                    break;

                case 'PREVISTO':
                    $query = "tipo = 'PREVISTO'";
                    break;

                default:
                    # code...
                    break;
            }
            $request[1] = new Time($request[1], 'UTC');
            $obj = [];
            $total = 0;
            $this->loadModel('Fluxocontas');
            $contas = $this->Fluxocontas->find('all', ['contain' => ['Fluxosubgrupos' => ['Fluxogrupos']]]);
            $lancamentos = $this->Lancamentos->find('all', [
                'contain' => ['Fluxocontas', 'Fornecedores', 'Clientes', 'Drecontas'],
                'conditions' => [$query . $renovados['and']]
            ]);
            foreach ($contas as $c) :
                $valor = 0;
                foreach ($lancamentos as $l) :

                    if ($c->conta == $l->fluxoconta->conta && $l->created->i18nFormat('yyyy-MM') == $request[1]->i18nFormat('yyyy-MM')) {
                        // debug($l->created->i18nFormat('yyyy-MM') == $request[1]->i18nFormat('yyyy-MM'));
                        $c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? $valor += $l->valor : $valor -= $l->valor;
                        switch ($c->fluxosubgrupo->fluxogrupo->grupo) {
                            case 'entrada':
                                # code...
                                $totals['entrada'] += $l->valor;
                                $totals['total'] += $l->valor;
                                break;

                            case 'saida':
                                # code...
                                $totals['saida'] -= $l->valor;
                                $totals['total'] -= $l->valor;
                                break;
                        }
                    }
                endforeach;
                $c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? $total += $valor : $total += $valor;
                array_push($obj, [$c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? 'recebimento' : 'pagamento', $c->conta, $valor]);
            endforeach;
            $this->response = $this->response->withType('application/json')
                ->withStringBody(json_encode([$obj, $total, $totals]));
            return $this->response;
        }
        $obj = [];
        $total = 0;
        $this->loadModel('Fluxocontas');
        $contas = $this->Fluxocontas->find('all', ['contain' => ['Fluxosubgrupos' => ['Fluxogrupos']]]);
        $lancamentos = $this->Lancamentos->find('all', [
            'contain' => ['Fluxocontas', 'Fornecedores', 'Clientes', 'Drecontas'],
            'conditions' => [$query . $renovados['and']]
        ]);
        foreach ($contas as $c) :
            $valor = 0;
            foreach ($lancamentos as $l) :
                if ($c->conta == $l->fluxoconta->conta) {
                    $c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? $valor += $l->valor : $valor -= $l->valor;
                }
                switch ($c->fluxosubgrupo->fluxogrupo->grupo) {
                    case 'entrada':
                        $totals['entrada'] += $l->valor;
                        $totals['total'] += $l->valor;
                        break;

                    case 'saida':
                        $totals['saida'] -= $l->valor;
                        $totals['total'] -= $l->valor;
                        break;
                }
            endforeach;
            $c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? $total += $valor : $total += $valor;
            array_push($obj, [$c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? 'recebimento' : 'pagamento', $c->conta, $valor]);
        endforeach;
        $this->response = $this->response->withType('application/json')
            ->withStringBody(json_encode([$obj, $total, $totals]));
        return $this->response;
    }

    public function painel()
    {
    }

    public function index()
    {
        $renovados = $this->getrenovado();
        $this->paginate = [
            'contain' => ['Fluxocontas', 'Fornecedores', 'Clientes', 'Drecontas'],
            'conditions' => [$renovados['simple']]
        ];
        $lancamentos = $this->paginate($this->Lancamentos);
        $now = FrozenTime::now()->i18nFormat('yyyy-MM-dd', 'UTC');
        // exit;
        $this->set(compact('lancamentos', 'now'));
    }


    /**
     * View method
     *
     * @param string|null $id Lancamento id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $lancamento = $this->Lancamentos->get($id, [
            'contain' => ['Fluxocontas', 'Fornecedores', 'Clientes', 'Drecontas', 'Lancamentos', 'Caixaregistros', 'Comprovantes'],
        ]);
        if($lancamento->lancamento_id != null){

            $lancamento->lancamentos = $this->Lancamentos->get($lancamento->lancamento_id, [
                'contain' => ['Fluxocontas', 'Fornecedores', 'Clientes', 'Drecontas', 'Caixaregistros', 'Comprovantes'],
            ]);
            $lancamento->lancamentos = [];
            for($id = $lancamento->lancamento_id; $id != null; $id){
                array_push($lancamento->lancamentos, $this->Lancamentos->get($id, [
                    'contain' => ['Fluxocontas', 'Fornecedores', 'Clientes', 'Drecontas', 'Caixaregistros', 'Comprovantes'],
                ]));
                $id = $lancamento->lancamentos[array_key_last($lancamento->lancamentos)]->lancamento_id;
            }
        }
        // debug($lancamento->lancamentos);exit;
        $this->set(compact('lancamento'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */


    public function add()
    {

        $this->paginate = [
            'contain' => ['Fluxosubgrupos' => ['Fluxogrupos']],
        ];
        $this->loadModel('Comprovantes');

        $lancamento = $this->Lancamentos->newEmptyEntity();
        if ($this->request->is('post')) {
            $lancamento = $this->Lancamentos->patchEntity($lancamento, $this->request->getData());
            if (($lancamento->tipo == 'REALIZADO') && !($this->caixaaberto())) {
                $this->Flash->error(__('Não pode ser criado pois o caixa está fechado.'));

                return $this->redirect(['action' => 'add']);
            }

            $image = $this->request->getData('uploadfiles');
            $name = $image->getClientFilename();
            $targetpath = WWW_ROOT . 'img/uploads/' . DS . $name;
            if ($name)
                $image->moveTo($targetpath);
            $comprovantes = $this->Comprovantes->newEmptyEntity();
            $comprovantes->img = $name;
            if (($this->Comprovantes->save($comprovantes)) && ($this->Lancamentos->save($lancamento))) {
                $this->Flash->success(__('Lançamento adicionado com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Lançamento não foi adicionado, por favor tente novamente.'));
        }



        $entradasGrupos = $this->Lancamentos->Fluxocontas->find('list', [
            'contain' => ['Fluxosubgrupos' => ['Fluxogrupos']],
            'valueField' => function ($d) {

                if ($d->fluxosubgrupo->fluxogrupo->grupo == 'entrada') {
                   return $d->fluxosubgrupo->fluxogrupo->grupo . ' de ' .
                        $d->fluxosubgrupo->subgrupo . '     ' .
                        $d->conta;
                }
            }
        ]);
        $entradas = [];
        foreach($entradasGrupos as $entrada){
            $entradas[]= $entrada;
            
        }
        $entradas = array_filter($entradas);
  

        $saidasGrupos = $this->Lancamentos->Fluxocontas->find('list', [
            'contain' => ['Fluxosubgrupos' => ['Fluxogrupos']],
            'valueField' => function ($d) {
                if ($d->fluxosubgrupo->fluxogrupo->grupo == 'saida') {
                    return  $d->fluxosubgrupo->fluxogrupo->grupo . ' de ' .
                        $d->fluxosubgrupo->subgrupo . '     ' .
                        $d->conta;
                }
            }
        ]);

        $saidas = [];
        foreach($saidasGrupos as $saida){
            $saidas[]= $saida;
            
        }
        $saidas = array_filter($saidas);

        $tudo = array_merge($entradas,$saidas);
 
        $fornecedores = $this->Lancamentos->Fornecedores->find('list', ['limit' => 200]);
        $clientes = $this->Lancamentos->Clientes->find('list', ['limit' => 200]);
        $drecontas = $this->Lancamentos->Drecontas->find('list', ['limit' => 200]);
        $Grupos = $this->Lancamentos->Fluxocontas->Fluxosubgrupos->Fluxogrupos->find('list', ['limit' => 200]);
        $grupos = ['PREVISTO', 'REALIZADO'];
        $this->set(compact('lancamento', 'fornecedores', 'clientes', 'drecontas', 'grupos', 'Grupos', 'entradas', 'saidas','tudo'));
    }

    public function renovar($id = null)
    {
        $lancamento = $this->Lancamentos->get($id, [
            'contain' => [],
        ]);
        $this->loadModel('Comprovantes');
        $comprovantes = $this->paginate($this->Comprovantes);
        if ($this->request->is(['patch', 'post', 'put'])) {

            $lancamento2 = $this->Lancamentos->newEmptyEntity();
            // debug([$lancamento2]);exit;
            $lancamento2->tipo = $lancamento->tipo;
            $lancamento2->descricao = $this->request->getData()['descricao'];
            $lancamento2->valor = $this->request->getData()['valor'];
            $lancamento2->data_emissao = $lancamento->data_emissao;
            $lancamento2->data_baixa = $lancamento->data_baixa;
            $lancamento2->data_vencimento = $this->request->getData()['data_vencimento'];
            $lancamento2->created = $lancamento->created;
            $lancamento2->modified = $lancamento->modified;
            $lancamento2->fluxoconta_id = $lancamento->fluxoconta_id;
            $lancamento2->fornecedor_id = $lancamento->fornecedor_id;
            $lancamento2->cliente_id = $lancamento->cliente_id;
            $lancamento2->lancamento_id = $lancamento->id_lancamento;
            $lancamento2->dreconta_id = $lancamento->dreconta_id;

            if ($this->Lancamentos->save($lancamento2)) {
                $this->Flash->success(__('Lançamento editado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Lançamento não foi editado, por favor tente novamente.'));
        }
        $fluxocontas = $this->Lancamentos->Fluxocontas->find('list', ['limit' => 200]);
        $fornecedores = $this->Lancamentos->Fornecedores->find('list', ['limit' => 200]);
        $clientes = $this->Lancamentos->Clientes->find('list', ['limit' => 200]);
        $drecontas = $this->Lancamentos->Drecontas->find('list', ['limit' => 200]);
        $lancamentos = $this->Lancamentos->find('list', ['limit' => 200]);
        $this->set(compact('lancamento', 'fluxocontas', 'fornecedores', 'clientes', 'drecontas', 'lancamentos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Lancamento id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $lancamento = $this->Lancamentos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $lancamento = $this->Lancamentos->patchEntity($lancamento, $this->request->getData());

            if ($this->Lancamentos->save($lancamento)) {
                $this->Flash->success(__('Lançamento editado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Lançamento não foi editado, por favor tente novamente.'));
        }
        $fluxocontas = $this->Lancamentos->Fluxocontas->find('list', ['limit' => 200]);
        $fornecedores = $this->Lancamentos->Fornecedores->find('list', ['limit' => 200]);
        $clientes = $this->Lancamentos->Clientes->find('list', ['limit' => 200]);
        $drecontas = $this->Lancamentos->Drecontas->find('list', ['limit' => 200]);
        $lancamentos = $this->Lancamentos->find('list', ['limit' => 200]);
        $this->set(compact('lancamento', 'fluxocontas', 'fornecedores', 'clientes', 'drecontas', 'lancamentos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Lancamento id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $lancamento = $this->Lancamentos->get($id);
        if ($this->Lancamentos->delete($lancamento)) {
            $this->Flash->success(__('Lançamento deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O Lançamento não foi deletado, por favor tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
