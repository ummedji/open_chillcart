<?php

/* MN */

App::uses('Model', 'Model');


class DeliveryLocation extends AppModel {


	public $belongsTo = array(
		'Store' => array('className' => 'Store',
						'foreignKey' => 'store_id',
						'dependent'  => true),
		'Location' => array('className' => 'Location',
						'foreignKey' => 'location_id',
						'dependent'  => true));
}