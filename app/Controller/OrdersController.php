<?php

/* janakiraman */

App::uses('AppController','Controller');
App::uses('CakeEmail', 'Network/Email');

class OrdersController extends AppController {
    
  var $helpers = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');

  public $uses    = array('Order','ShoppingCart', 'CustomerAddressBook', 'DeliveryTimeSlot',
                          'StripeCustomer', 'Storeoffer', 'Status', 'State', 'City', 'Location',
                          'Store', 'ProductDetail', 'Orderstatus', 'Notification');

  public $components = array('Stripe', 'Googlemap', 'AndroidResponse', 'Twilio');

  public function beforeFilter() {

    parent::beforeFilter();

    $orderStatus = $this->Status->find('list', array(
                                    'fields' => array('id', 'title')));

    $states = $this->State->find('list', array(
                          'conditions' => array('State.country_id' => $this->siteSetting['Sitesetting']['site_country']),
                          'fields' => array('id', 'state_name')));


    $this->storeState = $this->State->find('list', array(
                        'fields' => array('id', 'state_name')));
    $this->storeCity = $this->City->find('list', array(
              'fields' => array('City.id', 'City.city_name')));

    if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
      $this->storeLocation = $this->Location->find('list', array(
                      'fields' => array('id','zip_code')));
    } else {
      $this->storeLocation = $this->Location->find('list', array(
                      'fields' => array('id','area_name')));
    }
    $this->set(compact('orderStatus', 'states'));
  }




  /**
   * BrandsController::admin_index()
   * 
   * @return void
   */
  public function admin_index() {
  	$order_list = $this->Order->find('all', array(
                        'conditions' => array('Order.status' => 'Pending'),
                        'order' => array('Order.id DESC')));

    $status = array('Pending' => 'Pending', 'Accepted' => 'Accepted',
                    'Failed' => 'Failed', 'Delivered' => 'Delivered');

    $this->set(compact('order_list', 'status'));
  }


  // Admin Collection Orders
  public function admin_collectionOrders() {

    $order_list = $this->Order->find('all', array(
                        'conditions' => array('Order.status' => 'Accepted',
                                              'Order.order_type' => 'Collection'),
                        'order' => array('Order.id DESC')));

    $status = array('Accepted' => 'Accepted', 'Failed' => 'Failed', 'Delivered' => 'Delivered');

    $this->set(compact('order_list', 'status'));
  }
    public function admin_failedOrderDetail(){
        $order_list = $this->Order->find('all', array(
                          'conditions' => array('Order.status' => 'Failed'),
                          'order' => array('Order.id DESC')));
        $status = array('Pending'   => 'Pending', 'Accepted'  => 'Accepted',
                        'Failed'    => 'Failed', 'Delivered' => 'Delivered');

        $this->set(compact('order_list', 'status'));
    }

  // Admin Dispatch Order
  public function admin_order() {

    $statuss = array('Delivered','Pending','Failed', 'Deleted');

    $location = $this->Location->find('list', array(
                                    'fields' => array('id', 'area_name')));

    $city = $this->City->find('list', array(
                                    'fields' => array('id', 'city_name')));

    $orderList = $this->Order->find('all', array(
                        'conditions' => array('Order.order_type' => 'Delivery',
                              'NOT'  => array('Order.status' => $statuss)),
                        'order' => array('Order.id DESC')));
    $status = array('Failed' => 'Failed', 'Delivered' => 'Delivered');

    $this->set(compact('orderList', 'location', 'city', 'status'));


  }
  //Report Management Process
  public function admin_reportIndex($id = null) {
      $order_list = $this->Order->find('all', array(
                                  'conditions' => array('Order.status' => 'Delivered'),
                                  'order' => array('Order.id DESC')));
      $this->set(compact('order_list'));     

  }
  //Admin side ReportManagement Based Order View
  public function admin_reportOrderView($id = null) {
    if (!empty($id)){

      $orders_list = $this->Order->find('first', array(
                              'conditions' => array('Order.id' => $id,
                                                    'Order.status' => 'Delivered')));
      if (empty($orders_list)) {
          $this->render('/Errors/error400');
      }

      $cities = $this->City->find('list', array(
                      'conditions' => array('City.state_id' => $orders_list['Store']['store_state']),
                      'fields' => array('id', 'city_name')));

      $location = $this->Location->find('list', array(
                      'conditions' => array('Location.city_id' => $orders_list['Store']['store_city']),
                      'fields' => array('id', 'area_name')));

      $this->set(compact('orders_list', 'cities', 'location'));
    } else {
      $this->redirect(array('controller' => 'Orders', 'action' => 'reportIndex'));
    }
    
  }

  //Admin side Order view Process
  public function admin_orderView($id = null) {
    
    if(!empty($id)){
      $order_detail = $this->Order->find('first', array(
                              'conditions' => array('Order.id' => $id)));
      if (empty($order_detail)) {
          $this->render('/Errors/error400');
      }

      $cities = $this->City->find('list', array(
                      'conditions' => array('City.state_id' => $order_detail['Store']['store_state']),
                      'fields' => array('id', 'city_name')));

      $location = $this->Location->find('list', array(
                      'conditions' => array('Location.city_id' => $order_detail['Store']['store_city']),
                      'fields' => array('id', 'area_name')));
      
      $this->set(compact('order_detail', 'cities', 'location'));

    } else {
       $this->redirect(array('controller' => 'Orders', 'action' => 'index'));
    }
    
  }

  //Confirm Order Process
  public function conformOrder() {

      $role = $this->Auth->User('role_id');
      if (empty($role) || $this->Auth->User('role_id') != 4) {
          $this->redirect(array('controller' => 'searches', 'action' => 'index'));
      }

      if ($this->request->data['Order']['paymentMethod'] != 'cod') {
          $stripeCard = $this->StripeCustomer->find('first', array(
                              'conditions' => array(
                                        'StripeCustomer.id' => $this->request->data['Order']['paymentMethod'],
                                        'StripeCustomer.customer_id' => $this->Auth->User('Customer.id'))));
          if (empty($stripeCard)) {
              $this->redirect(array('controller' => 'searches', 'action' => 'index'));
          }
      }
      
      $today= date("m/d/Y");
      $lastsessionid  = $this->Session->read("preSessionid");
      $SessionId = (!empty($lastsessionid)) ? $lastsessionid : $this->Session->id();

      if (!empty($this->request->data['Order']['delivery_id'])) {
        $customerDetails = $this->CustomerAddressBook->find('first', array(
                        'conditions' => array(
                            'CustomerAddressBook.id' => $this->request->data['Order']['delivery_id'],
                            'CustomerAddressBook.customer_id' => $this->Auth->User('Customer.id'))));
      }
      
      foreach ($this->request->data['Order']['timeSlot'] as $key => $value) {

          $order['store_id']            = $value['store_id'];
          $order['customer_id']         = $this->Auth->User('Customer.id');
          $order['user_type']           = 'Customer';
          $order['order_description']   = $this->request->data['Order']['order_description'];
          $order['delivery_date']       = ($value['type'] == 'Today') ? date("Y-m-d") : date("Y-m-d", time()+86400);
          $order['order_type']          = $value['orderType'];

          $storeDetails = $this->Store->findById($order['store_id']);

          if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
            $storeAddress = $storeDetails['Store']['street_address'].', '.
                      $this->storeCity[$storeDetails['Store']['store_city']].', '.
                      $this->storeState[$storeDetails['Store']['store_state']].' '.
                      $this->storeLocation[$storeDetails['Store']['store_zip']].', '.
                      $this->siteSetting['Country']['country_name'];


          } else {
            $storeAddress = $storeDetails['Store']['street_address'].', '.
                      $this->storeLocation[$storeDetails['Store']['store_zip']].', '.
                      $this->storeCity[$storeDetails['Store']['store_city']].', '.
                      $this->storeState[$storeDetails['Store']['store_state']].', '.
                      $this->siteSetting['Country']['country_name'];
          }
          
          $sourceLatLong    = $this->Googlemap->getlatitudeandlongitude($storeAddress);
          $source_lat       = (!empty($sourceLatLong['lat'])) ? $sourceLatLong['lat'] : 0;
          $source_long      = (!empty($sourceLatLong['long'])) ? $sourceLatLong['long'] : 0;
          
          if ($order['order_type'] != 'Collection') {

            $order['customer_name']       = $customerDetails['Customer']['first_name']. ' '.
                                            $customerDetails['Customer']['last_name'];
            $order['customer_email']      = $customerDetails['Customer']['customer_email'];
            $order['customer_phone']      = $customerDetails['Customer']['customer_phone'];
            $order['address']             = $customerDetails['CustomerAddressBook']['address'];
            $order['landmark']            = $customerDetails['CustomerAddressBook']['landmark'];
            $order['state_name']          = $customerDetails['State']['state_name'];
            $order['city_name']           = $customerDetails['City']['city_name'];
            $order['location_name']       = $customerDetails['Location']['area_name'];

            $deliveryAddress =  $order['address'].', '.
                            $order['location_name'].', '.
                            $order['city_name'].', '.
                            $order['state_name'].', '.
                            $this->siteSetting['Country']['country_name'];

            $destinationLatLong = $this->Googlemap->getlatitudeandlongitude($deliveryAddress);

            $order['destination_latitude']    = (!empty($destinationLatLong['lat'])) ? $destinationLatLong['lat'] : 0;
            $order['destination_longitude']   = (!empty($destinationLatLong['long'])) ? $destinationLatLong['long'] : 0;
          } else {

            $order['customer_name']       = $this->Auth->User('Customer.first_name'). ' '.
                                            $this->Auth->User('Customer.last_name');
            $order['customer_email']      = $this->Auth->User('Customer.customer_email');
            $order['customer_phone']      = $this->Auth->User('Customer.customer_phone');
            $order['address']             = $storeDetails['Store']['street_address'];
            $order['landmark']            = '';
            $order['state_name']          = $this->storeState[$storeDetails['Store']['store_state']];
            $order['city_name']           = $this->storeCity[$storeDetails['Store']['store_city']];
            $order['location_name']       = $this->storeLocation[$storeDetails['Store']['store_zip']];

            $order['destination_latitude']    = $source_lat;
            $order['destination_longitude']   = $source_long;
          }


          $destination_lat  = $order['destination_latitude'];
          $destination_long = $order['destination_longitude'];
          $distance = $this->Googlemap->getDrivingDistance($source_lat,$source_long,$destination_lat,$destination_long);
          $order['source_latitude']   = $source_lat;
          $order['source_longitude']  = $source_long;

          $storeOffers = $this->Storeoffer->find('first', array(
                                    'conditions' => array('Storeoffer.store_id' => $value['store_id'],
                                              'Storeoffer.status' => 1,
                                               "Storeoffer.from_date <="  => $today,
                                               "Storeoffer.to_date >="    => $today),
                                    'order' => 'Storeoffer.id DESC'));

          $deliverDetails = $this->DeliveryTimeSlot->findById($value['time']);
          $total = $this->ShoppingCart->find('all', array(
                  'conditions'=>array('ShoppingCart.session_id' => $SessionId,
                                      'ShoppingCart.order_id' => 0,
                                      'ShoppingCart.store_id' => $value['store_id']),
                  'fields' => array('SUM(ShoppingCart.product_total_price) AS cartSubTotal')));

          $order['delivery_time_slot']  = $deliverDetails['TimeSlot']['time_from']. ' TO '.
                                          $deliverDetails['TimeSlot']['time_to'];
          $order['delivery_charge']     = ($value['orderType'] != 'Collection') ? $deliverDetails['DeliveryTimeSlot']['delivery_charge'] : 0;
          $order['order_sub_total']     = $total[0][0]['cartSubTotal'];
          $order['tax_amount']          = $deliverDetails['Store']['tax'];
          $order['distance']            = (isset($distance['distanceText'])) ? $distance['distanceText'] : 0 ;
          $order['offer_amount']        = ($storeOffers['Storeoffer']['offer_price'] <= $total[0][0]['cartSubTotal']) ?
                                            $total[0][0]['cartSubTotal'] * $storeOffers['Storeoffer']['offer_percentage']/100 :
                                            0;
                                            
          $order['order_grand_total']   = $order['order_sub_total'] + $order['delivery_charge'] + $order['tax_amount'] - $order['offer_amount'];

          $this->Order->save($order, null, null);
          $update['ref_number'] = '#GNC00'.$this->Order->id;
          $orderId[]    = $update['id'] = $this->Order->id;
          $this->Order->save($update);

          $storeDetails = $this->Store->findById($value['store_id']);

          // Store Owner Message
          if ($storeDetails['Store']['is_logged'] == 1) {
              $deviceId      = $storeDetails['Store']['device_id'];
              $message      = 'New order came - '.$update['ref_number'];
              
              $gcm = $this->AndroidResponse->sendOrderByGCM(
                      array('message'    => $message),
                              $deviceId);

          }

          $this->ShoppingCart->updateAll(
                        array('ShoppingCart.order_id' => $this->Order->id),
                        array('ShoppingCart.session_id' => $SessionId,
                               'ShoppingCart.order_id' => 0,
                              'ShoppingCart.store_id'   => $value['store_id']));

          $cartProducts = $this->ShoppingCart->find('all', array(
                'conditions' => array('ShoppingCart.order_id' => $this->Order->id)));

          foreach ($cartProducts as $key => $value) {
              $value['ProductDetail']['quantity'] -= $value['ShoppingCart']['product_quantity'];
              $value['ProductDetail']['quantity'] = ($value['ProductDetail']['quantity'] > 0) ? 
                                                    $value['ProductDetail']['quantity'] :
                                                    0;
              $this->ProductDetail->save($value['ProductDetail']);
          }
          $this->Order->id = '';
      }


      if ($this->request->data['Order']['paymentMethod'] == 'cod') {

          foreach ($orderId as $key => $value) {
              $orderUpdate['id'] = $value;
              $orderUpdate['payment_type'] = 'cod';
              $this->Order->save($orderUpdate);
              //OrderMail
              $this->ordermail($value);
              //OrderSms
              $this->ordersms($value);
          }
      } else {

        $id = $this->request->data['Order']['paymentMethod'];
        $amount = 0;

        $stripeCard = $this->StripeCustomer->findById($id);

        if (empty($stripeCard['StripeCustomer']['stripe_customer_id'])) {

            $datas    = array("stripeToken"  => $stripeCard['StripeCustomer']['stripe_token_id']);
            $customer = $this->Stripe->customerCreate($datas);
            $stripId = $stripeCard['StripeCustomer']['stripe_customer_id'] = $customer['stripe_id'];
            $this->StripeCustomer->save($stripeCard);

        } else {
            $stripId = $stripeCard['StripeCustomer']['stripe_customer_id'];
        }


        foreach ($orderId as $key => $value) {
          $orderTotal = $this->Order->findById($value);
          $amount += $orderTotal['Order']['order_grand_total'];
        }

        $data   = array('currency'       => 'usd',
                        "amount"         => $amount,
                        "stripeCustomer" => $stripId);
        
        $stripeResponse = $this->Stripe->charge($data);
        if ($stripeResponse['status'] == "succeeded" && $stripeResponse['stripe_id'] != '') {
          
            foreach ($orderId as $key => $value) {

              $orderUpdate['id'] = $value;
              $orderUpdate['transaction_id']  = $stripeResponse['stripe_id'];
              $orderUpdate['payment_type']    = 'Card';
              $orderUpdate['payment_method']  = 'paid';
              $this->Order->save($orderUpdate);
              //OrderMail
              $this->ordermail($value);
              //OrderSms
              $this->ordersms($value);
            }
        } else {

          foreach ($orderId as $key => $value) {

            $orderUpdate['id']            = $value;
            $orderUpdate['status']        = 'Failed';
            $orderUpdate['payment_type']  = 'Card';
            $orderUpdate['failed_reason'] = 'Payment failed';
            $this->Order->save($orderUpdate);
            $this->Session->write('orderFailed', 'failed');
          }
          $this->Session->setFlash(__('Payment failed', true),
                                    'default', array('class' => 'alert alert-danger'));
          $this->redirect(array('controller' => 'searches', 'action' => 'index', 'Failed'));
        }

      }
      $this->Session->write("preSessionid",'');
      $this->Session->write('orderplaced', 'success');
      $this->redirect(array('controller' => 'searches', 'action' => 'index', 'Thanks'));
  }

  //Order Sms
  public function ordersms($orderId) {

    $orderDetail = $this->Order->findById($orderId);
    $customerMessage = 'Thanks for using chillcart service. Your order '.$orderDetail['Order']['ref_number'].' has been placed. Track your order at '.$this->siteUrl.'. Regards Chillcart';
    $toCustomerNumber = '+'.$this->siteSetting['Country']['phone_code'].$this->Auth->User('Customer.customer_phone');
    $customerSms      = $this->Twilio->sendSingleSms($toCustomerNumber, $customerMessage);

    if ($orderDetail['Store']['sms_option'] == 'Yes' && !empty($orderDetail['Store']['sms_phone'])) {
      $storeMessage  = "Dear ".$orderDetail['Store']['store_name']." you've received a ";
      $storeMessage .= ($orderDetail['Order']['payment_method'] != 'paid') ? 'COD' : 'PAID';
      $storeMessage .= ' order '.$orderDetail['Order']['ref_number'].' from '.$orderDetail['Order']['customer_name'];

      if ($orderDetail['Order']['order_type'] == 'Delivery') {
           $storeMessage .= ','.$orderDetail['Order']['address'].','.$orderDetail['Order']['landmark'].
                            ','.$orderDetail['Order']['location_name'].','.$orderDetail['Order']['city_name'].
                            ','.$orderDetail['Order']['city_name'];
      }

      $storeMessage .= '. '.$orderDetail['Order']['order_type'].' due on '.$orderDetail['Order']['delivery_date'].' at '.$orderDetail['Order']['delivery_time_slot'].'. Thanks Chillcart';
      $toStoreNumber = '+'.$this->siteSetting['Country']['phone_code'].$orderDetail['Store']['sms_phone'];
      $customerSms   = $this->Twilio->sendSingleSms($toStoreNumber, $storeMessage);
    }
     return true;
  }


  public function store_index(){
    $this->layout = 'assets';
    $order_list = $this->Order->find('all', array(
                        'conditions'=>array('Order.store_id' => $this->Auth->User('Store.id'),
                                            'Order.status' => 'Delivered'),
                        'order' => array('Order.id DESC')));

    $this->set(compact('order_list'));
  }
  public function store_reportOrderView($id = null) {
    $this->layout = 'assets';
    if (!empty($id)){
      $orders_list = $this->Order->find('first', array(
                              'conditions' => array('Order.id' => $id,
                                          'Order.status' => 'Delivered',
                                          'Order.store_id' => $this->Auth->User('Store.id'))));
      if (empty($orders_list)) {
          $this->render('/Errors/error400');
      }
      $cities = $this->City->find('list', array(
                      'conditions' => array('City.state_id' => $orders_list['Store']['store_state']),
                      'fields' => array('id', 'city_name')));

      $location = $this->Location->find('list', array(
                      'conditions' => array('Location.city_id' => $orders_list['Store']['store_city']),
                      'fields' => array('id', 'area_name')));

      $this->set(compact('orders_list', 'cities', 'location'));
    } else {
      $this->redirect(array('controller' => 'Orders', 'action' => 'reportIndex'));
    }
    
  }
   public function store_orderIndex() {
    $this->layout = 'assets';
    $id           = $this->Auth->User();
    $order_list = $this->Order->find('all', array(
                          'conditions'=>array('Order.store_id'=>$id['Store']['id'],
                                            'Order.status' => 'Pending'),
                          'order' => array('Order.id DESC')));
    $status = array('Pending' => 'Pending', 'Accepted' => 'Accepted',
                    'Failed' => 'Failed', 'Delivered' => 'Delivered');

    $this->set(compact('order_list', 'status'));
  }
   public function store_orderView($id = null) {
    $this->layout = 'assets';
    if(!empty($id)){

      $order_detail = $this->Order->find('first', array(
                              'conditions' => array('Order.id' => $id,
                                          'Order.store_id' => $this->Auth->User('Store.id'))));
      if (empty($order_detail)) {
          $this->render('/Errors/error400');
      }
      $cities = $this->City->find('list', array(
                      'conditions' => array('City.state_id' => $order_detail['Store']['store_state']),
                      'fields' => array('id', 'city_name')));

      $location = $this->Location->find('list', array(
                      'conditions' => array('Location.city_id' => $order_detail['Store']['store_city']),
                      'fields' => array('id', 'area_name')));
      
      $this->set(compact('order_detail', 'cities', 'location'));
      

    } else {
       $this->redirect(array('controller' => 'Orders', 'action' => 'index'));
    }
    
  }
  public function store_order() {
    $this->layout = 'assets';
    $id           = $this->Auth->User();
    $statuss = array('Delivered','Pending','Failed','Deleted');

    $location = $this->Location->find('list', array(
                                    'fields' => array('id', 'area_name')));

    $city = $this->City->find('list', array(
                                    'fields' => array('id', 'city_name')));
    
    $orderList = $this->Order->find('all', array(
                        'conditions' => array('Order.store_id'=>$id['Store']['id'],
                                              'Order.order_type' => 'Delivery',
                            'NOT' => array('Order.status' => $statuss)),
                        'order' => array('Order.id DESC')));
    $status = array('Failed' => 'Failed', 'Delivered' => 'Delivered');

    $this->set(compact('orderList', 'location', 'city', 'status'));
  }


  public function admin_orderStatus() {

    $orderStatusUpdate['id'] = $orderId      = $this->request->data['orderId'];
    $orderStatusUpdate['status']  = $this->request->data['status'];

    $orderDetail = $this->Order->findById($orderId);

    if (isset($this->request->data['reason'])) {
        $orderStatusUpdate['failed_reason']  = $this->request->data['reason'];
        $this->Order->save($orderStatusUpdate);
    }

    if ($this->request->data['status'] == 'Delivered') {

        $this->Orderstatus->deleteAll(array('Orderstatus.order_id'=>$orderId));
        $orderStatusUpdate['payment_method']  = 'paid';
        $this->Order->save($orderStatusUpdate);
    }

    if ($orderStatusUpdate['status'] == 'Accepted') {
        $orderStatusUpdate['driver_id']  = '';

        if ($this->Order->save($orderStatusUpdate)) {
            $gcmId = $orderDetail['Driver']['device_id'];
            
            $message = array(
                            'message' => 'Disclaim Order',
                            'OrderId' => $orderId,
                            'OrderDetails' => '');

            $gcm = $this->AndroidResponse->sendOrderByGCM($message,$gcmId);
            $gcm = json_decode($gcm, true);

            $customerMessage = 'Congratulations! Your order '.$orderDetail['Order']['ref_number'].'succesfully accepted by '.
                                $orderDetail['Store']['store_name'].'. Your order will be delivered by '.
                                $orderDetail['Order']['delivery_date']. ' at '.$orderDetail['Order']['delivery_time_slot'].'. Thanks Chillcart';

            $toCustomerNumber = '+'.$this->siteSetting['Country']['phone_code'].$orderDetail['Customer']['customer_phone'];
            $customerSms      = $this->Twilio->sendSingleSms($toCustomerNumber, $customerMessage);
            echo 'Success';
        }
    }

    if ($orderStatusUpdate['status'] == 'Deleted') {
        if ($this->Order->save($orderStatusUpdate)) {
          echo 'Success';
        }
    }
    

    // Store Owner Message
    if ($orderDetail['Store']['is_logged'] == 1) {
      
        $deviceId      = $orderDetail['Store']['device_id'];

        if ($this->request->data['status'] == 'Failed') {
          $message = 'This order '.$orderDetail['Order']['ref_number']. ' will be failed. due to '.$this->request->data['reason'].'.';
        } elseif (!empty($orderDetail['Driver']['device_id']) && $this->request->data['status'] == 'Accepted') {
          $message = 'This order '.$orderDetail['Order']['ref_number']. ' was disclaimed.';
        } else{
           $message = 'This order '.$orderDetail['Order']['ref_number']. ' will be '.strtolower(trim($this->request->data('status'))).'.';
        }

        $gcm = $this->AndroidResponse->sendOrderByGCM(array('message' => $message),$deviceId);
    }

    exit();
  }

  public function store_orderStatus() {
    
    $orderStatusUpdate['id'] = $orderId      = $this->request->data['orderId'];
    $orderStatusUpdate['status']  = $this->request->data['status'];

    $orderDetail = $this->Order->findById($orderId);


    if (isset($this->request->data['reason'])) {
        $orderStatusUpdate['failed_reason']  = $this->request->data['reason'];
        $this->Order->save($orderStatusUpdate);
    }

    if ($this->request->data['status'] == 'Delivered') {

        $this->Orderstatus->deleteAll(array('Orderstatus.order_id'=>$orderId));

        $orderStatusUpdate['payment_method']  = 'paid';

        $this->Order->save($orderStatusUpdate);
    }

    if ($orderStatusUpdate['status'] == 'Accepted') {
        $orderStatusUpdate['driver_id']  = '';

        if ($this->Order->save($orderStatusUpdate)) {
            
            $gcmId = $orderDetail['Driver']['device_id'];
            
            $message = array(
                            'message' => 'Disclaim Order',
                            'OrderId' => $orderId,
                            'OrderDetails' => '');

            $gcm = $this->AndroidResponse->sendOrderByGCM($message,$gcmId);
            $gcm = json_decode($gcm, true);

            $customerMessage = 'Congratulations! Your order '.$orderDetail['Order']['ref_number'].' succesfully accepted by '.$orderDetail['Store']['store_name'].'. Your order will be delivered by '.$orderDetail['Order']['delivery_date']. ' at '.$orderDetail['Order']['delivery_time_slot'].'. Thanks Chillcart';

            $toCustomerNumber = '+'.$this->siteSetting['Country']['phone_code'].$orderDetail['Customer']['customer_phone'];
            $customerSms      = $this->Twilio->sendSingleSms($toCustomerNumber, $customerMessage);

            echo 'Success';
        }
    }
    if ($orderStatusUpdate['status'] == 'Deleted') {
        if ($this->Order->save($orderStatusUpdate)) {
          echo 'Success';
        }
    }
    

    // Store Owner Message
    if ($orderDetail['Store']['is_logged'] == 1) {
      
        $deviceId      = $orderDetail['Store']['device_id'];

        if ($this->request->data['status'] == 'Failed') {
          $message = 'This order '.$orderDetail['Order']['ref_number']. ' will be failed. due to '.$this->request->data['reason'].'.';
        } elseif (!empty($orderDetail['Driver']['device_id']) && $this->request->data['status'] == 'Accepted') {
          $message = 'This order '.$orderDetail['Order']['ref_number']. ' was disclaimed.';
        } else{
           $message = 'This order '.$orderDetail['Order']['ref_number']. ' will be '.strtolower(trim($this->request->data('status'))).'.';
        }
        $gcm = $this->AndroidResponse->sendOrderByGCM(array('message' => $message),$deviceId);
    }
    exit();
  }
    public function store_collectionOrder(){
        $this->layout = 'assets';
        $id           = $this->Auth->User();
        $order_list = $this->Order->find('all', array(
                              'conditions' => array('Order.status' => 'Accepted',
                                                  'Order.store_id'=>$id['Store']['id'],
                                                  'Order.order_type' => 'Collection'),
                              'order' => array('Order.id DESC')));

        $status = array('Accepted' => 'Accepted', 'Failed' => 'Failed', 'Delivered' => 'Delivered');

        $this->set(compact('order_list', 'status'));
    }

    public function store_failedOrderDetail(){
        $this->layout = 'assets';
        $id           = $this->Auth->User();
        $order_list = $this->Order->find('all', array(
                              'conditions' => array('Order.status' => 'Failed',
                                                      'Order.store_id'=>$id['Store']['id']),
                              'order' => array('Order.id DESC')));
        $status = array('Pending' => 'Pending', 'Accepted' => 'Accepted',
                          'Failed' => 'Failed', 'Delivered' => 'Delivered');
        $this->set(compact('order_list', 'status'));
    }

    public function ordermail($orderId) {

        $datas       = $this->Order->findById($orderId);
        $store_id    = $datas['Order']['store_id'];

        $statusmailCustomer = $this->Notification->find('first',array(
                                  'conditions'=>array('Notification.title =' => 'Order details mail')));

        $statusmailSeller   = $this->Notification->find('first',array(
                                  'conditions'=>array('Notification.title =' => 'Order sellar Mail')));

        $customerContent = $statusmailCustomer['Notification']['content'];
        $customerSubject = $statusmailCustomer['Notification']['subject'];

        $sellerContent = $statusmailSeller['Notification']['content'];
        $sellerSubject = $statusmailSeller['Notification']['subject'];


        $name= '<table width="100%" border="0" style="border-color:#d9d9d9;"  cellspacing="0">
          <tbody><tr style="border-bottom:1px solid #ccc">
                <th style="font:bold 14px/30px Arial;background:#09a925;color:#ffffff; padding:8px; border:1px solid #d9d9d9;border-right:0;" width="3%">
                  S.No</th>
                <th style="font:bold 14px/30px Arial;background:#09a925;color:#ffffff; padding:8px; border:1px solid #d9d9d9;border-right:0;" width="5%">
                  Item Image </th>
                <th style="font:bold 14px/30px Arial;background:#09a925;color:#ffffff; padding:8px; border:1px solid #d9d9d9;border-right:0;" width="25%">
                  Item Name</th>
                <th style="font:bold 14px/30px Arial;background:#09a925;color:#ffffff; padding:8px; border:1px solid #d9d9d9;border-right:0;" width="5%">
                  Qty</th>
                <th style="font:bold 14px/30px Arial;background:#09a925;color:#ffffff; padding:8px; border:1px solid #d9d9d9;border-right:0;" width="5%">
                  Price</th>
                <th style="font:bold 14px/30px Arial;background:#09a925;color:#ffffff; padding:8px; border:1px solid #d9d9d9;border-right:0;" width="12%">
                  Total Price</th>
          </tr>';

      $source = $this->siteUrl.'/siteicons/logo.png';
      $Currency   = $this->siteSetting['Country']['currency_symbol'];


      foreach ($datas['ShoppingCart'] as $key => $data) {

        $productSrc = $this->cdn.'/stores/products/carts/'.$data['product_image'];

        $serialNo = $key+1;

        $name.='<tr>
              <td style="border:1px solid #09a925;border-top:0;border-right:0;text-align:center; color:#000;font:14px Arial;border-left:0;" >'.$serialNo.'
              <td style="border:1px solid #09a925;border-top:0;border-right:0;text-align:center; color:#000;font:14px Arial" >
                <div style="width:100px; padding:5px; display:inline-block;">

                  <img src='.$productSrc.' onerror="this.onerror=null;this.src='."'".$this->siteUrl.'/images/noimage.jpg'."'".'" width="71"  style="max-width:100%">
                   </div></td>
              <td style="border:1px solid #09a925;border-top:0;border-right:0;text-align:left; color:#000;font:14px Arial"><span style="padding:10px; display:inline-block;">'.
                $data['product_name'].'</span></td>
              <td style="border:1px solid #09a925;border-top:0;border-right:0;text-align:center; color:#000;font:14px Arial" >'.
                $data['product_quantity'].'</td>
              <td style="border:1px solid #09a925;border-top:0;border-right:0;text-align:right; padding-right:10px; color:#000;font:14px Arial" width="10%">'.
                $Currency." ".$data['product_price'] .'</td>
              <td style="border:1px solid #09a925;border-top:0;text-align:right; padding-right:10px; color:#000;font:14px Arial;border-right:0;" >'.
                $Currency." ".$data['product_total_price'] .'</td>
        </tr>'; 
      }
      
        $name.='<tr>
              <td colspan="5" style="text-align:right; padding-right:10px;font:bold 16px/30px Arial; border:1px solid #09a925;border-right:0;border-top:0;border-left:0;">
                  Sub-Total</td>
              <td style="text-align:right; padding-right:10px;font:16px/30px Arial; border:1px solid #09a925;border-top:0;border-right:0;">'.
                $Currency." ".$datas['Order']['order_sub_total'] .'</td>
          </tr>';
    
      if ($datas['Order']['delivery_charge'] > 0) {
        $name.='<tr>
              <td colspan="5" style="text-align:right; padding-right:10px;font:bold 16px/30px Arial; border:1px solid #09a925;border-right:0;border-top:0;border-left:0;">
                  Delivery Charge</td>
              <td style="text-align:right; padding-right:10px;font:16px/30px Arial; border:1px solid #09a925;border-top:0;border-right:0;">'.
                $Currency." ".$datas['Order']['delivery_charge'] .'</td>
          </tr>';

      }

      if ($datas['Order']['tax_amount'] > 0) {

        $name.='<tr>
              <td colspan="5" style="text-align:right; padding-right:10px;font:bold 16px/30px Arial; border:1px solid #09a925;border-right:0;border-top:0;border-left:0;">
                  Tax</td>
              <td style="text-align:right; padding-right:10px;font:16px/30px Arial; border:1px solid #09a925;border-top:0;border-right:0;">'.
                $Currency." ".$datas['Order']['tax_amount'] .'</td>
          </tr>';
      }

      if ($datas['Order']['offer_amount'] > 0) {


        $name.='<tr>
              <td colspan="5" style="text-align:right; padding-right:10px;font:bold 16px/30px Arial; border:1px solid #09a925;border-right:0;border-top:0;border-left:0;">
                  Sub-Offer</td>
              <td style="text-align:right; padding-right:10px;font:16px/30px Arial; border:1px solid #09a925;border-top:0;border-right:0;">'.
                $Currency." ".$datas['Order']['offer_amount'] .'</td>
          </tr>';
      }


        $name.='<tr>
              <td colspan="5" style="text-align:right;  padding-right:10px;color:#09a925;font:bold 18px/30px Arial; border:1px solid #09a925;border-right:1px solid #09a925; border-bottom:1px solid #09a925;border-top:0;border-right:0;border-left:0;">
                Total</td>
              <td style="text-align:right; padding-right:10px;color:#09a925;font:bold 18px/30px Arial; border:1px solid #09a925;border-right:1px solid #09a925; border-bottom:1px solid #09a925; border-top:0;border-right:0;">'.
                $Currency." ".$datas['Order']['order_grand_total'].' </td>
          </tr>
        </table>
        </div>';


      $Address= '<div style="width:100%; display:inline-block; ">
                  <div style="width:100%; display:inline-block;margin-top:20px;">
                    <div style="width:46%; display:inline-block; vertical-align:top; padding-left:20px;">

                      <div style="width:100%; display:inline-block;">
                        <h3 style="font-family:Arial; color:#09a925;" >
                          Here is your order information</th> </h3>
                        <div style="width:100%; display:inline-block;">
                            <span style="width:45%; display:inline-block;font:bold 15px Arial; text-align:right; margin:5px 0;">
                                Order Number/ID :
                            </span>
                            <span style="width:45%; display:inline-block;font:15px Arial; margin:5px 0; padding-left:10px;">'.
                              $datas['Order']['ref_number'].'
                            </span> 
                        </div>
                        <div style="width:100%; display:inline-block;">
                          <span style="width:45%; display:inline-block;font:bold 15px Arial; text-align:right; margin:5px 0;">
                            Payment Method :
                          </span>
                          <span style="width:45%; display:inline-block;font:15px Arial; margin:5px 0; padding-left:10px;">'.
                            str_ireplace('cod', 'cash on delivery', $datas['Order']['payment_type']) .'
                          </span> 
                        </div>
                        <div style="width:100%; display:inline-block;">
                          <span style="width:45%; display:inline-block;font:bold 15px Arial; text-align:right; margin:5px 0;">
                              Order Type : 
                           </span>
                          <span style="width:45%; display:inline-block;font:15px Arial; margin:5px 0; padding-left:10px;"> '.
                            $datas['Order']['order_type'].'
                          </span> 
                        </div>  
                        <div style="width:100%; display:inline-block;">
                          <span style="width:45%; display:inline-block;font:bold 15px Arial; text-align:right; margin:5px 0;">
                            '.$datas['Order']['order_type'].' Time :
                          </span>
                          <span style="width:45%; display:inline-block;font:15px Arial; margin:5px 0; padding-left:10px;"> '.
                            $datas['Order']['delivery_time_slot'].'
                          </span> 
                        </div>
                      </div>
                      </div>
                      <div style="width:45%; display:inline-block;border-left:1px dotted #09a925;min-height:200px; padding-left:30px;vertical-align:top;">
                        <div style="width:100%; display:inline-block;">
                          <h3 style="font-family:Arial; color:#09a925;" >
                            Address
                          </h3>
                        </div>
                        <div style="width:100%; display:inline-block;">
                          <span style="width:100%; display:inline-block;font:bold 15px Arial;margin:5px 0;">'.
                            $datas['Order']['customer_name'].'
                          </span> 
                          <span style="width:100%; display:inline-block;font:15px Arial; margin:5px 0;">'.
                            $datas['Order']['address']." ".
                            $datas['Order']['location_name']. ','.
                            $datas['Order']['city_name'].'
                          </span> 
                          <span style="width:100%; display:inline-block;font:15px Arial; margin:5px 0;">'.
                                $datas['Order']['state_name']." - ".
                                $this->siteSetting['Country']['country_name']. '
                          </span> 
                          <span style="width:100%; display:inline-block;font:bold 15px Arial;margin:5px 0;">'.
                            $datas['Order']['customer_phone'].'</span>  
                          </div>
                        </div>
                      </div>';

      $customer_mail = $datas['Order']['customer_email'];
      $customerName  = $datas['Order']['customer_name'];
      $storename     = $datas['Store']['store_name'];
      $sitemailId    = $this->siteSetting['Sitesetting']['admin_email'];

      $mailContent = $customerContent;
      $siteUrl = $this->siteUrl;

      $mailContent     = str_replace("{Customer name}", $customerName, $mailContent);
      $mailContent     = str_replace("{source}", $source, $mailContent);
      $mailContent     = str_replace("{Store name}", $storename, $mailContent);
      $mailContent     = str_replace("{orderid}", $datas['Order']['ref_number'], $mailContent);
      $mailContent     = str_replace("{note}", $name, $mailContent);
      $mailContent     = str_replace("{Address}", $Address, $mailContent);
      $mailContent     = str_replace("{SITE_URL}", $siteUrl, $mailContent);
      $customerSubject = str_replace("[with Order ID]", $datas['Order']['ref_number'], $customerSubject);
      $customerSubject = str_replace("store name", $storename, $customerSubject);

      $email = new CakeEmail();
      $email->from($sitemailId);
      $email->to($customer_mail);
      $email->subject($customerSubject);
      $email->template('ordermail');
      $email->emailFormat('html');
      $email->viewVars(array('mailContent' => $mailContent,
                          'source' => $source,
                          'storename' => $storename));
      $email->send();

      if ($datas['Store']['email_order'] == 'Yes' && !empty($datas['Store']['order_email'])) {

        $storemailId = $datas['Store']['order_email'];

        $mailContent = $sellerContent;

        $mailContent   = str_replace("{Customer name}", $customerName, $mailContent);
        $mailContent   = str_replace("{source}", $source, $mailContent);
        $mailContent   = str_replace("{Store name}", $storename, $mailContent);
        $mailContent   = str_replace("{orderid}", $datas['Order']['ref_number'], $mailContent);
        $mailContent   = str_replace("{note}", $name, $mailContent);
        $mailContent   = str_replace("{Address}", $Address, $mailContent);
        $mailContent   = str_replace("{SITE_URL}", $siteUrl, $mailContent);
        $sellerSubject = str_replace("[ Order ID ]", $datas['Order']['ref_number'], $sellerSubject);
        $sellerSubject = str_replace("customer name", $customerName, $sellerSubject);

        $email = new CakeEmail();
        $email->from($customer_mail); 
        $email->to($storemailId);
        $email->subject($sellerSubject);
        $email->template('ordermail');
        $email->emailFormat('html');
        $email->viewVars(array('mailContent' => $mailContent,
                              'source' => $source,
                              'storename' => $storename));
        $email->send();
      }
      return true;
    }

}