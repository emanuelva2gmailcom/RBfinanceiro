<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fluxogrupos Model
 *
 * @property \App\Model\Table\FluxosubgruposTable&\Cake\ORM\Association\HasMany $Fluxosubgrupos
 *
 * @method \App\Model\Entity\Fluxogrupo newEmptyEntity()
 * @method \App\Model\Entity\Fluxogrupo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Fluxogrupo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fluxogrupo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Fluxogrupo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Fluxogrupo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Fluxogrupo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fluxogrupo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fluxogrupo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Fluxogrupo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fluxogrupo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fluxogrupo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Fluxogrupo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class FluxogruposTable extends Table
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

        $this->setTable('fluxogrupos');
        $this->setDisplayField('grupo');
        $this->setPrimaryKey('id_fluxogrupo');

        $this->addBehavior('Timestamp');

        $this->hasMany('Fluxosubgrupos', [
            'foreignKey' => 'fluxogrupo_id',
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
            ->integer('id_fluxogrupo')
            ->allowEmptyString('id_fluxogrupo', null, 'create');

        $validator
            ->scalar('grupo')
            ->allowEmptyString('grupo');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

        return $validator;
    }
}
