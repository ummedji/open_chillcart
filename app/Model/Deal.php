<?php

/* MN */

App::uses('Model', 'Model');

class Deal extends AppModel
{

    public $belongsTo = array(
        'MainProduct' => array('className' => 'Product',
            'foreignKey' => 'main_product',
            'dependent' => true),
        'SubProduct' => array('className' => 'Product',
            'foreignKey' => 'sub_product',
            'dependent' => true),
        'Store' => array('className' => 'Store',
            'foreignKey' => 'store_id',
            'dependent' => true));

    var $validate = array(
        'store_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select store'
            )
        ),
        'deal_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter deal name'
            )
        ),
        'main_product' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select product'
            )
        ),
        'sub_product' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select product'
            )
        )
    );

}