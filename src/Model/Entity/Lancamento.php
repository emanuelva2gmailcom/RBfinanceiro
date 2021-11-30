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
 * @property float|null $valor
 * @property \Cake\I18n\FrozenDate|null $data_emissao
 * @property \Cake\I18n\FrozenDate|null $data_vencimento
 * @property \Cake\I18n\FrozenDate|null $data_competencia
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property int|null $subconta_id
 * @property int|null $fornecedor_id
 * @property int|null $cliente_id
 * @property int|null $lancamento_id
 * @property \Cake\I18n\FrozenDate|null $data_baixa
 * @property int|null $parcela
 *
 * @property \App\Model\Entity\Subconta $subconta
 * @property \App\Model\Entity\Fornecedore $fornecedore
 * @property \App\Model\Entity\Cliente $cliente
 * @property \App\Model\Entity\Lancamento[] $lancamentos
 * @property \App\Model\Entity\Caixaregistro[] $caixaregistros
 * @property \App\Model\Entity\Comprovante[] $comprovantes
 * @property \App\Model\Entity\Notification[] $notifications
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
        'data_vencimento' => true,
        'data_competencia' => true,
        'created' => true,
        'modified' => true,
        'subconta_id' => true,
        'fornecedor_id' => true,
        'cliente_id' => true,
        'lancamento_id' => true,
        'data_baixa' => true,
        'parcela' => true,
        'subconta' => true,
        'fornecedore' => true,
        'cliente' => true,
        'lancamentos' => true,
        'caixaregistros' => true,
        'comprovantes' => true,
        'notifications' => true,
    ];
}
