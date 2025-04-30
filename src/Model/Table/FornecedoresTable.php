<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Fornecedores Model
 *
 * @method \App\Model\Entity\Fornecedore newEmptyEntity()
 * @method \App\Model\Entity\Fornecedore newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Fornecedore> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Fornecedore get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Fornecedore findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Fornecedore patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Fornecedore> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Fornecedore|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Fornecedore saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Fornecedore>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fornecedore>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Fornecedore>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fornecedore> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Fornecedore>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fornecedore>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Fornecedore>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Fornecedore> deleteManyOrFail(iterable $entities, array $options = [])
 */
class FornecedoresTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('fornecedores');
        $this->setDisplayField('nome');
        $this->setPrimaryKey('id_fornecedor');
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
            ->scalar('nome')
            ->maxLength('nome', 255)
            ->requirePresence('nome', 'create')
            ->notEmptyString('nome');

        $validator
            ->scalar('cnpj')
            ->maxLength('cnpj', 20)
            ->requirePresence('cnpj', 'create')
            ->notEmptyString('cnpj')
            ->add('cnpj', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('contato')
            ->maxLength('contato', 50)
            ->allowEmptyString('contato');

        $validator
            ->scalar('categoria')
            ->maxLength('categoria', 255)
            ->allowEmptyString('categoria');

        $validator
            ->dateTime('data_cadastro')
            ->allowEmptyDateTime('data_cadastro');

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
        $rules->add($rules->isUnique(['cnpj']), ['errorField' => 'cnpj']);

        return $rules;
    }
}
