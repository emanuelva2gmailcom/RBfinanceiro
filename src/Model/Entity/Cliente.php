<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Cliente Entity
 *
 * @property int $id_cliente
 * @property string|null $nome
 * @property string|null $cpf
 * @property string|null $endereco
 * @property string|null $email
 * @property string|null $telefone
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 * @property bool|null $is_pendente
 *
 * @property \App\Model\Entity\Lancamento[] $lancamentos
 */
class Cliente extends Entity
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
        'nome' => true,
        'cpf' => true,
        'endereco' => true,
        'email' => true,
        'telefone' => true,
        'created' => true,
        'modified' => true,
        'is_pendente' => true,
        'lancamentos' => true,
    ];
}
