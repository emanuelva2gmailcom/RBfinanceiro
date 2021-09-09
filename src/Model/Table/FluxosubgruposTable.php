<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fluxosubgrupos Model
 *
 * @property \App\Model\Table\FluxogruposTable&\Cake\ORM\Association\BelongsTo $Fluxogrupos
 * @property \App\Model\Table\FluxocontasTable&\Cake\ORM\Association\HasMany $Fluxocontas
 *
 * @method \App\Model\Entity\Fluxosubgrupo newEmptyEntity()
 * @method \App\Model\Entity\Fluxosubgrupo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Fluxosubgrupo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fluxosubgrupo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fluxosubgrupo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Fluxosubgrupo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fluxosubgrupo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fluxosubgrupo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fluxosubgrupo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fluxosubgrupo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fluxosubgrupo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fluxosubgrupo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fluxosubgrupo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FluxosubgruposTable extends Table
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

        $this->setTable('fluxosubgrupos');
        $this->setDisplayField('id_fluxosubgrupo');
        $this->setPrimaryKey('id_fluxosubgrupo');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Fluxogrupos', [
            'foreignKey' => 'fluxogrupo_id',
        ]);
        $this->hasMany('Fluxocontas', [
            'foreignKey' => 'fluxosubgrupo_id',
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
            ->integer('id_fluxosubgrupo')
            ->allowEmptyString('id_fluxosubgrupo', null, 'create');

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
        $rules->add($rules->existsIn(['fluxogrupo_id'], 'Fluxogrupos'), ['errorField' => 'fluxogrupo_id']);

        return $rules;
    }
}
