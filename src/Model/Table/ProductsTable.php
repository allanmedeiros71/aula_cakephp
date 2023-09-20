<?php
namespace App\Model\Table;

use App\Model\Entity\Product;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Products Model
 *
 * @method \App\Model\Entity\Product get($primaryKey, $options = [])
 * @method \App\Model\Entity\Product newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Product[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Product|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Product patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Product[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Product findOrCreate($search, callable $callback = null, $options = [])
 */
class ProductsTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('products');
        $this->setDisplayField('ProductID');
        $this->setPrimaryKey('ProductID');

        $this->belongsTo('suppliers', [
            'joinType'=>'INNER',
            'foreignKey'=> 'SupplierID'
        ]);

        $this->belongsTo('categories', [
            'joinType'=>'INNER',
            'foreignKey'=> 'CategoryID'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('ProductID')
            ->allowEmptyString('ProductID', null, 'create');

        $validator
            ->scalar('ProductName')
            ->maxLength('ProductName', 255)
            ->allowEmptyString('ProductName');

        $validator
            ->integer('SupplierID')
            ->allowEmptyString('SupplierID');

        $validator
            ->integer('CategoryID')
            ->allowEmptyString('CategoryID');

        $validator
            ->scalar('Unit')
            ->maxLength('Unit', 255)
            ->allowEmptyString('Unit');

        $validator
            ->decimal('Price')
            ->greaterThan('Price', 0, 'Price must be greater than zero')
            ->allowEmptyString('Price');

        return $validator;
    }

    public function buildRules(RulesChecker $rules){
        // parent::buildRules($rules);

        $rules->add($rules->isUnique(['ProductName'],'Product Name already exists'));
        $rules->add($rules->existsIn(['SupplierID'], 'suppliers','SupplierID must exists in supplier table'));
        $rules->add($rules->existsIn(['CategoryID'], 'categories','CategotyID must exists in category table'));

        // $rules->add(callable $rule, $name = null, array $options = []);
        $rules->add(function(Product $entity){
            return $entity->isDirty('Unit'); // O campo Unit não foi alterado 
        },'verifica_produto', [
            'errorField'=>'Unit',
            'message'=>'Unit field must be changed'
        ]);


        return $rules;
    }
}
