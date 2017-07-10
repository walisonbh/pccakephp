<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LogradourosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LogradourosTable Test Case
 */
class LogradourosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LogradourosTable
     */
    public $Logradouros;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tb_logradouros',
        'app.tb_bairros',
        'app.tb_cidades',
        'app.tb_estados',
        'app.tb_paises'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Logradouros') ? [] : ['className' => LogradourosTable::class];
        $this->Logradouros = TableRegistry::get('Logradouros', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Logradouros);

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
