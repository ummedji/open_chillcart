<?php
App::uses('Model', 'Model');

class City extends Model
{
    public $name = "City";
    public $belongsTo = array(
        'State' => array('className' => 'State',
            'foreignKey' => 'state_id',
            'dependent' => true),
        'Country' => array('className' => 'Country',
            'foreignKey' => 'country_id',
            'dependent' => true),
    );

    var $validate = array(
        'country_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select the country'
            )
        ),
        'state_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select the state'
            )
        ),
        'city_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter the city name'
            )
        )
	);
}
