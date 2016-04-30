<?php

/* MN */

App::uses('Model', 'Model');

class Store extends AppModel
{

    public $belongsTo = array(
        'User' => array('className' => 'User',
            'foreignKey' => 'user_id',
            'dependent' => true));
    public $hasMany = array(
        'DeliveryTimeSlot' => array(
            'className' => 'DeliveryTimeSlot',
            'foreignKey' => 'store_id',
            'dependent' => true),
        'DeliveryLocation' => array(
            'className' => 'DeliveryLocation',
            'foreignKey' => 'store_id',
            'dependent' => true),
        'Storeoffer' => array(
            'className' => 'Storeoffer',
            'foreignKey' => 'store_id',
            'dependent' => true),
        'Invoice' => array(
            'className' => 'Invoice',
            'foreignKey' => 'store_id',
            'dependent' => true),
        'Review' => array(
            'className' => 'Review',
            'foreignKey' => 'store_id',
            'dependent' => true));
    public $hasOne = array(
        'Product' => array(
            'className' => 'Product',
            'foreignKey' => 'store_id',
            'dependent' => true));

    var $validate = array(
        'contact_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter contact name'
            )
        ),
        'contact_phone' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please contact phone'
            )
        ),
        'contact_email' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter email'
            ),
            'validEmailRule' => array(
                'rule' => array('email'),
                'message' => 'Please enter valid email'
            )
        ),
        'street_address' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter street address'
            )
        ),
        'store_state' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select the state'
            )
        ),
        'store_city' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select the city'
            )
        ),
        'store_zip' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select the zipcode/area name'
            )
        ),
        'store_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter store name'
            )
        ),
        'store_phone' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter phone number'
            ),
            'phone_no_should_be_numeric' => array(
                'rule' => 'numeric',
                'message' => 'Please enter valid phone number'
            )
        ),
        'dispatch' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please choose the option'
            )
        ),
        'collection' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please choose the option'
            )
        ),
        'delivery' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please choose the option'
            )
        ),
        'delivery_option' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select the zipcode/area name'
            )
        ),
        'location_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select atlease 1 location'
            )
        ),
        'minimum_order' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter minimum order'
            )
        ),
        'tax' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter tax'
            ),
            'tax_no_should_be_numeric' => array(
                'rule' => 'numeric',
                'message' => 'Please enter valid phone number'
            )
        ),
        'commission' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter comission'
            )
        )
    );
}