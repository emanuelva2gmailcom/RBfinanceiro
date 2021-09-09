<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CaixaregistrosFixture
 */
class CaixaregistrosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id_caixaregistro' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'caixa_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'tipopagamento_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        'lancamento_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id_caixaregistro'], 'length' => []],
            'caixaregistros_caixa_id_fkey' => ['type' => 'foreign', 'columns' => ['caixa_id'], 'references' => ['caixas', 'id_caixa'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'caixaregistros_lancamento_id_fkey' => ['type' => 'foreign', 'columns' => ['lancamento_id'], 'references' => ['lancamentos', 'id_lancamento'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'caixaregistros_tipopagamento_id_fkey' => ['type' => 'foreign', 'columns' => ['tipopagamento_id'], 'references' => ['tipopagamentos', 'id_tipopagamento'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'id_caixaregistro' => 1,
                'caixa_id' => 1,
                'tipopagamento_id' => 1,
                'lancamento_id' => 1,
            ],
        ];
        parent::init();
    }
}
