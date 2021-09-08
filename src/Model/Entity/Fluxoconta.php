<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fluxoconta Entity
 *
 * @property int $id_fluxoconta
 * @property string|null $conta
 * @property string|null $descricao
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $fluxosubgrupo_id
 *
 * @property \App\Model\Entity\Fluxosubgrupo $fluxosubgrupo
 * @property \App\Model\Entity\Lancamento[] $lancamentos
 */
class Fluxoconta extends Entity
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
        'conta' => true,
        'descricao' => true,
        'created' => true,
        'modified' => true,
        'fluxosubgrupo_id' => true,
        'fluxosubgrupo' => true,
        'lancamentos' => true,
    ];
}
