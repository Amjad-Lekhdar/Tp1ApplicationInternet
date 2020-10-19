<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Statut Controller
 *
 * @property \App\Model\Table\StatutTable $Statut
 *
 * @method \App\Model\Entity\Statut[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class StatutController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $statut = $this->paginate($this->Statut);

        $this->set(compact('statut'));
    }

    /**
     * View method
     *
     * @param string|null $id Statut id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $statut = $this->Statut->get($id, [
            'contain' => ['Users'],
        ]);

        $this->set('statut', $statut);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $statut = $this->Statut->newEntity();
        if ($this->request->is('post')) {
            $statut = $this->Statut->patchEntity($statut, $this->request->getData());
            if ($this->Statut->save($statut)) {
                $this->Flash->success(__('The statut has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The statut could not be saved. Please, try again.'));
        }
        $this->set(compact('statut'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Statut id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $statut = $this->Statut->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $statut = $this->Statut->patchEntity($statut, $this->request->getData());
            if ($this->Statut->save($statut)) {
                $this->Flash->success(__('The statut has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The statut could not be saved. Please, try again.'));
        }
        $this->set(compact('statut'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Statut id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $statut = $this->Statut->get($id);
        if ($this->Statut->delete($statut)) {
            $this->Flash->success(__('The statut has been deleted.'));
        } else {
            $this->Flash->error(__('The statut could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
