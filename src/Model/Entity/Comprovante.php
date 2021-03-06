<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Comprovante Entity
 *
 * @property int $id_comprovante
 * @property string|null $nome_arquivo
 * @property string|null $tipo
 * @property int|null $lancamento_id
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property string|null $img
 *
 * @property \App\Model\Entity\Lancamento $lancamento
 */
class Comprovante extends Entity
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
        'nome_arquivo' => true,
        'tipo' => true,
        'lancamento_id' => true,
        'created' => true,
        'modified' => true,
        'img' => true,
        'lancamento' => true,
    ];
}
