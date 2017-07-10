<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TbLogradouros Model
 *
 * @property \App\Model\Table\TbBairrosTable|\Cake\ORM\Association\BelongsTo $TbBairros
 *
 * @method \App\Model\Entity\TbLogradouro get($primaryKey, $options = [])
 * @method \App\Model\Entity\TbLogradouro newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TbLogradouro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TbLogradouro|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TbLogradouro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TbLogradouro[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TbLogradouro findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TbLogradourosTable extends Table
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

        $this->setTable('tb_logradouros');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('TbBairros', [
            'foreignKey' => 'bairro_id',
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
            ->requirePresence('nome', 'create')
            ->notEmpty('nome');

        $validator
            ->requirePresence('cep', 'create')
            ->notEmpty('cep');

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
        $rules->add($rules->existsIn(['bairro_id'], 'TbBairros'));

        return $rules;
    }
}
