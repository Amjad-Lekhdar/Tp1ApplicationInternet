<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Schedules Controller
 *
 * @property \App\Model\Table\SchedulesTable $Schedules
 *
 * @method \App\Model\Entity\Schedule[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SchedulesController extends AppController
{
    
    
    public function initialize(): void {
        parent::initialize();
        $this->Auth->allow(['add']);
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
         $this->paginate = [
            'contain' => ['Employees'],
        ];
        
        
        $schedules = $this->paginate($this->Schedules);
        
        $this->set(compact('schedules'));
    }

    /**
     * View method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => ['Employees'],
        ]);

        $this->set('schedule', $schedule);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if($this->request->session()->read('Employee.id')== false){
            $this->Flash->error(_('Schedule must be added from an employee'));
            return $this->redirect(['controller'=> 'employees', 'action' => 'index']);
        } else {
        
        $schedule = $this->Schedules->newEntity();
        if ($this->request->is('post')) {
            
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->getData());
            $schedule->Employee_ID = $this->request->session()->read('Employee.id');
            $this->request->session()->delete('Employee.id');
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));
                $employee_slug = $this->request->session()->read('Employee.slug');
                return $this->redirect(['controller'=> 'employees','action' => 'view', $employee_slug]);
            }
            $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
        }
        $employees = $this->Schedules->Employees->find('list', ['limit' => 200]);
        $this->set(compact('schedule','employees'));
    }
    
    }

    /**
     * Edit method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schedule = $this->Schedules->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schedule = $this->Schedules->patchEntity($schedule, $this->request->getData());
            if ($this->Schedules->save($schedule)) {
                $this->Flash->success(__('The schedule has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The schedule could not be saved. Please, try again.'));
        }
        $this->set(compact('schedule'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Schedule id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schedule = $this->Schedules->get($id);
        if ($this->Schedules->delete($schedule)) {
            $this->Flash->success(__('The schedule has been deleted.'));
        } else {
            $this->Flash->error(__('The schedule could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
    
    public function isAuthorized($user) {
        
        // The add and tags actions are always allowed to logged in users.
        
            return true;
        
        
    }
}
