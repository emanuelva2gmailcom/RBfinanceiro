<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fluxocontas Controller
 *
 * @property \App\Model\Table\FluxocontasTable $Fluxocontas
 * @method \App\Model\Entity\Fluxoconta[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FluxocontasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Fluxosubgrupos'],
        ];
        $fluxocontas = $this->paginate($this->Fluxocontas);

        $this->set(compact('fluxocontas'));
    }

    /**
     * View method
     *
     * @param string|null $id Fluxoconta id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fluxoconta = $this->Fluxocontas->get($id, [
            'contain' => ['Fluxosubgrupos', 'Lancamentos'],
        ]);

        $this->set(compact('fluxoconta'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fluxoconta = $this->Fluxocontas->newEmptyEntity();
        if ($this->request->is('post')) {
            $fluxoconta = $this->Fluxocontas->patchEntity($fluxoconta, $this->request->getData());
            if ($this->Fluxocontas->save($fluxoconta)) {
                $this->Flash->success(__('The fluxoconta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fluxoconta could not be saved. Please, try again.'));
        }
        $fluxosubgrupos = $this->Fluxocontas->Fluxosubgrupos->find('list', ['limit' => 200]);
        $this->set(compact('fluxoconta', 'fluxosubgrupos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fluxoconta id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fluxoconta = $this->Fluxocontas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fluxoconta = $this->Fluxocontas->patchEntity($fluxoconta, $this->request->getData());
            if ($this->Fluxocontas->save($fluxoconta)) {
                $this->Flash->success(__('The fluxoconta has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fluxoconta could not be saved. Please, try again.'));
        }
        $fluxosubgrupos = $this->Fluxocontas->Fluxosubgrupos->find('list', ['limit' => 200]);
        $this->set(compact('fluxoconta', 'fluxosubgrupos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fluxoconta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fluxoconta = $this->Fluxocontas->get($id);
        if ($this->Fluxocontas->delete($fluxoconta)) {
            $this->Flash->success(__('The fluxoconta has been deleted.'));
        } else {
            $this->Flash->error(__('The fluxoconta could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
