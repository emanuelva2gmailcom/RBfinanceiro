<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FluxogruposTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FluxogruposTable Test Case
 */
class FluxogruposTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FluxogruposTable
     */
    protected $Fluxogrupos;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Fluxogrupos',
        'app.Fluxosubgrupos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Fluxogrupos') ? [] : ['className' => FluxogruposTable::class];
        $this->Fluxogrupos = $this->getTableLocator()->get('Fluxogrupos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Fluxogrupos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FluxogruposTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
