<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Utility\Text;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    
    public function initialize()
    {
    parent::initialize();
    $this->Auth->allow(['logout','add' ,'edit']);
    $this->Auth->deny(['index','view']);
    }
    
    public function logout()
    {
    $this->Flash->success('You are now logged out.');
    return $this->redirect($this->Auth->logout());
    }

    
    
    public function login()
    {
    if ($this->request->is('post')) {
        $user = $this->Auth->identify();
        if ($user) {
            $this->Auth->setUser($user);
            return $this->redirect($this->Auth->redirectUrl());
            }
        $this->Flash->error('Your username or password is incorrect.');
        }
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Statut'],
        ];
        
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
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
            'contain' => ['Employees'],
        ]);

        $this->set('user', $user);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            $user->uuid = Text::uuid();
            $user->confirmed = false;
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        
        $statuts = $this->Users->Statut->find('list');
        
        
        $this->set(compact('user','statuts'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            
           
            
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        
        $statuts = $this->Users->Statut->find('list');
        $this->set(compact('user', 'statuts'));
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
    
     public function isAuthorized($user) {
       $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['index','add', 'edit'])) {
            return true;
        }
            
        $id = $this->request->getParam('pass.0');
        if(!$id){
            $this->Flash->error(__('missing parameter'));
            return false;
            
        }
        
        if($id == $user['id']){
            return true;
            
        }else{
            return parent::isAuthorized($user);
        }
        
    }
    
   public function statuts()
{
    // La clé 'pass' est fournie par CakePHP et contient tous les
    // segments d'URL passés dans la requête
    $statuts = $this->request->getParam('pass');

    // Utilisation de ArticlesTable pour trouver les articles taggés
    $users = $this->Users->find('select', [
        'statuts' => $statuts
    ]);

    // Passage des variable dans le contexte de la view du template
    $this->set([
        'users' => $users,
        'statuts' => $statuts
    ]);
}

    public function confirm($uuid){
    
        $user = $this->Users->findByUuid($uuid)->firstOrFail();
        $user->confirmed=true;
        if($this->Users->save($user)){
           $this->Flash->success(__('Thank you') . ' . '.('Your email has been confirmed'));
           return $this->redirect(['action'=> 'index']);
        }
        
        $this->Flash->error(__('The confirmation could not be saved. Please, try again.'));
    
    }
    
     public function sendConfirmEmail($user){
         $email = new Email('default');
         $email->to($user->email)->subject(__('Confirm your email'))->send( 'http://' . $_SERVER['HTTP_HOST'] . $this->request->webroot . 'users/confirm/'. $user_uuid);
         
     }
    

    
}
