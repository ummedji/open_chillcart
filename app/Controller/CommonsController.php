<?php

/* Janakiraman */

App::uses('AppController', 'Controller');
class CommonsController extends AppController {
	var $helpers = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');
	public $uses = array('Store', 'User','Category','Customer', 'State', 'City', 'Location', 
                         'TimeSlot', 'DeliveryTimeSlot', 'DeliveryLocation','Brand','Country',
                         'Product','CustomerAddressBook','Voucher','Storeoffer','Deal','Driver',
                         'Order','Review');
    
	/**
	 * CommonsController::statusChanges()
	 * Status Change Process
	 * @return void
	 */
	public function statusChanges() {
	  	$id 	= $this->request->data['id'];
		$model 	= $this->request->data['model'];

        if (!empty($id)) {
            switch (trim($model)) {

                case 'Brand':
                    $stausBrand = $this->Brand->findById($id);
                    if (!empty($stausBrand)) {
                        if($stausBrand['Brand']['status'] == 1){
                            $stausBrand['Brand']['status'] = 0;
                        } else {
                           $stausBrand['Brand']['status'] = 1;
                        }
                        $this->Brand->save($stausBrand['Brand']);
                    }
                break;
                case 'Category':
                    $stausCategory = $this->Category->findById($id);
                    if (!empty($stausCategory)) {
                        if($stausCategory['Category']['status'] == 1){
                            $stausCategory['Category']['status'] = 0;
                        } else {
                           $stausCategory['Category']['status'] = 1;
                        }
                        $this->Category->save($stausCategory['Category']);
                    }
                break;
                case 'CustomerAddressBook':
                    $stausCustomerAddressBook = $this->CustomerAddressBook->findById($id);
                    if (!empty($stausCustomerAddressBook)) {
                        if($stausCustomerAddressBook['CustomerAddressBook']['status'] == 1){
                            $stausCustomerAddressBook['CustomerAddressBook']['status'] = 0;
                        } else {
                           $stausCustomerAddressBook['CustomerAddressBook']['status'] = 1;
                        }
                        $this->CustomerAddressBook->save($stausCustomerAddressBook['CustomerAddressBook']);
                    }
                break;
                case 'Product':
                    if ($this->Auth->User('role_id') == 3) {
                        $stausProduct = $this->Product->find('first', array(
                                        'conditions' => array('Product.id' => $id,
                                                            'Product.store_id' => $this->Auth->User('Store.id'))));
                        if (!empty($stausProduct)) {
                            if($stausProduct['Product']['status'] == 1){
                                $stausProduct['Product']['status'] = 0;
                            } else {
                               $stausProduct['Product']['status'] = 1;
                            }
                            $this->Product->save($stausProduct['Product']);                         
                        }
                    } elseif ($this->Auth->User('role_id') == 1) {
                        if($stausProduct['Product']['status'] == 1){
                            $stausProduct['Product']['status'] = 0;
                        } else {
                           $stausProduct['Product']['status'] = 1;
                        }
                         $stausProduct['Product']['id'] = $id;
                         $this->Product->save($stausProduct['Product']);
                    }
                break;
                case 'City':
                    $stausCity = $this->City->findById($id);
                    if (!empty($stausCity)) {
                        if($stausCity['City']['status'] == 1){
                            $stausCity['City']['status'] = 0;
                        } else {
                           $stausCity['City']['status'] = 1;
                        }
                        $this->City->save($stausCity['City']);
                    }
                break;
                case 'Country':
                    $stausCountry = $this->Country->findById($id);
                    if (!empty($stausCountry)) {
                        if($stausCountry['Country']['status'] == 1){
                            $stausCountry['Country']['status'] = 0;
                        } else {
                           $stausCountry['Country']['status'] = 1;
                        }
                        $this->Country->save($stausCountry['Country']);
                    }
                break;
                case 'State':
                    $stausState = $this->State->findById($id);
                    if (!empty($stausState)) {
                        if($stausState['State']['status'] == 1){
                            $stausState['State']['status'] = 0;
                        } else {
                           $stausState['State']['status'] = 1;
                        }
                        $this->State->save($stausState['State']);
                    }
                break;
                case 'Location':
                    $stausLocation = $this->Location->findById($id);
                    if (!empty($stausLocation)) {
                        if($stausLocation['Location']['status'] == 1){
                            $stausLocation['Location']['status'] = 0;
                        } else {
                           $stausLocation['Location']['status'] = 1;
                        }
                        $this->Location->save($stausLocation['Location']);
                    }
                break;
                case 'Customer':
                    $stausCustomer = $this->Customer->findById($id);

                    //echo "<pre>"; print_r($stausCustomer);
                    //exit();

                    if (!empty($stausCustomer)) {
                        if($stausCustomer['Customer']['status'] == 1){
                            $this->Customer->updateAll(array('Customer.status' => 0), array('Customer.id' => $id));
                        } else {
                           $this->Customer->updateAll(array('Customer.status' => 1), array('Customer.id' => $id));
                        }
                    }
                break;
                case 'Voucher':
                    $stausVoucher = $this->Voucher->findById($id);
                    if (!empty($stausVoucher)) {
                        if($stausVoucher['Voucher']['status'] == 1){
                            $stausVoucher['Voucher']['status'] = 0;
                        } else {
                           $stausVoucher['Voucher']['status'] = 1;
                        }
                        $this->Voucher->save($stausVoucher['Voucher']);
                    }
                break;
                case 'Storeoffer':
                    $stausStoreoffer = $this->Storeoffer->findById($id);
                    if (!empty($stausStoreoffer)) {
                        if($stausStoreoffer['Storeoffer']['status'] == 1){
                            $stausStoreoffer['Storeoffer']['status'] = 0;
                        } else {
                           $stausStoreoffer['Storeoffer']['status'] = 1;
                        }
                        $this->Storeoffer->save($stausStoreoffer['Storeoffer']);
                    }
                break;
                case 'Review':
                    $stausReview = $this->Review->findById($id);
                    if (!empty($stausReview)) {
                        if($stausReview['Review']['status'] == 1){
                            $stausReview['Review']['status'] = 0;
                        } else {
                           $stausReview['Review']['status'] = 1;
                        }
                        $this->Review->save($stausReview['Review']);
                    }
                break;

                case 'Deal':
                    if ($this->Auth->User('role_id') == 3) {
                        $stausDeal = $this->Deal->find('first', array(
                                        'conditions' => array('Deal.id' => $id,
                                                            'Deal.store_id' => $this->Auth->User('Store.id'))));
                        if (!empty($stausDeal)) {
                            if($stausDeal['Deal']['status'] == 1){
                                $stausDeal['Deal']['status'] = 0;
                            } else {
                               $stausDeal['Deal']['status'] = 1;
                            }
                            $this->Deal->save($stausDeal['Deal']);                         
                        }
                    } elseif ($this->Auth->User('role_id') == 1) {
                        $stausDeal = $this->Deal->findById($id);

                        if($stausDeal['Deal']['status'] == 1){
                            $stausDeal['Deal']['status'] = 0;
                        } else {
                           $stausDeal['Deal']['status'] = 1;
                        }
                         $stausDeal['Deal']['id'] = $id;
                         $this->Deal->save($stausDeal['Deal']);
                    }
                break;
                case 'Driver':
                    if ($this->Auth->User('role_id') == 3) {
                        $stausDriver = $this->Driver->find('first', array(
                                        'conditions' => array('Driver.id' => $id,
                                                            'Driver.store_id' => $this->Auth->User('Store.id'))));

                        if (!empty($stausDriver)) {
                            if($stausDriver['Driver']['status'] == 'Active'){
                                $stausDriver['Driver']['status'] = 'Deactive';
                            } else {
                               $stausDriver['Driver']['status'] = 'Active';
                            }
                            $this->Driver->save($stausDriver['Driver']);                         
                        }
                    } elseif ($this->Auth->User('role_id') == 1) {
                        $stausDriver = $this->Driver->findById($id);

                        if($stausDriver['Driver']['status'] == 'Active'){
                            $stausDriver['Driver']['status'] = 'Deactive';
                        } else {
                           $stausDriver['Driver']['status'] = 'Active';
                        }
                         $this->Driver->save($stausDriver['Driver']);
                    }
                break;
                case 'Store':
                    $stausStore = $this->Store->findById($id);
                    if (!empty($stausStore)) {
                        if($stausStore['Store']['status'] == 1){
                            $stausStore['Store']['status'] = 0;
                        } else {
                           $stausStore['Store']['status'] = 1;
                        }
                        $this->Store->save($stausStore['Store']);
                    }
                break;
                case 'newsletter':
                    $stausCustomer = $this->Customer->findById($id);
                    if (!empty($stausCustomer)) {
                        if($stausCustomer['Customer']['news_letter_option'] == 'Yes'){
                            $stausCustomer['Customer']['news_letter_option'] = 'No';
                        } else {
                           $stausCustomer['Customer']['news_letter_option'] = 'Yes';
                        }
                        $this->Customer->save($stausCustomer['Customer']);
                    }
                break;
            }
        }
        exit();
	}

	/**
	 * CommonsController::deleteProcess()
	 * Delete Process
	 * @return void
	 */
	public function deleteProcess(){
    	   
        $id 	= $this->request->data['id'];
        $model 	= $this->request->data['model'];

        if (!empty($id)) {
            switch (trim($model)) {

                case 'Brand':
                    $stausBrand = $this->Brand->findById($id);
                    if (!empty($stausBrand)) {
                        $stausBrand['Brand']['status'] = 3;
                        $this->Brand->save($stausBrand['Brand']);
                    }
                break;
                case 'Category':
                    $stausCategory = $this->Category->findById($id);
                    if (!empty($stausCategory)) {
                        $stausCategory['Category']['status'] = 3;
                        $this->Category->save($stausCategory['Category']);
                    }
                break;
                case 'CustomerAddressBook':
                    $stausCustomerAddressBook = $this->CustomerAddressBook->findById($id);
                    if (!empty($stausCustomerAddressBook)) {
                        $this->CustomerAddressBook->delete($id);
                    }
                break;
                case 'Product':
                    if(!empty($id)) {
                        if ($this->Auth->User('role_id') == 3) {
                            $deleteProduct = $this->Product->find('first', array(
                                            'conditions' => array('Product.id' => $id,
                                                                'Product.store_id' => $this->Auth->User('Store.id'))));

                            if (!empty($deleteProduct)) {
                                $deleteProduct['Product']['status'] = 3;
                                $this->Product->save($deleteProduct['Product']);                         
                            }
                        } elseif ($this->Auth->User('role_id') == 1) {
                             $deleteProduct['Product']['status'] = 3;
                             $deleteProduct['Product']['id'] = $id;
                             $this->Product->save($deleteProduct['Product']);
                        }
                        
                    }         
                break;
                case 'City':
                    $stausCity = $this->City->findById($id);
                    if (!empty($stausCity)) {
                        $stausCity['City']['status'] = 3;
                        $this->City->save($stausCity['City']);
                    }
                break;
                case 'Country':
                    $stausCountry = $this->Country->findById($id);
                    if (!empty($stausCountry)) {
                        $stausCountry['Country']['status'] = 3;
                        $this->Country->save($stausCountry['Country']);
                    }
                break;
                case 'State':
                    $stausState = $this->State->findById($id);
                    if (!empty($stausState)) {
                        $stausState['State']['status'] = 3;
                        $this->State->save($stausState['State']);
                    }
                break;
                case 'Location':
                    $stausLocation = $this->Location->findById($id);
                    if (!empty($stausLocation)) {
                        $stausLocation['Location']['status'] = 3;
                        $this->Location->save($stausLocation['Location']);
                    }
                break;
                case 'Customer':
                    $stausCustomer = $this->Customer->findById($id);
                    if (!empty($stausCustomer)) {
                        $this->Customer->updateAll(array('Customer.status' => 3), array('Customer.id' => $id));
                    }
                break;
                case 'Voucher':
                    $stausVoucher = $this->Voucher->findById($id);
                    if (!empty($stausVoucher)) {
                        $stausVoucher['Voucher']['status'] = 3;
                        $this->Voucher->save($stausVoucher['Voucher']);
                    }
                break;
                case 'Storeoffer':
                    $stausStoreoffer = $this->Storeoffer->findById($id);
                    if (!empty($stausStoreoffer)) {
                        $stausStoreoffer['Storeoffer']['status'] = 3;
                        $this->Storeoffer->save($stausStoreoffer['Storeoffer']);
                    }
                break;
                case 'Deal':
                    if ($this->Auth->User('role_id') == 3) {
                        $deleteDeal = $this->Deal->find('first', array(
                                        'conditions' => array('Deal.id' => $id,
                                                            'Deal.store_id' => $this->Auth->User('Store.id'))));

                        if (!empty($deleteDeal)) {
                            $this->Deal->delete($id);
                        }
                    } elseif ($this->Auth->User('role_id') == 1) {
                         $this->Deal->delete($id);
                    }
                break;
                case 'Order':
                    if(!empty($id)) {
                        if ($this->Auth->User('role_id') == 3) {
                            $deleteOrder = $this->Order->find('first', array(
                                            'conditions' => array('Order.id' => $id,
                                                                'Order.store_id' => $this->Auth->User('Store.id'))));

                            if (!empty($deleteOrder)) {
                                $deleteOrder['Order']['status'] = 'Failed';
                                $this->Order->save($deleteOrder['Order']);                         
                            }
                        } elseif ($this->Auth->User('role_id') == 1) {
                             $deleteOrder['Order']['status'] = 'Failed';
                             $deleteOrder['Order']['id'] = $id;
                             $this->Order->save($deleteOrder['Order']);
                        }
                    }
                break;
                case 'Driver':
                    if(!empty($id)) {
                        if ($this->Auth->User('role_id') == 3) {
                            $deleteDriver = $this->Driver->find('first', array(
                                            'conditions' => array('Driver.id' => $id,
                                                                'Driver.store_id' => $this->Auth->User('Store.id'))));

                            if (!empty($deleteDriver)) {
                                $deleteDriver['Driver']['status'] = 'Delete';
                                $this->Driver->save($deleteDriver['Driver']);                         
                            }
                        } elseif ($this->Auth->User('role_id') == 1) {
                             $deleteDriver['Driver']['status'] = 'Delete';
                             $deleteDriver['Driver']['id'] = $id;
                             $this->Driver->save($deleteDriver['Driver']);
                        }
                    }
                break;
                case 'Review':
                    $stausReview = $this->Review->findById($id);
                    if (!empty($stausReview)) {
                        $stausReview['Review']['status'] = 3;
                        $this->Review->save($stausReview['Review']);
                    }
                break;
            }
        }
        exit();
  	}

    public function admin_multipleSelect(){
       
        $model           = (isset($this->request->data['name'])) ? $this->request->data['name'] : '';
        $statusOption    = (isset($this->request->data['actions'])) ? $this->request->data['actions'] : '';
        $recordsData     = (isset($this->request->data['Commons'])) ? $this->request->data['Commons'] : array();

        foreach($recordsData as $key => $value) {
            if (!empty($value)) {
                switch (trim($model)) {
                    case 'Product':
                        $stausProduct = $this->Product->findById($value);
                        if (!empty($stausProduct)) {
                            if($statusOption  == 'Active') {
                                $stausProduct['Product']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausProduct['Product']['status'] = 0;                         
                            } else {
                                $stausProduct['Product']['status'] = 3;
                            }
                            $this->Product->save($stausProduct['Product']);
                        }
                    break;
                    case 'Driver':
                        $stausDriver = $this->Driver->findById($value);
                        if (!empty($stausDriver)) {
                            if($statusOption  == 'Active') {
                                $stausDriver['Driver']['status'] = 'Active';                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausDriver['Driver']['status'] = 'Deactive';                         
                            } else {
                                $stausDriver['Driver']['status'] = 'Delete';
                            }
                            $this->Driver->save($stausDriver['Driver']);
                        }
                    break;
                    case 'Deal':
                        $stausDeal = $this->Deal->findById($value);
                        if (!empty($stausDeal)) {
                            if($statusOption  == 'Active') {
                                $stausDeal['Deal']['status'] = 1;
                                $this->Deal->save($stausDeal['Deal']);                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausDeal['Deal']['status'] = 0;
                                $this->Deal->save($stausDeal['Deal']);                         
                            } else {
                                $this->Deal->delete($value);
                            }
                        }
                    break;
                    case 'Storeoffer':
                        $stausStoreoffer = $this->Storeoffer->findById($value);
                        if (!empty($stausStoreoffer)) {
                            if($statusOption  == 'Active') {
                                $stausStoreoffer['Storeoffer']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausStoreoffer['Storeoffer']['status'] = 0;                         
                            } else {
                                $stausStoreoffer['Storeoffer']['status'] = 3;
                            }
                            $this->Storeoffer->save($stausStoreoffer['Storeoffer']);
                        }
                    break;
                    case 'Brand':
                        $stausBrand = $this->Brand->findById($value);
                        if (!empty($stausBrand)) {
                            if($statusOption  == 'Active') {
                                $stausBrand['Brand']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausBrand['Brand']['status'] = 0;                         
                            } else {
                                $stausBrand['Brand']['status'] = 3;
                            }
                            $this->Brand->save($stausBrand['Brand']);
                        }
                    break;
                    case 'Category':
                        $stausCategory = $this->Category->findById($value);
                        if (!empty($stausCategory)) {
                            if($statusOption  == 'Active') {
                                $stausCategory['Category']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausCategory['Category']['status'] = 0;                         
                            } else {
                                $stausCategory['Category']['status'] = 3;
                            }
                            $this->Category->save($stausCategory['Category']);
                        }
                    break;
                    case 'Store':
                        $stausStore = $this->Store->findById($value);
                        if (!empty($stausStore)) {
                            if($statusOption  == 'Active') {
                                $stausStore['Store']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausStore['Store']['status'] = 0;                         
                            } else {
                                $stausStore['Store']['status'] = 3;
                            }
                            $this->Store->save($stausStore['Store']);
                        }
                    break;
                    case 'Review':
                        $stausReview = $this->Review->findById($value);
                        if (!empty($stausReview)) {
                            if($statusOption  == 'Active') {
                                $stausReview['Review']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausReview['Review']['status'] = 0;                         
                            } else {
                                $stausReview['Review']['status'] = 3;
                            }
                            $this->Review->save($stausReview['Review']);
                        }
                    break;
                    case 'Voucher':
                        $stausVoucher = $this->Voucher->findById($value);
                        if (!empty($stausVoucher)) {
                            if($statusOption  == 'Active') {
                                $stausVoucher['Voucher']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausVoucher['Voucher']['status'] = 0;                         
                            } else {
                                $stausVoucher['Voucher']['status'] = 3;
                            }
                            $this->Voucher->save($stausVoucher['Voucher']);
                        }
                    break;
                    case 'Country':
                        $stausCountry = $this->Country->findById($value);
                        if (!empty($stausCountry)) {
                            if($statusOption  == 'Active') {
                                $stausCountry['Country']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausCountry['Country']['status'] = 0;                         
                            } else {
                                $stausCountry['Country']['status'] = 3;
                            }
                            $this->Country->save($stausCountry['Country']);
                        }
                    break;
                    case 'State':
                        $stausState = $this->State->findById($value);
                        if (!empty($stausState)) {
                            if($statusOption  == 'Active') {
                                $stausState['State']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausState['State']['status'] = 0;                         
                            } else {
                                $stausState['State']['status'] = 3;
                            }
                            $this->State->save($stausState['State']);
                        }
                    break;
                    case 'City':
                        $stausCity = $this->City->findById($value);
                        if (!empty($stausCity)) {
                            if($statusOption  == 'Active') {
                                $stausCity['City']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausCity['City']['status'] = 0;                         
                            } else {
                                $stausCity['City']['status'] = 3;
                            }
                            $this->City->save($stausCity['City']);
                        }
                    break;
                    case 'Location':
                        $stausLocation = $this->Location->findById($value);
                        if (!empty($stausLocation)) {
                            if($statusOption  == 'Active') {
                                $stausLocation['Location']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausLocation['Location']['status'] = 0;                         
                            } else {
                                $stausLocation['Location']['status'] = 3;
                            }
                            $this->Location->save($stausLocation['Location']);
                        }
                    break;
                    case 'Customer':
                        $stausCustomer = $this->Customer->findById($value);
                        if (!empty($stausCustomer)) {
                            if($statusOption  == 'Active') {
                                $this->Customer->updateAll(array('Customer.status' => 1), array('Customer.id' => $value));
                            } elseif($statusOption  == 'Deactive') {
                                $this->Customer->updateAll(array('Customer.status' => 0), array('Customer.id' => $value));
                            } else {
                                $this->Customer->updateAll(array('Customer.status' => 3), array('Customer.id' => $value));
                            }
                        }
                    break;
                    case 'CustomerAddressBook':
                        $stausCustomerAddressBook = $this->CustomerAddressBook->findById($value);
                        if (!empty($stausCustomerAddressBook)) {
                            if($statusOption  == 'Active') {
                                $stausCustomerAddressBook['CustomerAddressBook']['status'] = 1;
                                $this->CustomerAddressBook->save($stausCustomerAddressBook['CustomerAddressBook']);
                            } elseif($statusOption  == 'Deactive') {
                                $stausCustomerAddressBook['CustomerAddressBook']['status'] = 0;
                                $this->CustomerAddressBook->save($stausCustomerAddressBook['CustomerAddressBook']);
                            } else {
                                $this->CustomerAddressBook->delete($value);
                            }
                        }
                    break;
                }
                            
            }
        }

        switch (trim($model)) {
            case 'Product':
                $this->redirect(array('controller' => 'products','action' => 'index', $this->request->data['Store']['Storeproduct'], 'admin'=> true));
            break;
            case 'Driver':
                $this->redirect(array('controller' => 'drivers','action' => 'index','admin'=> true));
            break;
            case 'Deal':
                $this->redirect(array('controller' => 'deals','action' => 'index','admin'=> true));
            break;
            case 'Storeoffer':
                $this->redirect(array('controller' => 'storeoffers','action' => 'index','admin'=> true));
            break;
            case 'Brand':
                $this->redirect(array('controller' => 'brands','action' => 'index','admin'=> true));
            break;
            case 'Category':
                if (isset($this->request->data['categoryType'])) {
                    $this->redirect(array('controller' => 'categories','action' => 'subCatIndex','admin'=> true));
                } else {
                    $this->redirect(array('controller' => 'categories','action' => 'index','admin'=> true));
                }
            break;
            case 'Store':
                $this->redirect(array('controller' => 'stores','action' => 'index','admin'=> true));
            break;
            case 'Review':
                $this->redirect(array('controller' => 'reviews','action' => 'list','admin'=> true));
            break;
            case 'Voucher':
                $this->redirect(array('controller' => 'vouchers','action' => 'index','admin'=> true));
            break;
            case 'Country':
                $this->redirect(array('controller' => 'countries','action' => 'index','admin'=> true));
            break;
            case 'State':
                $this->redirect(array('controller' => 'states','action' => 'index','admin'=> true));
            break;
            case 'City':
                $this->redirect(array('controller' => 'cities','action' => 'index','admin'=> true));
            break;
            case 'Location':
                $this->redirect(array('controller' => 'locations','action' => 'index','admin'=> true));
            break;
            case 'Customer':
                $this->redirect(array('controller' => 'customers','action' => 'index','admin'=> true));
            break;
            case 'CustomerAddressBook':
                $this->redirect(array('controller' => 'customers','action' => 'index','admin'=> true));
            break;
        }
        exit();
    }

    public function store_multipleSelect() {

        $model           = (isset($this->request->data['name'])) ? $this->request->data['name'] : '';
        $statusOption    = (isset($this->request->data['actions'])) ? $this->request->data['actions'] : '';
        $recordsData     = (isset($this->request->data['Commons'])) ? $this->request->data['Commons'] : array();

        foreach($recordsData as $key => $value) {
            if ($this->Auth->User('role_id') == 3) {


                switch (trim($model)) {
                    case 'Product':
                        $stausProduct = $this->Product->find('first', array(
                                            'conditions' => array('Product.id' => $value,
                                                                'Product.store_id' => $this->Auth->User('Store.id'))));
                        if (!empty($stausProduct)) {
                            if($statusOption  == 'Active') {
                                $stausProduct['Product']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausProduct['Product']['status'] = 0;                         
                            } else {
                                $stausProduct['Product']['status'] = 3;
                            }
                            $this->Product->save($stausProduct['Product']);
                        }
                    break;
                    case 'Driver':
                        $stausDriver = $this->Driver->find('first', array(
                                            'conditions' => array('Driver.id' => $value,
                                                                'Driver.store_id' => $this->Auth->User('Store.id'))));
                        if (!empty($stausDriver)) {
                            if($statusOption  == 'Active') {
                                $stausDriver['Driver']['status'] = 'Active';                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausDriver['Driver']['status'] = 'Deactive';                         
                            } else {
                                $stausDriver['Driver']['status'] = 'Delete';
                            }
                            $this->Driver->save($stausDriver['Driver']);
                        }
                    break;
                    case 'Deal':
                        $stausDeal = $this->Deal->find('first', array(
                                            'conditions' => array('Deal.id' => $value,
                                                                'Deal.store_id' => $this->Auth->User('Store.id'))));
                        if (!empty($stausDeal)) {
                            if($statusOption  == 'Active') {
                                $stausDeal['Deal']['status'] = 1;
                                $this->Deal->save($stausDeal['Deal']);                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausDeal['Deal']['status'] = 0;
                                $this->Deal->save($stausDeal['Deal']);                         
                            } else {
                                $this->Deal->delete($value);
                            }
                        }
                    break;
                    case 'Storeoffer':
                        $stausStoreoffer = $this->Storeoffer->find('first', array(
                                            'conditions' => array('Storeoffer.id' => $value,
                                                                'Storeoffer.store_id' => $this->Auth->User('Store.id'))));
                        if (!empty($stausStoreoffer)) {
                            if($statusOption  == 'Active') {
                                $stausStoreoffer['Storeoffer']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausStoreoffer['Storeoffer']['status'] = 0;                         
                            } else {
                                $stausStoreoffer['Storeoffer']['status'] = 3;
                            }
                            $this->Storeoffer->save($stausStoreoffer['Storeoffer']);
                        }
                    break;
                    case 'Brand':
                        $stausBrand = $this->Brand->findById($value);
                        if (!empty($stausBrand)) {
                            if($statusOption  == 'Active') {
                                $stausBrand['Brand']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausBrand['Brand']['status'] = 0;                         
                            } else {
                                $stausBrand['Brand']['status'] = 3;
                            }
                            $this->Brand->save($stausBrand['Brand']);
                        }
                    break;
                    case 'Category':
                        $stausCategory = $this->Category->findById($value);
                        if (!empty($stausCategory)) {
                            if($statusOption  == 'Active') {
                                $stausCategory['Category']['status'] = 1;                        
                            } elseif($statusOption  == 'Deactive') {
                                $stausCategory['Category']['status'] = 0;                         
                            } else {
                                $stausCategory['Category']['status'] = 3;
                            }
                            $this->Category->save($stausCategory['Category']);
                        }
                    break;
                }
                            
            }
        }

        switch (trim($model)) {
            case 'Product':
                $this->redirect(array('controller' => 'products','action' => 'index','store'=> true));
            break;
            case 'Driver':
                $this->redirect(array('controller' => 'drivers','action' => 'index','store'=> true));
            break;
            case 'Deal':
                $this->redirect(array('controller' => 'deals','action' => 'index','store'=> true));
            break;
            case 'Storeoffer':
                $this->redirect(array('controller' => 'storeoffers','action' => 'index','store'=> true));
            break;
            case 'Brand':
                $this->redirect(array('controller' => 'brands','action' => 'index','store'=> true));
            break;
            case 'Category':
                $this->redirect(array('controller' => 'categories','action' => 'index','store'=> true));
            break;
        }
        exit();
    }
}