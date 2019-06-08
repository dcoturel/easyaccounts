<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Transferences Controller
 *
 * @property \App\Model\Table\TransferencesTable $Transferences
 *
 * @method \App\Model\Entity\Transference[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class TransferencesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CashResourceOuts', 'CashResourceIns', 'Entries']
        ];
        $transferences = $this->paginate($this->Transferences);
        
        $transferences = array_map([$this, 'setHasAccess'], $transferences->toArray());

        $this->set(compact('transferences'));
    }

    /**
     * View method
     *
     * @param string|null $id Transference id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $transference = $this->Transferences->get($id, [
            'contain' => ['CashResourceOuts', 'CashResourceIns', 'Entries']
        ]);

        $this->set('transference', $transference);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $transference = $this->Transferences->newEntity();
        if ($this->request->is('post')) {
            $transference = $this->Transferences->patchEntity($transference, $this->request->getData());
            $transference->user_id = $this->Auth->user('id');
            if ($this->Transferences->save($transference)) {
                $this->Flash->success(__('The {0} has been saved.', 'Transference'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Transference'));
        }
        $cashResourceOuts = $this->Transferences->CashResourceOuts->find('list', ['limit' => 200]);
        $cashResourceIns = $this->Transferences->CashResourceIns->find('list', ['limit' => 200]);
        $entries = $this->Transferences->Entries->find('list', ['limit' => 200]);
        $this->set(compact('transference', 'cashResourceOuts', 'cashResourceIns', 'entries'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Transference id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $transference = $this->Transferences->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $transference = $this->Transferences->patchEntity($transference, $this->request->getData());
            if ($this->Transferences->save($transference)) {
                $this->Flash->success(__('The {0} has been saved.', 'Transference'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Transference'));
        }
        $cashResourceOuts = $this->Transferences->CashResourceOuts->find('list', ['limit' => 200]);
        $cashResourceIns = $this->Transferences->CashResourceIns->find('list', ['limit' => 200]);
        $entries = $this->Transferences->Entries->find('list', ['limit' => 200]);
        $this->set(compact('transference', 'cashResourceOuts', 'cashResourceIns', 'entries'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Transference id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $transference = $this->Transferences->get($id);
        if ($this->Transferences->delete($transference)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Transference'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Transference'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
