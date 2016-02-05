<?php

/* MN */

App::uses('Model', 'Model');


class Sitesetting extends AppModel {


	public $belongsTo = array(
		'Country' => array('className' => 'Country',
						'foreignKey' => 'site_country',
						'dependent'  => true));
}