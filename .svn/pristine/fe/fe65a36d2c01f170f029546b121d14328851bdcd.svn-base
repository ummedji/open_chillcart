<?php
App::uses('Model', 'Model');
class Location extends Model {    
    public $name   = "Location";    
    public $belongsTo = array(
			'City' => array ('className' => 'City',
							 'foreignKey' => 'city_id',
							 'dependent' => true),
			'State' => array ('className' => 'State',
							   'foreignKey' => 'state_id',
							  'dependent' => true));  
}
