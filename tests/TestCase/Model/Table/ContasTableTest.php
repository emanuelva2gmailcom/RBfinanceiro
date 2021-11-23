<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ContasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ContasTable Test Case
 */
class ContasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ContasTable
     */
    protected $Contas;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Contas',
        'app.Subgrupos',
        'app.Subcontas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Contas') ? [] : ['className' => ContasTable::class];
        $this->Contas = $this->getTableLocator()->get('Contas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Contas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ContasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ContasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
