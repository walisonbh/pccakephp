<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PaisesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PaisesTable Test Case
 */
class PaisesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PaisesTable
     */
    public $Paises;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('Paises') ? [] : ['className' => PaisesTable::class];
        $this->Paises = TableRegistry::get('Paises', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Paises);

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
}
