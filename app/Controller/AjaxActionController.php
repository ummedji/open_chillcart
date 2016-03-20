<?php

/* MN */

App::uses('AppController', 'Controller');
App::uses('OrdersController', 'Controller');

class AjaxActionController extends AppController
{

    public $uses = array('User', 'Order', 'Driver', 'Orderstatus');

    public $components = array('Googlemap');

    var $helpers = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');

    public function beforeFilter()
    {
        #$this->Auth->allow(array('*'));
        parent::beforeFilter();
    }

    /**
     * Get values via ajax calls with actions
     */
    public function index()
    {

        if ($this->request->is('post')) {
            $this->set('Action', $this->request->data['Action']);
            switch ($this->request->data['Action']) {

                case 'orderManage' :
                    $status = array('Delivered', 'Pending', 'Failed');

                    if ($this->Auth->User('Store.id') != '') {

                        $orders = $this->Order->find('all', array(
                            'conditions' => array('Order.store_id' => $this->Auth->User('Store.id'),
                                'Order.order_type' => 'Delivery',
                                'NOT' => array('Order.status' => $status)),
                            'fields' => array('Order.status', 'Driver.driver_name'),
                            'order' => array('Order.id' => 'DESC')));

                        $ordersComplete = $this->Order->find('all', array(
                            'conditions' => array('Order.status' => 'Delivered',
                                'Order.order_type' => 'Delivery',),
                            'limit' => 5,
                            'order' => array('Order.id' => 'DESC')));
                    } else {

                        $orders = $this->Order->find('all', array(
                            'conditions' => array('Order.order_type' => 'Delivery',
                                'NOT' => array('Order.status' => $status)),
                            'fields' => array('Order.status', 'Driver.driver_name'),
                            'order' => array('Order.id' => 'DESC')));

                        $ordersComplete = $this->Order->find('all', array(
                            'conditions' => array('Order.status' => 'Delivered',
                                'Order.order_type' => 'Delivery',),
                            'limit' => 5,
                            'order' => array('Order.id' => 'DESC')));
                    }

                    $orders = json_encode($orders);
                    $ordersComplete = json_encode($ordersComplete);
                    echo $orders . '@@@@' . $ordersComplete;
                    exit();

                    break;

                case 'TrackingOrder':
                    $Order = new OrdersController();
                    $track = $Order->orderDetails($this->request->data['OrderId']);

                    if (strtolower($track['0']['Statuses']['status']) == 'new') {
                        $drivers = $this->Driver->find('all', array(
                                'conditions' => array(
                                    'dr_log_in' => '1',
                                    'Drivertracking.order_id' => '0'
                                ),
                                'group' => array(
                                    'Driver.id'
                                )
                            )
                        );
                    }

                    $this->set('orders', $track);
                    if (isset($drivers)) {
                        $this->set(compact('drivers'));
                    }
                    break;


                case 'LoadTrackingMap':
                    //$this->Order->recursive = 1;
                    $track = $this->Order->findById($this->request->data['OrderId']);

                    if (strtolower($track['Order']['status']) == 'accepted') {

                        if ($this->Auth->User('role_id') == 1) {

                            $drivers = $this->Driver->find('all', array(
                                'conditions' => array('Vehicle.vehicle_name !=' => '',
                                    'Driver.driver_status' => 'Available'),
                                'group' => array('Driver.id')));
                        } else {

                            $drivers = $this->Driver->find('all', array(
                                'conditions' => array('Vehicle.vehicle_name !=' => '',
                                    'Driver.driver_status' => 'Available',
                                    'Driver.store_id' => $this->Auth->user('Store.id')),

                                'group' => array('Driver.id')));
                        }


                    }

                    if (strtolower($track['Order']['status']) != 'Accepted'
                        && strtolower($track['Order']['status']) != 'Delivered'
                    ) {

                        $Driver = $this->Driver->findById($track['Driver']['id']);


                        if (strtolower($track['Order']['status']) == 'Driver Accepted') {
                            $sourceLat = $track['DriverTracking']['driver_latitude'];
                            $sourceLong = $track['DriverTracking']['driver_longitude'];
                            $destinationLat = $track['Order']['source_latitude'];
                            $destinationLong = $track['Order']['source_longitude'];
                            $track['distance'] = $this->Googlemap->getDrivingDistance(
                                $sourceLat, $sourceLong,
                                $destinationLat, $destinationLong
                            );
                        } else {
                            $sourceLat = $track['Order']['source_latitude'];
                            $sourceLong = $track['Order']['source_longitude'];
                            $destinationLat = $track['Order']['delivery_latitude'];
                            $destinationLong = $track['Order']['delivery_longitude'];
                            $track['distance'] = $this->Googlemap->getDrivingDistance(
                                $sourceLat, $sourceLong,
                                $destinationLat, $destinationLong
                            );
                        }

                        $this->set(compact('Driver'));
                    }

                    //echo "<pre>"; print_r($track);

                    $this->set('orders', $track);
                    if (isset($drivers)) {
                        $this->set(compact('drivers'));
                    }
                    break;


                case 'OrderStatus':
                    $orderId = $this->request->data('orderId');
                    $orderTrack = array();

                    $status = array('Driver Accepted', 'Collected', 'Delivered');


                    $this->Orderstatus->recursive = 2;
                    $orderTrack = $this->Orderstatus->find('all', array(
                        'conditions' => array(
                            'Orderstatus.order_id' => $orderId,
                            'Orderstatus.status' => $status
                        ),
                        'order' => 'Orderstatus.id ASC',
                        'group' => 'Orderstatus.status'
                    ));

                    //echo "<pre>"; print_r($orderTrack);

                    $this->set(compact('orderTrack'));
                    break;

                case 'InitialTracking':

                    break;
            }
        }
    }
}