<?php

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Funcionarios Model
 *
 * @property \App\Model\Table\CidadesTable|\Cake\ORM\Association\BelongsTo $Cidades
 * @property \App\Model\Table\DependentesTable|\Cake\ORM\Association\BelongsTo $Dependentes
 * @property \App\Model\Table\FuncionariosCursosTable|\Cake\ORM\Association\BelongsTo $FuncionariosCursos
 * @property \App\Model\Table\FuncionariosLogradourosTable|\Cake\ORM\Association\BelongsTo $FuncionariosLogradouros
 *
 * @method \App\Model\Entity\Funcionario get($primaryKey, $options = [])
 * @method \App\Model\Entity\Funcionario newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Funcionario[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Funcionario|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Funcionario patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Funcionario[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Funcionario findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FuncionariosTable extends Table {

	/**
	 * Initialize method
	 *
	 * @param array $config The configuration for the Table.
	 * @return void
	 */
	public function initialize(array $config) {
		parent::initialize($config);

		$this->setTable('tb_funcionarios');
		$this->setDisplayField('nome');
		$this->setPrimaryKey('id');

		$this->addBehavior('Timestamp');

		$this->belongsTo('Cidades', [
			'foreignKey' => 'cidade_id',
			'joinType' => 'INNER'
		]);

		$this->hasMany('Anexos', [
			'foreignKey' => 'funcionario_id',
			'saveStrategy' => 'replace',
			'dependent' => true
		]);
		
		$this->hasMany('Dependentes', [
			'foreignKey' => 'funcionario_id',
			'saveStrategy' => 'replace',
			'dependent' => true
		]);

		$this->hasMany('FuncionariosCursos', [
			'foreignKey' => 'funcionario_id',
			'saveStrategy' => 'replace',
			'dependent' => true
		]);

		$this->hasMany('FuncionariosLogradouros', [
			'foreignKey' => 'funcionario_id',
			'saveStrategy' => 'replace',
			'dependent' => true
		]);
	}

	/**
	 * Default validation rules.
	 *
	 * @param \Cake\Validation\Validator $validator Validator instance.
	 * @return \Cake\Validation\Validator
	 */
	public function validationDefault(Validator $validator) {
		$validator
			->integer('id')
			->allowEmpty('id', 'create');

		$validator
			->requirePresence('nome', 'create')
			->notEmpty('nome');

		$validator
			->requirePresence('cpf', 'create')
			->notEmpty('cpf');

		$validator
			->requirePresence('matricula', 'create')
			->notEmpty('matricula');

		$validator
			->allowEmpty('estadocivil');

		$validator
			->allowEmpty('salario');

		$validator
			->integer('temfilhos')
			->allowEmpty('temfilhos');

		$validator
			->allowEmpty('imagem');

		$validator
			->allowEmpty('brevedescricao');

		return $validator;
	}

	/**
	 * Returns a rules checker object that will be used for validating
	 * application integrity.
	 *
	 * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
	 * @return \Cake\ORM\RulesChecker
	 */
	public function buildRules(RulesChecker $rules) {
		$rules->add($rules->existsIn(['cidade_id'], 'Cidades'));

		return $rules;
	}

}
