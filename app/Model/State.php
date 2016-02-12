<?php
App::uses('Model', 'Model');

class State extends Model {    
    public $name   = "State";  
    public $belongsTo = array(
		'Country' => array ('className' => 'Country',
							'foreignKey' => 'country_id',
							 'dependent' => true));   
}
