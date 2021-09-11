<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fluxocontas Model
 *
 * @property \App\Model\Table\FluxosubgruposTable&\Cake\ORM\Association\BelongsTo $Fluxosubgrupos
 * @property \App\Model\Table\LancamentosTable&\Cake\ORM\Association\HasMany $Lancamentos
 *
 * @method \App\Model\Entity\Fluxoconta newEmptyEntity()
 * @method \App\Model\Entity\Fluxoconta newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Fluxoconta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fluxoconta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fluxoconta findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Fluxoconta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fluxoconta[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fluxoconta|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fluxoconta saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fluxoconta[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fluxoconta[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fluxoconta[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fluxoconta[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FluxocontasTable extends Table
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

        $this->setTable('fluxocontas');
        $this->setDisplayField('conta');
        $this->setPrimaryKey('id_fluxoconta');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Fluxosubgrupos', [
            'foreignKey' => 'fluxosubgrupo_id',
        ]);
        $this->hasMany('Lancamentos', [
            'foreignKey' => 'fluxoconta_id',
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
            ->integer('id_fluxoconta')
            ->allowEmptyString('id_fluxoconta', null, 'create');

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
        $rules->add($rules->existsIn(['fluxosubgrupo_id'], 'Fluxosubgrupos'), ['errorField' => 'fluxosubgrupo_id']);

        return $rules;
    }
}
