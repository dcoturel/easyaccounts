<?php
namespace App\Model\Table;

use App\Model\Entity\Entry;
use Cake\Datasource\EntityInterface;
use Cake\Event\Event;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use ArrayObject;

/**
 * Incomes Model
 *
 * @property \App\Model\Table\CashResourcesTable|\Cake\ORM\Association\BelongsTo $CashResources
 * @property \App\Model\Table\ConceptsTable|\Cake\ORM\Association\BelongsTo $Concepts
 * @property \App\Model\Table\EntriesTable|\Cake\ORM\Association\BelongsTo $Entries
 *
 * @method \App\Model\Entity\Income get($primaryKey, $options = [])
 * @method \App\Model\Entity\Income newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Income[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Income|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Income saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Income patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Income[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Income findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IncomesTable extends Table
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

        $this->setTable('incomes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('CashResources', [
            'foreignKey' => 'cash_resource_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Concepts', [
            'foreignKey' => 'concept_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Entries', [
            'foreignKey' => 'entry_id',
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
            ->scalar('reference')
            ->maxLength('reference', 128)
            ->requirePresence('reference', 'create')
            ->allowEmptyString('reference', false);

        $validator
            ->date('date')
            ->requirePresence('date', 'create')
            ->allowEmptyDate('date', false);

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->allowEmptyString('amount', false);
        
        $validator
            ->requirePresence('cash_resource_id', 'create')
            ->requirePresence('concept_id', 'create');

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
        $rules->add($rules->existsIn(['cash_resource_id'], 'CashResources'));
        $rules->add($rules->existsIn(['concept_id'], 'Concepts'));
        $rules->add($rules->existsIn(['entry_id'], 'Entries'));

        return $rules;
    }
    
    public function beforeSave(Event $event, EntityInterface $entity, ArrayObject $options) {
        if ($entity->isNew()) {
            $concept = $this->Concepts->get($entity->concept_id);
            $cash_resource = $this->CashResources->get($entity->cash_resource_id);
            $entry = [
                'date' => $entity->date,
            ];
            
            $entry_items = [
                [
                    'account_id' => $cash_resource->account_id,
                    'sign' => 'D',
                    'amount' => $entity->amount,
                ],
                [
                    'account_id' => $concept->account_id,
                    'sign' => 'H',
                    'amount' => $entity->amount,
                ],
            ];
            
              
            $entryObject = $this->Entries->newEntity();
            $entryObject = $this->Entries->patchEntity($entryObject, $entry);
            
            $entry_itemsO = [];
            
            foreach ($entry_items as $ei) {
                $obj = $this->Entries->EntryItems->newEntity();
                $obj = $this->Entries->EntryItems->patchEntity($obj, $ei);
                $entry_itemsO[] = $obj;
            }
            
            
            $entryObject->entry_items = $entry_itemsO;
            
            $entryObject = $this->Entries->save($entryObject);
            
            if ($entryObject instanceof Entry) {
                $entity->entry_id = $entryObject->id;
            } else {
                $event->stopPropagation();
            }
            
        }
    }
    
    public function beforeDelete(Event $event, EntityInterface $entity, ArrayObject $options) {
        if ($this->Entries->EntryItems->deleteAll(['entry_id' => $entity->entry_id])>0) {
            if ($this->Entries->deleteAll(['id' => $entity->entry_id])>0) {
                
            } else {
                $event->stopPropagation();
            }
        } else {
            $event->stopPropagation();
        }
    }
}
