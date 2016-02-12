<?php
App::uses('Model', 'Model');
class Customer extends Model {    
    public $name      = "Customer"; 
    public $belongsTo = array(
    						'User' => array ('className' => 'User',
    						'foreignKey' => 'user_id',
    						'dependent' => true)); 
    public $hasMany  = array(
    						'CustomerAddressBook' => array ('className' => 'CustomerAddressBook',
    						'foreignKey' => 'customer_id',
    						'dependent' => true),
                            'Order' => array ('className' => 'Order',
    						'foreignKey' => 'customer_id',
    						'dependent' => true));
    
    var $validate   = array(
                            'address_title' => array(
                                         'rule' => 'notEmpty',
                                         'required' => true,
                                         'allowEmpty' => false, 
                                        'message' => 'Please enter a Tittle'),
                            'address' => array(
                                        'rule' => 'alphaNumeric',
                                        'required' => true,
                                        'allowEmpty' => false,
                                        'message' => 'Please enter a address detail'),
                            'address_phone' => array(
                                        'rule' => '/^[0-9]$/i',
                                        'required' => true,
                                        'allowEmpty' => false,
                                        'message' => 'Please enter a phone number'),
                            'landmark' => array(
                                        'rule' => 'notEmpty',
                                        'required' => true,
                                        'allowEmpty' => false,
                                        'message' => 'Please enter a land mark'),
                            'state_id' => array(
                                        'rule' => 'notEmpty',
                                        'required' => true,
                                        'allowEmpty' => false,
                                        'message' => 'Please selete state'),
                            'city_id' => array(
                                        'rule' => 'notEmpty',
                                        'required' => true,
                                        'allowEmpty' => false,
                                        'message' => 'Please selete city'),
                            'location_id' => array(
                                        'rule' => 'notEmpty',
                                        'required' => true,
                                        'allowEmpty' => false,
                                        'message' => 'Please selete location'),
                            ); 
     var $validates  = array(
                            'first_name' => array(
                                                 'rule' => 'notEmpty',
                                                 'required' => true,
                                                 'allowEmpty' => false, 
                                                'message' => 'Please enter a firstname'),
                            'customer_phone' => array(
                                                    'rule' => '/^[0-9]$/i',
                                                    'required' => true,
                                                    'allowEmpty' => false,
                                                    'message' => 'Please enter a phone number')
                            );
    
}
