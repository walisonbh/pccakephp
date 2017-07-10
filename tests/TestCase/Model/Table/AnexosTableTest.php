<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnexosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnexosTable Test Case
 */
class AnexosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AnexosTable
     */
    public $Anexos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tb_anexos',
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
        $config = TableRegistry::exists('Anexos') ? [] : ['className' => AnexosTable::class];
        $this->Anexos = TableRegistry::get('Anexos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Anexos);

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
