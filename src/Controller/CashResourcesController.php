<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * CashResources Controller
 *
 * @property \App\Model\Table\CashResourcesTable $CashResources
 *
 * @method \App\Model\Entity\CashResource[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class CashResourcesController extends AppController
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
        $cashResources = $this->paginate($this->CashResources);

        $this->set(compact('cashResources'));
    }

    /**
     * View method
     *
     * @param string|null $id Cash Resource id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $cashResource = $this->CashResources->get($id, [
            'contain' => ['Accounts']
        ]);

        $this->set('cashResource', $cashResource);
    }


    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $cashResource = $this->CashResources->newEntity();
        if ($this->request->is('post')) {
            $cashResource = $this->CashResources->patchEntity($cashResource, $this->request->getData());
            if ($this->CashResources->save($cashResource)) {
                $this->Flash->success(__('The {0} has been saved.', 'Cash Resource'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Cash Resource'));
        }
        $accounts = $this->CashResources->Accounts->find('list', ['limit' => 200]);
        $this->set(compact('cashResource', 'accounts'));
    }


    /**
     * Edit method
     *
     * @param string|null $id Cash Resource id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $cashResource = $this->CashResources->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $cashResource = $this->CashResources->patchEntity($cashResource, $this->request->getData());
            if ($this->CashResources->save($cashResource)) {
                $this->Flash->success(__('The {0} has been saved.', 'Cash Resource'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The {0} could not be saved. Please, try again.', 'Cash Resource'));
        }
        $accounts = $this->CashResources->Accounts->find('list', ['limit' => 200]);
        $this->set(compact('cashResource', 'accounts'));
    }


    /**
     * Delete method
     *
     * @param string|null $id Cash Resource id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $cashResource = $this->CashResources->get($id);
        if ($this->CashResources->delete($cashResource)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Cash Resource'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Cash Resource'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
