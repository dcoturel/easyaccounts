<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Concepts Controller
 *
 * @property \App\Model\Table\ConceptsTable $Concepts
 *
 * @method \App\Model\Entity\Concept[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ConceptsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Accounts']
        ];
        $concepts = $this->paginate($this->Concepts);

        $this->set(compact('concepts'));
    }

    /**
     * View method
     *
     * @param string|null $id Concept id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $concept = $this->Concepts->get($id, [
            'contain' => ['Accounts']
        ]);

        $this->set('concept', $concept);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $concept = $this->Concepts->newEntity();
        if ($this->request->is('post')) {
            $concept = $this->Concepts->patchEntity($concept, $this->request->getData());
            if ($this->Concepts->save($concept)) {
                $this->Flash->success(__('The {0} has been saved.', 'Concept'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Concept'));
        }
        $accounts = $this->Concepts->Accounts->find('list', ['limit' => 200]);
        $this->set(compact('concept', 'accounts'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Concept id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $concept = $this->Concepts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $concept = $this->Concepts->patchEntity($concept, $this->request->getData());
            if ($this->Concepts->save($concept)) {
                $this->Flash->success(__('The {0} has been saved.', 'Concept'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Concept'));
        }
        $accounts = $this->Concepts->Accounts->find('list', ['limit' => 200]);
        $this->set(compact('concept', 'accounts'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Concept id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $concept = $this->Concepts->get($id);
        if ($this->Concepts->delete($concept)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Concept'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Concept'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
