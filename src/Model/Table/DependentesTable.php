<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dependentes Model
 *
 * @property \App\Model\Table\FuncionariosTable|\Cake\ORM\Association\BelongsTo $Funcionarios
 *
 * @method \App\Model\Entity\Dependente get($primaryKey, $options = [])
 * @method \App\Model\Entity\Dependente newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Dependente[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Dependente|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dependente patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Dependente[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Dependente findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DependentesTable extends Table
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

        $this->setTable('tb_dependentes');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

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
            ->requirePresence('application_type', 'create')
            ->notEmpty('application_type');

        $validator
            ->requirePresence('formato', 'create')
            ->notEmpty('formato');

        $validator
            ->allowEmpty('nome');

        $validator
            ->allowEmpty('bytes');

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
        $rules->add($rules->existsIn(['funcionario_id'], 'Funcionarios'));

        return $rules;
    }
}
