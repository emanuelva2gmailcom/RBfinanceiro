<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fornecedores Controller
 *
 * @property \App\Model\Table\FornecedoresTable $Fornecedores
 * @method \App\Model\Entity\Fornecedore[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FornecedoresController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $fornecedores = $this->paginate($this->Fornecedores);

        $this->set(compact('fornecedores'));
    }

    /**
     * View method
     *
     * @param string|null $id Fornecedore id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fornecedore = $this->Fornecedores->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('fornecedore'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fornecedore = $this->Fornecedores->newEmptyEntity();
        if ($this->request->is('post')) {
            $fornecedore = $this->Fornecedores->patchEntity($fornecedore, $this->request->getData());
            if ($this->Fornecedores->save($fornecedore)) {
                $this->Flash->success(__('Fornecedor adicionado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Fornecedor não foi adicionado, tente novamente.'));
        }
        $this->set(compact('fornecedore'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fornecedore id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fornecedore = $this->Fornecedores->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fornecedore = $this->Fornecedores->patchEntity($fornecedore, $this->request->getData());
            if ($this->Fornecedores->save($fornecedore)) {
                $this->Flash->success(__('Fornecedor editado com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Fornecedor não editado, tente novamente.'));
        }
        $this->set(compact('fornecedore'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fornecedore id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fornecedore = $this->Fornecedores->get($id);
        if ($this->Fornecedores->delete($fornecedore)) {
            $this->Flash->success(__('Fornecedor deletado com sucesso'));
        } else {
            $this->Flash->error(__('Fornecedor não deletado, tente novamente'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
