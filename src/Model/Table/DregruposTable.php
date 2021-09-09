<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dregrupos Model
 *
 * @property \App\Model\Table\DrecontasTable&\Cake\ORM\Association\HasMany $Drecontas
 *
 * @method \App\Model\Entity\Dregrupo newEmptyEntity()
 * @method \App\Model\Entity\Dregrupo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Dregrupo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Dregrupo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Dregrupo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Dregrupo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Dregrupo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Dregrupo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dregrupo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Dregrupo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dregrupo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dregrupo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Dregrupo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class DregruposTable extends Table
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

        $this->setTable('dregrupos');
        $this->setDisplayField('id_dregrupo');
        $this->setPrimaryKey('id_dregrupo');

        $this->addBehavior('Timestamp');

        $this->hasMany('Drecontas', [
            'foreignKey' => 'dregrupo_id',
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
            ->integer('id_dregrupo')
            ->allowEmptyString('id_dregrupo', null, 'create');

        $validator
            ->scalar('grupo')
            ->allowEmptyString('grupo');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

        return $validator;
    }
}
