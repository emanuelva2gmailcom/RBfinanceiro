<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Drecontas Controller
 *
 * @property \App\Model\Table\DrecontasTable $Drecontas
 * @method \App\Model\Entity\Dreconta[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class DrecontasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Dregrupos'],
        ];
        $drecontas = $this->paginate($this->Drecontas);

        $this->set(compact('drecontas'));
    }

    /**
     * View method
     *
     * @param string|null $id Dreconta id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $dreconta = $this->Drecontas->get($id, [
            'contain' => ['Dregrupos', 'Lancamentos'],
        ]);

        $this->set(compact('dreconta'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $dreconta = $this->Drecontas->newEmptyEntity();
        if ($this->request->is('post')) {
            $dreconta = $this->Drecontas->patchEntity($dreconta, $this->request->getData());
            if ($this->Drecontas->save($dreconta)) {
                $this->Flash->success(__('Conta adicionado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Conta não foi adicionado, por favor tente novamente.'));
        }
        $dregrupos = $this->Drecontas->Dregrupos->find('list', ['limit' => 200]);
        $this->set(compact('dreconta', 'dregrupos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Dreconta id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $dreconta = $this->Drecontas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $dreconta = $this->Drecontas->patchEntity($dreconta, $this->request->getData());
            if ($this->Drecontas->save($dreconta)) {
                $this->Flash->success(__('Conta editado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Conta não foi editado, por favor tente novamente.'));
        }
        $dregrupos = $this->Drecontas->Dregrupos->find('list', ['limit' => 200]);
        $this->set(compact('dreconta', 'dregrupos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Dreconta id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $dreconta = $this->Drecontas->get($id);
        if ($this->Drecontas->delete($dreconta)) {
            $this->Flash->success(__('Conta deletado com sucesso.'));
        } else {
            $this->Flash->error(__('Conta não foi deletado, tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
