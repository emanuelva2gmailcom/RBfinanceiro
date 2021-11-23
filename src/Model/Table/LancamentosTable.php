<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lancamentos Model
 *
 * @property \App\Model\Table\SubcontasTable&\Cake\ORM\Association\BelongsTo $Subcontas
 * @property \App\Model\Table\FornecedoresTable&\Cake\ORM\Association\BelongsTo $Fornecedores
 * @property \App\Model\Table\ClientesTable&\Cake\ORM\Association\BelongsTo $Clientes
 * @property \App\Model\Table\LancamentosTable&\Cake\ORM\Association\BelongsTo $Lancamentos
 * @property \App\Model\Table\DrecontasTable&\Cake\ORM\Association\BelongsTo $Drecontas
 * @property \App\Model\Table\CaixaregistrosTable&\Cake\ORM\Association\HasMany $Caixaregistros
 * @property \App\Model\Table\ComprovantesTable&\Cake\ORM\Association\HasMany $Comprovantes
 * @property \App\Model\Table\LancamentosTable&\Cake\ORM\Association\HasMany $Lancamentos
 *
 * @method \App\Model\Entity\Lancamento newEmptyEntity()
 * @method \App\Model\Entity\Lancamento newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Lancamento[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Lancamento get($primaryKey, $options = [])
 * @method \App\Model\Entity\Lancamento findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Lancamento patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Lancamento[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Lancamento|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lancamento saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Lancamento[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lancamento[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lancamento[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Lancamento[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LancamentosTable extends Table
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

        $this->setTable('lancamentos');
        $this->setDisplayField('tipo');
        $this->setPrimaryKey('id_lancamento');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Subcontas', [
            'foreignKey' => 'fluxoconta_id',
        ]);
        $this->belongsTo('Fornecedores', [
            'foreignKey' => 'fornecedor_id',
        ]);
        $this->belongsTo('Clientes', [
            'foreignKey' => 'cliente_id',
        ]);
        $this->belongsTo('Lancamentos', [
            'foreignKey' => 'lancamento_id',
        ]);
        $this->belongsTo('Drecontas', [
            'foreignKey' => 'dreconta_id',
        ]);
        $this->hasMany('Caixaregistros', [
            'foreignKey' => 'lancamento_id',
        ]);
        $this->hasMany('Comprovantes', [
            'foreignKey' => 'lancamento_id',
        ]);
        $this->hasMany('Lancamentos', [
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
            ->integer('id_lancamento')
            ->allowEmptyString('id_lancamento', null, 'create');

        $validator
            ->scalar('tipo')
            ->allowEmptyString('tipo');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

        $validator
            ->decimal('valor')
            ->allowEmptyString('valor');

        $validator
            ->dateTime('data_emissao')
            ->allowEmptyDateTime('data_emissao');

        $validator
            ->dateTime('data_baixa')
            ->allowEmptyDateTime('data_baixa');

        $validator
            ->dateTime('data_vencimento')
            ->allowEmptyDateTime('data_vencimento');

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
        $rules->add($rules->existsIn(['subconta_id'], 'Subcontas'), ['errorField' => 'subconta_id']);
        $rules->add($rules->existsIn(['fornecedor_id'], 'Fornecedores'), ['errorField' => 'fornecedor_id']);
        $rules->add($rules->existsIn(['cliente_id'], 'Clientes'), ['errorField' => 'cliente_id']);
        $rules->add($rules->existsIn(['lancamento_id'], 'Lancamentos'), ['errorField' => 'lancamento_id']);
        // $rules->add($rules->existsIn(['dreconta_id'], 'Drecontas'), ['errorField' => 'dreconta_id']);

        return $rules;
    }
}
