<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Caixas Controller
 *
 * @property \App\Model\Table\CaixasTable $Caixas
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CaixasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $caixas = $this->paginate($this->Caixas);

        $this->set(compact('caixas'));
    }

    /**
     * View method
     *
     * @param string|null $id Caixa id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $caixa = $this->Caixas->get($id, [
            'contain' => ['Caixaregistros'],
        ]);

        $this->set(compact('caixa'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $caixa = $this->Caixas->newEmptyEntity();
        if ($this->request->is('post')) {
            $caixa = $this->Caixas->patchEntity($caixa, $this->request->getData());
            if ($this->Caixas->save($caixa)) {
                $this->Flash->success(__('Caixa adicionado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Caixa não foi adicionado, por favor tente novamente.'));
        }
        $this->set(compact('caixa'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Caixa id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $caixa = $this->Caixas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $caixa = $this->Caixas->patchEntity($caixa, $this->request->getData());
            if ($this->Caixas->save($caixa)) {
                $this->Flash->success(__('Caixa editado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Caixa não foi editado, por favor tente novamente.'));
        }
        $this->set(compact('caixa'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Caixa id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $caixa = $this->Caixas->get($id);
        if ($this->Caixas->delete($caixa)) {
            $this->Flash->success(__('Caixa deletado com sucesso.'));
        } else {
            $this->Flash->error(__('Caixa não foi deletado, por favor tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
