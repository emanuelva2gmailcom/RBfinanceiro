<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Comprovantes Controller
 *
 * @property \App\Model\Table\ComprovantesTable $Comprovantes
 * @method \App\Model\Entity\Comprovante[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ComprovantesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Lancamentos'],
        ];
        $comprovantes = $this->paginate($this->Comprovantes);

        $this->set(compact('comprovantes'));
    }

    /**
     * View method
     *
     * @param string|null $id Comprovante id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $comprovante = $this->Comprovantes->get($id, [
            'contain' => ['Lancamentos'],
        ]);

        $this->set(compact('comprovante'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $comprovante = $this->Comprovantes->newEmptyEntity();
        if ($this->request->is('post')) {
            $comprovante = $this->Comprovantes->patchEntity($comprovante, $this->request->getData());
            if ($this->Comprovantes->save($comprovante)) {
                $this->Flash->success(__('Comprovante adicionado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Comprovante não foi adicionado, tente novamente.'));
        }
        $lancamentos = $this->Comprovantes->Lancamentos->find('list', ['limit' => 200]);
        $this->set(compact('comprovante', 'lancamentos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Comprovante id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $comprovante = $this->Comprovantes->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $comprovante = $this->Comprovantes->patchEntity($comprovante, $this->request->getData());
            if ($this->Comprovantes->save($comprovante)) {
                $this->Flash->success(__('Comprovante editado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Comprovante não foi editado, tente novamente.'));
        }
        $lancamentos = $this->Comprovantes->Lancamentos->find('list', ['limit' => 200]);
        $this->set(compact('comprovante', 'lancamentos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Comprovante id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $comprovante = $this->Comprovantes->get($id);
        if ($this->Comprovantes->delete($comprovante)) {
            $this->Flash->success(__('Comprovante deletado com sucesso.'));
        } else {
            $this->Flash->error(__('Comprovante não foi deletado, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
