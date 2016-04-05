<?php

App::uses('Model', 'Model');

class Storeoffer extends Model {    
    public $name   = "Storeoffer";   
    public $belongsTo = array(
			'Store' => array ('className' => 'Store',
							'foreignKey' => 'store_id',
							 'dependent' => true));

    var $validate = array(
        'store_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select store Name'
            )
        ),
        'offer_percentage' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please Enter Offer percentage'
            ),
            'offerPercentage_no_should_be_numeric' => array(
                'rule' => 'numeric',
                'message' => 'Please enter offer percentage'
            )
        ),
        'offer_price' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please Enter Offer price'
            ),
            'offerPrice_no_should_be_numeric' => array(
                'rule' => 'numeric',
                'message' => 'Please enter valid offer price'
            )
        ),
        'from_date' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please Enter from_date'
            )
        ),
        'to_date' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please Enter to_date'
            )
        ),
    );
}