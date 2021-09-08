<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LancamentosFixture
 */
class LancamentosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id_lancamento' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'tipo' => ['type' => 'string', 'length' => null, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null],
        'descricao' => ['type' => 'string', 'length' => null, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null],
        'valor' => ['type' => 'decimal', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'data_emissao' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        'data_baixa' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        'data_vencimento' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        'created' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        'modified' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        'fluxoconta_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'fornecedor_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cliente_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'lancamento_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'dreconta_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id_lancamento'], 'length' => []],
            'lancamentos_cliente_id_fkey' => ['type' => 'foreign', 'columns' => ['cliente_id'], 'references' => ['clientes', 'id_cliente'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'lancamentos_dreconta_id_fkey' => ['type' => 'foreign', 'columns' => ['dreconta_id'], 'references' => ['drecontas', 'id_dreconta'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'lancamentos_fluxoconta_id_fkey' => ['type' => 'foreign', 'columns' => ['fluxoconta_id'], 'references' => ['fluxocontas', 'id_fluxoconta'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'lancamentos_fornecedor_id_fkey' => ['type' => 'foreign', 'columns' => ['fornecedor_id'], 'references' => ['fornecedores', 'id_fornecedor'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'lancamentos_lancamento_id_fkey' => ['type' => 'foreign', 'columns' => ['lancamento_id'], 'references' => ['lancamentos', 'id_lancamento'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
    ];
    // phpcs:enable
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id_lancamento' => 1,
                'tipo' => 'Lorem ipsum dolor sit amet',
                'descricao' => 'Lorem ipsum dolor sit amet',
                'valor' => 1.5,
                'data_emissao' => 1631132564,
                'data_baixa' => 1631132564,
                'data_vencimento' => 1631132564,
                'created' => 1631132564,
                'modified' => 1631132564,
                'fluxoconta_id' => 1,
                'fornecedor_id' => 1,
                'cliente_id' => 1,
                'lancamento_id' => 1,
                'dreconta_id' => 1,
            ],
        ];
        parent::init();
    }
}
