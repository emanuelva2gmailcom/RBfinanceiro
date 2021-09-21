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
        $lancamento = $this->Lancamentos->newEmptyEntity();
        if ($this->request->is('post')) {
            $lancamento = $this->Lancamentos->patchEntity($lancamento, $this->request->getData());
            if(($lancamento->tipo == 'REALIZADO') && !($this->caixaaberto())){
                $this->Flash->error(__('Não pode ser criado pois o caixa está fechado.'));

                return $this->redirect(['action' => 'add']);
            }
            if ($this->Lancamentos->save($lancamento)) {
                $this->Flash->success(__('Lançamento adicionado com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Lançamento não foi adicionado, por favor tente novamente.'));
        }
        $fluxocontas = $this->Lancamentos->Fluxocontas->find('list', ['limit' => 200]);
        $fornecedores = $this->Lancamentos->Fornecedores->find('list', ['limit' => 200]);
        $clientes = $this->Lancamentos->Clientes->find('list', ['limit' => 200]);
        $drecontas = $this->Lancamentos->Drecontas->find('list', ['limit' => 200]);
        $grupos = ['PREVISTO','REALIZADO'];
        $this->set(compact('lancamento', 'fluxocontas', 'fornecedores', 'clientes', 'drecontas','grupos'));
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
        $grupos = ['PREVISTO','REALIZADO'];
        $this->set(compact('lancamento', 'fluxocontas', 'fornecedores', 'clientes', 'drecontas','lancamentos','grupos'));
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
