<?php

/* MN */

App::uses('Model', 'Model');

class Deal extends AppModel {

	public $belongsTo = array(
		'MainProduct' => array('className'   => 'Product',
								'foreignKey' => 'main_product',
								'dependent'  => true),
		'SubProduct' => array('className'    => 'Product',
								'foreignKey' => 'sub_product',
								'dependent'  => true),
		'Store' => array('className'  => 'Store',
								'foreignKey' => 'store_id',
								'dependent'  => true));
	
}