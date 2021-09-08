<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FornecedoresTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FornecedoresTable Test Case
 */
class FornecedoresTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\FornecedoresTable
     */
    protected $Fornecedores;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Fornecedores',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Fornecedores') ? [] : ['className' => FornecedoresTable::class];
        $this->Fornecedores = $this->getTableLocator()->get('Fornecedores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Fornecedores);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\FornecedoresTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
