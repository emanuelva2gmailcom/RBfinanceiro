<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Fluxogrupo Entity
 *
 * @property int $id_fluxogrupo
 * @property string|null $grupo
 * @property string|null $descricao
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\Fluxosubgrupo[] $fluxosubgrupos
 */
class Fluxogrupo extends Entity
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
        'grupo' => true,
        'descricao' => true,
        'created' => true,
        'modified' => true,
        'fluxosubgrupos' => true,
    ];
}
