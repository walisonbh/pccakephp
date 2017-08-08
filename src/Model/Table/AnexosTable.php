<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Anexos Model
 *
 * @property \App\Model\Table\FuncionariosTable|\Cake\ORM\Association\BelongsTo $Funcionarios
 *
 * @method \App\Model\Entity\Anexo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Anexo newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Anexo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Anexo|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Anexo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Anexo[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Anexo findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AnexosTable extends Table
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

        $this->setTable('tb_anexos');
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
            ->notEmpty('id', 'create');

        $validator
            ->requirePresence('anexotipo', 'create')
            ->notEmpty('anexotipo');

        $validator
            ->requirePresence('application_type', 'create')
            ->notEmpty('application_type');

        $validator
            ->requirePresence('formato', 'create')
            ->notEmpty('formato');

        $validator
            ->allowEmpty('estadocivil');

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
