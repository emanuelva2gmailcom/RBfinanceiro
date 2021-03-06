<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Lancamento Entity
 *
 * @property int $id_lancamento
 * @property string|null $tipo
 * @property string|null $descricao
 * @property string|null $valor
 * @property \Cake\I18n\FrozenTime|null $data_emissao
 * @property \Cake\I18n\FrozenTime|null $data_baixa
 * @property \Cake\I18n\FrozenTime|null $data_vencimento
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $fluxoconta_id
 * @property int|null $fornecedor_id
 * @property int|null $cliente_id
 * @property int|null $lancamento_id
 * @property int|null $dreconta_id
 *
 * @property \App\Model\Entity\Fluxoconta $fluxoconta
 * @property \App\Model\Entity\Fornecedore $fornecedore
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Lancamento[] $lancamentos
 * @property \App\Model\Entity\Dreconta $dreconta
 * @property \App\Model\Entity\Caixaregistro[] $caixaregistros
 * @property \App\Model\Entity\Comprovante[] $comprovantes
 */
class Lancamento extends Entity
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
        'tipo' => true,
        'descricao' => true,
        'valor' => true,
        'data_emissao' => true,
        'data_baixa' => true,
        'data_vencimento' => true,
        'created' => true,
        'modified' => true,
        'fluxoconta_id' => true,
        'fornecedor_id' => true,
        'cliente_id' => true,
        'lancamento_id' => true,
        'dreconta_id' => true,
        'fluxoconta' => true,
        'fornecedore' => true,
        'cliente' => true,
        'lancamentos' => true,
        'dreconta' => true,
        'caixaregistros' => true,
        'comprovantes' => true,
    ];
}
