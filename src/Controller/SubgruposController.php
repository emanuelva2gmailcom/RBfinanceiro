<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Subgrupos Controller
 *
 * @property \App\Model\Table\SubgruposTable $Subgrupos
 * @method \App\Model\Entity\Subgrupo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SubgruposController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Grupos'],
        ];
        $subgrupos = $this->paginate($this->Subgrupos);

        $this->set(compact('subgrupos'));
    }

    /**
     * View method
     *
     * @param string|null $id Subgrupo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $subgrupo = $this->Subgrupos->get($id, [
            'contain' => ['Grupos', 'Contas'],
        ]);

        $this->set(compact('subgrupo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $subgrupo = $this->Subgrupos->newEmptyEntity();
        if ($this->request->is('post')) {
            $subgrupo = $this->Subgrupos->patchEntity($subgrupo, $this->request->getData());
            if ($this->Subgrupos->save($subgrupo)) {
                $this->Flash->success(__('The subgrupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subgrupo could not be saved. Please, try again.'));
        }
        $grupos = $this->Subgrupos->Grupos->find('list', ['limit' => 200]);
        $this->set(compact('subgrupo', 'grupos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Subgrupo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $subgrupo = $this->Subgrupos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $subgrupo = $this->Subgrupos->patchEntity($subgrupo, $this->request->getData());
            if ($this->Subgrupos->save($subgrupo)) {
                $this->Flash->success(__('The subgrupo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The subgrupo could not be saved. Please, try again.'));
        }
        $grupos = $this->Subgrupos->Grupos->find('list', ['limit' => 200]);
        $this->set(compact('subgrupo', 'grupos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Subgrupo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $subgrupo = $this->Subgrupos->get($id);
        if ($this->Subgrupos->delete($subgrupo)) {
            $this->Flash->success(__('The subgrupo has been deleted.'));
        } else {
            $this->Flash->error(__('The subgrupo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
