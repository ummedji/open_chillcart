<?php

/* MN */

App::uses('Model', 'Model');

class Driver extends AppModel {

	public $belongsTo = array(
		'User' => array('className'  => 'User',
						'foreignKey' => 'parent_id',
						'dependent'  => true));

	public $hasOne = array(
		'DriverTracking' => array(
						'className'  => 'DriverTracking',
						'foreignKey' => 'driver_id',
						'dependent'  => true),
		'Vehicle' => array(
						'className'  => 'Vehicle',
						'foreignKey' => 'driver_id',
						'dependent'  => true));
}