<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contas Model
 *
 * @property \App\Model\Table\SubgruposTable&\Cake\ORM\Association\BelongsTo $Subgrupos
 * @property \App\Model\Table\SubcontasTable&\Cake\ORM\Association\HasMany $Subcontas
 *
 * @method \App\Model\Entity\Conta newEmptyEntity()
 * @method \App\Model\Entity\Conta newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Conta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Conta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Conta findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Conta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Conta[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Conta|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Conta saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Conta[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Conta[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Conta[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Conta[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ContasTable extends Table
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

        $this->setTable('contas');
        $this->setDisplayField('conta');
        $this->setPrimaryKey('id_conta');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Subgrupos', [
            'foreignKey' => 'subgrupo_id',
        ]);
        $this->hasMany('Subcontas', [
            'foreignKey' => 'conta_id',
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
            ->integer('id_conta')
            ->allowEmptyString('id_conta', null, 'create');

        $validator
            ->scalar('conta')
            ->allowEmptyString('conta');

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
        $rules->add($rules->existsIn(['subgrupo_id'], 'Subgrupos'), ['errorField' => 'subgrupo_id']);

        return $rules;
    }
}
