<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbFuncionariosLogradourosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbFuncionariosLogradourosTable Test Case
 */
class TbFuncionariosLogradourosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TbFuncionariosLogradourosTable
     */
    public $TbFuncionariosLogradouros;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tb_funcionarios_logradouros',
        'app.tb_logradouros',
        'app.tb_funcionarios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TbFuncionariosLogradouros') ? [] : ['className' => TbFuncionariosLogradourosTable::class];
        $this->TbFuncionariosLogradouros = TableRegistry::get('TbFuncionariosLogradouros', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbFuncionariosLogradouros);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
