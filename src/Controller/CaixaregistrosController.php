<?php

declare(strict_types=1);

namespace App\Controller;

use Cake\I18n\FrozenTime;

/**
 * Caixaregistros Controller
 *
 * @property \App\Model\Table\CaixaregistrosTable $Caixaregistros
 * @method \App\Model\Entity\Caixaregistro[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CaixaregistrosController extends AppController
{
    // use FrozenTime;
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

    public function darbaixa($id = null)
    {

        $caixaregistro = $this->Caixaregistros->newEmptyEntity();
        if ($this->request->is('post')) {
            $caixaregistro = $this->Caixaregistros->patchEntity($caixaregistro, $this->request->getData());
            $this->efetuarbaixa($id, $this->request->getData());
        }
        $tipopagamentos = $this->Caixaregistros->Tipopagamentos->find('list', ['limit' => 200]);
        $this->set(compact('tipopagamentos', 'caixaregistro'));
    }

    public function efetuarbaixa($id = null, $request = null)
    {
        $data = [
            'lancamento_id' => $id,
            'tipopagamento_id' => $request['tipopagamento_id'],
            'caixa_id' => $this->caixaaberto()[0]
        ];
        $this->loadModel('Comprovantes');
        $comprovantes = $this->paginate($this->Comprovantes);
        $this->loadModel('Lancamentos');
        $lancamento = $this->Lancamentos->get($id);

        if ($lancamento->data_baixa !== null) {
            return $this->redirect(['controller' => 'lancamentos', 'action' => 'index']);
        }

        if ($lancamento->tipo !== 'REALIZADO' && ($this->caixaaberto()[1] == true)) {
            $comprovantes = $this->Comprovantes->newEmptyEntity();
            $caixaregistro = $this->Caixaregistros->newEmptyEntity();

            $image = $request['Comprovante'];
            $name = $image->getClientFilename();
            $targetpath = WWW_ROOT . 'img/uploads/' . DS . $name;
            $image->moveTo($targetpath);
            $comprovantes->img = $name;
            $comprovantes->lancamento_id = $lancamento->id_lancamento;

            $lancamento->data_baixa = FrozenTime::now();
            $lancamento->tipo = 'REALIZADO';
            $lancamento->data_competencia = $request['competencia'];

            $caixaregistro = $this->Caixaregistros->patchEntity($caixaregistro, $data);

            if (($this->Caixaregistros->save($caixaregistro)) && ($this->Lancamentos->save($lancamento)) && ($this->Comprovantes->save($comprovantes))) {
                $this->Flash->success(__('Caixa Registro adicionado com sucesso'));

                return $this->redirect(['controller' => 'Lancamentos', 'action' => 'index']);
            }
            $this->Flash->error(__('Caixa Registro não foi adicionado, por favor tente novamente.'));

        }
        $this->Flash->error(__('Caixa Fechado.'));
        return $this->redirect(['controller' => 'Lancamentos', 'action' => 'index']);
    }

}
