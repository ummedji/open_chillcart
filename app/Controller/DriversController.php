<?php

/* MN */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class DriversController extends AppController
{

    var $helpers = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');
    public $uses = array('Driver', 'User', 'Vehicle', 'Order', 'State', 'City', 'Location', 'Store');
    public $components = array('Updown', 'Googlemap', 'AndroidResponse', 'Twilio');


    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->storeState = $this->State->find('list', array(
            'fields' => array('id', 'state_name')));
        $this->storeCity = $this->City->find('list', array(
            'fields' => array('City.id', 'City.city_name')));

        if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
            $this->storeLocation = $this->Location->find('list', array(
                'fields' => array('id', 'zip_code')));
        } else {
            $this->storeLocation = $this->Location->find('list', array(
                'fields' => array('id', 'area_name')));
        }

        $this->set(compact('storeCity', 'storeArea', 'cityId', 'areaId'));
    }


    public function admin_index()
    {

        $drivers = $this->Driver->find('all', array(
            'conditions' => array('NOT' => array('Driver.status' => 'Delete'))));
        $this->set(compact('drivers'));
    }

    public function admin_add()
    {

        if (!empty($this->request->data['User']['username'])) {

            $driver  = $this->User->find('first', array(
                                'conditions' => array('User.username' => $this->request->data['User']['username'],
                                        'NOT' => array('User.id' => $this->request->data['User']['id'],
                                                        'Driver.status' => 'Delete'))));

            if (!empty($driver)) {
                $this->Session->setFlash('<p>' . __('Driver Already Exists ', true) . '</p>', 'default',
                    array('class' => 'alert alert-danger'));
            } else {

                $this->request->data['User']['role_id'] = 5;
                $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                if ($this->User->save($this->request->data['User'], null, null)) {

                    $this->request->data['Driver']['parent_id'] = $this->User->id;
                    $this->request->data['Driver']['driver_phone'] = $this->request->data['User']['username'];

                    $this->Driver->save($this->request->data['Driver'], null, null);

                    $this->Session->setFlash('<p>' . __('Driver Successfully Created', true) . '</p>', 'default',
                        array('class' => 'alert alert-success'));

                    $this->redirect(array('controller' => 'drivers', 'action' => 'index', 'admin' => true));

                }
            }
        }
    }


    public function admin_edit($id = null) {

        if (!empty($this->request->data)) {

            $driver_checking = $this->User->find('first', array(
                            'conditions' => array('User.username' => trim($this->request->data['Driver']['driver_phone']),
                                    'NOT' => array('User.id' => $this->request->data['User']['id'],
                                                    'Driver.status' => 'Delete'))));
            if (!empty($driver_checking)) {
                $this->Session->setFlash('<p>' . __('Driver Already Exists ', true) . '</p>', 'default',
                    array('class' => 'alert alert-danger'));
            } else {
                $this->request->data['User']['Username'] = trim($this->request->data['Driver']['driver_phone']);
                $this->User->save($this->request->data['User'], null, null);
                $this->Driver->save($this->request->data['Driver'], null, null);
                $this->Session->setFlash('<p>' . __('Driver Successfully Created', true) . '</p>', 'default',
                    array('class' => 'alert alert-success'));
                $this->redirect(array('controller' => 'drivers', 'action' => 'index', 'admin' => true));
            }

        }
        $driverDetails = $this->Driver->findById($id);
        $this->request->data = $driverDetails;
    }


    public function admin_addvehicle($id = null)
    {

        if (!empty($this->request->data['Vehicle']['vehicle_name'])) {

            $this->request->data['Vehicle']['driver_id'] = $id;

            if ($this->Vehicle->save($this->request->data['Vehicle'], null, null)) {

                $this->Session->setFlash('<p>' . __('Driver Vehicle Added Successfully', true) . '</p>', 'default',
                    array('class' => 'alert alert-success'));
                $this->redirect(array('controller' => 'drivers', 'action' => 'index', 'admin' => true));

            }
        }
    }


    public function admin_editvehicle($id = null, $vehicleId = null)
    {

        if (!empty($this->request->data['Vehicle']['vehicle_name'])) {

            if ($this->Vehicle->save($this->request->data['Vehicle'], null, null)) {

                $this->Session->setFlash('<p>' . __('Driver Vehicle updated Successfully', true) . '</p>', 'default',
                    array('class' => 'alert alert-success'));
                $this->redirect(array('controller' => 'drivers', 'action' => 'index', 'admin' => true));

            }
        }

        $this->request->data = $this->Vehicle->findById($vehicleId);
    }

    public function availDrivers($orderId) {

        $availDrivers = array();
        $orderDetails = $this->Order->findById($orderId);
        if ($orderDetails['Order']['driver_id']) {
            $this->Session->setFlash(__('Order already assigned to driver', true),
                'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('controller' => 'orders', 'action' => 'order', 'admin' => true));
        } else {

            $drivers = $this->Driver->find('all', array(
                'conditions' => array('Vehicle.vehicle_name !=' => '',
                    'Driver.driver_status' => 'Available',
                    'OR' => array('Driver.store_id' => array($orderDetails['Order']['store_id'], 0)),
                ),
                'group' => array('Driver.id')));


            $pickup['Latitude'] = $orderDetails['Store']['latitude'];
            $pickup['Longitude'] = $orderDetails['Store']['longitude'];

            if (!empty($drivers)) {

                foreach ($drivers as $key => $value) {

                    $distance = $this->Googlemap->getDrivingDistance(
                        $value['DriverTracking']['driver_latitude'],
                        $value['DriverTracking']['driver_longitude'],
                        $pickup['Latitude'],
                        $pickup['Longitude']);


                    //if (!empty($distance)) {

                        $availDrivers[$key]['Driver']['id'] = $value['Driver']['id'];
                        $availDrivers[$key]['Driver']['status'] = $value['Driver']['status'];
                        $availDrivers[$key]['Driver']['distance'] = $distance['distanceText'];
                        $availDrivers[$key]['Driver']['reachtime'] = $distance['durationText'];
                        $availDrivers[$key]['Driver']['driver_name'] = $value['Driver']['driver_name'];
                        $availDrivers[$key]['Driver']['driver_phone'] = $value['Driver']['driver_phone'];
                        $availDrivers[$key]['Driver']['vehicle_name'] = $value['Vehicle']['vehicle_name'];
                        $availDrivers[$key]['Driver']['vehicle_model'] = $value['Vehicle']['vehicle_name'];
                    //}

                }
            }
            $this->set(compact('orderId', 'availDrivers'));
        }

    }

    public function admin_billingDetail($driverId = null)
    {

        if (!empty($this->request->data['Drivers']) && $this->request->data['Drivers']['from_date'] != '' && $this->request->data['Drivers']['to_date'] != '') {
            $from_date = date('Y-m-d', strtotime($this->request->data['Drivers']['from_date']));
            $to_date = date('Y-m-d', strtotime($this->request->data['Drivers']['to_date']));
            $driverId = $this->request->data['Drivers']['id'];

            $order_detail = $this->Order->find('all', array(
                'conditions' => array('Order.driver_id' => $driverId,
                    'Order.delivery_date between ? and ?' =>
                        array($from_date, $to_date),
                    'Order.status' => 'Delivered'),
                'order' => array('Order.id DESC')));


        } else {
            $order_detail = $this->Order->find('all', array(
                'conditions' => array('Order.driver_id' => $driverId,
                    'Order.delivery_date' => date('Y-m-d', time()),
                    'Order.status' => 'Delivered'),
                'order' => array('Order.id DESC')));


        }

        $total_orderprice = 0;
        $total_km = 0;
        foreach ($order_detail as $key => $value) {
            $distance = explode(' ', $value['Order']['distance']);
            $value['Order']['distance'] = (trim($distance[1]) == 'm') ? $value['Order']['distance'] / 1000 :
                $value['Order']['distance'];
            $total_orderprice = $total_orderprice + $value['Order']['order_grand_total'];
            $total_km = $total_km + $value['Order']['distance'];
        }

        $fromDate = (isset($this->request->data['Drivers']['from_date'])) ? $this->request->data['Drivers']['from_date'] : date('m/d/Y', time());
        $toDate = (isset($this->request->data['Drivers']['to_date'])) ? $this->request->data['Drivers']['to_date'] : date('m/d/Y', time());


        $this->set(compact('order_detail', 'total_km', 'total_orderprice', 'driverId', 'fromDate', 'toDate'));

    }

    public function store_billingDetail($driverId = null)
    {
        $this->layout = 'assets';
        if (!empty($this->request->data['Drivers']) && $this->request->data['Drivers']['from_date'] != '' && $this->request->data['Drivers']['to_date'] != '') {
            $from_date = date('Y-m-d', strtotime($this->request->data['Drivers']['from_date']));
            $to_date = date('Y-m-d', strtotime($this->request->data['Drivers']['to_date']));
            $driverId = $this->request->data['Drivers']['id'];
            $order_detail = $this->Order->find('all', array(
                'conditions' => array('Order.driver_id' => $driverId,
                    'Order.delivery_date between ? and ?' =>
                        array($from_date, $to_date),
                    'Order.status' => 'Delivered'),
                'order' => array('Order.id DESC')));

        } else {
            $order_detail = $this->Order->find('all', array(
                'conditions' => array('Order.driver_id' => $driverId,
                    'Order.delivery_date' => date('Y-m-d', time()),
                    'Order.status' => 'Delivered'),
                'order' => array('Order.id DESC')));
        }

        $total_orderprice = 0;
        $total_km = 0;
        foreach ($order_detail as $key => $value) {
            $distance = explode(' ', $value['Order']['distance']);
            $value['Order']['distance'] = (trim($distance[1]) == 'm') ? $value['Order']['distance'] / 1000 :
                $value['Order']['distance'];
            $total_orderprice = $total_orderprice + $value['Order']['order_grand_total'];
            $total_km = $total_km + $value['Order']['distance'];
        }

        $fromDate = ($this->request->data['Drivers']['from_date']) ? $this->request->data['Drivers']['from_date'] : date('m/d/Y', time());
        $toDate = ($this->request->data['Drivers']['to_date']) ? $this->request->data['Drivers']['to_date'] : date('m/d/Y', time());

        $this->set(compact('order_detail', 'total_km', 'total_orderprice', 'driverId', 'fromDate', 'toDate'));

    }

    public function assignOrder($orderId, $driverId)
    {

        $orders = $this->Order->findById($orderId);

        if (!$orders['Order']['driver_id']) {
            $driverDetails = $this->Driver->find('first', array(
                'conditions' => array('Driver.id' => $driverId,
                    'User.role_id' => '5')));
            if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {

                $storeAddress = $orders['Store']['street_address'] . ', ' .
                    $this->storeCity[$orders['Store']['store_city']] . ', ' .
                    $this->storeState[$orders['Store']['store_state']] . ' ' .
                    $this->storeLocation[$orders['Store']['store_zip']] . ', ' .
                    $this->siteSetting['Country']['country_name'];


            } else {
                $storeAddress = $orders['Store']['street_address'] . ', ' .
                    $this->storeLocation[$orders['Store']['store_zip']] . ', ' .
                    $this->storeCity[$orders['Store']['store_city']] . ', ' .
                    $this->storeState[$orders['Store']['store_state']] . ', ' .
                    $this->siteSetting['Country']['country_name'];
            }


            $orderDetails['paymentType'] = $orders['Order']['payment_type'];
            $orderDetails['CustomerName'] = $orders['Order']['customer_name'];

            $orderDetails['StoreName'] = stripslashes($orders['Store']['store_name']);
            $orderDetails['SourceAddress'] = $storeAddress;
            $orderDetails['SourceLatitude'] = $orders['Order']['source_latitude'];
            $orderDetails['SourceLongitude'] = $orders['Order']['source_longitude'];
            $orderDetails['DestinationAddress'] = $orders['Order']['address'] . ', ' .
                $orders['Order']['location_name'] . ', ' .
                $orders['Order']['city_name'] . ', ' .
                $orders['Order']['state_name'];

            $orderDetails['LandMark'] = $orders['Order']['landmark'];
            $orderDetails['DestinationLatitude'] = $orders['Order']['destination_latitude'];
            $orderDetails['DestinationLongitude'] = $orders['Order']['destination_longitude'];
            $orderDetails['OrderDate'] = $orders['Order']['delivery_date'];
            $orderDetails['OrderTime'] = $orders['Order']['delivery_time_slot'];
            $orderDetails['OrderPrice'] = $orders['Order']['order_grand_total'];
            $orderDetails['OrderId'] = $orders['Order']['id'];
            $orderDetails['OrderGenerateId'] = $orders['Order']['ref_number'];

            $distance = $this->Googlemap->getDrivingDistance(
                $orderDetails['SourceLatitude'],
                $orderDetails['SourceLongitude'],
                $orderDetails['DestinationLatitude'],
                $orderDetails['DestinationLongitude']);
            $orderDetails['Distance'] = $distance['distanceText'];


            $count = $this->Order->find('count', array(
                'conditions' => array(
                    'Order.driver_id' => $driverId,
                    'Order.status' => 'Waiting')));

            $orderDetails['waitingCount'] = $count + 1;


            if (!empty($driverDetails)) {

                $deviceId = $driverDetails['Driver']['device_id'];
                $ordDetails = json_encode($orderDetails);
                $message = 'New order came - ' . $orders['Order']['ref_number'];

                $gcm = $this->AndroidResponse->sendOrderByGCM(
                    array('OrderDetails' => $ordDetails,
                        'message' => $message),
                    $deviceId);

                $orderStatus['id'] = $orderId;
                $orderStatus['status'] = 'Waiting';
                $orderStatus['driver_id'] = $driverId;

                $this->Order->save($orderStatus);

                $gcm = json_decode($gcm, true);
		 // Driver SMS
                $driverMessage  = 'Dear '.$driverDetails['Driver']['driver_name'].',pick up ';
                $driverMessage .= ($orders['Order']['payment_method'] != 'paid') ? 'COD' : 'PAID';
                $driverMessage .= ' order '.$orders['Order']['ref_number'].' from '.$orders['Order']['customer_name'];
                $driverMessage .=   ','.$orders['Order']['address'].','.$orders['Order']['landmark'].
                                    ','.$orders['Order']['location_name'].','.$orders['Order']['city_name'].
                                    ','.$orders['Order']['city_name'];
                $driverMessage .= '. '.$orders['Order']['order_type'].' due on '.$orders['Order']['delivery_date'].' at '.
                                    $orders['Order']['delivery_time_slot'].'. Thanks Chillcart';
                $toDriverNumber = '+'.$this->siteSetting['Country']['phone_code'].$driverDetails['Driver']['driver_phone'];
                $driverSms      = $this->Twilio->sendSingleSms($toDriverNumber, $driverMessage);


                echo $gcm['success'];
            } else {
                die('404');
            }
        }

        die();
    }


    public function checkOrderStatus($orderId)
    {

        $orders = $this->Order->findById($orderId);

        if ($orders['Order']['status'] == 'Assigned') {
            $this->Session->setFlash('Order was accepted');
        } else {
            $this->Session->setFlash('Order was rejected');
        }
        echo $orders['Order']['status'];
        die();
    }


    public function store_index()
    {
        $this->layout = 'assets';
        $id = $this->Auth->User();
        $drivers = $this->Driver->find('all', array(
            'conditions' => array(
                'Driver.store_id' => $id['Store']['id'],
                'NOT' => array('Driver.status' => 'Delete'))));
        $this->set(compact('drivers'));
    }

    public function store_add()
    {
        $this->layout = 'assets';
        $id = $this->Auth->User();

        if (!empty($this->request->data['User']['username'])) {

            $driver  = $this->User->find('first', array(
                                'conditions' => array('User.username' => $this->request->data['User']['username'],
                                     'NOT' => array('User.id' => $this->request->data['User']['id'],
                                                    'Driver.status' => 'Delete'))));

            if (!empty($driver)) {
                $this->Session->setFlash('<p>' . __('Driver Already Exists ', true) . '</p>', 'default',
                    array('class' => 'alert alert-danger'));
            } else {

                $this->request->data['User']['role_id'] = 5;
                $this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
                if ($this->User->save($this->request->data['User'], null, null)) {

                    $this->request->data['Driver']['parent_id'] = $this->User->id;
                    $this->request->data['Driver']['store_id'] = $id['Store']['id'];
                    $this->request->data['Driver']['driver_phone'] = $this->request->data['User']['username'];
                    $this->Driver->save($this->request->data['Driver'], null, null);

                    $this->Session->setFlash('<p>' . __('Driver Successfully Created', true) . '</p>', 'default',
                        array('class' => 'alert alert-success'));
                    $this->redirect(array('controller' => 'drivers', 'action' => 'index', 'store' => true));
                }
            }
        }
    }


    public function store_addvehicle($id = null)
    {
        $this->layout = 'assets';
        if (!empty($this->request->data['Vehicle']['vehicle_name'])) {

            $this->request->data['Vehicle']['driver_id'] = $id;

            if ($this->Vehicle->save($this->request->data['Vehicle'], null, null)) {

                $this->Session->setFlash('<p>' . __('Driver Vehicle Added Successfully', true) . '</p>', 'default',
                    array('class' => 'alert alert-success'));
                $this->redirect(array('controller' => 'drivers', 'action' => 'index', 'store' => true));

            }
        }
    }


    public function store_edit($id = null)
    {
        $this->layout = 'assets';
        $store_id = $this->Auth->User('Store.id');
        if (!empty($this->request->data)) {

            $getDriverEditData = $this->User->find('first', array(
                                      'conditions' => array('User.id' => $this->request->data['User']['id'],
                                                        'Driver.store_id' => $store_id)));
            if (empty($getDriverEditData)) {
                $this->render('/Errors/error400');
            }
            
            $driver_checking = $this->User->find('first', array(
                            'conditions' => array('User.username' => trim($this->request->data['Driver']['driver_phone']),
                                    'NOT' => array('User.id' => $this->request->data['User']['id'],
                                                    'Driver.status' => 'Delete'))));
            if (!empty($driver_checking)) {
                $this->Session->setFlash('<p>' . __('Driver Already Exists ', true) . '</p>', 'default',
                    array('class' => 'alert alert-danger'));
            } else {
                $this->request->data['User']['Username'] = trim($this->request->data['Driver']['driver_phone']);
                $this->User->save($this->request->data['User'], null, null);
                $this->Driver->save($this->request->data['Driver'], null, null);
                $this->Session->setFlash('<p>' . __('Driver Successfully updated', true) . '</p>', 'default',
                    array('class' => 'alert alert-success'));
                $this->redirect(array('controller' => 'drivers', 'action' => 'index', 'store' => true));
            }

        }
        $driverDetails = $this->Driver->find('first', array(
                                  'conditions' => array('Driver.id' => $id,
                                                    'Driver.store_id' => $store_id)));
        if (empty($driverDetails)) {
            $this->render('/Errors/error400');
        }

        $this->request->data = $driverDetails;
    }


    public function store_editVehicle($id = null, $vehicleId = null)
    {
        $this->layout = 'assets';
        if (!empty($this->request->data['Vehicle']['vehicle_name'])) {
            if ($this->Vehicle->save($this->request->data['Vehicle'], null, null)) {

                $this->Session->setFlash('<p>' . __('Driver Vehicle updated Successfully', true) . '</p>', 'default',
                    array('class' => 'alert alert-success'));
                $this->redirect(array('controller' => 'drivers', 'action' => 'index', 'store' => true));

            }
        }
        $this->request->data = $this->Vehicle->findById($vehicleId);
    }

    public function store_availDriver($orderId)
    {
        $this->layout = 'assets';

        $availDrivers = array();

        $orderDetails = $this->Order->find('first', array(
                                'conditions' => array('Order.id' => $orderId,
                                            'Order.store_id' => $this->Auth->User('Store.id'))));
        if (empty($orderDetails)) {
            $this->render('/Errors/error400');
        }

        if ($orderDetails['Order']['driver_id']) {
            $this->Session->setFlash(__('Order already assigned to driver', true),
                'default', array('class' => 'alert alert-success'));
            return $this->redirect(array('controller' => 'orders', 'action' => 'order', 'store' => true));
        } else {

            $drivers = $this->Driver->find('all', array(
                'conditions' => array('Vehicle.vehicle_name !=' => '',
                    'Driver.driver_status' => 'Available',
                    'Driver.store_id' => $this->Auth->user('Store.id')),

                'group' => array('Driver.id')));

            $pickup['Latitude'] = $orderDetails['Store']['latitude'];
            $pickup['Longitude'] = $orderDetails['Store']['longitude'];

            if (!empty($drivers)) {

                foreach ($drivers as $key => $value) {

                    $distance = $this->Googlemap->getDrivingDistance(
                        $value['DriverTracking']['driver_latitude'],
                        $value['DriverTracking']['driver_longitude'],
                        $pickup['Latitude'],
                        $pickup['Longitude']);

                    //if (!empty($distance)) {

                        $availDrivers[$key]['Driver']['id'] = $value['Driver']['id'];
                        $availDrivers[$key]['Driver']['status'] = $value['Driver']['status'];
                        $availDrivers[$key]['Driver']['distance'] = $distance['distanceText'];
                        $availDrivers[$key]['Driver']['reachtime'] = $distance['durationText'];
                        $availDrivers[$key]['Driver']['driver_name'] = $value['Driver']['driver_name'];
                        $availDrivers[$key]['Driver']['driver_phone'] = $value['Driver']['driver_phone'];
                        $availDrivers[$key]['Driver']['vehicle_name'] = $value['Vehicle']['vehicle_name'];
                        $availDrivers[$key]['Driver']['vehicle_model'] = $value['Vehicle']['vehicle_name'];
                    //}

                }
            }

            $this->set(compact('orderId', 'availDrivers'));
        }
    }
}
