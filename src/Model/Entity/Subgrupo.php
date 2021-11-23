<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Subgrupo Entity
 *
 * @property int $id_subgrupo
 * @property string|null $subgrupo
 * @property string|null $descricao
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $grupo_id
 *
 * @property \App\Model\Entity\Grupo $grupo
 * @property \App\Model\Entity\Conta[] $contas
 */
class Subgrupo extends Entity
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
        'subgrupo' => true,
        'descricao' => true,
        'created' => true,
        'modified' => true,
        'grupo_id' => true,
        'grupo' => true,
        'contas' => true,
    ];
}
