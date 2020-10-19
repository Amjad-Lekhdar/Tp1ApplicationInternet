<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Apropos Controller
 *
 * @property \App\Model\Table\AproposTable $Apropos
 *
 * @method \App\Model\Entity\Apropo[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AproposController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null
     */
    public function index()
    {
        $apropos = $this->paginate($this->Apropos);

        $this->set(compact('apropos'));
    }

    /**
     * View method
     *
     * @param string|null $id Apropo id.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $apropo = $this->Apropos->get($id, [
            'contain' => [],
        ]);

        $this->set('apropo', $apropo);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $apropo = $this->Apropos->newEntity();
        if ($this->request->is('post')) {
            $apropo = $this->Apropos->patchEntity($apropo, $this->request->getData());
            if ($this->Apropos->save($apropo)) {
                $this->Flash->success(__('The apropo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The apropo could not be saved. Please, try again.'));
        }
        $this->set(compact('apropo'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Apropo id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $apropo = $this->Apropos->get($id, [
            'contain' => [],
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $apropo = $this->Apropos->patchEntity($apropo, $this->request->getData());
            if ($this->Apropos->save($apropo)) {
                $this->Flash->success(__('The apropo has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The apropo could not be saved. Please, try again.'));
        }
        $this->set(compact('apropo'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Apropo id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $apropo = $this->Apropos->get($id);
        if ($this->Apropos->delete($apropo)) {
            $this->Flash->success(__('The apropo has been deleted.'));
        } else {
            $this->Flash->error(__('The apropo could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
