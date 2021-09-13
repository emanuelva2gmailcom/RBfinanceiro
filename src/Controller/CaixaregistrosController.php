<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Caixaregistros Controller
 *
 * @property \App\Model\Table\CaixaregistrosTable $Caixaregistros
 * @method \App\Model\Entity\Caixaregistro[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CaixaregistrosController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Caixas', 'Tipopagamentos', 'Lancamentos'],
        ];
        $caixaregistros = $this->paginate($this->Caixaregistros);

        $this->set(compact('caixaregistros'));
    }

    /**
     * View method
     *
     * @param string|null $id Caixaregistro id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $caixaregistro = $this->Caixaregistros->get($id, [
            'contain' => ['Caixas', 'Tipopagamentos', 'Lancamentos'],
        ]);

        $this->set(compact('caixaregistro'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $caixaregistro = $this->Caixaregistros->newEmptyEntity();
        if ($this->request->is('post')) {
            $caixaregistro = $this->Caixaregistros->patchEntity($caixaregistro, $this->request->getData());
            if ($this->Caixaregistros->save($caixaregistro)) {
                $this->Flash->success(__('Caixa Registro adicionado com sucesso'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Caixa Registro não foi adicionado, por favor tente novamente.'));
        }
        $caixas = $this->Caixaregistros->Caixas->find('list', ['limit' => 200]);
        $tipopagamentos = $this->Caixaregistros->Tipopagamentos->find('list', ['limit' => 200]);
        $lancamentos = $this->Caixaregistros->Lancamentos->find('list', ['limit' => 200]);
        $this->set(compact('caixaregistro', 'caixas', 'tipopagamentos', 'lancamentos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Caixaregistro id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $caixaregistro = $this->Caixaregistros->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $caixaregistro = $this->Caixaregistros->patchEntity($caixaregistro, $this->request->getData());
            if ($this->Caixaregistros->save($caixaregistro)) {
                $this->Flash->success(__('Caixa Registro editado com sucesso.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('Caixa Registro não foi editado, por favor tente novamente.'));
        }
        $caixas = $this->Caixaregistros->Caixas->find('list', ['limit' => 200]);
        $tipopagamentos = $this->Caixaregistros->Tipopagamentos->find('list', ['limit' => 200]);
        $lancamentos = $this->Caixaregistros->Lancamentos->find('list', ['limit' => 200]);
        $this->set(compact('caixaregistro', 'caixas', 'tipopagamentos', 'lancamentos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Caixaregistro id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $caixaregistro = $this->Caixaregistros->get($id);
        if ($this->Caixaregistros->delete($caixaregistro)) {
            $this->Flash->success(__('Caixa Registro deletado com sucesso.'));
        } else {
            $this->Flash->error(__('Caixa Registro não foi deletado, por favor tente novamente.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
