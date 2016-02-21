<?php

/* MN */


App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class MobileApiController extends AppController
{
    public $components = array('AndroidResponse', 'Notification', 'Functions', 'Twilio');
    public $uses = array('User', 'Order', 'Driver', 'DriverTracking', 'Orderstatus', 'MailContent',
        'State', 'City', 'Location');


    public function beforeFilter()
    {

        $this->Auth->allow('request');
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

    public function index()
    {

    }

    /**
     * Request from android
     * @param action
     * @return response->success, response->message
     */
    public function request()
    {
        $this->autoLayout = false;

        if ($this->request->is('post')) {

            /*echo "<pre>"; print_r($this->request->data);
            exit();*/

            if (empty($this->request->data)) {
                $data = $this->request->input('json_decode', true);
                $this->request->data = $data;
            }
            switch (trim($this->request->data['action'])) {

                case 'DriverLogin':

                    $this->request->data['User']['username'] = $this->request->data['username'];
                    $this->request->data['User']['password'] = $this->request->data['password'];

                    $this->request->data['User']['password'] = AuthComponent::password($this->data['User']['password']);

                    $driver = $this->User->find('first', array(
                        'conditions' => array(
                            'User.username' => $this->request->data['User']['username'],
                            'User.password' => $this->request->data['User']['password'])));


                    if (!empty($driver)) {

                        $getDriver = $this->Driver->findByParentId($driver['User']['id']);

                        if ($getDriver['Driver']['is_logged'] == 1) {
                            $response['success'] = 0;
                            $response['message'] = 'Driver Already Loggedin';
                            break;
                        }
                        if ($getDriver['Driver']['status'] != 'Active') {
                            $response['success'] = 0;
                            $response['message'] = 'Your account deactivated';
                            break;
                        }
                        if ($getDriver['Vehicle']['id'] == '') {
                            $response['success'] = 0;
                            $response['message'] = 'Vehicle not registered';
                            break;
                        }
                        $getDriver['Driver']['id'] = $getDriver['Driver']['id'];
                        $getDriver['Driver']['device_id'] = $this->request->data['device_id'];
                        $getDriver['Driver']['is_logged'] = 1;
                        $getDriver['Driver']['device_name'] = strtoupper($this->request->data['device_name']);
                        $getDriver['Driver']['driver_status'] = 'Available';

                        $drive = $this->Driver->save($getDriver);

                        if ($drive['User']['role_id'] == '5' && $drive['Driver']['is_logged'] == 1) {

                            $response['success'] = '1';
                            $response['driverid'] = $getDriver['Driver']['id'];
                            $response['driverName'] = $getDriver['Driver']['driver_name'];
                            $response['currency'] = $this->siteSetting['Country']['currency_symbol'];

                            $driverImage = (!empty($driver['Driver']['image']))
                                ? $this->siteUrl . '/driversImage/' . $driver['Driver']['image']
                                : $this->siteUrl . '/driversImage/no-photo.png';

                            $response['driverImage'] = $driverImage;
                            $response['driverStatus'] = 'Available';
                            $response['message'] = 'login successfully';

                            $message = 'Driver : ' . $getDriver['Driver']['driver_name'] . " loggedin";
                            //$this->Notification->pushNotification($message);

                            break;
                        } else {
                            $response['success'] = '0';
                            $response['message'] = 'Invalid username and password';
                            break;
                        }

                    } else {
                        $response['success'] = '0';
                        $response['message'] = 'Incorrect username and password';
                        break;
                    }
                    break;

                case 'DriverImageUpload':

                    $driver = $this->Driver->findById($this->request->data('driverid'));
                    if (!empty($this->request->data['image'])) {
                        // Get image string posted from Android App
                        $base = $this->request->data['image'];

                        // Get file name posted from Android App
                        $fileId = $driver['Driver']['id'] . time() . '.png';
                        $filename = APP . 'webroot/driversImage/' . $fileId;
                        // Decode Image
                        $binary = base64_decode($base);
                        header('Content-Type: bitmap; charset=utf-8');

                        $file = fopen($filename, 'wb+');
                        // Create File
                        fwrite($file, $binary);
                        fclose($file);
                        #Save Driver Image

                        $driverImage['Driver']['id'] = $driver['Driver']['id'];
                        $driverImage['Driver']['image'] = $fileId;
                        $this->Driver->save($driverImage);

                        $response['success'] = 1;
                        $response['message'] = 'Image uploaded successfully!';
                        $response['driverImage'] = $this->siteUrl . '/driversImage/' . $fileId;
                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'Image not upload!';
                    }
                    break;

                case 'DriverDetails':

                    $driverId = $this->request->data['driverid'];
                    $driver = $this->Driver->findById($driverId);

                    if (is_array($driver) && $driver['User']['role_id'] == 5) {

                        $driverImage = (!empty($driver['Driver']['image']))
                            ? $this->siteUrl . '/driversImage/' . $driver['Driver']['image']
                            : $this->siteUrl . '/driversImage/no-photo.png';

                        $response['success'] = 1;
                        $response['DriverName'] = $driver['Driver']['driver_name'];
                        $response['DriverMail'] = $driver['Driver']['driver_email'];
                        $response['DriverMobile'] = $driver['Driver']['driver_phone'];
                        $response['driverImage'] = $driverImage;

                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'Unknown driver';
                    }
                    break;

                case 'DriverUpdate':
                    $driver['Driver']['id'] = $this->request->data['driverid'];
                    $driver['Driver']['driver_name'] = $this->request->data['driverName'];
                    $driver['Driver']['driver_email'] = $this->request->data['driverMail'];
                    $driver['Driver']['driver_phone'] = $this->request->data['driverMobile'];

                    if ($driver['Driver']['id'] != '') {
                        if ($this->Driver->save($driver)) {

                            $response['success'] = 1;
                            $response['message'] = 'Updated successfully!';
                        } else {
                            $response['success'] = 0;
                            $response['message'] = 'Details not updated!';
                        }
                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'Unknown driver!';
                    }
                    break;

                case 'DriverLocation':

                    $latitude = $this->request->data('latitude');
                    $longitude = $this->request->data('longitude');

                    $driverId = $this->request->data['driverid'];

                    if ($this->request->data['driverid']) {

                        $driverTrack = $this->DriverTracking->findByDriverId($driverId);

                        $tracking['id'] = ($driverTrack['DriverTracking']['id'] != '') ? $driverTrack['DriverTracking']['id'] : '';
                        $tracking['driver_id'] = $driverId;
                        $tracking['driver_latitude'] = $latitude;
                        $tracking['driver_longitude'] = $longitude;

                        $trackResult = $this->DriverTracking->save($tracking);

                        $response['success'] = ($trackResult['DriverTracking']['id'] != '') ? 1 : 0;
                    } else {
                        $response['success'] = 0;
                    }

                    break;

                case 'DriverStatus':

                    $driverId = $this->request->data('driverid');
                    $status = $this->request->data('status');
                    $driver = $this->Driver->findById($driverId);

                    if (!empty($driver)) {

                        $driver['Driver']['driver_status'] = $status;

                        $this->Driver->save($driver);

                        $response['success'] = 1;
                        $response['message'] = 'Status changed';

                        $message = $driver['Driver']['driver_name'] . " in " . $status;
                        //$this->Notification->pushNotification($message);

                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'Status is not change';
                    }
                    break;

                case 'OrderStatus':

                    $driverId = $this->request->data('driverid');
                    $orderId = $this->request->data('orderid');
                    $status = (strtolower(trim($this->request->data('status'))) == 'reject')
                        ? 'Accepted' : $this->request->data('status');
                    $latitude = $this->request->data('latitude');
                    $longitude = $this->request->data('longitude');

                    if ($driverId == '' || $orderId == '' || $status == '') {
                        $response['success'] = 0;
                        $response['message'] = 'Missing arugument';
                    }

                    $ordStatus = $this->Order->findById($orderId);

                    $orders['Orderstatus']['id'] = '';
                    $orders['Orderstatus']['order_id'] = $orderId;
                    $orders['Orderstatus']['driver_id'] = $driverId;
                    $orders['Orderstatus']['driver_latitude'] = $latitude;
                    $orders['Orderstatus']['driver_longitude'] = $longitude;
                    $orders['Orderstatus']['status'] = $status;

                    if ($status != 'Accepted') {
                        $this->Orderstatus->save($orders);
                    } else {
                        $this->Orderstatus->deleteAll(array('Orderstatus.order_id' => $orderId));
                    }


                    $track = $this->DriverTracking->findByDriverId($driverId);

                    if (!empty($track)) {
                        $track['DriverTracking']['order_id'] = ($status != 'Delivered') ? $orderId : '';
                        $this->DriverTracking->save($track);
                    }
                    if (!empty($ordStatus)) {
                        $ordStatus['Order']['driver_id'] = ($status == 'Accepted') ? '' : $driverId;
                        $ordStatus['Order']['status'] = $status;
                        $ordStatus['Order']['payment_status'] = (strtolower($status) == 'delivered')
                            ? 'Paid' : $ordStatus['Order']['payment_status'];
                        //Driver's Offer Price
                        if (!empty($this->request->data['driverOffer'])) {
                            $ordStatus['Order']['driver_offer'] = $this->request->data['driverOffer'];
                        }


                        /*if ($status == 'On the way' || $status == 'Delivered') {

                            //SMS Send Process
                            /*if ($this->siteSetting['Setting']['isSms'] == 1) {

                                $receiver  = '+91'.$ordStatus['Order']['customer_phone'];
                                $message   = "Dear ".$ordStatus['Order']['customer_name'].", your Order ".$ordStatus['Order']['custom_order_id']."  has been ".$status.".";
                                $this->Functions->sendSms($receiver, $message);
                            }*/

                        //Email Send Process
                        /*if ($this->siteSetting['Setting']['isEmail'] == 1) {

                            /*if ($status == 'On the way') {
                                $trackContent   = 'http://dispatchsystem.net/trackings/index.php?r='
                                                .base64_encode($ordStatus['Order']['custom_order_id']);
                                $trackSubject   = 'Track your order('.$ordStatus['Order']['custom_order_id'].')';
                                $adminMail      = $this->siteSetting['Setting']['siteemail'];
                                $customerMail   = $ordStatus['Order']['customer_email'];

                                $email = new CakeEmail();
                                $email->from($adminMail);
                                $email->to($customerMail);
                                $email->subject($trackSubject);
                                $email->emailFormat('html');
                                $email->viewVars(array('mailContent' => $trackContent));
                                $email->send();
                            }

                            $orderMail = $this->MailContent->find('first',
                                        array('conditions'=>array(
                                                'MailContent.title =' => 'Order Status')));

                            $orderContent = $orderMail['MailContent']['content'];
                            $orderSubject = $orderMail['MailContent']['subject'];

                            $storemailId    = $this->siteSetting['Setting']['siteemail'];
                            $driverEmailId  = $ordStatus['Order']['customer_email'];
                            $source = $this->siteUrl.'images/logo/logo.png';

                            $driverName = $this->request->data['User']['firstname']. " ". $this->request->data['User']['name'];

                            #Generate email mime_content_type(filename)
                            $mailContent = $orderContent;
                            $siteUrl = $this->siteUrl;

                            $mailContent = str_replace("{customerName}", $ordStatus['Order']['customer_name'], $mailContent);
                            $mailContent = str_replace("{orderId}", $ordStatus['Order']['custom_order_id'], $mailContent);
                            $mailContent = str_replace("{status}", $status, $mailContent);

                            $email = new CakeEmail();
                            $email->from($storemailId);
                            $email->to($driverEmailId);
                            $email->subject($orderSubject);
                            $email->template('logincredential');
                            $email->emailFormat('html');
                            $email->viewVars(array('mailContent' => $mailContent,
                                                    'source'=>$source,
                                                    'siteUrl' => $this->siteUrl));
                            $email->send();
                        }
                    }*/

                        if (!empty($this->request->data['image']) && $status == 'Delivered') {
                            // Get image string posted from Android App
                            $base = $this->request->data['image'];
                            //chmod(APP.'webroot/OrderProof/', 777);
                            // Get file name posted from Android App
                            $fileId = 'Order_signature' . $orderId . '.png';
                            $filename = APP . 'webroot/OrderProof/' . $fileId;
                            // Decode Image
                            $binary = base64_decode($base);
                            header('Content-Type: bitmap; charset=utf-8');

                            $file = fopen($filename, 'wb+');
                            // Create File
                            fwrite($file, $binary);
                            fclose($file);

                            $ordStatus['Order']['payment_method'] = 'paid';
                        }

                        $this->Order->save($ordStatus);


                        $customerMessage = "Dear " . $ordStatus['Customer']['first_name'] . ",Your order has been " . $status . ' by driver, Order id : ' . $ordStatus['Order']['ref_number'];

                        $toCustomerNumber = '+' . $this->siteSetting['Country']['phone_code'] . $ordStatus['Customer']['customer_phone'];

                        //$customerSms = $this->Twilio->sendSingleSms($toCustomerNumber, $customerMessage);


                        $response['success'] = 1;
                        $response['message'] = 'Order Status Change Successfully';

                        $driverDetail = $this->Driver->findById($driverId);

                        //Push Notification
                        $message = ($status == 'Accepted') ? $ordStatus['Order']['ref_number'] . ' - Order is not picked up by ' . $driverDetail['User']['firstname'] . ' ' . $driverDetail['User']['name'] : $ordStatus['Order']['custom_order_id'] . " - Order status changed to " . $status;
                        //$this->Notification->pushNotification($message);
                        //Send Order Status To Native Site
                        if (!empty($this->siteSetting['Setting']['url'])) {
                            $orderMessage = array(
                                'action' => 'OrderStatus',
                                'status' => $status,
                                'orderId' => $ordStatus['Order']['ref_number'],
                                'driverName' => $driverDetail['Driver']['driver_name']
                            );

                            $this->AndroidResponse->sendResponseToNativeSite(
                                $this->siteSetting['Setting']['url'],
                                $orderMessage);
                        }

                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'Order Status Change Failed';

                    }
                    break;

                case 'CompletedOrders':

                    $status = 'Delivered';

                    $driverId = $this->request->data('driverid');
                    $date = $this->request->data('date');
                    $deliverDate = date('Y-m-d', strtotime($this->request->data('date')));

                    $orderCondition = array(
                        'conditions' => array(
                            'Order.driver_id' => $driverId,
                            'Order.status' => $status),
                        'order' => array('Order.id' => 'DESC'));

                    if ($deliverDate != '1970-01-01') {
                        $orderCondition['conditions']['Order.updated LIKE'] = $deliverDate . '%';
                    }

                    $order = $this->Order->find('all', $orderCondition);

                    if (!empty($order)) {
                        $orderDetails = array();
                        foreach ($order as $key => $value) {

                            if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {

                                $storeAddress = $value['Store']['street_address'] . ', ' .
                                    $this->storeCity[$value['Store']['store_city']] . ', ' .
                                    $this->storeState[$value['Store']['store_state']] . ' ' .
                                    $this->storeLocation[$value['Store']['store_zip']] . ', ' .
                                    $this->siteSetting['Country']['country_name'];


                            } else {
                                $storeAddress = $value['Store']['street_address'] . ', ' .
                                    $this->storeLocation[$value['Store']['store_zip']] . ', ' .
                                    $this->storeCity[$value['Store']['store_city']] . ', ' .
                                    $this->storeState[$value['Store']['store_state']] . ', ' .
                                    $this->siteSetting['Country']['country_name'];
                            }


                            $orderDetails[$key]['StoreName'] = stripslashes($value['Store']['store_name']);
                            $orderDetails[$key]['SourceAddress'] = $storeAddress;
                            $orderDetails[$key]['SourceLatitude'] = $value['Order']['source_latitude'];
                            $orderDetails[$key]['SourceLongitude'] = $value['Order']['source_longitude'];
                            $orderDetails[$key]['DestinationAddress'] = $value['Order']['address'] . ', ' .
                                $value['Order']['location_name'] . ', ' .
                                $value['Order']['city_name'] . ', ' .
                                $value['Order']['state_name'];

                            $orderDetails[$key]['LandMark'] = $value['Order']['landmark'];
                            $orderDetails[$key]['DestinationLatitude'] = $value['Order']['destination_latitude'];
                            $orderDetails[$key]['DestinationLongitude'] = $value['Order']['destination_longitude'];
                            $orderDetails[$key]['OrderDate'] = $value['Order']['delivery_date'];
                            $orderDetails[$key]['OrderTime'] = $value['Order']['delivery_time_slot'];
                            $orderDetails[$key]['OrderPrice'] = $value['Order']['order_grand_total'];
                            $orderDetails[$key]['OrderId'] = $value['Order']['id'];
                            $orderDetails[$key]['OrderGenerateId'] = $value['Order']['ref_number'];
                            $orderDetails[$key]['OrderStatus'] = $value['Order']['status'];
                            $orderDetails[$key]['CustomerName'] = $value['Order']['customer_name'];
                            $orderDetails[$key]['PaymentType'] = $value['Order']['payment_type'];


                            /* $orderDetails[$key]['RestaurantName']         = stripslashes($value['Restaurant']['restaurant_name']);
                             $orderDetails[$key]['CustomerName']           = stripslashes($value['Order']['customer_name']);
                             $orderDetails[$key]['SourceAddress']          = stripslashes($value['Restaurant']['restaurant_address']);
                             $orderDetails[$key]['SourceLatitude']         = $value['Restaurant']['latitude'];
                             $orderDetails[$key]['SourceLongitude']        = $value['Restaurant']['longitude'];
                             $orderDetails[$key]['DestinationAddress']     = stripslashes($value['Order']['delivery_address']);
                             $orderDetails[$key]['DestinationLatitude']    = $value['Order']['delivery_latitude'];
                             $orderDetails[$key]['DestinationLongitude']   = $value['Order']['delivery_longitude'];
                             $orderDetails[$key]['OrderDate']              = $value['Order']['order_date'];
                             $orderDetails[$key]['OrderTime']              = $value['Order']['order_time'];
                             $orderDetails[$key]['OrderPrice']             = $value['Order']['total'];
                             $orderDetails[$key]['OrderId']                = $value['Order']['id'];
                             $orderDetails[$key]['OrderGenerateId']        = $value['Order']['custom_order_id'];
                             $orderDetails[$key]['PaymentType']            = ($value['Order']['payment_type'] == null) ? '' : $value['Order']['payment_type'];
                             $orderDetails[$key]['OrderStatus']            = $value['Statuses']['status'];*/

                        }

                        $response['success'] = 1;
                        $response['orders'] = $orderDetails;
                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'No record(s) found';
                    }
                    break;

                case 'DriverAcceptedOrders':

                    $status = array('Delivered', 'Waiting');

                    $driverId = $this->request->data('driverid');
                    $order = $this->Order->find('all', array(
                        'conditions' => array('Order.driver_id' => $driverId,
                            'Not' => array('Order.status' => $status)),
                        'Sort' => array('Order.id DESC'),));

                    if (!empty($order)) {
                        $orderDetails = array();
                        foreach ($order as $key => $value) {


                            if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {

                                $storeAddress = $value['Store']['street_address'] . ', ' .
                                    $this->storeCity[$value['Store']['store_city']] . ', ' .
                                    $this->storeState[$value['Store']['store_state']] . ' ' .
                                    $this->storeLocation[$value['Store']['store_zip']] . ', ' .
                                    $this->siteSetting['Country']['country_name'];


                            } else {
                                $storeAddress = $value['Store']['street_address'] . ', ' .
                                    $this->storeLocation[$value['Store']['store_zip']] . ', ' .
                                    $this->storeCity[$value['Store']['store_city']] . ', ' .
                                    $this->storeState[$value['Store']['store_state']] . ', ' .
                                    $this->siteSetting['Country']['country_name'];
                            }


                            $orderDetails[$key]['StoreName'] = stripslashes($value['Store']['store_name']);
                            $orderDetails[$key]['SourceAddress'] = $storeAddress;
                            $orderDetails[$key]['SourceLatitude'] = $value['Order']['source_latitude'];
                            $orderDetails[$key]['SourceLongitude'] = $value['Order']['source_longitude'];
                            $orderDetails[$key]['DestinationAddress'] = $value['Order']['address'] . ', ' .
                                $value['Order']['location_name'] . ', ' .
                                $value['Order']['city_name'] . ', ' .
                                $value['Order']['state_name'];

                            $orderDetails[$key]['LandMark'] = $value['Order']['landmark'];
                            $orderDetails[$key]['DestinationLatitude'] = $value['Order']['destination_latitude'];
                            $orderDetails[$key]['DestinationLongitude'] = $value['Order']['destination_longitude'];
                            $orderDetails[$key]['OrderDate'] = $value['Order']['delivery_date'];
                            $orderDetails[$key]['OrderTime'] = $value['Order']['delivery_time_slot'];
                            $orderDetails[$key]['OrderPrice'] = $value['Order']['order_grand_total'];
                            $orderDetails[$key]['OrderId'] = $value['Order']['id'];
                            $orderDetails[$key]['OrderGenerateId'] = $value['Order']['ref_number'];
                            $orderDetails[$key]['OrderStatus'] = $value['Order']['status'];
                            $orderDetails[$key]['CustomerName'] = $value['Order']['customer_name'];
                            $orderDetails[$key]['PaymentType'] = $value['Order']['payment_type'];


                            /*$orderDetails[$key]['RestaurantName']         = stripslashes($value['Restaurant']['restaurant_name']);
                            $orderDetails[$key]['SourceAddress']          = stripslashes($value['Restaurant']['restaurant_address']);
                            $orderDetails[$key]['SourceLatitude']         = $value['Restaurant']['latitude'];
                            $orderDetails[$key]['SourceLongitude']        = $value['Restaurant']['longitude'];
                            $orderDetails[$key]['DestinationAddress']     = stripslashes($value['Order']['delivery_address']);
                            $orderDetails[$key]['DestinationLatitude']    = $value['Order']['delivery_latitude'];
                            $orderDetails[$key]['DestinationLongitude']   = $value['Order']['delivery_longitude'];
                            $orderDetails[$key]['OrderDate']              = $value['Order']['order_date'];
                            $orderDetails[$key]['OrderTime']              = $value['Order']['order_time'];
                            $orderDetails[$key]['OrderPrice']             = $value['Order']['total'];
                            $orderDetails[$key]['OrderId']                = $value['Order']['id'];
                            $orderDetails[$key]['OrderGenerateId']        = $value['Order']['custom_order_id'];
                            $orderDetails[$key]['OrderStatus']            = $value['Statuses']['status'];*/
                        }
                        $response['success'] = 1;
                        $response['orders'] = $orderDetails;
                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'No record(s) found';
                    }
                    break;

                case 'WaitingOrderCount':
                    $status = 'Waiting';

                    $driverId = $this->request->data('driverid');
                    if ($driverId != '') {
                        $count = $this->Order->find('count', array(
                            'conditions' => array(
                                'Order.driver_id' => $driverId,
                                'Order.status' => $status)));
                        $response['success'] = ($count > 0) ? 1 : 0;
                        $response['waitingCount'] = $count;
                        if ($count == 0)
                            $response['message'] = 'No record(s) found';
                        break;
                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'Invalid driver';
                    }
                    break;

                case 'WaitingOrders':

                    $status = 'Waiting';

                    $driverId = $this->request->data('driverid');
                    $order = $this->Order->find('all', array(
                        'conditions' => array(
                            'Order.driver_id' => $driverId,
                            'Order.status' => $status)));

                    if (!empty($order)) {
                        $orderDetails = array();
                        foreach ($order as $key => $value) {

                            $datetime1 = new DateTime(date('Y-m-d G:i:s'));
                            $datetime2 = new DateTime($value['Order']['updated']);
                            $interval = $datetime1->diff($datetime2);
                            $hour = $interval->format('%H');
                            $min = $interval->format('%I');
                            $sec = $interval->format('%S');
                            $day = $interval->format('%D');

                            if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {

                                $storeAddress = $value['Store']['street_address'] . ', ' .
                                    $this->storeCity[$value['Store']['store_city']] . ', ' .
                                    $this->storeState[$value['Store']['store_state']] . ' ' .
                                    $this->storeLocation[$value['Store']['store_zip']] . ', ' .
                                    $this->siteSetting['Country']['country_name'];


                            } else {
                                $storeAddress = $value['Store']['street_address'] . ', ' .
                                    $this->storeLocation[$value['Store']['store_zip']] . ', ' .
                                    $this->storeCity[$value['Store']['store_city']] . ', ' .
                                    $this->storeState[$value['Store']['store_state']] . ', ' .
                                    $this->siteSetting['Country']['country_name'];
                            }


                            $orderDetails[$key]['StoreName'] = stripslashes($value['Store']['store_name']);
                            $orderDetails[$key]['SourceAddress'] = $storeAddress;
                            $orderDetails[$key]['SourceLatitude'] = $value['Order']['source_latitude'];
                            $orderDetails[$key]['SourceLongitude'] = $value['Order']['source_longitude'];
                            $orderDetails[$key]['DestinationAddress'] = $value['Order']['address'] . ', ' .
                                $value['Order']['location_name'] . ', ' .
                                $value['Order']['city_name'] . ', ' .
                                $value['Order']['state_name'];
                            $orderDetails[$key]['LandMark'] = $value['Order']['landmark'];
                            $orderDetails[$key]['DestinationLatitude'] = $value['Order']['destination_latitude'];
                            $orderDetails[$key]['DestinationLongitude'] = $value['Order']['destination_longitude'];
                            $orderDetails[$key]['OrderDate'] = $value['Order']['delivery_date'];
                            $orderDetails[$key]['OrderTime'] = $value['Order']['delivery_time_slot'];
                            $orderDetails[$key]['OrderPrice'] = $value['Order']['order_grand_total'];
                            $orderDetails[$key]['OrderId'] = $value['Order']['id'];
                            $orderDetails[$key]['OrderGenerateId'] = $value['Order']['ref_number'];
                            $orderDetails[$key]['OrderStatus'] = $value['Order']['status'];
                            $orderDetails[$key]['CustomerName'] = $value['Order']['customer_name'];
                            $orderDetails[$key]['PaymentType'] = $value['Order']['payment_type'];

                            $orderDetails[$key]['Day'] = $day;
                            $orderDetails[$key]['Hour'] = $hour;
                            $orderDetails[$key]['Min'] = $min;
                            $orderDetails[$key]['Sec'] = $sec;


                            /*$datetime1 = new DateTime(date('Y-m-d G:i:s'));
                            $datetime2 = new DateTime($value['Order']['updated']);
                            $interval  = $datetime1->diff($datetime2);
                            $hour      = $interval->format('%H');
                            $min       = $interval->format('%I');
                            $sec       = $interval->format('%S');
                            $day       = $interval->format('%D');
                            
                            $orderDetails[$key]['StoreName']            = stripslashes($value['Restaurant']['restaurant_name']);
                            $orderDetails[$key]['CustomerName']           = stripslashes($value['Order']['customer_name']);
                            $orderDetails[$key]['SourceAddress']          = stripslashes($value['Restaurant']['restaurant_address']);
                            $orderDetails[$key]['SourceLatitude']         = $value['Restaurant']['latitude'];
                            $orderDetails[$key]['SourceLongitude']        = $value['Restaurant']['longitude'];
                            $orderDetails[$key]['DestinationAddress']     = stripslashes($value['Order']['delivery_address']);
                            $orderDetails[$key]['DestinationLatitude']    = $value['Order']['delivery_latitude'];
                            $orderDetails[$key]['DestinationLongitude']   = $value['Order']['delivery_longitude'];
                            $orderDetails[$key]['OrderDate']              = $value['Order']['order_date'];
                            $orderDetails[$key]['OrderTime']              = $value['Order']['order_time'];
                            $orderDetails[$key]['OrderPrice']             = $value['Order']['total'];
                            $orderDetails[$key]['OrderId']                = $value['Order']['id'];
                            $orderDetails[$key]['OrderGenerateId']        = $value['Order']['custom_order_id'];
                            $orderDetails[$key]['PaymentType']            = ($value['Order']['payment_type'] == null) ? '' : $value['Order']['payment_type'];
                            $orderDetails[$key]['OrderStatus']            = $value['Statuses']['status'];
                            $orderDetails[$key]['Day']                    = $day;
                            $orderDetails[$key]['Hour']                   = $hour;
                            $orderDetails[$key]['Min']                    = $min;
                            $orderDetails[$key]['Sec']                    = $sec;*/
                        }
                        $response['success'] = 1;
                        $response['orders'] = $orderDetails;
                    } else {
                        $response['success'] = 0;
                        $response['message'] = 'No record(s) found';
                    }
                    break;

                case 'OrderDetail':
                    $orderId = $this->request->data['orderid'];
                    if ($orderId != '') {
                        $orderDetails = $this->Order->findById($orderId);
                        $orderDet['success'] = '1';

                        if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
                            $storeAddress = $orderDetails['Store']['street_address'] . ', ' .
                                $this->storeCity[$orderDetails['Store']['store_city']] . ', ' .
                                $this->storeState[$orderDetails['Store']['store_state']] . ' ' .
                                $this->storeLocation[$orderDetails['Store']['store_zip']] . ', ' .
                                $this->siteSetting['Country']['country_name'];

                        } else {
                            $storeAddress = $orderDetails['Store']['street_address'] . ', ' .
                                $this->storeLocation[$orderDetails['Store']['store_zip']] . ', ' .
                                $this->storeCity[$orderDetails['Store']['store_city']] . ', ' .
                                $this->storeState[$orderDetails['Store']['store_state']] . ', ' .
                                $this->siteSetting['Country']['country_name'];
                        }


                        $orderDet['orderId'] = $orderDetails['Order']['ref_number'];
                        $orderDet['customerName'] = stripslashes($orderDetails['Order']['customer_name']);
                        $orderDet['customerAddress'] = $orderDetails['Order']['address'] . ', ' .
                            $orderDetails['Order']['location_name'] . ', ' .
                            $orderDetails['Order']['city_name'] . ', ' .
                            $orderDetails['Order']['state_name'];
                        $orderDet['customerEmail'] = $orderDetails['Order']['customer_email'];
                        $orderDet['customerPhone'] = $orderDetails['Order']['customer_phone'];
                        $orderDet['StoreName'] = stripslashes($orderDetails['Store']['store_name']);
                        $orderDet['SourceAddress'] = $storeAddress;
                        $orderDet['SourceLatitude'] = $orderDetails['Order']['source_latitude'];
                        $orderDet['SourceLongitude'] = $orderDetails['Order']['source_longitude'];
                        $orderDet['LandMark'] = $orderDetails['Order']['landmark'];
                        $orderDet['DestinationLatitude'] = $orderDetails['Order']['destination_latitude'];
                        $orderDet['DestinationLongitude'] = $orderDetails['Order']['destination_longitude'];
                        $orderDet['OrderDate'] = $orderDetails['Order']['delivery_date'];
                        $orderDet['OrderTime'] = $orderDetails['Order']['delivery_time_slot'];
                        $orderDet['OrderPrice'] = $orderDetails['Order']['order_grand_total'];
                        $orderDet['OrderId'] = $orderDetails['Order']['id'];
                        $orderDet['OrderGenerateId'] = $orderDetails['Order']['ref_number'];
                        $orderDet['CustomerName'] = $orderDetails['Order']['customer_name'];
                        $orderDet['PaymentType'] = $orderDetails['Order']['payment_type'];
                        $orderDet['offer'] = $orderDetails['Order']['offer_amount'];
                        $orderDet['tax'] = $orderDetails['Order']['tax_amount'];
                        $orderDet['deliveryCharge'] = $orderDetails['Order']['delivery_charge'];
                        $orderDet['subTotal'] = $orderDetails['Order']['order_sub_total'];
                        $orderDet['total'] = $orderDetails['Order']['order_grand_total'];
                        $orderDet['status'] = $orderDetails['Order']['status'];

                        $orderDet['orderMenu'] = stripslashes_deep($orderDetails['ShoppingCart']);


                        /*$orderDet['orderId']            = $orderDetails['Order']['custom_order_id'];
                        $orderDet['customerName']       = stripslashes($orderDetails['Order']['customer_name']);
                        $orderDet['customerAddress']    = stripslashes($orderDetails['Order']['delivery_address']);
                        $orderDet['customerEmail']      = $orderDetails['Order']['customer_email'];
                        $orderDet['customerPhone']      = $orderDetails['Order']['customer_phone'];
                        $orderDet['restaurantName']     = stripslashes($orderDetails['Restaurant']['restaurant_name']);
                        $orderDet['restaurantAddress']  = stripslashes($orderDetails['Restaurant']['restaurant_address']);
                        $orderDet['offer']              = $orderDetails['Order']['offer'];
                        $orderDet['tax']                = $orderDetails['Order']['tax'];
                        $orderDet['deliveryCharge']     = $orderDetails['Order']['delivery_charge'];
                        $orderDet['subTotal']           = $orderDetails['Order']['subtotal'];
                        $orderDet['total']              = $orderDetails['Order']['total'];
                        $orderDet['paymentType']        = $orderDetails['Order']['payment_type'];
                        $orderDet['deliveryDate']       = $orderDetails['Order']['order_date'];
                        $orderDet['deliveryTime']       = $orderDetails['Order']['order_time'];
                        $orderDet['orderDate']          = $orderDetails['Order']['created'];
                        $orderDet['status']             = $orderDetails['Statuses']['status'];
                        $orderDet['Description']        = stripslashes($orderDetails['Order']['description']);
                        $orderDet['orderMenu']          = stripslashes_deep($orderDetails['OrderItem']);*/

                        $response = $orderDet;
                    } else {
                        $response['success'] = '0';
                        $response['message'] = 'There is no order(s)!';
                    }
                    break;

                case 'OrderDisclaim':

                    $orderId = $this->request->data['orderid'];
                    $driverId = $this->request->data['driverid'];
                    /*$latitude   = $this->request->data('latitude');
                    $longitude  = $this->request->data('longitude');*/

                    $order['id'] = $orderId;
                    $order['driver_id'] = 0;
                    $order['status'] = 'Accepted';

                    $this->Order->save($order);

                    $orderStatus['Orderstatus']['id'] = '';
                    $orderStatus['Orderstatus']['order_id'] = $orderId;
                    $orderStatus['Orderstatus']['driver_id'] = $driverId;
                    /*$orderStatus['Orderstatus']['driver_latitude']   = $latitude;
                    $orderStatus['Orderstatus']['driver_longitude']  = $longitude;*/
                    $orderStatus['Orderstatus']['status'] = 'Accepted';

                    $this->Orderstatus->save($orderStatus);

                    $response['success'] = '1';

                    break;

                case 'DriverLogOut':

                    $driverId = $this->request->data['driverid'];
                    $message = array('message' => 'logout', 'OrderDetails' => '');
                    if ($driverId != '') {
                        $driver = $this->Driver->findById($driverId);
                        $gcm = ($this->request->data['from'] == 'site')
                            ? $this->AndroidResponse->sendOrderByGCM($message, $driver['Driver']['device_id']) : '';
                        $driver['Driver']['is_logged'] = '0';
                        $driver['Driver']['driver_status'] = 'Offline';
                        $this->DriverTracking->deleteAll(array('DriverTracking.driver_id' => $driver['Driver']['id']));
                        $driverLogout = $this->Driver->save($driver);

                        $response['success'] = '1';
                        $response['message'] = 'Successfully logout ';

                        $message = $driver['Driver']['driver_name'] . " loggedout";
                        //$this->Notification->pushNotification($message);
                    } else {
                        $response['success'] = '0';
                        $response['message'] = 'Try Again..!';
                    }
                    break;

            }
        } else {
            $response['success'] = '0';
            $response['message'] = 'Invalid request';
        }
        die(json_encode($response));
    }
}
