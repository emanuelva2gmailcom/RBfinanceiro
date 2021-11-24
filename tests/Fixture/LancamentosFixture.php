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
        'valor' => ['type' => 'float', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'data_emissao' => ['type' => 'date', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'data_vencimento' => ['type' => 'date', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'data_competencia' => ['type' => 'date', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        'created' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        'modified' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        'subconta_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'fornecedor_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'cliente_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'lancamento_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'parcela' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'data_baixa' => ['type' => 'date', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id_lancamento'], 'length' => []],
            'lancamentos_cliente_id_fkey' => ['type' => 'foreign', 'columns' => ['cliente_id'], 'references' => ['clientes', 'id_cliente'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'lancamentos_fornecedor_id_fkey' => ['type' => 'foreign', 'columns' => ['fornecedor_id'], 'references' => ['fornecedores', 'id_fornecedor'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'lancamentos_lancamento_id_fkey' => ['type' => 'foreign', 'columns' => ['lancamento_id'], 'references' => ['lancamentos', 'id_lancamento'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'lancamentos_subconta_id_fkey' => ['type' => 'foreign', 'columns' => ['subconta_id'], 'references' => ['subcontas', 'id_subconta'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'valor' => 1,
                'data_emissao' => '2021-11-24',
                'data_vencimento' => '2021-11-24',
                'data_competencia' => '2021-11-24',
                'created' => 1637753575,
                'modified' => 1637753575,
                'subconta_id' => 1,
                'fornecedor_id' => 1,
                'cliente_id' => 1,
                'lancamento_id' => 1,
                'parcela' => 1,
                'data_baixa' => '2021-11-24',
            ],
        ];
        parent::init();
    }
}
