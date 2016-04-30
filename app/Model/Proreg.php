<?php

App::uses('Model', 'Model');

class Proreg extends AppModel
{
    var $name = 'Proregs';
    public $validate = array(
    'email' => array(
        'rule' => 'email',
        'message' => 'Please supply a valid email address.'
		),
		'email_notEmpty' => array (

           'rule' => 'notEmpty',

           'message' => 'This person name already exists.',

		),
		'email_isUnique' => array (

           'rule' => 'isUnique',

           'message' => 'This person name already exists.',

		)
	);
}