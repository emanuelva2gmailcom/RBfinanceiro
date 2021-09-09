<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DregruposTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DregruposTable Test Case
 */
class DregruposTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DregruposTable
     */
    protected $Dregrupos;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Dregrupos',
        'app.Drecontas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Dregrupos') ? [] : ['className' => DregruposTable::class];
        $this->Dregrupos = $this->getTableLocator()->get('Dregrupos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Dregrupos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DregruposTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
