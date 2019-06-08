<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * EntryItems Model
 *
 * @property \App\Model\Table\EntriesTable|\Cake\ORM\Association\BelongsTo $Entries
 * @property \App\Model\Table\AccountsTable|\Cake\ORM\Association\BelongsTo $Accounts
 *
 * @method \App\Model\Entity\EntryItem get($primaryKey, $options = [])
 * @method \App\Model\Entity\EntryItem newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\EntryItem[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\EntryItem|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EntryItem saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\EntryItem patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\EntryItem[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\EntryItem findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class EntryItemsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('entry_items');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Entries', [
            'foreignKey' => 'entry_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Accounts', [
            'foreignKey' => 'account_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', 'create');

        $validator
            ->scalar('sign')
            ->maxLength('sign', 1)
            ->requirePresence('sign', 'create')
            ->allowEmptyString('sign', false);

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->allowEmptyString('amount', false);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['entry_id'], 'Entries'));
        $rules->add($rules->existsIn(['account_id'], 'Accounts'));

        return $rules;
    }
    
    public function balance() {
        $accounts = $this->Accounts->find('all', [])->toArray();
        $total = 0;
        
        foreach ($accounts as $account) {
            $total = $total + $this->debitsByAccount($account->id, '2001-01-01', '2500-12-31') - $this->creditsByAccount($account->id, '2001-01-01', '2500-12-31');
        }
            
        return($total);
    }
    
    public function balanceOfPeriod($date_from, $date_to) {
        $accounts = $this->Accounts->find('all', ['order' => ['code']])->toArray();
        $retval = [];
        foreach ($accounts as $account) {
            $item = [];
            $item["account_id"] = $account->id;
            $item["code"] = $account->code;
            $item["name"] = $account->name;
            $item["start"] = $this->totalAt($account->id, $date_from);
            $item["debits"] = $this->debitsByAccount($account->id, $date_from, $date_to);
            $item["credits"] = $this->creditsByAccount($account->id, $date_from, $date_to);
            $item["end"] = $item["start"] + $item["debits"] - $item["credits"];
            $retval[] = $item;
        }
        return($retval);
        
    }
    
    public function debitsByAccount($account_id, $date_from, $date_to) {
        $debits = $this->find('all', ['contain' => ['Entries'], 'conditions' => ['sign' => 'D', 'account_id' => $account_id, 'Entries.date >=' => $date_from, 'Entries.date <=' => $date_to]])->sumOf("amount");
        return($debits);
    }
    
    public function creditsByAccount($account_id, $date_from, $date_to) {
        $credits = $this->find('all', ['contain' => ['Entries'], 'conditions' => ['sign' => 'H', 'account_id' => $account_id, 'Entries.date >=' => $date_from, 'Entries.date <=' => $date_to]])->sumOf("amount");
        return($credits);
    }
    
    public function totalAt($account_id, $date) {
        $debits = $this->find('all', ['contain' => ['Entries'], 'conditions' => ['sign' => 'D', 'Entries.date <' => $date]])->sumOf("amount");
        $credits = $this->find('all', ['contain' => ['Entries'], 'conditions' => ['sign' => 'H', 'Entries.date <' => $date]])->sumOf("amount");
        
        return($debits - $credits);
    }
    
    public function accountLedger($account_id, $date_from, $date_to) {
        $retval = $this->find('all', ['contain' => ['Entries', 'Accounts'], 'conditions' => ['account_id' => $account_id, 'Entries.date >=' => $date_from, 'Entries.date <=' => $date_to]])->toArray();
        
        return($retval);
    }
}
