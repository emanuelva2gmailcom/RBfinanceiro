<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SubcontasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SubcontasTable Test Case
 */
class SubcontasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SubcontasTable
     */
    protected $Subcontas;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Subcontas',
        'app.Contas',
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
        $config = $this->getTableLocator()->exists('Subcontas') ? [] : ['className' => SubcontasTable::class];
        $this->Subcontas = $this->getTableLocator()->get('Subcontas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Subcontas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SubcontasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\SubcontasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
