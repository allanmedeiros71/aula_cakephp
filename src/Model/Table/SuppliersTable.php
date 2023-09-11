<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Suppliers Model
 *
 * @method \App\Model\Entity\Supplier get($primaryKey, $options = [])
 * @method \App\Model\Entity\Supplier newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Supplier[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Supplier|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Supplier saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Supplier patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Supplier[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Supplier findOrCreate($search, callable $callback = null, $options = [])
 */
class SuppliersTable extends Table
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

        $this->setTable('suppliers');
        $this->setDisplayField('SupplierID');
        $this->setPrimaryKey('SupplierID');
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
            ->integer('SupplierID')
            ->allowEmptyString('SupplierID', null, 'create');

        $validator
            ->scalar('SupplierName')
            ->maxLength('SupplierName', 255)
            ->allowEmptyString('SupplierName');

        $validator
            ->scalar('ContactName')
            ->maxLength('ContactName', 255)
            ->allowEmptyString('ContactName');

        $validator
            ->scalar('Address')
            ->maxLength('Address', 255)
            ->allowEmptyString('Address');

        $validator
            ->scalar('City')
            ->maxLength('City', 255)
            ->allowEmptyString('City');

        $validator
            ->scalar('PostalCode')
            ->maxLength('PostalCode', 255)
            ->allowEmptyString('PostalCode');

        $validator
            ->scalar('Country')
            ->maxLength('Country', 255)
            ->allowEmptyString('Country');

        $validator
            ->scalar('Phone')
            ->maxLength('Phone', 255)
            ->allowEmptyString('Phone');

        return $validator;
    }
}
