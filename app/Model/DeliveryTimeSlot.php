<?php

/* MN */

App::uses('Model', 'Model');


class DeliveryTimeSlot extends AppModel
{


    public $belongsTo = array(
        'TimeSlot' => array('className' => 'TimeSlot',
            'foreignKey' => 'slot_id',
            'dependent' => true),
        'Store' => array('className' => 'Store',
            'foreignKey' => 'store_id',
            'dependent' => true));
}