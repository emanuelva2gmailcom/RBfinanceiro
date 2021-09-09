<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FluxocontasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FluxocontasTable Test Case
 */
class FluxocontasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FluxocontasTable
     */
    protected $Fluxocontas;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Fluxocontas',
        'app.Fluxosubgrupos',
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
        $config = $this->getTableLocator()->exists('Fluxocontas') ? [] : ['className' => FluxocontasTable::class];
        $this->Fluxocontas = $this->getTableLocator()->get('Fluxocontas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Fluxocontas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FluxocontasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FluxocontasTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
