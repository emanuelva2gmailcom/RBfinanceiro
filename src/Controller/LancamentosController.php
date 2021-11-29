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
            if ($lancamento->subconta->conta->subgrupo->grupo == 'entrada') {
                $totals['entrada']['total'] += $lancamento->valor;
                $totals['total'] += $lancamento->valor;
            } else {
                $totals['saida']['total'] -= $lancamento->valor;
                $totals['total'] -= $lancamento->valor;
            }
        endforeach;

        return $totals;
    }
    public function teste()
    {
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
                    $date = 'data_baixa';
                    $query = "tipo = 'REALIZADO'";
                    break;

                    case 'PREVISTO':
                    $date = 'data_vencimento';
                    $query = "tipo = 'PREVISTO'";
                    break;

                default:
                $request[2] = 'created';
                break;
            }
            $request[1] = new Time($request[1], 'UTC');
            $request[1] = $request[1]->i18nFormat('yyyy-MM');
            $obj = [];
            $total = 0;
            $this->loadModel('Subcontas');
            $subcontas = $this->Subcontas->find('all', ['contain' => ['Contas' => ['Subgrupos' => ['Grupos']]]]);
            $lancamentos = $this->Lancamentos->find('all', [
                'contain' => ['Subcontas', 'Fornecedores', 'Clientes'],
                'conditions' => [$query . $renovados['and']]
            ]);
            foreach ($subcontas as $c) :
                $valor = 0;
                foreach ($lancamentos as $l) :
                    if ($l->$date->i18nFormat('yyyy-MM') == $request[1]) {
                        switch ($c->conta->subgrupo->grupo->grupo) {
                            case 'entrada':
                                $valor += $l->valor;
                                $totals['entrada'] += $l->valor;
                                $totals['total'] += $l->valor;
                                break;

                                case 'saida':
                                    $valor -= $l->valor;
                                    $totals['saida'] -= $l->valor;
                                    $totals['total'] -= $l->valor;
                                    break;
                                }
                    }
                endforeach;
                $c->conta->subgrupo->grupo->grupo == 'entrada' ? $total += $valor : $total += $valor;
                array_push($obj, [$c->conta->subgrupo->grupo->grupo == 'entrada' ? 'recebimento' : 'pagamento', $c->subconta, $valor]);
            endforeach;

            $this->response = $this->response->withType('application/json')
            ->withStringBody(json_encode([$obj, $total, $totals]));
            return $this->response;
        } else if ($this->request->is('get')) {
            $obj = [];
            $total = 0;
            $this->loadModel('Subcontas');
            $subcontas = $this->Subcontas->find('all', ['contain' => ['Contas' => ['Subgrupos' => ['Grupos']]]]);
            $lancamentos = $this->Lancamentos->find('all', [
                'contain' => ['Subcontas', 'Fornecedores', 'Clientes'],
                'conditions' => [$query . $renovados['and']]
            ]);
            foreach ($subcontas as $c) :
                $valor = 0;
                foreach ($lancamentos as $l) :
                    switch ($c->conta->subgrupo->grupo->grupo) {
                        case 'entrada':
                            $valor += $l->valor;
                            $totals['entrada'] += $l->valor;
                            $totals['total'] += $l->valor;
                            break;

                        case 'saida':
                            $valor -= $l->valor;
                            $totals['saida'] -= $l->valor;
                            $totals['total'] -= $l->valor;
                            break;
                    }
                endforeach;
                $c->conta->subgrupo->grupo->grupo == 'entrada' ? $total += $valor : $total += $valor;
                array_push($obj, [$c->conta->subgrupo->grupo->grupo == 'entrada' ? 'recebimento' : 'pagamento', $c->subconta, $valor]);
            endforeach;
            // debug($obj);
            // exit;
            $this->response = $this->response->withType('application/json')
                ->withStringBody(json_encode([$obj, $total, $totals]));
            return $this->response;
        }
    }

    public function painel()
    {
    }

    public function index()
    {
        $renovados = $this->getrenovado();

        $lancamentos = $this->paginate($this->Lancamentos);
        $lancamentos = $this->Lancamentos->find('all', ['conditions' => [$renovados['simple']], 'contain' => ['Subcontas', 'Fornecedores', 'Clientes']]);
        $now = FrozenTime::now()->i18nFormat('yyyy-MM-dd', 'UTC');

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
            'contain' => ['Subcontas', 'Fornecedores', 'Clientes', 'Lancamentos', 'Caixaregistros', 'Comprovantes'],
        ]);
        if ($lancamento->lancamento_id != null) {

            $lancamento->lancamentos = $this->Lancamentos->get($lancamento->lancamento_id, [
                'contain' => ['Subcontas', 'Fornecedores', 'Clientes', 'Caixaregistros', 'Comprovantes'],
            ]);
            $lancamento->lancamentos = [];
            for ($id = $lancamento->lancamento_id; $id != null; $id) {
                array_push($lancamento->lancamentos, $this->Lancamentos->get($id, [
                    'contain' => ['Subcontas', 'Fornecedores', 'Clientes', 'Caixaregistros', 'Comprovantes'],
                ]));
                $id = $lancamento->lancamentos[array_key_last($lancamento->lancamentos)]->lancamento_id;
            }
        }
        $this->set(compact('lancamento'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */

    public function add()
    {
        $this->loadModel('Comprovantes');
        $lancamento = $this->Lancamentos->newEmptyEntity();
        if ($this->request->is('post')) {

            if (($lancamento->tipo == 'REALIZADO') && !($this->caixaaberto())) {
                $this->Flash->error(__('Não pode ser criado pois o caixa está fechado.'));
                return $this->redirect(['action' => 'add']);
            }

            $image = $this->request->getData('Comprovante');
            $name = $image->getClientFilename();
            $tipo = explode('.', $name);
            $nome = $tipo[0];
            $tipo = end($tipo);
            $targetpath = WWW_ROOT . 'img/uploads/' . DS . $name;
            if ($name)
            $image->moveTo($targetpath);
            $comprovantes = $this->Comprovantes->newEmptyEntity();
            $comprovantes->img = $name;
            $comprovantes->tipo = $tipo;
            if ($name == '') {
                $name = null;
            }

            $comprovantes->nome_arquivo = $nome;

            $request = $this->request->getData();
            $request['parcela'] == null ? $lancamento->parcela = 1 : '';
            $lancamento = $this->Lancamentos->patchEntity($lancamento, $request);
            if($request['parcela'] > 1 && $request['parcela'] !== null && $request['tipo'] == 'PREVISTO'){
                $request['valor'] = $request['valor']/$request['parcela'];
                $request['parcela'] = intval($request['parcela']);
                for(intval($request['parcela']); $request['parcela'] >= 1; $request['parcela']--){
                    $parcela = $this->Lancamentos->newEntity($request);
                    $parcela->data_vencimento = $parcela->data_vencimento->addMonth($request['parcela']);
                    if (($this->Lancamentos->save($parcela))) {
                        $comprovantes->lancamento_id = $lancamento->id_lancamento;
                    } else{
                        $this->Flash->error(__('Ocorreu um erro ao criar as parcelas'));
                        return $this->redirect(['action' => 'add']);
                    }
                }
            } else {
                if (($this->Lancamentos->save($lancamento))) {
                    $comprovantes->lancamento_id = $lancamento->id_lancamento;
                } else{
                    $this->Flash->error(__('Ocorreu um erro ao criar as parcelas'));
                    return $this->redirect(['action' => 'add']);
                }
            }
            if ($lancamento->tipo == 'REALIZADO') {
                if ($name != null) {
                    if (($this->Comprovantes->save($comprovantes))) {
                        $this->Flash->success(__('Lançamento adicionado com sucesso'));
                        return $this->redirect(['action' => 'add']);
                    }
                } else {
                    $this->Flash->success(__('Lançamento adicionado com sucesso'));
                    return $this->redirect(['action' => 'add']);
                }
            } else {
                $this->Flash->success(__('Lançamento adicionado com sucesso'));
                return $this->redirect(['action' => 'add']);
            }

            $this->Flash->error(__('Lançamento não foi adicionado, por favor tente novamente.'));
        }

        $entradas = $this->Lancamentos->Subcontas->find('list', [
            'contain' => ['Contas' => ['Subgrupos' => ['Grupos']]],
            'conditions' => ['Grupos.grupo' => 'entrada'],
            // 'valueField' => function ($d) {
            //     if ($d->fluxosubgrupo->subgrupo == 'Entrada') {
            //         return $d->conta;
            //     }
            //     return $d->conta->subgrupo->grupo->grupo . ' de ' .
            //         $d->fluxosubgrupo->subgrupo . ' ' .
            //         $d->conta;
            // }

        ]);

        $saidas = $this->Lancamentos->Subcontas->find('list', [
            'contain' => ['Contas' => ['Subgrupos' => ['Grupos']]],
            'conditions' => ['Grupos.grupo' => 'saida'],
            // 'valueField' => function ($d) {
            //     if ($d->fluxosubgrupo->subgrupo == 'Saida') {
            //         return $d->conta;
            //     }
            //     return  $d->conta->subgrupo->grupo->grupo . ' de ' .
            //         $d->fluxosubgrupo->subgrupo . ' ' .
            //         $d->conta;
            // }
        ]);
        $todos = $this->Lancamentos->Subcontas->find('list', [
            'contain' => ['Contas' => ['Subgrupos' => ['Grupos']]],
            // 'valueField' => function ($d) {
            //     return  $d->conta->subgrupo->grupo->grupo . ' de ' .
            //         $d->fluxosubgrupo->subgrupo . ' ' .
            //         $d->conta;
            // }
        ]);

        // $variaveis = $this->Lancamentos->Drecontas->find('list', [
        //     'contain' => ['Dregrupos'],
        //     'conditions' => ['Dregrupos.grupo' => 'variavel'],
        // ]);

        // $fixos = $this->Lancamentos->Drecontas->find('list', [
        //     'contain' => ['Dregrupos'],
        //     'conditions' => ['Dregrupos.grupo' => 'fixo'],
        // ]);

        // $receitas = $this->Lancamentos->Drecontas->find('list', [
        //     'contain' => ['Dregrupos'],
        //     'conditions' => ['Dregrupos.grupo' => 'receita'],
        // ]);
        $fornecedores = $this->Lancamentos->Fornecedores->find('list', ['limit' => 200]);
        $clientes = $this->Lancamentos->Clientes->find('list', ['limit' => 200]);
        $subcontas = $this->Lancamentos->Subcontas->find('list', ['limit' => 200]);
        // $dregrupos = $this->Lancamentos->Drecontas->Dregrupos->find('list', ['limit' => 200]);
        $Grupos = $this->Lancamentos->Subcontas->Contas->Subgrupos->Grupos->find('list', ['limit' => 200]);
        $grupos = ['PREVISTO', 'REALIZADO'];
        $this->set(compact('lancamento', 'fornecedores', 'clientes', 'grupos', 'subcontas', 'Grupos', 'entradas', 'saidas', 'todos'));
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
            $lancamento2->tipo = $lancamento->tipo;
            $lancamento2->descricao = $this->request->getData()['descricao'];
            $lancamento2->valor = $this->request->getData()['valor'];
            $lancamento2->data_emissao = $lancamento->data_emissao;
            $lancamento2->data_baixa = $lancamento->data_baixa;
            $lancamento2->data_vencimento = $this->request->getData()['data_vencimento'];
            $lancamento2->created = $lancamento->created;
            $lancamento2->modified = $lancamento->modified;
            $lancamento2->subconta_id = $lancamento->subconta_id;
            $lancamento2->fornecedor_id = $lancamento->fornecedor_id;
            $lancamento2->cliente_id = $lancamento->cliente_id;
            $lancamento2->lancamento_id = $lancamento->id_lancamento;

            if ($this->Lancamentos->save($lancamento2)) {
                $this->Flash->success(__('Lançamento editado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('O Lançamento não foi editado, por favor tente novamente.'));
        }
        $subcontas = $this->Lancamentos->Subcontas->find('list', ['limit' => 200]);
        $fornecedores = $this->Lancamentos->Fornecedores->find('list', ['limit' => 200]);
        $clientes = $this->Lancamentos->Clientes->find('list', ['limit' => 200]);
        $lancamentos = $this->Lancamentos->find('list', ['limit' => 200]);
        $this->set(compact('lancamento', 'subcontas', 'fornecedores', 'clientes', 'lancamentos'));
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
        $subcontas = $this->Lancamentos->Subcontas->find('list', ['limit' => 200]);
        $fornecedores = $this->Lancamentos->Fornecedores->find('list', ['limit' => 200]);
        $clientes = $this->Lancamentos->Clientes->find('list', ['limit' => 200]);
        $lancamentos = $this->Lancamentos->find('list', ['limit' => 200]);
        $this->set(compact('lancamento', 'subcontas', 'fornecedores', 'clientes', 'lancamentos'));
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
        $this->loadModel('Caixaregistros');
        $this->loadModel('Comprovantes');
        $registros = $this->Caixaregistros->find('all')->where(['lancamento_id' => $id])->toArray();
        $comprovantes = $this->Comprovantes->find('all')->where(['lancamento_id' => $id])->toArray();
        $lancamento = $this->Lancamentos->get($id);
        if(!empty($registros)  || !empty($comprovantes)){
            foreach($registros as $registro):
                if (!$this->Caixaregistros->delete($registro)) {
                    $this->Flash->error(__('O Lançamento não foi deletado, por favor tente novamente.'));
                }
            endforeach;
            foreach($comprovantes as $comprovante):
                if (!$this->Comprovantes->delete($comprovante)) {
                    $this->Flash->error(__('O Lançamento não foi deletado, por favor tente novamente.'));
                }
            endforeach;
        }
        if ($this->Lancamentos->delete($lancamento)) {
            $this->Flash->success(__('Lançamento deletado com sucesso.'));
        } else {
            $this->Flash->error(__('O Lançamento não foi deletado, por favor tente novamente.'));
        }



        return $this->redirect(['action' => 'index']);
    }
}
