<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Caixas Model
 *
 * @property \App\Model\Table\CaixaregistrosTable&\Cake\ORM\Association\HasMany $Caixaregistros
 *
 * @method \App\Model\Entity\Caixa newEmptyEntity()
 * @method \App\Model\Entity\Caixa newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Caixa[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Caixa get($primaryKey, $options = [])
 * @method \App\Model\Entity\Caixa findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Caixa patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Caixa[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Caixa|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Caixa saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caixa[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CaixasTable extends Table
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

        $this->setTable('caixas');
        $this->setDisplayField('id_caixa');
        $this->setPrimaryKey('id_caixa');

        $this->addBehavior('Timestamp');

        $this->hasMany('Caixaregistros', [
            'foreignKey' => 'caixa_id',
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
            ->integer('id_caixa')
            ->allowEmptyString('id_caixa', null, 'create');

        $validator
            ->integer('data_caixa')
            ->allowEmptyString('data_caixa');

        $validator
            ->boolean('is_aberto')
            ->allowEmptyString('is_aberto');

        return $validator;
    }
}
