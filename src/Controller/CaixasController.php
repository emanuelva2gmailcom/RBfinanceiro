<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Caixas Controller
 *
 * @property \App\Model\Table\CaixasTable $Caixas
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CaixasController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $caixas = $this->paginate($this->Caixas);

        $this->set(compact('caixas'));
    }

    /**
     * View method
     *
     * @param string|null $id Caixa id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $caixa = $this->Caixas->get($id, [
            'contain' => ['Caixaregistros'],
        ]);

        $this->set(compact('caixa'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $caixa = $this->Caixas->newEmptyEntity();
        if ($this->request->is('post')) {
            $caixa = $this->Caixas->patchEntity($caixa, $this->request->getData());
            if ($this->Caixas->save($caixa)) {
                $this->Flash->success(__('The caixa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The caixa could not be saved. Please, try again.'));
        }
        $this->set(compact('caixa'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Caixa id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $caixa = $this->Caixas->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $caixa = $this->Caixas->patchEntity($caixa, $this->request->getData());
            if ($this->Caixas->save($caixa)) {
                $this->Flash->success(__('The caixa has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The caixa could not be saved. Please, try again.'));
        }
        $this->set(compact('caixa'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Caixa id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $caixa = $this->Caixas->get($id);
        if ($this->Caixas->delete($caixa)) {
            $this->Flash->success(__('The caixa has been deleted.'));
        } else {
            $this->Flash->error(__('The caixa could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }


    public function abrir($now = null)
    {
        $caixas = $this->paginate($this->Caixas);
        $data = [
            'is_aberto' => '1',
            'data_caixa' => $now
        ];
        foreach ($caixas as $caixa) :
            if (($now == $caixa->data_caixa) && ($caixa->is_aberto == true)) {
                $caixa = $this->Caixas->patchEntity($caixa, ['is_aberto' => false]);
                $this->Caixas->save($caixa);
                $this->Flash->error(__('Caixa fechado.'));
                return $this->redirect(['action' => 'index']);
            } else if (($now == $caixa->data_caixa) && ($caixa->is_aberto == false)) {
                $this->Flash->error(__('Caixa já fechado.'));
                return $this->redirect(['action' => 'index']);
            }
        endforeach;
        $caixa = $this->Caixas->newEmptyEntity();
        $caixa->is_aberto = true;
        $caixa->data_caixa = $now;
        if ($this->Caixas->save($caixa)) {
            $this->Flash->success(__('Caixa aberto.'));

            return $this->redirect(['controller' => 'Caixas', 'action' => 'index']);
        }
    }

    public function caixaaberto()
    {
        $this->loadModel('Caixas');
        $now = date('d-m-Y');
        $caixas = $this->paginate($this->Caixas);
        foreach ($caixas as $caixa) :
            if (($now == $caixa->data_caixa) && ($caixa->is_aberto == true)) {
                return $caixa->id_caixa;
                return $caixa->is_aberto;
            }
        endforeach;
        return false;
    }

}
