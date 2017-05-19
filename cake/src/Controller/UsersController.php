<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use Phinx\Db\Table;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{


    public function initialize() {
        if (in_array($this->request->action, ['redirectingPrevented', 'form', 'toggle'])) {
            $this->components['Ajax.Ajax'] = ['flashKey' => 'FlashMessage'];
        }
        parent::initialize();
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {


        if ($this->request->is(['ajax'])) {
            $users = $this->request->Getquery('id');
            $users = $this->Users->get($users);

            if($users['role'] == true){
                $role = ['role'=>false];
                $rolem = "não é adm";
                $content = '<span class="toggle-element" data-value="1" data-rel="users/index">'.$rolem.'</span>';
                $this->set(compact('content'));
            }else{
                $role = ['role'=>true];
                $rolem = "é adm";
                $content = '<span class="toggle-element" data-value="1" data-rel="users/index">'.$rolem.'</span>';
                $this->set(compact('content'));
            }
            $users = $this->Users->patchEntity($users, $role);
            $this->Users->save($users);

        }

        $users = $this->Users->find('all')->first();
        $this->set('users', $users);





    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => ['Profiles']
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {

        $user = $this->Users->newEntity($this->request->getData(),['associated'=>['Profiles']]);
        if ($this->request->is('post')) {

            $user = $this->Users->patchEntity($user, $this->request->getData(),['associated'=>['Profiles']]);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['ajax'])) {

            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {

            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    public function toggles(){
        $this->RequestHandler->renderAs($this, 'json');
        $this->response->type('application/json');
        $this->set('_serialize', true);

    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
