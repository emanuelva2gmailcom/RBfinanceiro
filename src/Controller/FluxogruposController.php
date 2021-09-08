<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Fluxogrupos Controller
 *
 * @property \App\Model\Table\FluxogruposTable $Fluxogrupos
 * @method \App\Model\Entity\Fluxogrupo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class FluxogruposController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $fluxogrupos = $this->paginate($this->Fluxogrupos);

        $this->set(compact('fluxogrupos'));
    }

    /**
     * View method
     *
     * @param string|null $id Fluxogrupo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $fluxogrupo = $this->Fluxogrupos->get($id, [
            'contain' => ['Fluxosubgrupos'],
        ]);

        $this->set(compact('fluxogrupo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $fluxogrupo = $this->Fluxogrupos->newEmptyEntity();
        if ($this->request->is('post')) {
            $fluxogrupo = $this->Fluxogrupos->patchEntity($fluxogrupo, $this->request->getData());
            if ($this->Fluxogrupos->save($fluxogrupo)) {
                $this->Flash->success(__('The fluxogrupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fluxogrupo could not be saved. Please, try again.'));
        }
        $this->set(compact('fluxogrupo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Fluxogrupo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $fluxogrupo = $this->Fluxogrupos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $fluxogrupo = $this->Fluxogrupos->patchEntity($fluxogrupo, $this->request->getData());
            if ($this->Fluxogrupos->save($fluxogrupo)) {
                $this->Flash->success(__('The fluxogrupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The fluxogrupo could not be saved. Please, try again.'));
        }
        $this->set(compact('fluxogrupo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Fluxogrupo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $fluxogrupo = $this->Fluxogrupos->get($id);
        if ($this->Fluxogrupos->delete($fluxogrupo)) {
            $this->Flash->success(__('The fluxogrupo has been deleted.'));
        } else {
            $this->Flash->error(__('The fluxogrupo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
