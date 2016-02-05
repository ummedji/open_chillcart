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
        switch (trim($model)) {

        	case 'Category':
                    if($id){
                        $this->Category->recursive = 0;
                        $getCatStatus = $this->Category->findById($id);
                        if($getCatStatus['Category']['status'] == 1){
          		       	    $getCatStatus['Category']['status'] = 0;
            			}else if($getCatStatus['Category']['status'] == 0){
   		                   $getCatStatus['Category']['status'] = 1;
            			} else if($getCatStatus['Category']['status'] == 2){
            				$getCatStatus['Category']['status'] = 1;
            			} else {
            			     $getCatStatus['Category']['status'] = 1;
            			}
            			$this->Category->save($getCatStatus['Category']);
                        exit();
           		    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }	
			
			break;
            case 'Store':
                    if($id){
                        $this->Store->recursive = 0;
                        $getCatStatus = $this->Store->findById($id);
                        if($getCatStatus['Store']['status'] == 1){
                            $getCatStatus['Store']['status'] = 0;
                        }else if($getCatStatus['Store']['status'] == 0){
                           $getCatStatus['Store']['status'] = 1;
                        } else if($getCatStatus['Store']['status'] == 2){
                            $getCatStatus['Store']['status'] = 1;
                        } else {
                             $getCatStatus['Store']['status'] = 1;
                        }
                        $this->Store->save($getCatStatus['Store']);
                        exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }   
            
            break;
            case 'Brand':
                    if(!empty($id)) {
                         $Status = $this->Brand->findById($id);
                         if ($Status['Brand']['status'] == 2) {
                            $Status['Brand']['status'] = 1;
                         } elseif($Status['Brand']['status'] == 1) {
                            $Status['Brand']['status'] = 0;
                         } elseif($Status['Brand']['status'] == 0) {
                            $Status['Brand']['status'] = 1;
                         } else {
                            $Status['Brand']['status'] = 1;
                         }
                         $this->Brand->save($Status['Brand']);
                         exit();
                    } else {
                        echo "sorry unable change your status";
                        exit();
                    }
			break;
            case 'Country':
                    if(!empty($id)) {
                         $Status = $this->Country->findById($id);
                         if ($Status['Country']['status'] == 2) {
                            $Status['Country']['status'] = 1;
                         } elseif($Status['Country']['status'] == 1) {
                            $Status['Country']['status'] = 0;
                         } elseif($Status['Country']['status'] == 0) {
                            $Status['Country']['status'] = 1;
                         } else {
                            $Status['Country']['status'] = 1;
                         }
                         $this->Country->save($Status['Country']);
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
			break;
            case 'City':
                    if(!empty($id)) {
                         $Status = $this->City->findById($id);
                         if ($Status['City']['status'] == 2) {
                            $Status['City']['status'] = 1;
                         } elseif($Status['City']['status'] == 1) {
                            $Status['City']['status'] = 0;
                         } elseif($Status['City']['status'] == 0) {
                            $Status['City']['status'] = 1;
                         } else {
                             $Status['City']['status'] = 1;
                         }
                         $this->City->save($Status['City']);
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
			break;
            case 'Customer':
                    if(!empty($id)) {
                         $status = $this->Customer->findById($id);




                          if ($status['Customer']['status'] == 2) {
                            $status['Customer']['status'] = 1;
                         } elseif($status['Customer']['status'] == 1) {
                            $status['Customer']['status'] = 0;
                         } elseif($status['Customer']['status'] == 0) {
                            $status['Customer']['status'] = 1;
                         } else {
                            $status['Customer']['status'] = 1;
                         }
                         if ($this->Customer->save($status, null, null)) {
                            echo 'Success';
                         }
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
			break;
            case 'Product':
                    if(!empty($id)) {
                         $Status = $this->Product->findById($id);
                         if ($Status['Product']['status'] == 2) {
                            $Status['Product']['status'] = 1;
                         } elseif($Status['Product']['status'] == 1) {
                            $Status['Product']['status'] = 0;
                         } elseif($Status['Product']['status'] == 0) {
                            $Status['Product']['status'] = 1;
                         } else {
                            $Status['Product']['status'] = 1;
                         }
                         $this->Product->save($Status['Product']);
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
			break;
            case 'State':
                    if(!empty($id)) {
                         $Status = $this->State->findById($id);
                         if ($Status['State']['status'] == 2) {
                            $Status['State']['status'] = 1;
                         } elseif($Status['State']['status'] == 1) {
                            $Status['State']['status'] = 0;
                         } elseif($Status['State']['status'] == 0) {
                            $Status['State']['status'] = 1;
                         } else {
                             $Status['State']['status'] = 1;
                         }
                         $this->State->save($Status['State']);
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
			break;
            case 'customeraddress':
                    //echo "<pre>";print_r($this->request->data);exit();
                    if(!empty($id)) {
                         $Status = $this->CustomerAddressBook->findById($id);
                         if ($Status['CustomerAddressBook']['status'] == 2) {
                            $Status['CustomerAddressBook']['status'] = 1;
                         } elseif($Status['CustomerAddressBook']['status'] == 1) {
                            $Status['CustomerAddressBook']['status'] = 0;
                         } elseif($Status['CustomerAddressBook']['status'] == 0) {
                            $Status['CustomerAddressBook']['status'] = 1;
                         } else {
                            $Status['CustomerAddressBook']['status'] = 1;
                         }
                         $this->CustomerAddressBook->save($Status['CustomerAddressBook']);
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
			break;
             case 'newsletter':
                    if(!empty($id)) {
                         $Status = $this->Customer->findById($id);
                         if ($Status['Customer']['news_letter_option'] == 'Yes') {
                            $Status['Customer']['news_letter_option'] = 'No';
                         } elseif($Status['Customer']['news_letter_option'] == 'No') {
                            $Status['Customer']['news_letter_option'] = 'Yes';
                         }
                            $this->Customer->save($Status['Customer']);
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
			break;
            case 'Voucher':
                    if(!empty($id)) {
                         $Status = $this->Voucher->findById($id);
                         if ($Status['Voucher']['status'] == 1) {
                            $Status['Voucher']['status'] = 0;
                         } elseif($Status['Voucher']['status'] == 0) {
                            $Status['Voucher']['status'] = 1;
                         }
                            $this->Voucher->save($Status['Voucher']);
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
			break;
            case 'Storeoffer':
                    if(!empty($id)) {
                         $Status = $this->Storeoffer->findById($id);
                         if ($Status['Storeoffer']['status'] == 1) {
                            $Status['Storeoffer']['status'] = 0;
                         } elseif($Status['Storeoffer']['status'] == 0) {
                            $Status['Storeoffer']['status'] = 1;
                         }
                            $this->Storeoffer->save($Status['Storeoffer']);
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
			break;
            case 'Location':
                    if(!empty($id)) {
                         $Status = $this->Location->findById($id);
                         if ($Status['Location']['status'] == 1) {
                            $Status['Location']['status'] = 0;
                         } elseif($Status['Location']['status'] == 0) {
                            $Status['Location']['status'] = 1;
                         } else {
                             $Status['Location']['status'] = 1;
                         }
                            $this->Location->save($Status['Location']);
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
			break;
            case 'Deal':
                    if(!empty($id)) {
                         $Status = $this->Deal->findById($id);
                         if ($Status['Deal']['status'] == 1) {
                            $Status['Deal']['status'] = 0;
                         } elseif($Status['Deal']['status'] == 0) {
                            $Status['Deal']['status'] = 1;
                         } else {
                            $Status['Deal']['status'] = 1;
                         }
                            $this->Deal->save($Status['Deal']);
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
            break;
            case 'Driver':
                if(!empty($id)) {
                    $Status = $this->Driver->findById($id);
                    if ($Status['Driver']['status'] == 'Active') {
                        $Status['Driver']['status'] = 'Deactive';
                    } elseif($Status['Driver']['status'] == 'Deactive') {
                        $Status['Driver']['status'] = 'Active';
                    }
                    $this->Driver->save($Status['Driver']);
                    exit();
                }  else {
                    echo "sorry unable change your status";
                    exit();
                }
                break;

                case 'Review':
                    if(!empty($id)) {
                         $Status = $this->Review->findById($id);
                         if ($Status['Review']['status'] == 1) {
                            $Status['Review']['status'] = 0;
                         } elseif($Status['Review']['status'] == 0) {
                            $Status['Review']['status'] = 1;
                         } else {
                            $Status['Review']['status'] = 1;
                         }
                            $this->Review->save($Status['Review']);
                         exit();
                    }  else {
                        echo "sorry unable change your status";
                        exit();
                    }
            break;


		}
	}
	/**
	 * CommonsController::deleteProcess()
	 * Delete Process
	 * @return void
	 */
	public function deleteProcess(){
    	   $id 	= $this->request->data['id'];
		   $model 	= $this->request->data['model'];
           switch (trim($model)) { 
    	       case 'customeraddress':
                    if($id){
                    /*$Status = $this->CustomerAddressBook->findById($id);
                       if ($Status['CustomerAddressBook']['status'] != 3) {
                             $Status['CustomerAddressBook']['status'] = 3;
                        }
                        $this->CustomerAddressBook->save($Status['CustomerAddressBook']); 
                        // $this->CustomerAddressBook->save($Status['CustomerAddressBook']);*/ 
                        $this->CustomerAddressBook->delete($id);                  
                        echo "sucess";
                        exit();
                    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }	
			
			break;
            case 'Product':
                    if($id){
                        $Status = $this->Product->findById($id);
                        if ($Status['Product']['status'] != 3) {
                             $Status['Product']['status'] = 3;
                        }
                        // $this->CustomerAddressBook->save($Status['CustomerAddressBook']);*/  
                        $this->Product->save($Status['Product']);                   
                        echo "sucess";
                        exit();
                    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }   
            
            break;
             case 'Brand':
                    if($id){
                        $Status = $this->Brand->findById($id);
                        if ($Status['Brand']['status'] != 3) {
                             $Status['Brand']['status'] = 3;
                        }
                        $this->Brand->save($Status['Brand']);                        
                        echo "sucess";
                        exit();
           		    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }	
			
			break;
            case 'Category':
                    if($id){
                        $Status = $this->Category->findById($id);
                        if ($Status['Category']['status'] != 3) {
                             $Status['Category']['status'] = 3;
                        }
                        $this->Category->save($Status['Category']);                        
                        echo "sucess";
                        exit();
           		    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }	
			
			break;
             case 'City':
                    if($id){
            		    $Status = $this->City->findById($id);
                        if ($Status['City']['status'] != 3) {
                             $Status['City']['status'] = 3;
                        }
                        $this->City->save($Status['City']);                        
                        echo "sucess";
                        exit();
           		    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }	
			
			break;
            case 'Country':
                    if($id){
            			$Status = $this->Country->findById($id);
                        if ($Status['Country']['status'] != 3) {
                             $Status['Country']['status'] = 3;
                        }
                        $this->Country->save($Status['Country']);                        
                        echo "sucess";
                        exit();
           		    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }	
			
			break;
               case 'Customer':
                   if(!empty($id)) {
                       $status = $this->Customer->findById($id);
                       $status['Customer']['status'] = 3 ;
                       if ($this->Customer->save($status, null, null)) {
                           echo 'Success';
                       }
                       exit();
                   }  else {
                       echo "sorry unable change your status";
                       exit();
                   }
                   break;
             case 'Location':
                    if($id){
            			$Status = $this->Location->findById($id);
                        if ($Status['Location']['status'] != 3) {
                             $Status['Location']['status'] = 3;
                        }
                        $this->Location->save($Status['Location']);                        
                        echo "sucess";
                        exit();
           		    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }	
			
			break;
            case 'Product':
                    if($id){
            		    $Status = $this->Product->findById($id);
                        if ($Status['Product']['status'] != 3) {
                             $Status['Product']['status'] = 3;
                        }
                        $this->Product->save($Status['Product']);                        
                        echo "sucess";
                        exit();
           		    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }	
			
			break;
            case 'State':
                    if($id){
            			$Status = $this->State->findById($id);
                        if ($Status['State']['status'] != 3) {
                             $Status['State']['status'] = 3;
                        }
                        $this->State->save($Status['State']);                        
                        echo "sucess";
                        exit();
           		    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }	
			
			break;
             case 'Voucher':
                    if($id){
            			$Status = $this->Voucher->findById($id);
                        if ($Status['Voucher']['status'] != 3) {
                             $Status['Voucher']['status'] = 3;
                        }
                        $this->Voucher->save($Status['Voucher']);                        
                        echo "sucess";
                        exit();
           		    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }	
			
			break;
            case 'Storeoffer':
                    if($id){
            			$Status = $this->Storeoffer->findById($id);
                        if ($Status['Storeoffer']['status'] != 3) {
                             $Status['Storeoffer']['status'] = 3;
                        }
                        $this->Storeoffer->save($Status['Storeoffer']);                        
                        echo "sucess";
                        exit();
           		    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }	
			
			break;
            case 'Deal':
                    if($id){
                        $Status = $this->Deal->findById($id);
                        if ($Status['Deal']['status'] != 3) {
                             $Status['Deal']['status'] = 3;
                        }
                        $this->Deal->save($Status['Deal']);                        
                        echo "sucess";
                        exit();
                    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }   
            
            break;
            case 'Order':
                    if($id){
                        $Status = $this->Order->findById($id);
                        if ($Status['Order']['status'] != 'Failed') {
                             $Status['Order']['status'] = 'Failed';
                        }
                        $this->Deal->save($Status['Order']);                        
                        echo "sucess";
                        exit();
                    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }   
            
            break;
            case 'Driver':
                    if($id){
                        $Status = $this->Driver->findById($id);
                        if ($Status['Driver']['status'] != 'Delete') {
                             $Status['Driver']['status'] = 'Delete';
                        }
                        $this->Driver->save($Status['Driver']);
                        echo "sucess";
                        exit();
                    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }   
            
            break;
            case 'Review':
                    if($id){
                        $Status = $this->Review->findById($id);
                        if ($Status['Review']['status'] != 3) {
                             $Status['Review']['status'] = 3;
                        }
                        $this->Review->save($Status['Review']);                        
                        echo "sucess";
                        exit();
                    }  else {
                        echo "sorry unable delete your detail";
                        exit();
                    }   
            
            break;

        }
  	}
    public function admin_multipleSelect(){
       
        $model  = $this->request->data['name'];
        $key    = $this->request->data['actions']; 
        switch (trim($model)) {
            case 'Brand':
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Brand->findById($value); 
                            $this->request->data['Brand']['status'] = 1;
                            $this->request->data['Brand']['id']     = $status['Brand']['id'];
                            $this->Brand->save($this->request->data['Brand']);                                                   

                        }
                       $this->redirect(array('controller' => 'Brands','action' => 'index'));
                    } else {
                        echo "please try again";
                       $this->redirect(array('controller' => 'Brands','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Brand->findById($value);
                            $this->request->data['Brand']['status'] = 0;
                            $this->request->data['Brand']['id']     = $status['Brand']['id'];
                            $this->Brand->save($this->request->data['Brand']);                                                   

                        }
                       $this->redirect(array('controller' => 'Brands','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Brands','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Brand->findById($value);
                            $this->request->data['Brand']['status'] = 3;
                            $this->request->data['Brand']['id']     = $status['Brand']['id'];
                            $this->Brand->save($this->request->data['Brand']);                                                   

                        }
                        $this->redirect(array('controller' => 'Brands','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Brands','action' => 'index'));
                    }

                }

            break;  

            case 'Category':
            //echo "<pre>";print_r($this->request->data);die();
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Category->findById($value); 
                            $this->request->data['Category']['status'] = 1;
                            $this->request->data['Category']['id']     = $status['Category']['id'];
                            $this->Category->save($this->request->data['Category']);                                                   

                        }
                       $this->redirect(array('controller' => 'Categories','action' => 'index'));
                    } else {
                        echo "please try again";
                       $this->redirect(array('controller' => 'Categories','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Category->findById($value);
                            $this->request->data['Category']['status'] = 0;
                            $this->request->data['Category']['id']     = $status['Category']['id'];
                            $this->Category->save($this->request->data['Category']);                                                   

                        }
                       $this->redirect(array('controller' => 'Categories','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Categories','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Category->findById($value);
                            $this->request->data['Category']['status'] = 3;
                            $this->request->data['Category']['id']     = $status['Category']['id'];
                            $this->Category->save($this->request->data['Category']);                                                   

                        }
                        $this->redirect(array('controller' => 'Categories','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Categories','action' => 'index'));
                    }

                }

            break;

            case 'Store':
                //echo "<pre>";print_r($this->request->data);die();
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Store->findById($value);
                            $this->request->data['Store']['status'] = 1;
                            $this->request->data['Store']['id']     = $status['Store']['id'];
                            $this->Store->save($this->request->data['Store']);

                        }
                        $this->redirect(array('controller' => 'Stores','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Stores','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Store->findById($value);
                            $this->request->data['Store']['status'] = 0;
                            $this->request->data['Store']['id']     = $status['Store']['id'];
                            $this->Store->save($this->request->data['Store']);

                        }
                        $this->redirect(array('controller' => 'Stores','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Stores','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Store->findById($value);
                            $this->request->data['Store']['status'] = 3;
                            $this->request->data['Store']['id']     = $status['Store']['id'];
                            $this->Store->save($this->request->data['Store']);

                        }
                        $this->redirect(array('controller' => 'Stores','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Stores','action' => 'index'));
                    }

                }

                break;

            case 'Product':
                //echo "<pre>";print_r($this->request->data);die();
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Product->findById($value);
                            $this->request->data['Product']['status'] = 1;
                            $this->request->data['Product']['id']     = $status['Product']['id'];
                            $this->Product->save($this->request->data['Product']);

                        }
                        $this->redirect(array('controller' => 'Products','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Products','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Product->findById($value);
                            $this->request->data['Product']['status'] = 0;
                            $this->request->data['Product']['id']     = $status['Product']['id'];

                            $this->Product->save($this->request->data['Product']);

                        }
                        $this->redirect(array('controller' => 'Products','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Products','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Product->findById($value);
                            $this->request->data['Product']['status'] = 3;
                            $this->request->data['Product']['id']     = $status['Product']['id'];
                            $this->Product->save($this->request->data['Product']);

                        }
                        $this->redirect(array('controller' => 'Products','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Products','action' => 'index'));
                    }

                }

                break;
            case 'Storeoffer':
                //echo "<pre>";print_r($this->request->data);die();
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Storeoffer->findById($value);
                            $this->request->data['Storeoffer']['status'] = 1;
                            $this->request->data['Storeoffer']['id']     = $status['Storeoffer']['id'];
                            $this->Storeoffer->save($this->request->data['Storeoffer']);

                        }
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Storeoffer->findById($value);
                            $this->request->data['Storeoffer']['status'] = 0;
                            $this->request->data['Storeoffer']['id']     = $status['Storeoffer']['id'];

                            $this->Storeoffer->save($this->request->data['Storeoffer']);

                        }
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Storeoffer->findById($value);
                            $this->request->data['Storeoffer']['status'] = 3;
                            $this->request->data['Storeoffer']['id']     = $status['Storeoffer']['id'];
                            $this->Storeoffer->save($this->request->data['Storeoffer']);

                        }
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index'));
                    }

                }

                break;

            case 'Deal':
                //echo "<pre>";print_r($this->request->data);die();
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Deal->findById($value);
                            $this->request->data['Deal']['status'] = 1;
                            $this->request->data['Deal']['id']     = $status['Deal']['id'];
                            $this->Deal->save($this->request->data['Deal']);

                        }
                        $this->redirect(array('controller' => 'Deals','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Deals','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Deal->findById($value);
                            $this->request->data['Deal']['status'] = 0;
                            $this->request->data['Deal']['id']     = $status['Deal']['id'];

                            $this->Deal->save($this->request->data['Deal']);

                        }
                        $this->redirect(array('controller' => 'Deals','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Deals','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Deal->findById($value);
                            $this->request->data['Deal']['status'] = 3;
                            $this->request->data['Deal']['id']     = $status['Deal']['id'];
                            $this->Deal->save($this->request->data['Deal']);

                        }
                        $this->redirect(array('controller' => 'Deals','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Deals','action' => 'index'));
                    }

                }

                break;
            case 'Review':
                //
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Review->findById($value);
                            $this->request->data['Review']['status'] = 1;
                            $this->request->data['Review']['id']     = $status['Review']['id'];
                            $this->Review->save($this->request->data['Review']);

                        }
                        $this->redirect(array('controller' => 'Reviews','action' => 'list'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Reviews','action' => 'list'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Review->findById($value);

                            $this->request->data['Review']['status'] = 0;
                            $this->request->data['Review']['id']     = $status['Review']['id'];
                            $this->Review->save($this->request->data['Review']);

                        }
                        $this->redirect(array('controller' => 'Reviews','action' => 'list'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Reviews','action' => 'list'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Review->findById($value);
                            $this->request->data['Review']['status'] = 3;
                            $this->request->data['Review']['id']     = $status['Review']['id'];
                            $this->Review->save($this->request->data['Review']);

                        }
                        $this->redirect(array('controller' => 'Reviews','action' => 'list'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Reviews','action' => 'list'));
                    }

                }

                break;

            case 'Driver':
                //
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Driver->findById($value);
                            $this->request->data['Driver']['status'] = 'Active';
                            $this->request->data['Driver']['id']     = $status['Driver']['id'];
                            $this->Driver->save($this->request->data['Driver']);

                        }
                        $this->redirect(array('controller' => 'Drivers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Drivers','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Driver->findById($value);
                            $this->request->data['Driver']['status'] = 'Deactive';
                            $this->request->data['Driver']['id']     = $status['Driver']['id'];
                            $this->Driver->save($this->request->data['Driver']);

                        }
                        $this->redirect(array('controller' => 'Drivers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Drivers','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Driver->findById($value);
                            $this->request->data['Driver']['status'] = 'Delete';
                            $this->request->data['Driver']['id']     = $status['Driver']['id'];
                            $this->Driver->save($this->request->data['Driver']);

                        }
                        $this->redirect(array('controller' => 'Drivers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Drivers','action' => 'index'));
                    }

                }

                break;
            case 'Voucher':
                //
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Voucher->findById($value);
                            $this->request->data['Voucher']['status'] = 1;
                            $this->request->data['Voucher']['id']     = $status['Voucher']['id'];
                            $this->Voucher->save($this->request->data['Voucher']);

                        }
                        $this->redirect(array('controller' => 'Vouchers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Vouchers','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Voucher->findById($value);
                            $this->request->data['Voucher']['status'] = 0;
                            $this->request->data['Voucher']['id']     = $status['Voucher']['id'];
                            $this->Voucher->save($this->request->data['Voucher']);

                        }
                        $this->redirect(array('controller' => 'Vouchers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Vouchers','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $status  = $this->Voucher->findById($value);
                            $this->request->data['Voucher']['status'] = 3;
                            $this->request->data['Voucher']['id']     = $status['Voucher']['id'];
                            $this->Voucher->save($this->request->data['Voucher']);

                        }
                        $this->redirect(array('controller' => 'Vouchers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Vouchers','action' => 'index'));
                    }

                }

                break;
            case 'Country':
                //echo "<pre>";print_r( $this->request->data);exit();
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            //echo "<pre>";print_r( $value);
                            $change['status'] = 1;
                            $change['id'] = $value;
                            $this->Country->save($change,null,null);

                        }
                        $this->redirect(array('controller' => 'Countries','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Countries','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            //echo "<pre>";print_r( $value);exit();
                            $change['status'] = 0;
                            $change['id'] = $value;
                            $this->Country->save($change,null,null);

                        }
                        $this->redirect(array('controller' => 'Countries','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Countries','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 1;
                            $change['id'] = $value;
                            $this->Country->save($change,null,null);

                        }
                        $this->redirect(array('controller' => 'Countries','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Countries','action' => 'index'));
                    }

                }

                break;
            case 'State':
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 1;
                            $change['id'] = $value;
                            $this->State->save($change);

                        }
                        $this->redirect(array('controller' => 'States','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'States','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 0;
                            $change['id'] = $value;
                            $this->State->save($change);

                        }
                        $this->redirect(array('controller' => 'States','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'States','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 3;
                            $change['id'] = $value;
                            $this->State->save($change);

                        }
                        $this->redirect(array('controller' => 'States','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'States','action' => 'index'));
                    }

                }

                break;

            case 'City':
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 1;
                            $change['id'] = $value;
                            $this->City->save($change);

                        }
                        $this->redirect(array('controller' => 'Cities','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Cities','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 0;
                            $change['id'] = $value;
                            $this->City->save($change);

                        }
                        $this->redirect(array('controller' => 'Cities','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Cities','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 3;
                            $change['id'] = $value;
                            $this->City->save($change);

                        }
                        $this->redirect(array('controller' => 'Cities','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Cities','action' => 'index'));
                    }

                }

                break;



            case 'Location':
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 1;
                            $change['id'] = $value;
                            $this->Location->save($change);

                        }
                        $this->redirect(array('controller' => 'Locations','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Locations','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 0;
                            $change['id'] = $value;
                            $this->Location->save($change);

                        }
                        $this->redirect(array('controller' => 'Locations','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Locations','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 3;
                            $change['id'] = $value;
                            $this->Location->save($change);

                        }
                        $this->redirect(array('controller' => 'Locations','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Locations','action' => 'index'));
                    }

                }

                break;
            case 'Customer':
                //echo "<pre>";print_r($this->request->data);die();
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 1;
                            $change['id'] = $value;
                            $this->Customer->save($change,null,null);

                        }
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 0;
                            $change['id'] = $value;
                            $this->Customer->save($change,null,null);

                        }
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 3;
                            $change['id'] = $value;
                            $this->Customer->save($change,null,null);

                        }
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    }

                }

                break;
            case 'CustomerAddressBook':
                //echo "<pre>";print_r($this->request->data);die();
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 1;
                            $change['id'] = $value;
                            $this->CustomerAddressBook->save($change,null,null);

                        }
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 0;
                            $change['id'] = $value;
                            $this->CustomerAddressBook->save($change,null,null);

                        }
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            /*$change['status'] = 3;
                            $change['id'] = $value;
                            $this->CustomerAddressBook->save($change,null,null);*/
                            $this->CustomerAddressBook->delete($value);

                        }
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Customers','action' => 'index'));
                    }

                }

                break;




        }
        exit();

    }

    public function store_multipleSelect() {

        $model = $this->request->data['name'];
        $key = $this->request->data['actions'];
        switch (trim($model)) {
            case 'Brand':
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 1;
                            $change['id'] = $value;
                            $this->Brand->save($change);

                        }
                        $this->redirect(array('controller' => 'Brands','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Brands','action' => 'index','store'=> true));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 0;
                            $change['id'] = $value;
                            $this->Brand->save($change);

                        }
                        $this->redirect(array('controller' => 'Brands','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Brands','action' => 'index','store'=> true));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 3;
                            $change['id'] = $value;
                            $this->Brand->save($change);

                        }
                        $this->redirect(array('controller' => 'Brands','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Brands','action' => 'index','store'=> true));
                    }

                }

                break;
            case 'Category':
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 1;
                            $change['id'] = $value;
                            $this->Category->save($change);

                        }
                        $this->redirect(array('controller' => 'Categories','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Categories','action' => 'index','store'=> true));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 0;
                            $change['id'] = $value;
                            $this->Category->save($change);

                        }
                        $this->redirect(array('controller' => 'Categories','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Categories','action' => 'index','store'=> true));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 3;
                            $change['id'] = $value;
                            $this->Category->save($change);

                        }
                        $this->redirect(array('controller' => 'Categories','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Categories','action' => 'index','store'=> true));
                    }

                }

                break;
            case 'Product':
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 1;
                            $change['id'] = $value;
                            $this->Product->save($change);

                        }
                        $this->redirect(array('controller' => 'Products','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Products','action' => 'index','store'=> true));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 0;
                            $change['id'] = $value;
                            $this->Product->save($change);

                        }
                        $this->redirect(array('controller' => 'Products','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Products','action' => 'index','store'=> true));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 3;
                            $change['id'] = $value;
                            $this->Product->save($change);

                        }
                        $this->redirect(array('controller' => 'Products','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Products','action' => 'index','store'=> true));
                    }

                }

                break;

            case 'Driver':
                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 'Active';
                            $change['id'] = $value;
                            $this->Driver->save($change);

                        }
                        $this->redirect(array('controller' => 'Drivers','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Drivers','action' => 'index','store'=> true));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 'Deactive';
                            $change['id'] = $value;
                            $this->Driver->save($change);

                        }
                        $this->redirect(array('controller' => 'Drivers','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Drivers','action' => 'index','store'=> true));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 'Delete';
                            $change['id'] = $value;
                            $this->Driver->save($change);

                        }
                        $this->redirect(array('controller' => 'Drivers','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Drivers','action' => 'index','store'=> true));
                    }

                }

                break;

            case 'Deal':

                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 1;
                            $change['id'] = $value;

                            $this->Deal->save($change);

                        }
                        $this->redirect(array('controller' => 'Deals','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Deals','action' => 'index','store'=> true));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 0;
                            $change['id'] = $value;
                            $this->Deal->save($change);

                        }
                        $this->redirect(array('controller' => 'Deals','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Deals','action' => 'index','store'=> true));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 3;
                            $change['id'] = $value;
                            $this->Deal->save($change);

                        }
                        $this->redirect(array('controller' => 'Deals','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Deals','action' => 'index','store'=> true));
                    }

                }

                break;

            case 'Storeoffer':

                if($key  == 'Active') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 1;
                            $change['id'] = $value;

                            $this->Storeoffer->save($change);

                        }
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index','store'=> true));
                    }
                } elseif($key  == 'Deactive') {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 0;
                            $change['id'] = $value;
                            $this->Storeoffer->save($change);

                        }
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index','store'=> true));
                    }

                } else {
                    if(!empty($this->request->data['Commons'])) {
                        foreach($this->request->data['Commons'] as $key => $value) {
                            $change['status'] = 3;
                            $change['id'] = $value;
                            $this->Storeoffer->save($change);

                        }
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index','store'=> true));
                    } else {
                        echo "please try again";
                        $this->redirect(array('controller' => 'Storeoffers','action' => 'index','store'=> true));
                    }

                }

                break;
                
        }
        exit();
    }
}