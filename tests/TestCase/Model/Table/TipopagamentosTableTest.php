<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TipopagamentosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TipopagamentosTable Test Case
 */
class TipopagamentosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\TipopagamentosTable
     */
    protected $Tipopagamentos;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Tipopagamentos',
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
        $config = $this->getTableLocator()->exists('Tipopagamentos') ? [] : ['className' => TipopagamentosTable::class];
        $this->Tipopagamentos = $this->getTableLocator()->get('Tipopagamentos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Tipopagamentos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\TipopagamentosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
