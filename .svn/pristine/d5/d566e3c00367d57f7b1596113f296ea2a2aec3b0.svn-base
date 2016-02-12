<?php
App::uses('Model', 'Model');

class City extends Model {    
    public $name   = "City";    
    public $belongsTo = array(
			'State' => array ('className' => 'State',
							'foreignKey' => 'state_id',
							 'dependent' => true),
			'Country'=>array('className' => 'Country',
							'foreignKey' => 'country_id',
							 'dependent' => true),
			);  
}
