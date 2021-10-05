<?php

declare(strict_types=1);
namespace App\Controller;
use Cake\I18n\FrozenTime;
use Cake\I18n\Time;

/**
 * Lancamentos Controller
 *
 * @property \App\Model\Table\LancamentosTable $Lancamentos
 * @method \App\Model\Entity\Lancamento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class LancamentosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */

    public function getPainel()
    {
        if($this->request->is('post')){
            $this->response = $this->response;
            $this->response = $this->response
                ->withHeader('Access-Control-Allow-Origin','*')
                ->withHeader('Access-Control-Allow-Methods', '*')
                ->withHeader('Access-Control-Allow-Credentials', 'true')
                ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With')
                ->withHeader('Access-Control-Allow-Headers', 'Content-Type')
                ->withHeader('Access-Control-Allow-Type', 'application/json');
            $this->response = $this->response->withType('application/json')
                ->withStringBody(json_encode('cu'));
            return $this->response;
        }
        $obj = [
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
        $this->paginate = [
            'contain' => ['Fluxocontas' => ['Fluxosubgrupos' => ['Fluxogrupos']], 'Fornecedores', 'Clientes', 'Drecontas'],
        ];
        $lancamentos = $this->paginate($this->Lancamentos);
        foreach($lancamentos as $lancamento):
            if($lancamento->fluxoconta->fluxosubgrupo->fluxogrupo->grupo == 'entrada'){
                array_push($obj['entrada']['entradas'], $lancamento);
                $obj['entrada']['total'] += $lancamento->valor;
                $obj['total'] += $lancamento->valor;
            }else{
                array_push($obj['saida']['saidas'], $lancamento);
                $obj['saida']['total'] -= $lancamento->valor;
                $obj['total'] -= $lancamento->valor;
            }
        endforeach;
        $this->response = $this->response;
        $this->response = $this->response
            ->withHeader('Access-Control-Allow-Origin','*')
            ->withHeader('Access-Control-Allow-Methods', '*')
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type')
            ->withHeader('Access-Control-Allow-Type', 'application/json');
        $this->response = $this->response->withType('application/json')
            ->withStringBody(json_encode($obj));
        return $this->response;
    }

    public function getTablePainel($request = null)
    {
        $query = "tipo = 'REALIZADO' or tipo = 'PREVISTO'";
        if($request != null){
            switch ($request['tipo']) {
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
            // debug($query);exit;
            $request['mes'] = new Time($request['mes'], 'UTC');
            $obj = [
            ];
            $total = 0;
            $this->loadModel('Fluxocontas');
            $contas = $this->Fluxocontas->find('all',['contain' => ['Fluxosubgrupos' => ['Fluxogrupos']]]);
            $lancamentos = $this->Lancamentos->find('all', ['contain' => ['Fluxocontas', 'Fornecedores', 'Clientes', 'Drecontas'],
            'conditions' => [$query]]);
            foreach($contas as $c):
                $valor = 0;
                foreach($lancamentos as $l):
                    if($c->conta == $l->fluxoconta->conta && $l->created->i18nFormat('yyyy-MM') == $request['mes']->i18nFormat('yyyy-MM')){
                        // debug($l->created->i18nFormat('yyyy-MM') == $request['mes']->i18nFormat('yyyy-MM'));
                        $c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? $valor += $l->valor : $valor -= $l->valor;
                    }
                endforeach;
                $c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? $total += $valor : $total += $valor;
                array_push($obj, [$c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? 'recebimento' : 'pagamento', $c->conta, $valor]);
            endforeach;
            return [$obj, $total];
        } else{
            $obj = [
            ];
            $total = 0;
            $this->loadModel('Fluxocontas');
            $contas = $this->Fluxocontas->find('all',['contain' => ['Fluxosubgrupos' => ['Fluxogrupos']]]);
            $lancamentos = $this->Lancamentos->find('all', ['contain' => ['Fluxocontas', 'Fornecedores', 'Clientes', 'Drecontas'],
            'conditions' => [$query]]);
            foreach($contas as $c):
                $valor = 0;
                foreach($lancamentos as $l):
                    if($c->conta == $l->fluxoconta->conta){
                        $c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? $valor += $l->valor : $valor -= $l->valor;
                    }
                endforeach;
                $c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? $total += $valor : $total += $valor;
                array_push($obj, [$c->fluxosubgrupo->fluxogrupo->grupo == 'entrada' ? 'recebimento' : 'pagamento', $c->conta, $valor]);
            endforeach;
            return [$obj, $total];
        }
    }

    public function painel()
    {
        if($this->request->is('post')){
            
            $obj = $this->getTablePainel($this->request->getData())[0];
            $total = $this->getTablePainel($this->request->getData())[1];
            // debug($obj);exit;
            $this->set(compact('obj', 'total'));
        }
        if($this->request->is('get')){
            $obj = $this->getTablePainel()[0];
            $total = $this->getTablePainel()[1];
    
            $this->set(compact('obj', 'total'));
        }
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Fluxocontas', 'Fornecedores', 'Clientes', 'Drecontas'],
        ];
        $lancamentos = $this->paginate($this->Lancamentos);

        $this->set(compact('lancamentos'));
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
        
        $fluxocontas = $this->Lancamentos->Fluxocontas->find('list', ['limit' => 200]);
        $fornecedores = $this->Lancamentos->Fornecedores->find('list', ['limit' => 200]);
        $clientes = $this->Lancamentos->Clientes->find('list', ['limit' => 200]);
        $drecontas = $this->Lancamentos->Drecontas->find('list', ['limit' => 200]);
        $grupos = ['PREVISTO', 'REALIZADO'];
        $this->set(compact('lancamento', 'fluxocontas', 'fornecedores', 'clientes', 'drecontas', 'grupos','fluxocontas'));
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


?>