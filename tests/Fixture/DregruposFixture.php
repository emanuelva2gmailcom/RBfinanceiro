<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DregruposFixture
 */
class DregruposFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // phpcs:disable
    public $fields = [
        'id_dregrupo' => ['type' => 'integer', 'length' => 10, 'autoIncrement' => true, 'default' => null, 'null' => false, 'comment' => null, 'precision' => null, 'unsigned' => null],
        'grupo' => ['type' => 'string', 'length' => null, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null],
        'descricao' => ['type' => 'string', 'length' => null, 'default' => null, 'null' => true, 'collate' => null, 'comment' => null, 'precision' => null],
        'created' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        'modified' => ['type' => 'timestampfractional', 'length' => null, 'default' => null, 'null' => true, 'comment' => null, 'precision' => 6],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id_dregrupo'], 'length' => []],
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
                'id_dregrupo' => 1,
                'grupo' => 'Lorem ipsum dolor sit amet',
                'descricao' => 'Lorem ipsum dolor sit amet',
                'created' => 1631132616,
                'modified' => 1631132616,
            ],
        ];
        parent::init();
    }
}
