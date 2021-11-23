<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subcontas Model
 *
 * @property \App\Model\Table\ContasTable&\Cake\ORM\Association\BelongsTo $Contas
 * @property \App\Model\Table\LancamentosTable&\Cake\ORM\Association\HasMany $Lancamentos
 *
 * @method \App\Model\Entity\Subconta newEmptyEntity()
 * @method \App\Model\Entity\Subconta newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Subconta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subconta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Subconta findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Subconta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Subconta[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subconta|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subconta saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subconta[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subconta[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subconta[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subconta[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubcontasTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('subcontas');
        $this->setDisplayField('id_subconta');
        $this->setPrimaryKey('id_subconta');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Contas', [
            'foreignKey' => 'conta_id',
        ]);
        $this->hasMany('Lancamentos', [
            'foreignKey' => 'subconta_id',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id_subconta')
            ->allowEmptyString('id_subconta', null, 'create');

        $validator
            ->scalar('subconta')
            ->allowEmptyString('subconta');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['conta_id'], 'Contas'), ['errorField' => 'conta_id']);

        return $rules;
    }
}
