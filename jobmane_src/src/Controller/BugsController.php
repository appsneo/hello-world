<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bugs Controller
 *
 * @property \App\Model\Table\BugsTable $Bugs
 */
class BugsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Users']
        ];
        $bugs = $this->paginate($this->Bugs);

//        $this->set(compact('bugs'));
  //      $this->set('_serialize', ['bugs']);
        // 社長でログインした場合は社内全体のプロジェクトを参照する
    //    $bugs = $this->paginate($this->Bugs->find('all')
      //    ->contain(['Users'])
        //);

        //  ->where([
          //  'completion_check' => 0,
      //    ])
        //);

  //        $bug = $this->Bugs->newEntity();
    //      if ($this->request->is('post')) {
      //        $bug = $this->Bugs->patchEntity($bug, $this->request->data);
        //      if ($this->Bugs->save($bug)) {
          //        $this->Flash->success(__('The bug has been saved.'));

            //      return $this->redirect(['action' => 'index']);
              //} else {
                //  $this->Flash->error(__('The bug could not be saved. Please, try again.'));
          //    }
        //  }
  //        $wrUsers = $this->Bugs->Users->find('list', ['limit' => 200]);
    //      $upUsers = $this->Bugs->Users->find('list', ['limit' => 200]);
      //    $this->set(compact('bug', 'wrUsers', 'upUsers'));
        if(count($bugs) == 0) {
            $bug = $this->Bugs->newEntity();
        } else {
            $bug = $bugs[0];
        }

        $this->set(compact('bug'));
        $this->set('_serialize', ['bugs']);
        $this->render('add');
    }

    /**
     * View method
     *
     * @param string|null $id Bug id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bug = $this->Bugs->get($id, [
            'contain' => ['WrUsers', 'UpUsers']
        ]);

        $this->set('bug', $bug);
        $this->set('_serialize', ['bug']);
    }


        /**
         * Add method
         *
         * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
         */
        public function new()
        {
            $bug = $this->Bugs->newEntity();

          $this->set(compact('bug'));
          $this->set('_serialize', ['bugs']);
          $this->render('add');
      }


    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
//      // 社長でログインした場合は社内全体のプロジェクトを参照する
  //    $bugs = $this->paginate($this->Bugs->find('all')
    //    ->contain(['Users'])
      //);

      //  ->where([
        //  'completion_check' => 0,
    //    ])
      //);

        $bug = $this->Bugs->newEntity();
        if ($this->request->is('post')) {
            $bug = $this->Bugs->patchEntity($bug, $this->request->data);
            if ($this->Bugs->save($bug)) {
                $this->Flash->success(__('The bug has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The bug could not be saved. Please, try again.'));
            }
        }
//        $wrUsers = $this->Bugs->Users->find('list', ['limit' => 200]);
  //      $upUsers = $this->Bugs->Users->find('list', ['limit' => 200]);
    //    $this->set(compact('bug', 'wrUsers', 'upUsers'));
  //    if(count($bugs) == 0) {
    //      $bug = $this->Bugs->newEntity();
      //} else {
        //  $bug = $bugs[0];
    //  }

      $this->set(compact('bug'));
      $this->set('_serialize', ['bugs']);
  }

    /**
     * Edit method
     *
     * @param string|null $id Bug id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bug = $this->Bugs->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bug = $this->Bugs->patchEntity($bug, $this->request->data);
            if ($this->Bugs->save($bug)) {
                $this->Flash->success(__('The bug has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The bug could not be saved. Please, try again.'));
            }
        }
        $wrUsers = $this->Bugs->WrUsers->find('list', ['limit' => 200]);
        $upUsers = $this->Bugs->UpUsers->find('list', ['limit' => 200]);
        $this->set(compact('bug', 'wrUsers', 'upUsers'));
        $this->set('_serialize', ['bug']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Bug id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bug = $this->Bugs->get($id);
        if ($this->Bugs->delete($bug)) {
            $this->Flash->success(__('The bug has been deleted.'));
        } else {
            $this->Flash->error(__('The bug could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
