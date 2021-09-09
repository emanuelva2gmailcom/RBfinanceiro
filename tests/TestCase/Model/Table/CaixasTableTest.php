<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CaixasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CaixasTable Test Case
 */
class CaixasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CaixasTable
     */
    protected $Caixas;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Caixas',
        'app.Caixaregistros',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Caixas') ? [] : ['className' => CaixasTable::class];
        $this->Caixas = $this->getTableLocator()->get('Caixas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Caixas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CaixasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
