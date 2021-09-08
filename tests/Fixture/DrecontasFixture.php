<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DrecontasFixture
 */
class DrecontasFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id_dreconta' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'conta' => ['type' => 'string', 'length' => null, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null],
        'descricao' => ['type' => 'string', 'length' => null, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null],
        'created' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        'modified' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        'dregrupo_id' => ['type' => 'integer', 'length' => 10, 'default' => null, 'null' => true, 'comment' => null, 'precision' => null, 'unsigned' => null, 'autoIncrement' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id_dreconta'], 'length' => []],
            'drecontas_dregrupo_id_fkey' => ['type' => 'foreign', 'columns' => ['dregrupo_id'], 'references' => ['dregrupos', 'id_dregrupo'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
                'id_dreconta' => 1,
                'conta' => 'Lorem ipsum dolor sit amet',
                'descricao' => 'Lorem ipsum dolor sit amet',
                'created' => 1631132611,
                'modified' => 1631132611,
                'dregrupo_id' => 1,
            ],
        ];
        parent::init();
    }
}
