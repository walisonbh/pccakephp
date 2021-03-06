<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * FuncionariosLogradouro Entity
 *
 * @property int $id
 * @property string $numero
 * @property int $logradouro_id
 * @property int $funcionario_id
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Logradouro $tb_logradouro
 * @property \App\Model\Entity\Funcionario $tb_funcionario
 */
class FuncionariosLogradouro extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
