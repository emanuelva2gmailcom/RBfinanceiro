<?php

declare(strict_types=1);

namespace App\Controller;

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

    public function painel()
    {

        $obj = [
        ];
        $total = 0;
        $this->paginate = [
            'contain' => ['Fluxocontas', 'Fornecedores', 'Clientes', 'Drecontas'],
        ];
        $this->loadModel('Fluxocontas');
        $contas = $this->Fluxocontas->find('all',['contain' => ['Fluxosubgrupos' => ['Fluxogrupos']]]);
        $lancamentos = $this->paginate($this->Lancamentos);
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
        $this->set(compact('obj', 'total'));
    }

    public function index()
    {
        $this->paginate = [
            'contain' => ['Fluxocontas', 'Fornecedores', 'Clientes', 'Drecontas'],
        ];
        $lancamentos = $this->paginate($this->Lancamentos);

        $this->set(compact('lancamentos'));
    }

    public function previsto()
    {
        $lancamento = $this->Lancamentos->newEmptyEntity();
        if ($this->request->is('post')) {
           if(($lancamento->tipo == 'PREVISTO')) { ?>
            <script>
                function mudar(prev) {
                    var display = document.getElementById(prev).style.display;
                    if(display == "none")
                        document.getElementById(prev).style.display = 'block';
                    else
                        document.getElementById(prev).style.display = 'none';
                }

                mudar();
            </script>
            <?php }else{ ?>
            <script>
                function mudar(real) {
                    var display = document.getElementById(real).style.display;
                    if(display == "none")
                        document.getElementById(real).style.display = 'block';
                    else
                        document.getElementById(real).style.display = 'none';
                }

                mudar();
            </script>
            <?php }
         }


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
        $comprovantes = $this->paginate($this->Comprovantes);
        $lancamento = $this->Lancamentos->newEmptyEntity();
        if ($this->request->is('post')) {
            $lancamento = $this->Lancamentos->patchEntity($lancamento, $this->request->getData());
            if (!$lancamento->getErrors()) {
                $image = $this->request->getData('uploadfiles');
                $name = $image->getClientFilename();
                $targetpath = WWW_ROOT.'img/uploads/'.DS.$name;
                if($name)
                $image->moveTo($targetpath);
                $comprovantes = $this->Comprovantes->newEmptyEntity();
                $comprovantes->img = $name;
            }
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
        $this->set(compact('lancamento', 'fluxocontas', 'fornecedores', 'clientes', 'drecontas', 'grupos'));
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
