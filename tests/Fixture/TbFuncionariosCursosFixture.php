<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TbFuncionariosCursosFixture
 *
 */
class TbFuncionariosCursosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'curso_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'funcionario_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_curso_func_idx' => ['type' => 'index', 'columns' => ['curso_id'], 'length' => []],
            'fk_func_curso_idx' => ['type' => 'index', 'columns' => ['funcionario_id'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_curso_func' => ['type' => 'foreign', 'columns' => ['curso_id'], 'references' => ['tb_cursos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_func_curso' => ['type' => 'foreign', 'columns' => ['funcionario_id'], 'references' => ['tb_funcionarios', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'curso_id' => 1,
            'funcionario_id' => 1,
            'created' => '2017-07-08 19:56:14',
            'modified' => '2017-07-08 19:56:14'
        ],
    ];
}
