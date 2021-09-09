<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FluxosubgruposTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FluxosubgruposTable Test Case
 */
class FluxosubgruposTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FluxosubgruposTable
     */
    protected $Fluxosubgrupos;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Fluxosubgrupos',
        'app.Fluxogrupos',
        'app.Fluxocontas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Fluxosubgrupos') ? [] : ['className' => FluxosubgruposTable::class];
        $this->Fluxosubgrupos = $this->getTableLocator()->get('Fluxosubgrupos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Fluxosubgrupos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FluxosubgruposTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\FluxosubgruposTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
