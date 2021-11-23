<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Grupos Model
 *
 * @property \App\Model\Table\SubgruposTable&\Cake\ORM\Association\HasMany $Subgrupos
 *
 * @method \App\Model\Entity\Grupo newEmptyEntity()
 * @method \App\Model\Entity\Grupo newEntity(array $data, array $options = [])
 * @method \App\Model\Entity\Grupo[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Grupo get($primaryKey, $options = [])
 * @method \App\Model\Entity\Grupo findOrCreate($search, ?callable $callback = null, $options = [])
 * @method \App\Model\Entity\Grupo patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Grupo[] patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Grupo|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Grupo saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Grupo[]|\Cake\Datasource\ResultSetInterface|false saveMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Grupo[]|\Cake\Datasource\ResultSetInterface saveManyOrFail(iterable $entities, $options = [])
 * @method \App\Model\Entity\Grupo[]|\Cake\Datasource\ResultSetInterface|false deleteMany(iterable $entities, $options = [])
 * @method \App\Model\Entity\Grupo[]|\Cake\Datasource\ResultSetInterface deleteManyOrFail(iterable $entities, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class GruposTable extends Table
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

        $this->setTable('grupos');
        $this->setDisplayField('grupo');
        $this->setPrimaryKey('id_grupo');

        $this->addBehavior('Timestamp');

        $this->hasMany('Subgrupos', [
            'foreignKey' => 'grupo_id',
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
            ->integer('id_grupo')
            ->allowEmptyString('id_grupo', null, 'create');

        $validator
            ->scalar('grupo')
            ->allowEmptyString('grupo');

        $validator
            ->scalar('descricao')
            ->allowEmptyString('descricao');

        return $validator;
    }
}
