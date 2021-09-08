<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Drecontas Model
 *
 * @property \App\Model\Table\DregruposTable&\Cake\ORM\Association\BelongsTo $Dregrupos
 * @property \App\Model\Table\LancamentosTable&\Cake\ORM\Association\HasMany $Lancamentos
 *
 * @method \App\Model\Entity\Dreconta newEmptyEntity()
 * @method \App\Model\Entity\Dreconta newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Dreconta[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Dreconta get($primaryKey, $options = [])
 * @method \App\Model\Entity\Dreconta findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Dreconta patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Dreconta[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Dreconta|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dreconta saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dreconta[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dreconta[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dreconta[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dreconta[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DrecontasTable extends Table
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

        $this->setTable('drecontas');
        $this->setDisplayField('id_dreconta');
        $this->setPrimaryKey('id_dreconta');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Dregrupos', [
            'foreignKey' => 'dregrupo_id',
        ]);
        $this->hasMany('Lancamentos', [
            'foreignKey' => 'dreconta_id',
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
            ->integer('id_dreconta')
            ->allowEmptyString('id_dreconta', null, 'create');

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
        $rules->add($rules->existsIn(['dregrupo_id'], 'Dregrupos'), ['errorField' => 'dregrupo_id']);

        return $rules;
    }
}
