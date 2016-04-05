<?php

/* MN */

App::uses('Model', 'Model');


class Sitesetting extends AppModel
{


    public $belongsTo = array(
        'Country' => array('className' => 'Country',
            'foreignKey' => 'site_country',
            'dependent' => true));

    var $validate = array(
        'site_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter site name'
            )
        ),
        'search_by' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please choose the option'
            )
        ),
        'admin_name' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter admin name'
            )
        ),
        'admin_email' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter admin email'
            ),
            'validEmailRule' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid email address'
            )
        ),
        'contact_us_email' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter contact us email'
            ),
            'validEmailRule' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid email address'
            )
        ),
        'invoice_email' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter invoice email'
            ),
            'validEmailRule' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid email address'
            )
        ),
        'contact_phone' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter site contact phone'
            ),
            'phone_no_should_be_numeric' => array(
                'rule' => 'numeric',
                'message' => 'Please enter valid phone number'
            )
        ),
        'order_email' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter order email'
            ),
            'validEmailRule' => array(
                'rule' => array('email'),
                'message' => 'Please enter a valid email address'
            )
        ),
        'site_address' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter site address'
            )
        ),
        'site_country' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select the country'
            )
        ),
        'site_state' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select the state'
            )
        ),
        'site_city' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select the city'
            )
        ),
        'site_zip' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select zipcode/area name'
            )
        ),
        'site_timezone' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter time zone'
            )
        ),
        'vat_no' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter VAT no'
            )
        ),
        'vat_percent' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter VAT percentage'
            )
        ),
        'card_fee' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter card fee'
            )
        ),
        'invoice_duration' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please select invoice time period'
            )
        ),
        'sms_token' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter sms token id'
            )
        ),
        'sms_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter sms auth id'
            )
        ),
        'sms_source_number' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter sms source number'
            )
        ),
        'mailchimp_key' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter mailchimp key'
            )
        ),
        'mailchimp_list_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter mailchimp list'
            )
        ),
        'facebook_api_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter facebook api key'
            )
        ),
        'facebook_secret_key' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter facebook secret key'
            )
        ),
        'google_api_id' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter google api key'
            )
        ),
        'google_secret_key' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter google secret key'
            )
        ),
        'stripe_secretkey' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter stripe secret key'
            )
        ),
        'stripe_publishkey' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter stripe publish key'
            )
        ),
        'stripe_secretkeyTest' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter stripe secret key'
            )
        ),
        'stripe_publishkeyTest' => array(
            'notEmpty' => array(
                'rule' => 'notEmpty',
                'message' => 'Please enter stripe publish key'
            )
        ),
    );
}