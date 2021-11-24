<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Subgrupos Model
 *
 * @property \App\Model\Table\GruposTable&\Cake\ORM\Association\BelongsTo $Grupos
 * @property \App\Model\Table\ContasTable&\Cake\ORM\Association\HasMany $Contas
 *
 * @method \App\Model\Entity\Subgrupo newEmptyEntity()
 * @method \App\Model\Entity\Subgrupo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Subgrupo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Subgrupo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Subgrupo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Subgrupo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Subgrupo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Subgrupo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subgrupo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Subgrupo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subgrupo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subgrupo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Subgrupo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class SubgruposTable extends Table
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

        $this->setTable('subgrupos');
        $this->setDisplayField('subgrupo');
        $this->setPrimaryKey('id_subgrupo');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Grupos', [
            'foreignKey' => 'grupo_id',
        ]);
        $this->hasMany('Contas', [
            'foreignKey' => 'subgrupo_id',
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
            ->integer('id_subgrupo')
            ->allowEmptyString('id_subgrupo', null, 'create');

        $validator
            ->scalar('subgrupo')
            ->allowEmptyString('subgrupo');

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
        $rules->add($rules->existsIn(['grupo_id'], 'Grupos'), ['errorField' => 'grupo_id']);

        return $rules;
    }
}
