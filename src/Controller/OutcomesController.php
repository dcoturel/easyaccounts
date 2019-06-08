<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Outcomes Controller
 *
 * @property \App\Model\Table\OutcomesTable $Outcomes
 *
 * @method \App\Model\Entity\Outcome[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class OutcomesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['CashResources', 'Concepts', 'Entries']
        ];
        $outcomes = $this->paginate($this->Outcomes);
        
        $outcomes = array_map([$this, 'setHasAccess'], $outcomes->toArray());

        $this->set(compact('outcomes'));
    }

    /**
     * View method
     *
     * @param string|null $id Outcome id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $outcome = $this->Outcomes->get($id, [
            'contain' => ['CashResources', 'Concepts', 'Entries']
        ]);

        $this->set('outcome', $outcome);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $outcome = $this->Outcomes->newEntity();
        if ($this->request->is('post')) {
            $outcome = $this->Outcomes->patchEntity($outcome, $this->request->getData());
            $outcome->user_id = $this->Auth->user('id');
            if ($this->Outcomes->save($outcome)) {
                $this->Flash->success(__('The {0} has been saved.', 'Outcome'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Outcome'));
        }
        $cashResources = $this->Outcomes->CashResources->find('list', ['limit' => 200]);
        $concepts = $this->Outcomes->Concepts->find('list', ['limit' => 200]);
        $entries = $this->Outcomes->Entries->find('list', ['limit' => 200]);
        $this->set(compact('outcome', 'cashResources', 'concepts', 'entries'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Outcome id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $outcome = $this->Outcomes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $outcome = $this->Outcomes->patchEntity($outcome, $this->request->getData());
            if ($this->Outcomes->save($outcome)) {
                $this->Flash->success(__('The {0} has been saved.', 'Outcome'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Outcome'));
        }
        $cashResources = $this->Outcomes->CashResources->find('list', ['limit' => 200]);
        $concepts = $this->Outcomes->Concepts->find('list', ['limit' => 200]);
        $entries = $this->Outcomes->Entries->find('list', ['limit' => 200]);
        $this->set(compact('outcome', 'cashResources', 'concepts', 'entries'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Outcome id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $outcome = $this->Outcomes->get($id);
        if ($this->Outcomes->delete($outcome)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Outcome'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Outcome'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
