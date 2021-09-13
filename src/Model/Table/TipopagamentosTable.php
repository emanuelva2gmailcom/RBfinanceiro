<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Tipopagamentos Model
 *
 * @property \App\Model\Table\CaixaregistrosTable&\Cake\ORM\Association\HasMany $Caixaregistros
 *
 * @method \App\Model\Entity\Tipopagamento newEmptyEntity()
 * @method \App\Model\Entity\Tipopagamento newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Tipopagamento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Tipopagamento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Tipopagamento findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Tipopagamento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Tipopagamento[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Tipopagamento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tipopagamento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Tipopagamento[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tipopagamento[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tipopagamento[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Tipopagamento[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TipopagamentosTable extends Table
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

        $this->setTable('tipopagamentos');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id_tipopagamento');

        $this->addBehavior('Timestamp');

        $this->hasMany('Caixaregistros', [
            'foreignKey' => 'tipopagamento_id',
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
            ->integer('id_tipopagamento')
            ->allowEmptyString('id_tipopagamento', null, 'create');

        $validator
            ->scalar('nome')
            ->allowEmptyString('nome');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

        return $validator;
    }
}
