<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Confirmed Controller
 *
 * @property \App\Model\Table\ConfirmedTable $Confirmed
 */
class ConfirmedController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users', 'Confirmed']
        ];
        $confirmed = $this->paginate($this->Confirmed);

        $this->set(compact('confirmed'));
        $this->set('_serialize', ['confirmed']);
    }

    /**
     * View method
     *
     * @param string|null $id Confirmed id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $confirmed = $this->Confirmed->get($id, [
            'contain' => ['Users', 'Confirmed', 'Confirmed']
        ]);

        $this->set('confirmed', $confirmed);
        $this->set('_serialize', ['confirmed']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $confirmed = $this->Confirmed->newEntity();
        if ($this->request->is('post')) {
            $confirmed = $this->Confirmed->patchEntity($confirmed, $this->request->data);
            if ($this->Confirmed->save($confirmed)) {
                $this->Flash->success(__('The confirmed has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The confirmed could not be saved. Please, try again.'));
            }
        }
        $users = $this->Confirmed->Users->find('list', ['limit' => 200]);
        $confirmed = $this->Confirmed->find('list', ['limit' => 200]);
        $this->set(compact('confirmed', 'users', 'confirmed'));
        $this->set('_serialize', ['confirmed']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Confirmed id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function ok($id = null)
    {
      $in = explode('_', $id);

      $confirmed_id = $in[0];
      $user_id = $in[1];
      $this->log('▼', 'debug');
      $this->log($confirmed_id, 'debug');
      $this->log($user_id, 'debug');

      $update = $this->Confirmed->query()->update();
      $update->set([ 'checked' => 1 ]);
      $update->where([
        'user_id' => $user_id,
        'confirmed_id' => $confirmed_id,
      ]);
      $update->execute();


      return;
//
  //      $confirmed = $this->Confirmed->get($id, [
    //        'contain' => []
      //  ]);
      //  if ($this->request->is(['patch', 'post', 'put'])) {
        //    $confirmed = $this->Confirmed->patchEntity($confirmed, $this->request->data);
          //  if ($this->Confirmed->save($confirmed)) {
            //    $this->Flash->success(__('The confirmed has been saved.'));

//                return $this->redirect(['action' => 'index']);
  //          } else {
    //            $this->Flash->error(__('The confirmed could not be saved. Please, try again.'));
      //      }
        //}
  //      $users = $this->Confirmed->Users->find('list', ['limit' => 200]);
    //    $confirmed = $this->Confirmed->Confirmed->find('list', ['limit' => 200]);
      //  $this->set(compact('confirmed', 'users', 'confirmed'));
        //$this->set('_serialize', ['confirmed']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Confirmed id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $confirmed = $this->Confirmed->get($id);
        if ($this->Confirmed->delete($confirmed)) {
            $this->Flash->success(__('The confirmed has been deleted.'));
        } else {
            $this->Flash->error(__('The confirmed could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
