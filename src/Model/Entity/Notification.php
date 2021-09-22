<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Notification Entity
 *
 * @property int $id_notification
 * @property string|null $title
 * @property string|null $message
 * @property \Cake\I18n\FrozenTime|null $data
 * @property string|null $class
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modify
 * @property int|null $lancamento_id
 *
 * @property \App\Model\Entity\Lancamento $lancamento
 */
class Notification extends Entity
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
        'title' => true,
        'message' => true,
        'data' => true,
        'class' => true,
        'created' => true,
        'modify' => true,
        'lancamento_id' => true,
        'lancamento' => true,
    ];
}
