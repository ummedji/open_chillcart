<?php

/* MN */

App::uses('AppController', 'Controller');


class CheckoutsController extends AppController
{

    var $helpers = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');

    public $uses = array('CustomerAddressBook', 'State', 'ShoppingCart', 'DeliveryTimeSlot',
        'StripeCustomer', 'DeliveryLocation', 'Storeoffer', 'City',
        'Location','Customers','Countries');

    public $components = array('Updown', 'Stripe', 'Functions');


    public function beforeFilter()
    {

        $this->Auth->allow(array('*'));
        parent::beforeFilter();

        $customerState = $this->State->find('list', array(
            'conditions' => array('State.country_id' => $this->siteSetting['Sitesetting']['site_country']),
            'fields' => array('id', 'state_name')));

        $customerCity = $this->City->find('list', array(
            'fields' => array('City.id', 'City.city_name')));

        $customerArea = $this->Location->find('list', array(
            'fields' => array('id', 'area_name')));

        $customerAreaCode = $this->Location->find('list', array(
            'fields' => array('id', 'zip_code')));

        $lastsessionid = $this->Session->read("preSessionid");
        $this->SessionId = (!empty($lastsessionid)) ? $lastsessionid : $this->Session->id();

        $this->set(compact('customerState', 'customerCity', 'customerArea', 'customerAreaCode'));
    }


    public function index()
    {
        $minOrderCheck = $this->storeMinOrderCheck();
        $this->layout = 'frontend';
        $shopCartDetails = $this->ShoppingCart->find('all', array(
                                'conditions' => array('ShoppingCart.session_id' => $this->SessionId,
                                                    'ShoppingCart.order_id' => 0),
                                'order' => array('ShoppingCart.store_id'),
                                'group' => 'ShoppingCart.store_id'));
		if (empty($shopCartDetails) || empty($minOrderCheck)) {
            $this->redirect(array('controller' => 'searches', 'action' => 'index'));
        }
        foreach ($shopCartDetails as $keys => $values) {
            $storeSlots[$keys]['store_name'] = $values['Store']['store_name'];
            $storeSlots[$keys]['store_id']   = $values['Store']['id'];
            $storeSlots[$keys]['delivery']   = $values['Store']['delivery'];
            $storeSlots[$keys]['collection'] = $values['Store']['collection'];
            $storeSlots[$keys]['seo_url']    = $values['Store']['seo_url'];

            $timeSlots = $this->DeliveryTimeSlot->find('all', array(
                'conditions' => array('DeliveryTimeSlot.store_id' => $values['Store']['id'])));

            foreach ($timeSlots as $key => $value) {

                $time = strtotime(date('h:i A'));
                $from = strtotime(date('h:i A', strtotime($value['TimeSlot']['time_from'])));
                $to   = strtotime(date('h:i A', strtotime($value['TimeSlot']['time_to'])));

                if ($time <= $from) {
                    if ($value['DeliveryTimeSlot']['delivery_charge'] != 0) {

                        if ($values['Store']['collection'] == 'Yes' && $values['Store']['delivery'] == 'No') {

                            $storeSlots[$keys]['timeslates'][$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'];
                        } else {

                            $storeSlots[$keys]['timeslates'][$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'] . ' ' . __('Delivery Charge') .
                                $this->siteCurrency . ' ' . $value['DeliveryTimeSlot']['delivery_charge'];
                        }
                    } else {

                        if ($values['Store']['collection'] == 'Yes' && $values['Store']['delivery'] == 'No') {

                            $storeSlots[$keys]['timeslates'][$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'];
                        } else {

                            $storeSlots[$keys]['timeslates'][$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'] . ' ' . __('Free Delivery');
                        }
                    }
                } elseif ($time >= $from && $time <= $to) {

                    if ($value['DeliveryTimeSlot']['delivery_charge'] != 0) {

                        if ($values['Store']['collection'] == 'Yes' && $values['Store']['delivery'] == 'No') {

                            $storeSlots[$keys]['timeslates'][$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'];
                        } else {

                            $storeSlots[$keys]['timeslates'][$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'] . ' ' . __('Delivery Charge') .
                                $this->siteCurrency . ' ' . $value['DeliveryTimeSlot']['delivery_charge'];
                        }
                    } else {

                        if ($values['Store']['collection'] == 'Yes' && $values['Store']['delivery'] == 'No') {

                            $storeSlots[$keys]['timeslates'][$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'];
                        } else {

                            $storeSlots[$keys]['timeslates'][$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'] . ' ' . __('Free Delivery');
                        }
                    }
                }
            }
        }

        $optionDays = array('Today' => __('Today'), 'Tomorrow' => __('Tomorrow'));
        $addresses = $this->CustomerAddressBook->find('all', array(
                            'conditions' => array('CustomerAddressBook.customer_id' => 
                                                    $this->Auth->User('Customer.id'),
                                                'CustomerAddressBook.status' => 1)));
        $stripeCards = $this->StripeCustomer->find('all', array(
            'conditions' => array('StripeCustomer.customer_id' => $this->Auth->User('Customer.id'))));
        $user_data = $this->Customers->find('all', array(
                            'conditions' => array('Customers.id' => 
                                                   $this->Auth->User('Customer.id'))));
        $customerState = $this->State->find('list', array(
            'conditions' => array('State.country_id' => $addresses[0]["CustomerAddressBook"]["state_id"]),
            'fields' => array('id', 'state_name')));
        $customerCity = $this->City->find('list', array(
             'conditions' => array('City.id' => $addresses[0]["CustomerAddressBook"]["city_id"]),
            'fields' => array('City.id', 'City.city_name')));
        
        $total = $this->ShoppingCart->find('all', array(
								'conditions'=>array('ShoppingCart.session_id' => $this->SessionId),
								'fields' => array('SUM(ShoppingCart.product_total_price) AS cartTotal')));

	$storeProduct = $this->ShoppingCart->find('all',array(
        						'conditions' => array('ShoppingCart.session_id' => $this->SessionId),
        						'fields' => array('store_id',
        										 'COUNT(ShoppingCart.store_id) AS productCount',
        										 'SUM(ShoppingCart.product_total_price) As productTotal'),
        						'group'=>array('ShoppingCart.store_id')));

	$cartCount = $this->ShoppingCart->find('first',array(
        						'conditions' => array('ShoppingCart.session_id' => $this->SessionId),
        						'fields' => array('store_id',
        										 'COUNT(ShoppingCart.store_id) AS productCount',
        										 'SUM(ShoppingCart.product_total_price) As productTotal')));

	$storeCart = $this->ShoppingCart->find('all', array(
								'conditions' => array('ShoppingCart.session_id' => $this->SessionId),
								'order' => array('ShoppingCart.store_id')));
        
       
       // $customerCountry = $this->Countries->find('list', array(
       //      'conditions' => array('Countries.id' => $addresses[0]["State"]["countrty_id"]),
       //     'fields' => array('Countries.id', 'Countries.country_name')));
        $country = $this->siteSetting;
        $country_id = $country['Sitesetting']['site_country'];
		$state_list = $this->State->find('list', array(
            'conditions' => array('State.country_id' => $country_id),
            'fields' => array('State.id', 'State.state_name')));
        $this->set(compact('addresses', 'shopCartDetails', 'storeSlots', 'optionDays', 'stripeCards','customerState','customerCity','cartCount','storeCart','total','state_list'));
        
        
    }
	 public function addAddressBook()
    {
        if ($this->request->is('post') || $this->request->is('put')) {
			//print_r($this->request->data); exit;
            $this->CustomerAddressBook->set($this->request->data);
            if($this->CustomerAddressBook->validates()) {

                $address_check = $this->CustomerAddressBook->find('first', array(
                    'conditions' => array(
                        'CustomerAddressBook.address_title' =>
                            trim($this->request->data['CustomerAddressBook']['address_title']),
                        'CustomerAddressBook.customer_id' => $this->Auth->User('Customer.id')
                    )));
                if (!empty($address_check)) {
                    $this->Session->setFlash('<p>' . __('Address Book Already Exists', true) . '</p>', 'default',
                        array('class' => 'alert alert-danger'));
                    $this->redirect(array('controller' => 'checkouts', 'action' => 'index'));
                } else {
					$this->request->data['CustomerAddressBook']['customer_id'] = $this->Auth->User('Customer.id');
                    $this->CustomerAddressBook->save($this->request->data['CustomerAddressBook']);

                    $this->Session->setFlash('<p>' . __('Your address book has been added successfully', true) . '</p>', 'default',
                        array('class' => 'alert alert-success'));
                    $this->redirect(array('controller' => 'checkouts', 'action' => 'index'));
                }
            } else {
                $this->CustomerAddressBook->validationErrors;
            }
        }
    }
    // Min Order Check
    public function storeMinOrderCheck() {

        $this->ShoppingCart->recursive = 2;
        $storeProduct = $this->ShoppingCart->find('all',array(
                                        'conditions' => array('ShoppingCart.session_id' => $this->SessionId),
                                        'fields' => array('store_id',
                                                         'COUNT(ShoppingCart.store_id) AS productCount',
                                                         'SUM(ShoppingCart.product_total_price) As productTotal'),
                                        'group'=>array('ShoppingCart.store_id')));
        foreach ($storeProduct as $key => $value) {
            if ($value['Store']['minimum_order'] > $value[0]['productTotal']) {
                return false;
            }
        }
        return true;
    }


    public function customerBookAdd()
    {

        if (!empty($this->request->data['CustomerAddressBook'])) {
            $this->request->data['CustomerAddressBook']['customer_id'] = $this->Auth->User('Customer.id');
            $this->request->data['CustomerAddressBook']['status'] = 1;
            $this->CustomerAddressBook->save($this->request->data['CustomerAddressBook']);
        }

        $this->Session->setFlash('<p>' . __('Your address book has been added successfully', true) . '</p>', 'default',
            array('class' => 'alert alert-success'));
        $this->redirect(array('controller' => 'checkouts', 'action' => 'index'));
    }


    public function customerCardAdd()
    {

        $data = $this->Functions->parseSerialize($this->params['data']['formData']);
        $this->request->data = $data['amp;data'];
        if (!empty($this->request->data['StripeCustomer'])) {
            $datas = array("stripeToken" => $this->request->data['StripeCustomer']['stripe_token_id']);
            $this->request->data['StripeCustomer']['customer_id'] = $this->Auth->User('Customer.id');
            $this->StripeCustomer->save($this->request->data['StripeCustomer']);
        }
        exit();
    }

    public function paymentCard()
    {

        $stripeCards = $this->StripeCustomer->find('all', array(
            'conditions' => array('StripeCustomer.customer_id' => $this->Auth->User('Customer.id'))));
        $this->set(compact('stripeCards'));
    }

    public function cardAdd()
    {

    }


    public function locations()
    {

        $id = $this->request->data['id'];
        $model = $this->request->data['model'];

        switch (trim($model)) {

            case 'State':
                $locations = $this->State->find('list', array(
                    'conditions' => array('State.country_id' => $id),
                    'fields' => array('id', 'state_name')));
                break;

            case 'City':
                $locations = $this->City->find('list', array(
                    'conditions' => array('City.state_id' => $id),
                    'fields' => array('id', 'city_name')));
                break;

            case 'Location':
                if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {

                    $locations = $this->Location->find('list', array(
                        'conditions' => array('Location.city_id' => $id),
                        'fields' => array('id', 'zip_code')));
                } else {
                    $locations = $this->Location->find('list', array(
                        'conditions' => array('Location.city_id' => $id),
                        'fields' => array('id', 'area_name')));
                }
                break;
        }
        $this->set(compact('model', 'locations'));
    }

    public function storeTimeSlot()
    {

        $id = $this->request->data['id'];
        $type = $this->request->data['type'];
        $orderType = $this->request->data['orderType'];


        $timeSlots = $this->DeliveryTimeSlot->find('all', array(
            'conditions' => array('DeliveryTimeSlot.store_id' => $id)));

        foreach ($timeSlots as $key => $value) {

            $time = strtotime(date('h:i A'));
            $from = strtotime(date('h:i A', strtotime($value['TimeSlot']['time_from'])));
            $to = strtotime(date('h:i A', strtotime($value['TimeSlot']['time_to'])));

            if ($type == 'Today') {
                if ($time <= $from) {

                    if ($value['DeliveryTimeSlot']['delivery_charge'] != 0) {

                        if ($orderType == 'Delivery') {

                            $storeSlots[$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'] . ' ' . __('Delivery Charge') .
                                $this->siteCurrency . ' ' . $value['DeliveryTimeSlot']['delivery_charge'];
                        } else {
                            $storeSlots[$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'];
                        }

                    } else {

                        if ($orderType == 'Delivery') {

                            $storeSlots[$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'] . ' ' . __('Free Delivery');
                        } else {
                            $storeSlots[$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'];
                        }
                    }

                } elseif ($time >= $from && $time <= $to) {

                    if ($value['DeliveryTimeSlot']['delivery_charge'] != 0) {

                        if ($orderType == 'Delivery') {
                            $storeSlots[$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'] . ' ' . __('Delivery Charge') .
                                $this->siteCurrency . ' ' . $value['DeliveryTimeSlot']['delivery_charge'];
                        } else {
                            $storeSlots[$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'];
                        }


                    } else {

                        if ($orderType == 'Delivery') {

                            $storeSlots[$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'] . ' ' . __('Free Delivery');
                        } else {
                            $storeSlots[$value['DeliveryTimeSlot']['id']] =
                                $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'];
                        }

                    }

                }
            } else {
                if ($value['DeliveryTimeSlot']['delivery_charge'] != 0) {

                    if ($orderType == 'Delivery') {

                        $storeSlots[$value['DeliveryTimeSlot']['id']] =
                            $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'] . ' ' . __('Delivery Charge') .
                            $this->siteCurrency . ' ' . $value['DeliveryTimeSlot']['delivery_charge'];
                    } else {
                        $storeSlots[$value['DeliveryTimeSlot']['id']] =
                            $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'];
                    }
                } else {
                    if ($orderType == 'Delivery') {
                        $storeSlots[$value['DeliveryTimeSlot']['id']] =
                            $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'] . ' ' . __('Free Delivery');
                    } else {
                        $storeSlots[$value['DeliveryTimeSlot']['id']] =
                            $value['TimeSlot']['time_from'] . ' TO ' . $value['TimeSlot']['time_to'];
                    }
                }
            }
        }
        $this->set(compact('storeSlots'));
    }


    public function orderReview()
    {

        $id             = $this->request->data['id'];
        $orderTypeCheck = $this->request->data['orderTypeCheck'];
        $orderTypes     = explode(',', $orderTypeCheck);
        $data           = explode(',', $id);
        $today          = date("m/d/Y");

        foreach ($data as $key => $value) {

            $deliverySlot = $this->DeliveryTimeSlot->findById($value);

            if (!empty($deliverySlot)) {

                $deliveryDetails[$key]['store_id'] = $deliverySlot['Store']['id'];
                $deliveryDetails[$key]['store_name'] = $deliverySlot['Store']['store_name'];

                if ($orderTypes[$key] == 'Delivery') {
                    $deliveryDetails[$key]['delivery_charge'] = $deliverySlot['DeliveryTimeSlot']['delivery_charge'];
                }
                $deliveryDetails[$key]['delivery_time_slot'] = $deliverySlot['TimeSlot']['time_from'] .
                    ' TO ' . $deliverySlot['TimeSlot']['time_to'];
            }

            $storeOffers = $this->Storeoffer->find('first', array(
                'conditions' => array('Storeoffer.store_id' => $deliverySlot['Store']['id'],
                    'Storeoffer.status' => 1,
                    "Storeoffer.from_date <=" => $today,
                    "Storeoffer.to_date >=" => $today),
                'order' => 'Storeoffer.id DESC'));

            $storeProduct = $this->ShoppingCart->find('all', array(
                'conditions' => array('ShoppingCart.session_id' => $this->SessionId,
                                     'ShoppingCart.order_id' => 0),
                'fields' => array('store_id',
                    'SUM(ShoppingCart.product_total_price) As productTotal'),
                'group' => array('ShoppingCart.store_id')));

            if (!empty($storeOffers)) {

                if ($storeOffers['Storeoffer']['offer_price'] <= $storeProduct[$key][0]['productTotal']) {
                    $offerDetails[$key]['offerPercentage'] = $storeOffers['Storeoffer']['offer_percentage'];
                    $offerDetails[$key]['storeOffer'] = $storeProduct[$key][0]['productTotal'] * (
                            $storeOffers['Storeoffer']['offer_percentage'] / 100);
                }
            }

            if (!empty($deliverySlot['Store']['tax'])) {
                $taxDetails[$key]['store_name'] = $deliverySlot['Store']['store_name'];
                $taxDetails[$key]['tax'] = $deliverySlot['Store']['tax'];
            }
            $offerDetails[$key]['store_id'] = $deliverySlot['Store']['id'];
            $offerDetails[$key]['store_name'] = $deliverySlot['Store']['store_name'];
        }
        //$this->ShoppingCart->recursive = 3;
        $shopCart = $this->ShoppingCart->find('all', array(
            'conditions' => array('ShoppingCart.session_id' => $this->SessionId,
                                  'ShoppingCart.order_id' => 0),
            'order' => array('ShoppingCart.store_id')));

        $this->set(compact('shopCart', 'deliveryDetails', 'offerDetails', 'taxDetails'));

    }

    public function deliveryLocation()
    {

        $id = (!empty($this->request->data['id'])) ? $this->request->data['id'] : '';
        $orderTypes = (!empty($this->request->data['orderTypes'])) ? $this->request->data['orderTypes'] : '';

        $orderTypes = explode(',', $orderTypes);

        $locationDetails = $this->CustomerAddressBook->findById($id);
        $deliveryLocationId = $locationDetails['CustomerAddressBook']['location_id'];

        $this->ShoppingCart->recursive = 0;
        $shopCartDetails = $this->ShoppingCart->find('all', array(
            'conditions' => array('ShoppingCart.session_id' => $this->SessionId),
            'order' => array('ShoppingCart.store_id'),
            'group' => 'ShoppingCart.store_id'));

        foreach ($shopCartDetails as $key => $value) {

            $store_id = $value['ShoppingCart']['store_id'];

            if ($orderTypes[$key] == 'Delivery') {

                $deliveryLocation = $this->DeliveryLocation->find('first', array(
                    'conditions' => array(
                        'DeliveryLocation.store_id' => $store_id,
                        'DeliveryLocation.location_id' => $deliveryLocationId)));
                if (empty($deliveryLocation)) {
                    echo "<label class='error'>" . $value['Store']['store_name'] . " " . __("don't deliver to your address please select another one") . "</label><br>";
                }
            }

        }
        exit();
    }
}