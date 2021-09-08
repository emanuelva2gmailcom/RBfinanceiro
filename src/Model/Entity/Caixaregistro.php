<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Caixaregistro Entity
 *
 * @property int $id_caixaregistro
 * @property int|null $caixa_id
 * @property int|null $tipopagamento_id
 * @property int|null $lancamento_id
 *
 * @property \App\Model\Entity\Caixa $caixa
 * @property \App\Model\Entity\Tipopagamento $tipopagamento
 * @property \App\Model\Entity\Lancamento $lancamento
 */
class Caixaregistro extends Entity
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
        'caixa_id' => true,
        'tipopagamento_id' => true,
        'lancamento_id' => true,
        'caixa' => true,
        'tipopagamento' => true,
        'lancamento' => true,
    ];
}
