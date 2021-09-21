<?php
declare(strict_types=1);

namespace App\Controller;
use Cake\I18n\FrozenTime;
/**
 * Notifications Controller
 *
 * @property \App\Model\Table\NotificationsTable $Notifications
 * @method \App\Model\Entity\Notification[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NotificationsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Lancamentos'],
        ];
        $notifications = $this->paginate($this->Notifications);

        $this->set(compact('notifications'));
    }

    /**
     * View method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => ['Lancamentos'],
        ]);

        $this->set(compact('notification'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $notification = $this->Notifications->newEmptyEntity();
        if ($this->request->is('post')) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->getData());
            $notification->data->i18nFormat('yyyy-MM-dd');
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification could not be saved. Please, try again.'));
        }
        $lancamentos = $this->Notifications->Lancamentos->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'lancamentos'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $notification = $this->Notifications->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $notification = $this->Notifications->patchEntity($notification, $this->request->getData());
            if ($this->Notifications->save($notification)) {
                $this->Flash->success(__('The notification has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The notification could not be saved. Please, try again.'));
        }
        $lancamentos = $this->Notifications->Lancamentos->find('list', ['limit' => 200]);
        $this->set(compact('notification', 'lancamentos'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Notification id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $notification = $this->Notifications->get($id);
        if ($this->Notifications->delete($notification)) {
            $this->Flash->success(__('The notification has been deleted.'));
        } else {
            $this->Flash->error(__('The notification could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function getNotifications()
    {
        $notifications = $this->Notifications->find('all');
        foreach($notifications as $notification):
        $notification->data = $notification->data->i18nFormat('yyyy-MM-dd');
        // debug($a);
        endforeach;
        // exit;
        $this->response = $this->response;
        $this->response = $this->response
            ->withHeader('Access-Control-Allow-Origin','*')
            ->withHeader('Access-Control-Allow-Methods', '*')
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With')
            ->withHeader('Access-Control-Allow-Headers', 'Content-Type')
            ->withHeader('Access-Control-Allow-Type', 'application/json');
        $this->response = $this->response->withType('application/json')
            ->withStringBody(json_encode($notifications));
        return $this->response;
        // debug($this->response);exit;
    }
}
