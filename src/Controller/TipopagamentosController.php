<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Tipopagamentos Controller
 *
 * @property \App\Model\Table\TipopagamentosTable $Tipopagamentos
 * @method \App\Model\Entity\Tipopagamento[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TipopagamentosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $tipopagamentos = $this->paginate($this->Tipopagamentos);

        $this->set(compact('tipopagamentos'));
    }

    /**
     * View method
     *
     * @param string|null $id Tipopagamento id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $tipopagamento = $this->Tipopagamentos->get($id, [
            'contain' => ['Caixaregistros'],
        ]);

        $this->set(compact('tipopagamento'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $tipopagamento = $this->Tipopagamentos->newEmptyEntity();
        if ($this->request->is('post')) {
            $tipopagamento = $this->Tipopagamentos->patchEntity($tipopagamento, $this->request->getData());
            if ($this->Tipopagamentos->save($tipopagamento)) {
                $this->Flash->success(__('The tipopagamento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipopagamento could not be saved. Please, try again.'));
        }
        $this->set(compact('tipopagamento'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Tipopagamento id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $tipopagamento = $this->Tipopagamentos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipopagamento = $this->Tipopagamentos->patchEntity($tipopagamento, $this->request->getData());
            if ($this->Tipopagamentos->save($tipopagamento)) {
                $this->Flash->success(__('The tipopagamento has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The tipopagamento could not be saved. Please, try again.'));
        }
        $this->set(compact('tipopagamento'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Tipopagamento id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tipopagamento = $this->Tipopagamentos->get($id);
        if ($this->Tipopagamentos->delete($tipopagamento)) {
            $this->Flash->success(__('The tipopagamento has been deleted.'));
        } else {
            $this->Flash->error(__('The tipopagamento could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
