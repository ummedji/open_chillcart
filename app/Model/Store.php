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
}