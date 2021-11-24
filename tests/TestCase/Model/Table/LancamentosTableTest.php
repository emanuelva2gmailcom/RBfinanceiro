<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LancamentosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LancamentosTable Test Case
 */
class LancamentosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\LancamentosTable
     */
    protected $Lancamentos;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Lancamentos',
        'app.Subcontas',
        'app.Fornecedores',
        'app.Clientes',
        'app.Caixaregistros',
        'app.Comprovantes',
        'app.Subgrupos',
        'app.Notifications',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Lancamentos') ? [] : ['className' => LancamentosTable::class];
        $this->Lancamentos = $this->getTableLocator()->get('Lancamentos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Lancamentos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\LancamentosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\LancamentosTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
