<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Transference Entity
 *
 * @property int $id
 * @property string $reference
 * @property \Cake\I18n\FrozenDate $date
 * @property float $amount
 * @property int $cash_resource_out_id
 * @property int $cash_resource_in_id
 * @property int $entry_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\CashResourceOut $cash_resource_out
 * @property \App\Model\Entity\CashResourceIn $cash_resource_in
 * @property \App\Model\Entity\Entry $entry
 */
class Transference extends Entity
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
        'cash_resource_out_id' => true,
        'cash_resource_in_id' => true,
        'entry_id' => true,
        'created' => true,
        'modified' => true,
        'cash_resource_out' => true,
        'cash_resource_in' => true,
        'entry' => true
    ];
}
