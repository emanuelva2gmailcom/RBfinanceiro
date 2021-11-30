<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Subcontas Controller
 *
 * @property \App\Model\Table\SubcontasTable $Subcontas
 * @method \App\Model\Entity\Subconta[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubcontasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Contas'],
        ];
        $subcontas = $this->paginate($this->Subcontas);

        $this->set(compact('subcontas'));
    }

    /**
     * View method
     *
     * @param string|null $id Subconta id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subconta = $this->Subcontas->get($id, [
            'contain' => ['Contas', 'Lancamentos'],
        ]);
        
        $this->set(compact('subconta'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subconta = $this->Subcontas->newEmptyEntity();
        if ($this->request->is('post')) {
            $subconta = $this->Subcontas->patchEntity($subconta, $this->request->getData());
            if ($this->Subcontas->save($subconta)) {
                $this->Flash->success(__('The subconta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subconta could not be saved. Please, try again.'));
        }
        $contas = $this->Subcontas->Contas->find('list', ['limit' => 200]);
        $this->set(compact('subconta', 'contas'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subconta id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subconta = $this->Subcontas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subconta = $this->Subcontas->patchEntity($subconta, $this->request->getData());
            if ($this->Subcontas->save($subconta)) {
                $this->Flash->success(__('The subconta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subconta could not be saved. Please, try again.'));
        }
        $contas = $this->Subcontas->Contas->find('list', ['limit' => 200]);
        $this->set(compact('subconta', 'contas'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subconta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subconta = $this->Subcontas->get($id);
        if ($this->Subcontas->delete($subconta)) {
            $this->Flash->success(__('The subconta has been deleted.'));
        } else {
            $this->Flash->error(__('The subconta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
