<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * FuncionariosLogradouros Model
 *
 * @property \App\Model\Table\LogradourosTable|\Cake\ORM\Association\BelongsTo $Logradouros
 * @property \App\Model\Table\FuncionariosTable|\Cake\ORM\Association\BelongsTo $Funcionarios
 *
 * @method \App\Model\Entity\FuncionariosLogradouro get($primaryKey, $options = [])
 * @method \App\Model\Entity\FuncionariosLogradouro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\FuncionariosLogradouro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\FuncionariosLogradouro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\FuncionariosLogradouro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\FuncionariosLogradouro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\FuncionariosLogradouro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FuncionariosLogradourosTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('tb_funcionarios_logradouros');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Logradouros', [
            'foreignKey' => 'logradouro_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Funcionarios', [
            'foreignKey' => 'funcionario_id',
            'joinType' => 'INNER'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('cep', 'create')
            ->notEmpty('cep', 'O campo "CEP" é de preenchimento obrigatório.');

        $validator
            ->requirePresence('numero', 'create')
            ->notEmpty('numero', 'O campo "Número" é de preenchimento obrigatório.');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['logradouro_id'], 'Logradouros'));
        $rules->add($rules->existsIn(['funcionario_id'], 'Funcionarios'));

        return $rules;
    }
}
