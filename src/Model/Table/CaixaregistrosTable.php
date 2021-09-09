<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Caixaregistros Model
 *
 * @property \App\Model\Table\CaixasTable&\Cake\ORM\Association\BelongsTo $Caixas
 * @property \App\Model\Table\TipopagamentosTable&\Cake\ORM\Association\BelongsTo $Tipopagamentos
 * @property \App\Model\Table\LancamentosTable&\Cake\ORM\Association\BelongsTo $Lancamentos
 *
 * @method \App\Model\Entity\Caixaregistro newEmptyEntity()
 * @method \App\Model\Entity\Caixaregistro newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Caixaregistro[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Caixaregistro get($primaryKey, $options = [])
 * @method \App\Model\Entity\Caixaregistro findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Caixaregistro patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Caixaregistro[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Caixaregistro|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Caixaregistro saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Caixaregistro[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caixaregistro[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caixaregistro[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Caixaregistro[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 */
class CaixaregistrosTable extends Table
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

        $this->setTable('caixaregistros');
        $this->setDisplayField('id_caixaregistro');
        $this->setPrimaryKey('id_caixaregistro');

        $this->belongsTo('Caixas', [
            'foreignKey' => 'caixa_id',
        ]);
        $this->belongsTo('Tipopagamentos', [
            'foreignKey' => 'tipopagamento_id',
        ]);
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
            ->integer('id_caixaregistro')
            ->allowEmptyString('id_caixaregistro', null, 'create');

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
        $rules->add($rules->existsIn(['caixa_id'], 'Caixas'), ['errorField' => 'caixa_id']);
        $rules->add($rules->existsIn(['tipopagamento_id'], 'Tipopagamentos'), ['errorField' => 'tipopagamento_id']);
        $rules->add($rules->existsIn(['lancamento_id'], 'Lancamentos'), ['errorField' => 'lancamento_id']);

        return $rules;
    }
}
