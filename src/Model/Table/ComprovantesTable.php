<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Comprovantes Model
 *
 * @property \App\Model\Table\LancamentosTable&\Cake\ORM\Association\BelongsTo $Lancamentos
 *
 * @method \App\Model\Entity\Comprovante newEmptyEntity()
 * @method \App\Model\Entity\Comprovante newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Comprovante[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Comprovante get($primaryKey, $options = [])
 * @method \App\Model\Entity\Comprovante findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Comprovante patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Comprovante[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Comprovante|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Comprovante saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Comprovante[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comprovante[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comprovante[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Comprovante[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ComprovantesTable extends Table
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

        $this->setTable('comprovantes');
        $this->setDisplayField('id_comprovante');
        $this->setPrimaryKey('id_comprovante');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Lancamentos', [
            'foreignKey' => 'lancamento_id',
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
            ->integer('id_comprovante')
            ->allowEmptyString('id_comprovante', null, 'create');

        $validator
            ->scalar('nome_arquivo')
            ->allowEmptyString('nome_arquivo');

        $validator
            ->scalar('tipo')
            ->allowEmptyString('tipo');

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
        $rules->add($rules->existsIn(['lancamento_id'], 'Lancamentos'), ['errorField' => 'lancamento_id']);

        return $rules;
    }
}
