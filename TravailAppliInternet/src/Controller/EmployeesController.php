<?php

// src/Controller/ArticlesController.php

namespace App\Controller;

class EmployeesController extends AppController {

    public function isAuthorized($user) {
        $action = $this->request->getParam('action');
        // The add and tags actions are always allowed to logged in users.
        if (in_array($action, ['add', 'edit' , 'delete', 'view' , 'index', 'changeLang'])) {
            return true;
        }

        // All other actions require a slug.
        $slug = $this->request->getParam('pass.0');
        if (!$slug) {
            return false;
        }

        // Check that the article belongs to the current user.
        $employee = $this->Employees->findBySlug($slug)->first();

        return $employee->user_id === $user['id'];
    }

    public function index() {
         $this->paginate = [
            'contain' => ['Users', 'Roles', 'Files'],
        ];
        $employees = $this->paginate($this->Employees);

        $this->set(compact('employees'));
    }

    public function view($slug = null) {
        
       
        $employee = $this->Employees->find()
                ->where(['Employees.slug' => $slug])
                ->contain(['Schedules', 'Roles', 'Files'])
                ->firstOrFail();
       
       
        
        $this->set(compact('employee', $employee));
    }

    public function add() {
        $employee = $this->Employees->newEntity();
        if ($this->request->is('post')) {
            $employee = $this->Employees->patchEntity($employee, $this->request->getData());

            $employee->user_id = $this->Auth->user('id');

            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }
        $roles = $this->Employees->Roles->find('list', ['limit' => 200]);
        $files = $this->Employees->Files->find('list', ['limit' => 200]);
        $this->set(compact('employee', 'roles','files'));
    }

    public function edit($slug) {
        $employee = $this->Employees->findBySlug($slug)
                ->contain('Roles', 'Files')
                ->firstOrFail();
        if ($this->request->is(['patch','post', 'put'])) {
            $this->Employees->patchEntity($employee, $this->request->getData(), [
                // Added: Disable modification of user_id.
                'accessibleFields' => ['user_id' => false]
            ]);
            if ($this->Employees->save($employee)) {
                $this->Flash->success(__('The employee has been saved.'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The employee could not be saved. Please, try again.'));
        }

        $roles = $this->Employees->Roles->find('list', ['limit' => 200]);
        $files = $this->Employees->Files->find('list', ['limit' => 200]);
        $this->set(compact('employee', 'files', 'roles'));
    }

    public function delete($slug) {
        $this->request->allowMethod(['post', 'delete']);

        $employee = $this->Employees->findBySlug($slug)->firstOrFail();
        if ($this->Employees->delete($employee)) {
            $this->Flash->success(__('The employee {0} as been deleted.', $employee->First_name));
            
        }else {
            $this->Flash->error(__('The employee could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(['action' => 'index']);
    }

}
