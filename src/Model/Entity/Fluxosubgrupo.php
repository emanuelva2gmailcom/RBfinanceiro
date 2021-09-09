<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fluxosubgrupo Entity
 *
 * @property int $id_fluxosubgrupo
 * @property string|null $subgrupo
 * @property string|null $descricao
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $fluxogrupo_id
 *
 * @property \App\Model\Entity\Fluxogrupo $fluxogrupo
 * @property \App\Model\Entity\Fluxoconta[] $fluxocontas
 */
class Fluxosubgrupo extends Entity
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
        'fluxogrupo_id' => true,
        'fluxogrupo' => true,
        'fluxocontas' => true,
    ];
}
