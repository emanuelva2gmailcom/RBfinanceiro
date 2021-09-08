<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ComprovantesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ComprovantesTable Test Case
 */
class ComprovantesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ComprovantesTable
     */
    protected $Comprovantes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Comprovantes',
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
        $config = $this->getTableLocator()->exists('Comprovantes') ? [] : ['className' => ComprovantesTable::class];
        $this->Comprovantes = $this->getTableLocator()->get('Comprovantes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Comprovantes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ComprovantesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ComprovantesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
