<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * EntryItems Controller
 *
 * @property \App\Model\Table\EntryItemsTable $EntryItems
 *
 * @method \App\Model\Entity\EntryItem[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class EntryItemsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Entries', 'Accounts']
        ];
        $entryItems = $this->paginate($this->EntryItems);

        $this->set(compact('entryItems'));
    }
    
    public function accountLedger($account_id, $date_from = '2001-01-01', $date_to = '2500-12-31') {
        $totalInit = $this->EntryItems->totalAt($account_id, $date_from);
        $entryItems = $this->EntryItems->accountLedger($account_id, $date_from, $date_to);
        
        $this->set('entryItems', $entryItems);
        $this->set('totalInit', $totalInit);
    }
    
    public function balance($date_from = '2001-01-01', $date_to = '2500-12-31') {
        $balance = $this->EntryItems->balanceOfPeriod($date_from, $date_to);
        $this->set('balance', $balance);
    }

    /**
     * View method
     *
     * @param string|null $id Entry Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $entryItem = $this->EntryItems->get($id, [
            'contain' => ['Entries', 'Accounts']
        ]);

        $this->set('entryItem', $entryItem);
    }


    /**
     * Delete method
     *
     * @param string|null $id Entry Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $entryItem = $this->EntryItems->get($id);
        if ($this->EntryItems->delete($entryItem)) {
            $this->Flash->success(__('The {0} has been deleted.', 'Entry Item'));
        } else {
            $this->Flash->error(__('The {0} could not be deleted. Please, try again.', 'Entry Item'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
