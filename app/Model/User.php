<?php

App::uses('Model', 'Model');

class User extends AppModel
{
    var $name = 'User';
    public $hasOne = array(
        'Customer' => array('className' => 'Customer',
                            'foreignKey' => 'user_id',
                            'dependent' => true),
        'Store' => array('className' => 'Store',
                            'foreignKey' => 'user_id',
                            'dependent' => true),
        'Driver' => array('className' => 'Driver',
                            'foreignKey' => 'parent_id',
                            'dependent' => true));
    var $validate = array(
        'username' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Please enter a username'),
        'password' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Please enter a password')
    );
    var $validates = array(
        'first_name' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Please enter first name'),
        'last_name' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Please enter last name'),
        'customer_email' => 'email', array(
            'rule' => 'notEmpty',
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Please enter Email'),
        'password' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Please enter The password'),
        'confir_password' => array(
            'rule' => 'notEmpty',
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Please enter The confir_password'),

        'customer_phone' => array(
            'rule' => '/^[0-9]$/i',
            'required' => true,
            'allowEmpty' => false,
            'message' => 'Please enter The phone number and digit only allow')

    );


}