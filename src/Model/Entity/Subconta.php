<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subconta Entity
 *
 * @property int $id_subconta
 * @property string|null $subconta
 * @property string|null $descricao
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $conta_id
 *
 * @property \App\Model\Entity\Conta $conta
 * @property \App\Model\Entity\Lancamento[] $lancamentos
 */
class Subconta extends Entity
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
        'subconta' => true,
        'descricao' => true,
        'created' => true,
        'modified' => true,
        'conta_id' => true,
        'conta' => true,
        'lancamentos' => true,
    ];
}
