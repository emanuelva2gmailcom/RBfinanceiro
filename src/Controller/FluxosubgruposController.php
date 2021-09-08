<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fluxosubgrupos Controller
 *
 * @property \App\Model\Table\FluxosubgruposTable $Fluxosubgrupos
 * @method \App\Model\Entity\Fluxosubgrupo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FluxosubgruposController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Fluxogrupos'],
        ];
        $fluxosubgrupos = $this->paginate($this->Fluxosubgrupos);

        $this->set(compact('fluxosubgrupos'));
    }

    /**
     * View method
     *
     * @param string|null $id Fluxosubgrupo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fluxosubgrupo = $this->Fluxosubgrupos->get($id, [
            'contain' => ['Fluxogrupos', 'Fluxocontas'],
        ]);

        $this->set(compact('fluxosubgrupo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fluxosubgrupo = $this->Fluxosubgrupos->newEmptyEntity();
        if ($this->request->is('post')) {
            $fluxosubgrupo = $this->Fluxosubgrupos->patchEntity($fluxosubgrupo, $this->request->getData());
            if ($this->Fluxosubgrupos->save($fluxosubgrupo)) {
                $this->Flash->success(__('The fluxosubgrupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fluxosubgrupo could not be saved. Please, try again.'));
        }
        $fluxogrupos = $this->Fluxosubgrupos->Fluxogrupos->find('list', ['limit' => 200]);
        $this->set(compact('fluxosubgrupo', 'fluxogrupos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fluxosubgrupo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fluxosubgrupo = $this->Fluxosubgrupos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fluxosubgrupo = $this->Fluxosubgrupos->patchEntity($fluxosubgrupo, $this->request->getData());
            if ($this->Fluxosubgrupos->save($fluxosubgrupo)) {
                $this->Flash->success(__('The fluxosubgrupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fluxosubgrupo could not be saved. Please, try again.'));
        }
        $fluxogrupos = $this->Fluxosubgrupos->Fluxogrupos->find('list', ['limit' => 200]);
        $this->set(compact('fluxosubgrupo', 'fluxogrupos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fluxosubgrupo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fluxosubgrupo = $this->Fluxosubgrupos->get($id);
        if ($this->Fluxosubgrupos->delete($fluxosubgrupo)) {
            $this->Flash->success(__('The fluxosubgrupo has been deleted.'));
        } else {
            $this->Flash->error(__('The fluxosubgrupo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
