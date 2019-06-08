<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Outcome Entity
 *
 * @property int $id
 * @property string $reference
 * @property \Cake\I18n\FrozenDate $date
 * @property float $amount
 * @property int $cash_resource_id
 * @property int $concept_id
 * @property int $entry_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CashResource $cash_resource
 * @property \App\Model\Entity\Concept $concept
 * @property \App\Model\Entity\Entry $entry
 */
class Outcome extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'reference' => true,
        'date' => true,
        'amount' => true,
        'cash_resource_id' => true,
        'concept_id' => true,
        'entry_id' => true,
        'created' => true,
        'modified' => true,
        'cash_resource' => true,
        'concept' => true,
        'entry' => true
    ];
}
