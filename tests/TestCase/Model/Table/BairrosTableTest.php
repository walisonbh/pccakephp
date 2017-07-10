<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\BairrosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\BairrosTable Test Case
 */
class BairrosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\BairrosTable
     */
    public $Bairros;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tb_bairros',
        'app.tb_cidades'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Bairros') ? [] : ['className' => BairrosTable::class];
        $this->Bairros = TableRegistry::get('Bairros', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Bairros);

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
