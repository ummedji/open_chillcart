<?php

App::uses('Model', 'Model');

class Vehicle extends AppModel
{
    var $validate = array(
        'vehicle_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter the vehicle name'
            )
        ),
        'model_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter vehicle model'
            ),
        ),
        'color' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter the vehicle color'
            )
        ),
        'year' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter the year'
            ),
            'phone_no_should_be_numeric' => array(
                'rule' => 'numeric',
                'message' => 'Please enter valid year'
            )
        ),
        'vehicle_no' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please choose the gender'
            )
        )
    );
}