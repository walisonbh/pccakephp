<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Anexo Entity
 *
 * @property int $id
 * @property string $anexotipo
 * @property string $application_type
 * @property string $formato
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 * @property string $estadocivil
 * @property string $nome
 * @property int $funcionario_id
 * @property string|resource $bytes
 *
 * @property \App\Model\Entity\Funcionario $tb_funcionario
 */
class Anexo extends Entity
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
