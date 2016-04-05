<?php

/* MN */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class StoresController extends AppController
{
    var $helpers = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');
    public $uses = array('Store', 'User', 'State', 'City', 'Location',
        'TimeSlot', 'DeliveryTimeSlot', 'DeliveryLocation',
        'Notification');
    public $components = array('Updown', 'Googlemap', 'Functions', 'CakeS3');


    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->storeState = $this->State->find('list', array(
            'fields' => array('id', 'state_name')));
        $storesCity = $this->storeCity = $this->City->find('list', array(
                                'fields' => array('City.id', 'City.city_name')));

        if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
            $storeArea = $this->storeLocation = $this->Location->find('list', array(
                'fields' => array('id', 'zip_code')));
        } else {
            $storeArea = $this->storeLocation = $this->Location->find('list', array(
                'fields' => array('id', 'area_name')));
        }

        $this->set(compact('storesCity', 'storeArea'));
    }


    /**
     * StoresController::admin_index()
     * Store Management Detail
     * @return void
     */
    public function admin_index()
    {
        $stores = $this->Store->find('all', array(
            'conditions' => array('NOT' => array('Store.status' => 3)),
            'group' => array('Store.id')));
        $this->set(compact('stores'));
    }

    /**
     * StoresController::admin_add()
     * Store Add Detail
     * @return void
     */
    public function admin_add()
    {

        $storeCity      = array();
        $storeLocation  = array();

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Store->set($this->request->data);
            if($this->Store->validates()) {
                $CustomerExist = $this->User->find('first', array(
                                'conditions' => array('User.role_id' => 4,
                                      'User.username' => trim($this->request->data['User']['username']),
                                  'NOT' => array('Customer.status' => 3))));
                $StoreExists = $this->User->find('first', array(
                                'conditions' => array('User.role_id' => 3,
                                            'User.username' => trim($this->request->data['User']['username']),
                                        'NOT' => array('Store.status' => 3))));
                if (!empty($CustomerExist) || !empty($StoreExists)) {

                    $storeCity = $this->City->find('list', array(
                                    'conditions' => array('City.state_id' => $this->request->data['Store']['store_state']),
                                    'fields' => array('City.id', 'City.city_name')));
                    if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
                        $storeLocation = $this->Location->find('list', array(
                                                'conditions' => array(
                                                            'Location.city_id' => $this->request->data['Store']['store_city']),
                                                'fields' => array('id', 'zip_code')));
                    } else {
                        $storeLocation = $this->Location->find('list', array(
                                                'conditions' => array(
                                                            'Location.city_id' => $this->request->data['Store']['store_city']),
                                                'fields' => array('id', 'area_name')));
                    }

                    $this->Session->setFlash('<p>' . __('User Name Already Exists', true) . '</p>', 'default',
                        array('class' => 'alert alert-danger'));
                } else {

                    $storeArrray = $this->request->data;

                    if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {

                        $storeAddress = $storeArrray['Store']['street_address'] . ', ' .
                            $this->storeCity[$storeArrray['Store']['store_city']] . ', ' .
                            $this->storeState[$storeArrray['Store']['store_state']] . ' ' .
                            $this->storeLocation[$storeArrray['Store']['store_zip']] . ', ' .
                            $this->siteSetting['Country']['country_name'];

                    } else {
                        $storeAddress = $storeArrray['Store']['street_address'] . ', ' .
                            $this->storeLocation[$storeArrray['Store']['store_zip']] . ', ' .
                            $this->storeCity[$storeArrray['Store']['store_city']] . ', ' .
                            $this->storeState[$storeArrray['Store']['store_state']] . ', ' .
                            $this->siteSetting['Country']['country_name'];
                    }

                    $latLong = $this->Googlemap->getlatitudeandlongitude($storeAddress);
                    $storeArrray['Store']['latitude']  = (!empty($latLong['lat'])) ? $latLong['lat'] : 0;
                    $storeArrray['Store']['longitude'] = (!empty($latLong['long'])) ? $latLong['long'] : 0;

                    $storeArrray['Store']['seo_url'] =
                        $this->Functions->seoUrl($this->request->data['Store']['store_name']);
                    $storeArrray['User']['role_id'] = 3;
                    $storeArrray['User']['password'] = $this->Auth->password($storeArrray['User']['password']);
                    if ($this->User->save($storeArrray, null, null)) {
                        $storeArrray['Store']['user_id'] = $this->User->id;
                        $destinationPath = WWW_ROOT . 'storelogos';
                        if ($storeArrray['Store']['store_logo']['error'] == 0) {

                            $imagesizedata = getimagesize($this->request->data['Store']['store_logo']['tmp_name']);
                            if ($imagesizedata) {

                                /*$refFile = $this->Updown->uploadFile($storeArrray['Store']['store_logo'],$destinationPath);
                                $storeArrray['Store']['store_logo'] = $refFile['refName'];*/

                                $storelogosPathS3 = 'storelogos/';
                                $newName = str_replace(" ", "-", time() . '.' . $storeArrray['Store']['store_logo']['name']);
                                $result = $this->CakeS3->putObject($storeArrray['Store']['store_logo']['tmp_name'], $storelogosPathS3 . $newName, S3::ACL_PUBLIC_READ);
                                $storeArrray['Store']['store_logo'] = $newName;
                            }

                        } else {
                            $storeArrray['Store']['store_logo'] = '';
                        }
                        $storeArrray['Store']['minimum_order'] = ($storeArrray['Store']['delivery_option'] == 'Yes') ?
                            $storeArrray['Store']['minimum_order'] : 0;
                        $storeArrray['Store']['tax'] = ($storeArrray['Store']['delivery_option'] == 'Yes') ?
                            $storeArrray['Store']['tax'] : 0;

                        if ($this->Store->save($storeArrray, null, null)) {
                            if ($storeArrray['Store']['delivery_option'] == 'Yes') {
                                if (!empty($storeArrray['DeliveryLocation']['location_id'])) {
                                    $locations = $storeArrray['DeliveryLocation']['location_id'];
                                    foreach ($locations as $key => $value) {
                                        if ($value != '') {
                                            $deliveryLocation['store_id'] = $this->Store->id;
                                            $deliveryLocation['location_id'] = $value;
                                            $this->DeliveryLocation->save($deliveryLocation);
                                            $this->DeliveryLocation->id = '';
                                        }
                                    }
                                }
                                $deliveryTimeSlots = $storeArrray['TimeSlot'];
                                foreach ($deliveryTimeSlots as $key => $value) {
                                    if (isset($value['slot_id'])) {
                                        $value['store_id'] = $this->Store->id;
                                        $value['delivery_charge'] = (!empty($value['delivery_charge'])) ?
                                            $value['delivery_charge'] : '0.00';
                                        $this->DeliveryTimeSlot->save($value);
                                        $this->DeliveryTimeSlot->id = '';
                                    }
                                }
                            }

                            $newRegisteration = $this->Notification->find('first', array(
                                    'conditions' => array('Notification.title' => 'Store signup'))
                            );
                            if ($newRegisteration) {
                                $regContent = $newRegisteration['Notification']['content'];
                                $regsubject = $newRegisteration['Notification']['subject'];
                            }
                            $storeEmail = $this->siteSetting['Sitesetting']['admin_email'];
                            $mailContent = $regContent;
                            $userID = $this->User->id;
                            $siteUrl = $this->siteUrl;
                            $activation = $this->siteUrl . '/users/activeLink/' . $userID;
                            $StoreName = $storeArrray['User']['username'];
                            $store_name = "Grocery";

                            $mailContent = str_replace("{sellar name}", $StoreName, $mailContent);
                            $mailContent = str_replace("{CLICK_HERE_TO_LOGIN}", $activation, $mailContent);
                            $mailContent = str_replace("{siteUrl}", $siteUrl, $mailContent);
                            $mailContent = str_replace("{SERVER_NAME}", $store_name, $mailContent);

                            $email = new CakeEmail();
                            $email->from($storeEmail);
                            $email->to($storeArrray['Store']['contact_email']);
                            $email->subject($regsubject);
                            $email->template('register');
                            $email->emailFormat('html');
                            $email->viewVars(array('mailContent' => $mailContent, 'source' => $source));
                            //$email->send();
                            $this->Session->setFlash('<p>' . __('Store has been saved', true) . '</p>', 'default',
                                array('class' => 'alert alert-success'));

                            $this->redirect(array('controller' => 'stores', 'action' => 'index', 'admin' => true));
                        }
                    }
                }
            } else {
                $this->Store->validationErrors;
            }
        }

        $this->set('timeslots', $this->TimeSlot->find('all'));
        //$this->set('invoiceperiod', $this->Store->find('list'));
        $this->set('states', $this->State->find('list', array(
                                    'conditions' => array('State.status' => 1),
                                    'fields' => array('id', 'state_name'))));
        $this->set(compact('storeCity', 'storeLocation'));
    }

    /**
     * StoresController::admin_edit()
     * Store Edit Detail
     * @param mixed $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Store->set($this->request->data);
            if($this->Store->validates()) {
                $store = $this->Store->findById($this->request->data['Store']['id']);
                $storeEmailCheck = $this->User->find('first', array(
                                      'conditions'=>array(
                                      'User.role_id' => 3,
                                      'User.username'=>trim($this->request->data['User']['username']),
                                       'NOT' => array('User.id' => $store['User']['id'],
                                                        'Store.status' => 3))));

                $CustomerExist = $this->User->find('first', array(
                                'conditions' => array(
                                      'User.role_id' => 4,
                                      'User.username' => trim($this->request->data['User']['username']),
                                  'NOT' => array('Customer.status' => 3))));

                if (!empty($storeEmailCheck) || !empty($CustomerExist)) {
                    $this->Session->setFlash('<p>' . __('User Email Already Exists', true) . '</p>', 'default',
                        array('class' => 'alert alert-danger'));
                } else {

                    $storeArrray = $this->request->data;

                    if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {

                        $storeAddress = $storeArrray['Store']['street_address'] . ', ' .
                            $this->storeCity[$storeArrray['Store']['store_city']] . ', ' .
                            $this->storeState[$storeArrray['Store']['store_state']] . ' ' .
                            $this->storeLocation[$storeArrray['Store']['store_zip']] . ', ' .
                            $this->siteSetting['Country']['country_name'];
                    } else {
                        $storeAddress = $storeArrray['Store']['street_address'] . ', ' .
                            $this->storeLocation[$storeArrray['Store']['store_zip']] . ', ' .
                            $this->storeCity[$storeArrray['Store']['store_city']] . ', ' .
                            $this->storeState[$storeArrray['Store']['store_state']] . ', ' .
                            $this->siteSetting['Country']['country_name'];
                    }

                    $latLong = $this->Googlemap->getlatitudeandlongitude($storeAddress);

                    $storeArrray['Store']['latitude']  = (!empty($latLong['lat'])) ? $latLong['lat'] : 0;
                    $storeArrray['Store']['longitude'] = (!empty($latLong['long'])) ? $latLong['long'] : 0;
                    $storeArrray['Store']['seo_url'] = $this->Functions->seoUrl($this->request->data['Store']['store_name']);

                    if ($this->User->save($storeArrray, null, null)) {
                        $destinationPath = WWW_ROOT . 'storelogos';
                        if ($storeArrray['Store']['store_logo']['error'] == 0) {

                            $imagesizedata = getimagesize($this->request->data['Store']['store_logo']['tmp_name']);
                            if ($imagesizedata) {
                                //$refFile = $this->Updown->uploadFile($storeArrray['Store']['store_logo'],$destinationPath);

                                $storelogosPathS3 = 'storelogos/';
                                $newName = str_replace(" ", "-", time() . '.' . $storeArrray['Store']['store_name']);
                                $result = $this->CakeS3->putObject($storeArrray['Store']['store_logo']['tmp_name'], $storelogosPathS3 . $newName, S3::ACL_PUBLIC_READ);
                                $storeArrray['Store']['store_logo'] = $newName;
                            }
                        } else {
                            $storeArrray['Store']['store_logo'] = $storeArrray['Store']['org_logo'];
                        }
                        if ($this->Store->save($storeArrray, null, null)) {
                            $this->DeliveryLocation->deleteAll(array("store_id" => $storeArrray['Store']['id']));
                            if (!empty($storeArrray['DeliveryLocation']['location_id'])) {
                                $locations = $storeArrray['DeliveryLocation']['location_id'];
                                foreach ($locations as $key => $value) {
                                    if ($value != '') {
                                        $deliveryLocation['store_id'] = $storeArrray['Store']['id'];
                                        $deliveryLocation['location_id'] = $value;
                                        $this->DeliveryLocation->save($deliveryLocation);
                                        $this->DeliveryLocation->id = '';
                                    }
                                }
                            }
                            $this->DeliveryTimeSlot->deleteAll(array("store_id" => $storeArrray['Store']['id']));
                            $deliveryTimeSlots = $storeArrray['DeliveryTimeSlot'];
                            foreach ($deliveryTimeSlots as $key => $value) {
                                if (isset($value['slot_id'])) {
                                    $value['store_id'] = $storeArrray['Store']['id'];
                                    $value['delivery_charge'] = (!empty($value['delivery_charge'])) ?
                                        $value['delivery_charge'] : '0.00';
                                    $this->DeliveryTimeSlot->save($value);
                                    $this->DeliveryTimeSlot->id = '';
                                }
                            }
                            $this->Session->setFlash('<p>' . __('Successfully Store has been Updated', true) . '</p>',
                                'default', array('class' => 'alert alert-success'));
                            $this->redirect(array('controller' => 'stores', 'action' => 'index', 'admin' => true));
                        }
                    }
                }
            } else {
                $this->Store->validationErrors;
            }
        }
        $getStoreData = $this->Store->findById($id);
        $this->set('states', $this->State->find('list', array(
            'conditions' => array('State.status' => 1,
                'State.country_id' => $this->siteSetting['Sitesetting']['site_country']),
            'fields' => array('id', 'state_name'))));
        $this->set('cities', $this->City->find('list', array(
            'conditions' => array('City.status' => 1,
                'City.state_id' => $getStoreData['Store']['store_state']),
            'fields' => array('id', 'city_name'))));

        if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
            $this->set('locations', $this->Location->find('list', array(
                'conditions' => array('Location.status' => 1,
                    'Location.city_id' => $getStoreData['Store']['store_city']),
                'fields' => array('id', 'zip_code'))));
        } else {
            $this->set('locations', $this->Location->find('list', array(
                'conditions' => array('Location.status' => 1,
                    'Location.city_id' => $getStoreData['Store']['store_city']),
                'fields' => array('id', 'area_name'))));
        }
        $this->set('timeslots', $this->TimeSlot->find('all'));
        $this->set('selected', $this->DeliveryLocation->find('list', array(
            'conditions' => array('DeliveryLocation.store_id' => $getStoreData['Store']['id']),
            'fields' => array('id', 'location_id')))
        );
        $this->request->data = $getStoreData;
    }

    /**
     * StoresController::admin_locations()
     * Location Find Process
     * @return void
     */
    public function admin_locations()
    {
        $id = $this->request->data['id'];
        $model = $this->request->data['model'];
        switch (trim($model)) {
            case 'State':
                $locations = $this->State->find('list', array(
                    'conditions' => array('State.country_id' => $id,
                        'State.status' => 1),
                    'fields' => array('id', 'state_name')));
                break;
            case 'City':
                $locations = $this->City->find('list', array(
                    'conditions' => array('City.state_id' => $id,
                        'City.status' => 1),
                    'fields' => array('id', 'city_name')));
                break;
            case 'Location':
                if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
                    $locations = $this->Location->find('list', array(
                        'conditions' => array('Location.city_id' => $id,
                            'Location.status' => 1),
                        'fields' => array('id', 'zip_code')));
                } else {
                    $locations = $this->Location->find('list', array(
                        'conditions' => array('Location.city_id' => $id,
                            'Location.status' => 1),
                        'fields' => array('id', 'area_name')));
                }
                break;
        }
        $this->set(compact('model', 'locations'));
    }


    public function locations()
    {
        $id = $this->request->data['id'];
        $model = $this->request->data['model'];
        switch (trim($model)) {
            case 'State':
                $locations = $this->State->find('list', array(
                    'conditions' => array('State.country_id' => $id,
                        'State.status' => 1),
                    'fields' => array('id', 'state_name')));
                break;
            case 'City':
                $locations = $this->City->find('list', array(
                    'conditions' => array('City.state_id' => $id,
                        'City.status' => 1),
                    'fields' => array('id', 'city_name')));
                break;
            case 'Location':
                if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
                    $locations = $this->Location->find('list', array(
                        'conditions' => array('Location.city_id' => $id,
                            'Location.status' => 1),
                        'fields' => array('id', 'zip_code')));
                } else {
                    $locations = $this->Location->find('list', array(
                        'conditions' => array('Location.city_id' => $id,
                            'Location.status' => 1),
                        'fields' => array('id', 'area_name')));
                }
                break;
        }
        $this->set(compact('model', 'locations'));
    }

    public function store_edit()
    {
        $this->layout = 'assets';
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Store->set($this->request->data);
            if($this->Store->validates()) {
                if (!empty($this->request->data) && $this->Auth->User('role_id') == 3) {
                    $storeEmailCheck = $this->User->find('first', array(
                                    'conditions' => array(
                                                'User.role_id'  => 3,
                                                'User.username' => trim($this->request->data['User']['username']),
                                                'NOT' => array('User.id' =>$this->request->data['User']['id'],
                                                                'Store.status' => 3))));
                    $CustomerExist = $this->User->find('first', array(
                                    'conditions' => array('User.role_id' => 4,
                                          'User.username' => trim($this->request->data['User']['username']),
                                      'NOT' => array('Customer.status' => 3))));
                    
                    if (!empty($storeEmailCheck) || !empty($CustomerExist)) {
                        $this->Session->setFlash('<p>' . __('User Name Already Exists', true) . '</p>', 'default',
                            array('class' => 'alert alert-danger'));
                    } else {
                        if ($this->User->save($this->request->data, null, null)) {
                            $destinationPath = WWW_ROOT . 'storelogos';
                            if ($this->request->data['Store']['store_logo']['error'] == 0) {

                                $imagesizedata = getimagesize($this->request->data['Store']['store_logo']['tmp_name']);
                                if ($imagesizedata) {

                                    $storelogosPathS3 = 'storelogos/';
                                    $newName = str_replace(" ", "-", time() . '.' . $storeArrray['Store']['store_name']);
                                    $result = $this->CakeS3->putObject($storeArrray['Store']['store_logo']['tmp_name'], $storelogosPathS3 . $newName, S3::ACL_PUBLIC_READ);
                                    $this->request->data['Store']['store_logo'] = $newName;
                                }

                            } else {
                                $this->request->data['Store']['store_logo'] = $this->request->data['Store']['org_logo'];
                            }
                            $storeArrray['Store']['seo_url'] = $this->Functions->seoUrl($this->request->data['Store']['store_name']);
                            if ($this->Store->save($this->request->data, null, null)) {
                                $this->DeliveryLocation->deleteAll(array("store_id" => $this->request->data['Store']['id']));
                                if (!empty($this->request->data['DeliveryLocation']['location_id'])) {
                                    $locations = $this->request->data['DeliveryLocation']['location_id'];
                                    foreach ($locations as $key => $value) {
                                        if ($value != '') {
                                            $deliveryLocation['store_id'] = $this->request->data['Store']['id'];
                                            $deliveryLocation['location_id'] = $value;
                                            $this->DeliveryLocation->save($deliveryLocation);
                                            $this->DeliveryLocation->id = '';
                                        }
                                    }
                                }
                                $this->DeliveryTimeSlot->deleteAll(array("store_id" => $this->request->data['Store']['id']));
                                $deliveryTimeSlots = $this->request->data['DeliveryTimeSlot'];
                                foreach ($deliveryTimeSlots as $key => $value) {
                                    if (isset($value['slot_id'])) {
                                        $value['store_id'] = $this->request->data['Store']['id'];
                                        $value['delivery_charge'] = (!empty($value['delivery_charge'])) ?
                                            $value['delivery_charge'] : '0.00';
                                        $this->DeliveryTimeSlot->save($value);
                                        $this->DeliveryTimeSlot->id = '';
                                    }
                                }
                                $this->Session->setFlash('<p>' . __('Successfully Store has been Updated', true) . '</p>', 'default',
                                    array('class' => 'alert alert-success'));
                            }
                        }
                    }
                }
            } else {
                $this->Store->validationErrors;
            }
        }
        $getStoreData = $this->Store->findById($this->Auth->User('Store.id'));
        $this->set('states', $this->State->find('list', array(
                            'fields' => array('id', 'state_name'))));
        $this->set('cities', $this->City->find('list', array(
                            'conditions' => array('City.status' => 1,
                                'City.state_id' => $getStoreData['Store']['store_state']),
                            'fields' => array('id', 'city_name'))));

        if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
            $this->set('locations', $this->Location->find('list', array(
                            'conditions' => array('Location.status' => 1,
                                'Location.city_id' => $getStoreData['Store']['store_city']),
                            'fields' => array('id', 'zip_code')))
            );
        } else {
            $this->set('locations', $this->Location->find('list', array(
                            'conditions' => array('Location.status' => 1,
                                'Location.city_id' => $getStoreData['Store']['store_city']),
                            'fields' => array('id', 'area_name'))));
        }
        $this->set('timeslots', $this->TimeSlot->find('all'));
        $this->set('selected', $this->DeliveryLocation->find('list', array(
                            'conditions' => array(
                                'DeliveryLocation.store_id' => $getStoreData['Store']['id']),
                            'fields' => array('id', 'location_id')))
        );
        $this->request->data = $getStoreData;
    }
}