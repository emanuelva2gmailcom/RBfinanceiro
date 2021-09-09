<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DrecontasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DrecontasTable Test Case
 */
class DrecontasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DrecontasTable
     */
    protected $Drecontas;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Drecontas',
        'app.Dregrupos',
        'app.Lancamentos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Drecontas') ? [] : ['className' => DrecontasTable::class];
        $this->Drecontas = $this->getTableLocator()->get('Drecontas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Drecontas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DrecontasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DrecontasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
