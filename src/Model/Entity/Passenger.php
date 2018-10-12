<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Passenger Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int $train_id
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $other
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Train $train
 */
class Passenger extends Entity
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
        'user_id' => true,
        'train_id' => true,
        'name' => true,
        'address' => true,
        'phone' => true,
        'other' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'train' => true
    ];
}
