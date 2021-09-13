<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Dregrupos Controller
 *
 * @property \App\Model\Table\DregruposTable $Dregrupos
 * @method \App\Model\Entity\Dregrupo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DregruposController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $dregrupos = $this->paginate($this->Dregrupos);

        $this->set(compact('dregrupos'));
    }

    /**
     * View method
     *
     * @param string|null $id Dregrupo id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dregrupo = $this->Dregrupos->get($id, [
            'contain' => ['Drecontas'],
        ]);

        $this->set(compact('dregrupo'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dregrupo = $this->Dregrupos->newEmptyEntity();
        if ($this->request->is('post')) {
            $dregrupo = $this->Dregrupos->patchEntity($dregrupo, $this->request->getData());
            if ($this->Dregrupos->save($dregrupo)) {

                $this->Flash->success(__('DREgrupo salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('DREgrupo não foi salvo, tente novamente'));

                $this->Flash->success(__('Grupo adicionada com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Grupo não foi adicionada, tente novamente'));

        }
        $this->set(compact('dregrupo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dregrupo id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dregrupo = $this->Dregrupos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dregrupo = $this->Dregrupos->patchEntity($dregrupo, $this->request->getData());
            if ($this->Dregrupos->save($dregrupo)) {

                $this->Flash->success(__('DREgrupo salvo com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('DREgrupo não foi salvo, tente novamente'));

                $this->Flash->success(__('Grupo editada com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Grupo não foi editada, tente novamente'));

        }
        $this->set(compact('dregrupo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dregrupo id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dregrupo = $this->Dregrupos->get($id);
        if ($this->Dregrupos->delete($dregrupo)) {

            $this->Flash->success(__('DREgrupo deletado com sucesso.'));
        } else {
            $this->Flash->error(__('DREgrupo não foi deletado, tente novamente'));
    $this->Flash->success(__('Grupo deletada com sucesso'));
        } else {
            $this->Flash->error(__('Grupo não foi deletada, tente novamente'));

        }

        return $this->redirect(['action' => 'index']);
    }
}
