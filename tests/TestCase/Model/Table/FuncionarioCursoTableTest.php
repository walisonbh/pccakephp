<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FuncionarioCursoTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FuncionarioCursoTable Test Case
 */
class FuncionarioCursoTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FuncionarioCursoTable
     */
    public $FuncionarioCurso;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tb_funcionario_curso',
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
        $config = TableRegistry::exists('FuncionarioCurso') ? [] : ['className' => FuncionarioCursoTable::class];
        $this->FuncionarioCurso = TableRegistry::get('FuncionarioCurso', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FuncionarioCurso);

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
