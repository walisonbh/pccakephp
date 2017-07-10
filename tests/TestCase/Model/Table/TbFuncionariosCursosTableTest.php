<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TbFuncionariosCursosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TbFuncionariosCursosTable Test Case
 */
class TbFuncionariosCursosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TbFuncionariosCursosTable
     */
    public $TbFuncionariosCursos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tb_funcionarios_cursos',
        'app.tb_cursos',
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
        $config = TableRegistry::exists('TbFuncionariosCursos') ? [] : ['className' => TbFuncionariosCursosTable::class];
        $this->TbFuncionariosCursos = TableRegistry::get('TbFuncionariosCursos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TbFuncionariosCursos);

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
