<?php
/* MN */
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {
    public $name = 'Users';
	var $helpers = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');
	public $uses = array('User', 'Customer','Notification');
	public $components = array('Functions', 'Hybridauth', 'Twilio', 'Mailchimp');
	public function beforeFilter() {
		$this->Auth->allow(array('signup', 'customer_customerLogin','storeLogin',
								'activeLink', 'logout', 'social_login', 'social_endpoint'));
		parent::beforeFilter();
	}
	public function index() {	
	if($this->Auth->user('role_id')=='1' || $this->Auth->user('role_id')=="2") {
	
		$this->set('title_for_layout', 'Admin');
		
		}
	}

	public function login() {	
		$this->redirect(array('controller' => 'searches', 'action' => 'index'));
	}

    /**
     * Displays a view
     * Admin login process
     * @param mixed What page to login
     * @return void
     */  
     public function admin_login() {
		if ($this->Auth->loggedIn() && $this->Auth->user('role_id') == 1) {
		      $this->redirect(array("controller"=>"dashboards","action"=>"index", 'admin'=>true));
		} else if ($this->Auth->loggedIn()) {
			echo '<h3 class="form-title"> You are not authorized to access this Page </h3>
        			<a href="'.$this->siteUrl.'/users/logout/admin"> Click here to Logout  </a>';
			exit();      	

        }
		if ($this->request->is('post')) {
            $roles      = array(1);  
			$userData   = $this->User->findByUsername($this->request->data['User']['username']);
			if(in_array($userData['User']['role_id'],$roles)) {
				if ($this->Auth->login()) {
					#REmember me            
					if($this->request->data['User']['rememberMe']==1) {
					    $this->Cookie->write('rememberMe',$this->request->data['User'],true,"12 months"); 
					} else {
					     $this->Cookie->delete('rememberMe');
					}
					$this->redirect(array('controller' => 'dashboards', 'action' => 'index', 'admin'=>true));
				} else { 

					$this ->Session->setFlash('<p>'.__('Login failed your Username or Password Incorrect',true).'</p>', 'default', 
										array('class' => 'alert alert-danger'));
                    $this->redirect(array('controller' => 'users', 'action' => 'login','admin'=>true));
				 }
			} else {
				$this ->Session->setFlash('<p>'.__('Login failed, unauthorized', true).'</p>', 'default', 
										array('class' => 'alert alert-danger'));
				$this->redirect(array('controller' => 'users', 'action' => 'login','admin'=>true));
			}
		}
		$this->request->data['User']    = $this->Cookie->read('rememberMe');  
		$this->set('title_for_layout', 'Admin');      
	}
	 public function store_storeLogin() {
		if ($this->Auth->loggedIn() && $this->Auth->user('role_id') == 3) {
		      $this->redirect(array("controller"=>"dashboards","action"=>"index", 'store'=>true));
		} else if ($this->Auth->loggedIn()) {
			echo '<h3 class="form-title"> You are not authorized to access this Page </h3>
        			<a href="'.$this->siteUrl.'/users/logout/store"> Click here to Logout  </a>';
			exit();      	

        }
		if ($this->request->is('post')) {

			if(isset($this->request->data['Users']['email']) && $this->request->data['Users']['email'] != ''){
			   	$userData = $this->User->find('first', array(
									   'conditions' =>array(
										   'User.username' => trim($this->request->data['Users']['email']),
										   'Store.status' => 1,
										   'User.role_id' => 3)));

			   	if(!empty($userData)){
				   $newRegisteration = $this->Notification->find('first', array(
					   					'conditions'=>array('Notification.title =' => 'Reset password')));

				   $toemail  	 = $this->request->data['Users']['email'];
				   $source	 	 = $this->siteUrl.'/siteicons/logo.png';
				   $storeEmail   = $this->siteSetting['Sitesetting']['admin_email'];
				   $siteName  	 = $this->siteSetting['Sitesetting']['site_name'];
				   $storename 	 = $userData['Store']['store_name'];
				   $tmpPassword  = $this->Functions->createTempPassword(7);

				   $datas['User']['password']=$this->Auth->Password($tmpPassword);
				   $datas['User']['id'] = $userData['User']['id'];

				   	if ($this->User->save($datas['User'],null,null)){
					   if($newRegisteration){
						   $forgetpasswordContent = $newRegisteration['Notification']['content'];
						   $forgetpasswordsubject = $newRegisteration['Notification']['subject'];
					   }

					   $mailContent = $forgetpasswordContent;
					   $siteUrl = $this->siteUrl.'/store';
					   $mailContent = str_replace("{Customer name}", $storename, $mailContent);
					   $mailContent = str_replace("{source}", $source, $mailContent);
					   $mailContent = str_replace("{title}", $siteName, $mailContent);
					   $mailContent = str_replace("{SITE_URL}", $siteUrl, $mailContent);
					   $mailContent = str_replace("{tmpPassword}", $tmpPassword, $mailContent);
					   $mailContent = str_replace("{Store name}", $siteName, $mailContent);

					   $email = new CakeEmail();
					   $email->from($storeEmail);
					   $email->to($toemail);
					   $email->subject($forgetpasswordsubject);
					   $email->template('register');
					   $email->emailFormat('html');
					   $email->viewVars(array('mailContent' => $mailContent,'source'=>$source,'storename'=>$siteName));

					   if($email->send()){
						// Forget Sms
					   	$storeMessage = "We've received a request to change your password. Use this password ".$tmpPassword." to login to your account and update it ASAP. Thanks Chillcart";
				          	$toStoreNumber = '+'.$this->siteSetting['Country']['phone_code'].$userData['Store']['contact_phone'];
				        $storeSms 	  = $this->Twilio->sendSingleSms($toStoreNumber, $storeMessage);
						$this->Session->setFlash('<p>'.__('Email has been sent successfully', true).'</p>', 'default',
							   array('class' => 'alert alert-success'));
						$this->redirect(array('controller' => 'users', 'action' => 'storeLogin', 'store' => true));
					   }
				    }
			   	} else {
			   		$this->Session->setFlash('<p>'.__('You are not authorized', true).'</p>', 'default',
							   array('class' => 'alert alert-danger'));
				   $this->redirect(array('controller' => 'users', 'action' => 'storeLogin', 'store' => true));
			   	}
		   	}

            $roles      = array(3);  
			$userData   = $this->User->findByUsername($this->request->data['User']['username']);
			if(in_array($userData['User']['role_id'],$roles)) {
				if ($this->Auth->login()) {
					#REmember me            
					if($this->request->data['User']['rememberMe']==1) {
					    $this->Cookie->write('rememberMe',$this->request->data['User'],true,"12 months"); 
					} else {
					     $this->Cookie->delete('rememberMe');
					}
					$this->redirect(array('controller' => 'dashboards', 'action' => 'index', 'store'=>true));
				} else { 

					$this ->Session->setFlash('<p>'.__('Login failed your Username or Password Incorrect',true).'</p>', 'default', 
										array('class' => 'alert alert-danger'));
                    $this->redirect(array('controller' => 'users', 'action' => 'storeLogin','store'=>true));
				 }
			} else {
				$this ->Session->setFlash('<p>'.__('Login failed, unauthorized', true).'</p>', 'default', 
										array('class' => 'alert alert-danger'));
				$this->redirect(array('controller' => 'users', 'action' => 'storeLogin','store'=>true));
			}
		}
		$this->request->data['User']    = $this->Cookie->read('rememberMe');
		
		$this->set('title_for_layout', 'Store Admin');
	}
    /**
     * Displays a view
     *logout process
     * @param mixed What page to logout
     * @return void
     */
 	public function logout() {
 		//echo "<pre>";print_r($this->params);exit();
 	  	$role_id    = $this->Auth->user("role_id");        
        /*if($this->Session->check('Auth.User'))
    	$this->loggedUser = $this->Session->read('Auth.User');
    	$this -> Session -> setFlash('<p>'.__('Logout Successfully', true).'</p>', 'default', 
											array('class' => 'alert alert-success')); */
     
		//echo "<pre>"; print_r($this->params['pass'][0]);
		if(isset($this->params) && $this->params['pass'][0]=='admin') {
			$this->Auth->logout();	       
		    $this->redirect(array('controller'=>'users', 'action'=>'login', 'admin'=>true));
		} else if (isset($this->params) && $this->params['pass'][0]=='store') {
			$this->Auth->logout();	       
		    $this->redirect(array('controller'=>'users', 'action'=>'storeLogin', 'store'=>true));
		} else if (isset($this->params) && $this->params['pass'][0]=='customer') {

			$this->Auth->logout();	       
		    $this->redirect(array('controller'=>'users', 'action'=>'customerlogin', 'customer'=>true));
		} else if (isset($this->params) && $this->params['pass'][0]=='customerregister') {

			$this->Auth->logout();	       
		    $this->redirect(array('controller'=>'users', 'action'=>'signup'));
		} else if (isset($this->params) && $this->params['pass'][0]=='storeregister') {

			$this->Auth->logout();	       
		    $this->redirect(array('controller'=>'users', 'action'=>'storeregister'));
		}

		if($role_id==1) {      
         	$this -> Session -> setFlash('<p>'.__('Logout successfully.', true).'</p>', 'default', 
											array('class' => 'alert alert-success'));     
		    $this->Auth->logout();	       
		    $this->redirect(array('controller'=>'users', 'action'=>'login', 'admin'=>true));
        } else if($role_id==3){
        	$this -> Session -> setFlash('<p>'.__('Logout successfully.', true).'</p>', 'default', 
											array('class' => 'alert alert-success'));     
		    $this->Auth->logout();	       
		    $this->redirect(array('controller'=>'users', 'action'=>'storeLogin', 'store'=>true));

        } else {
            $this -> Session -> setFlash('<p>'.__('Logout successfully.', true).'</p>', 'default', 
											array('class' => 'alert alert-success'));
            $this->Auth->logout();
            $this->redirect(array('controller'=>'users', 'action'=>'customerlogin', 'customer'=>true));
            //$this->redirect(array("controller"=>"homes","action"=>"home"));	
        }
        $this->Session->delete('coupon_code');
    }

    public function admin_adminLogout() {
		$this -> Session -> setFlash('<p>'.__('Logout successfully.', true).'</p>', 'default', 
													array('class' => 'alert alert-success'));
		$this->Auth->logout();
		$this->redirect(array('controller' => 'users', 'action' => 'login', 'admin'=>true));

	}

    /**
     * Displays a view
     *user logout process
     * @param mixed What page to USerlogout
     * @return void
     */
 	public function customer_userLogout() {
		$this -> Session -> setFlash('<p>'.__('Logout successfully', true).'</p>', 'default', 
													array('class' => 'alert alert-success'));
		$this->Auth->logout();
		$this->Session->write("preSessionid",'');
		session_regenerate_id();
		$this->redirect(array('controller' => 'Users', 'action' => 'customerlogin', 'customer'=>true));

	}
	public function store_storeLogout() {
		$this -> Session -> setFlash('<p>'.__('Logout successfully.', true).'</p>', 'default', 
													array('class' => 'alert alert-success'));
		$this->Auth->logout();
		$this->redirect(array('controller' => 'users', 'action' => 'storeLogin', 'store'=>true));

	}	
	/**
	 * UsersController::userRedirect()
	 * userdirct process
	 * @return void
	 */
	public function userRedirect() {                        
		if ($this -> userRoles['admin'] == $this -> loggedAdmin['role_id']) {
			//Admin login redirect...
			$this->redirect(array('controller' => 'dashboards', 'action' => 'index', 'admin'=>true));
		}else if ($this -> userRoles['storeadmin'] == $this -> loggedAdmin['role_id']) {
			//StoreAdmin login redirect...
			$this->redirect(array('controller' => 'dashboards', 'action' => 'index', 'storeadmin'=>true));             
			//$this->redirect($url);
		} else if ($this -> userRoles['customers'] == $this -> loggedAdmin['role_id']) {
			//Customer login redirect...
			$this->redirect(array('controller' => 'Customers', 'action' => 'myaccount', 'customer'=>true));
		}else if ($this -> userRoles['staff'] == $this -> loggedAdmin['role_id']) {
			//Staff login redirect...
			$this->redirect(array('controller' => 'settings', 'action' => 'general','storeadmin'=>true));
		}
        else
        {
            $this->redirect(array('controller' => 'users', 'action' => 'index'));
        }         
	}
	/**
	 * UsersController::admin_changepassword()
	 * admin change password process
	 * @return void
	 */
	/*public function admin_changepassword() {
		if($this->request->is('post')) {
			$id          = $this->Auth->User('id');
			$user        = $this->User->find('first', array(
									'conditions' => array('User.id' => $id),
									'fields' 	 => 'password'));

			$password 	 = $user['User']['password'];
			$oldpassword = $this->Auth->password($this->request->data['User']['oldpassword']);
			if($password == $oldpassword) {
				if($this->request->data['User']['newpassword'] == $this->request->data['User']['retypepassword']) {
					$nPassword  = $this->request->data['User']['newpassword'];
					$cPass['User']['id'] = $id;
					$cPass['User']['password'] = $this->Auth->password($nPassword);
					if($this->User->save($cPass['User'], null, null)){
						$this->Session->setFlash('<p>'.__('Password successfully Changed', true).'</p>', 'default', 
											array('class' => 'alert alert-success'));
						$this->redirect(array('controller' => 'users','action' => 'logout', 'admin' => false));		
					}else {
						$this->Session->setFlash('<p>'.__('Password not Updated', true).'</p>', 'default', 
											array('class' => 'alert alert-danger'));
					}
				} else {
					$this->Session->setFlash('<p>'.__('New Password and Retype Password not  Matched', true).'</p>', 'default', 
											array('class' => 'alert alert-danger'));
				}
			} else {
				$this -> Session -> setFlash('<p>'.__('Old Password not Matched', true).'</p>', 'default', 
											array('class' => 'alert alert-danger'));
			}
		}
	}*/
	/**
	 * UsersController::signup()
	 * Customer Signup Process
	 * @return void
	 */
	public function signup() {
	   $this->layout = 'frontend';

	   if ($this->Auth->loggedIn()) {
        	echo '<h3 class="form-title"> You are not authorized to access this Page </h3>
        			<a href="'.$this->siteUrl.'/users/logout/customerregister"> Click here to Logout  </a>';
			exit();
        }

       	if (!empty($this->request->data['Customer']['customer_email'])) {
          	//$user  = $this->User->findByUsernameAndRoleId($this->request->data['Customer']['customer_email'],4); 

          	$user = $this->User->find('first', array(
                      'conditions' => array('User.username' => trim($this->request->data['Customer']['customer_email']),
                                             'User.role_id' => 4,
                              'NOT' => array('Customer.status' => 3))));
	        if(!empty($user)) {
	            $this->Session->setFlash('<p>'.__('Email already exists', true).'</p>', 'default', 
	                                                array('class' => 'alert alert-danger'));
	        } else {
              	$this->request->data['User']['role_id']  = 4;
              	$this->request->data['User']['username'] = $this->request->data['Customer']['customer_email'];
              	$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
              	$this->User->save($this->request->data['User'],null,null);
              	$this->request->data['Customer']['user_id'] = $this->User->id;
              
              	$this->Customer->save($this->request->data['Customer'],null,null);
              	//Mail Processing From Admin To Customer
         	 	$newRegisteration = $this->Notification->find('first',array(
                                                            'conditions'=>array(
                                                            'Notification.title'=>'Customer activation')));
              	if($newRegisteration){

					$regContent = $newRegisteration['Notification']['content'];
					$regsubject = $newRegisteration['Notification']['subject'];
             	}

	            $adminEmail   = $this->siteSetting['Sitesetting']['admin_email'];
	            $source	 	  = $this->siteUrl.'/siteicons/logo.png';
		        $mailContent  = $regContent;
		        $userID       = $this->Customer->id;
		        $siteUrl      = $this->siteUrl;
		        $activation   = $this->siteUrl. '/users/activeLink/'.$userID;
		        $customerName = $this->request->data['Customer']['first_name'];
		        $store_name   = $this->siteSetting['Sitesetting']['site_name'];

		        $mailContent  = str_replace("{firstname}", $customerName, $mailContent);
		        $mailContent  = str_replace("{activation}", $activation, $mailContent);
		        $mailContent  = str_replace("{siteUrl}", $siteUrl, $mailContent);
		        $mailContent  = str_replace("{store name}",$store_name, $mailContent);
		        $email        = new CakeEmail();
		        $email->from($adminEmail);
		        $email->to($this->request->data['Customer']['customer_email']);
		        $email->subject($regsubject);
		        $email->template('register');
		        $email->emailFormat('html');
		        $email->viewVars(array('mailContent' => $mailContent,'source'=>$source));
		        $email->send();
             	
				//Signup Sms
		        $customerMessage = 'Thank you for registering with Chillcart.Click on below link to activate your account.'.$activation.'. Thanks Chillcart';
	          	$toCustomerNumber = '+'.$this->siteSetting['Country']['phone_code'].$this->request->data['Customer']['customer_phone'];
	          	$customerSms 	  = $this->Twilio->sendSingleSms($toCustomerNumber, $customerMessage);

	          	//Mailchimp Process
	          	$merge_vars = array(
					    'EMAIL' => $this->request->data['Customer']['customer_email'],
					    'FNAME' => $this->request->data['Customer']['first_name'],
					    'LNAME' => $this->request->data['Customer']['last_name']
					  );
	          	
    			$this->Mailchimp->MCAPI($this->mailChimpKey);
    			$list = $this->Mailchimp->listSubscribe($this->mailChimpListId, $this->request->data['Customer']['customer_email'], $merge_vars);

             	$this->Session->setFlash('<p>'.__('You have successfully registered an account. An email has been sent with further instructions', true).'</p>', 'default', 
                                                  array('class' => 'alert alert-success'));
             	$this->redirect(array('controller' => 'Users','action' => 'customerlogin','customer'=>true));
          	}
       	}
   	}
   /**
    * UsersController::customer_customerlogin()
    * Customer Login Process
    * @return void
    */
   	public function customer_customerlogin() {
    	$this->layout = 'frontend';

    	if (isset($this->request->query['page']) && $this->request->query['page']=='checkout') {
	    	$this->Session->write("redirectpage",'checkout');
	    }
		if ($this->Auth->loggedIn() && $this->Auth->user('role_id') == 4) {
		        $this->redirect(array("controller"=>"Customers","action"=>"myaccount", 'customer'=>true));
		} else if ($this->Auth->loggedIn()) {
			echo '<h3 class="form-title"> You are not authorized to access this Page </h3>
	    			<a href="'.$this->siteUrl.'/users/logout/customer"> Click here to Logout  </a>';
			exit();
	    }

    	if($this->request->is('post')) {
		   	if(isset($this->request->data['Users']['email']) && $this->request->data['Users']['email'] != ''){
			   $userData = $this->User->find('first', array(
									   'conditions' =>array(
										   'User.username' => $this->request->data['Users']['email'],
										   'Customer.status' => 1,
										   'User.role_id' => 4)));

			   if(!empty($userData)){
				   $newRegisteration = $this->Notification->find('first', array(
					   					'conditions'=>array('Notification.title =' => 'Reset password')));

				   $toemail  = $this->request->data['Users']['email'];
				   $source	 = $this->siteUrl.'/siteicons/logo.png';
				   $title 	 = 'logo.png';

				   $storeEmail = $this->siteSetting['Sitesetting']['admin_email'];
				   $storename  = $this->siteSetting['Sitesetting']['site_name'];
				   $customerName = $userData['Customer']['first_name'];
				   $tmpPassword = $this->Functions->createTempPassword(7);
				   $datas['User']['password']=$this->Auth->Password($tmpPassword);
				   $datas['User']['id']=$userData['User']['id'];

				   	if ($this->User->save($datas['User'],null,null)){

					   if($newRegisteration){

						   $forgetpasswordContent = $newRegisteration['Notification']['content'];
						   $forgetpasswordsubject = $newRegisteration['Notification']['subject'];
					   }
					   
					   $mailContent = $forgetpasswordContent;
					   $siteUrl = $this->siteUrl.'/customer/users/customerlogin/';
					   $mailContent = str_replace("{Customer name}", $customerName, $mailContent);
					   $mailContent = str_replace("{source}", $source, $mailContent);
					   $mailContent = str_replace("{title}", $title, $mailContent);
					   $mailContent = str_replace("{SITE_URL}", $siteUrl, $mailContent);
					   $mailContent = str_replace("{tmpPassword}", $tmpPassword, $mailContent);
					   $mailContent = str_replace("{Store name}", $storename, $mailContent);

					   $email = new CakeEmail();
					   $email->from($storeEmail);
					   $email->to($toemail);
					   $email->subject($forgetpasswordsubject);
					   $email->template('register');
					   $email->emailFormat('html');
					   $email->viewVars(array('mailContent' => $mailContent,'source'=>$source,'storename'=>$storename));

					   if($email->send()){
						// Forget Sms
					   	$customerMessage = "We've received a request to change your password. Use this password ".$tmpPassword." to login to your account and update it ASAP. Thanks Chillcart";
				          	$toCustomerNumber = '+'.$this->siteSetting['Country']['phone_code'].$userData['Customer']['customer_phone'];
				        $customerSms 	  = $this->Twilio->sendSingleSms($toCustomerNumber, $customerMessage);
						$this->Session->setFlash('<p>'.__('Email has been sent successfully', true).'</p>', 'default',
							   array('class' => 'alert alert-success'));
						$this->redirect(array('controller' => 'users', 'action' => 'customerlogin', 'customer' => true));
					   }
				    }
			   } else {
			   		$this->Session->setFlash('<p>'.__('You are not register customer', true).'</p>', 'default',
							   array('class' => 'alert alert-danger'));
				   $this->redirect(array('controller' => 'users', 'action' => 'customerlogin', 'customer' => true));
			   }
		   	}
		    


			if ($this->request->data['User']['username'] != '' && $this->request->data['User']['password'] != '') {
		        $role = array(4);

				$userData = $this->User->find('first', array(
										'conditions' =>array(
														'User.username' => $this->request->data['User']['username'],
														'Customer.status' => 1,
														'User.role_id' => 4)));

				if(in_array($userData['User']['role_id'], $role)) {

					$this->Session->write("preSessionid",$this->Session->id());
					if ($this->Auth->login()) {
					 #REmember me            
						if($this->request->data['User']['rememberMe']==1) {
						    $this->Cookie->write('rememberMe',$this->request->data['User'],true,"12 months"); 
						} else {
						     $this->Cookie->delete('rememberMe');
						}
						if($this->Session->read("redirectpage")=='checkout') {
		                    $this->Session->delete("redirectpage");
		                    $this->redirect(array('controller' => 'checkouts', 'action' => 'index','customer'=>false));
		                }
						$this->redirect(array('controller' => 'customers', 'action' => 'myaccount'));

					} else {

						$this ->Session->setFlash('<p>'.__('Login failed your Username or Password Incorrect', true).'</p>', 'default', 
											array('class' => 'alert alert-danger'));
		                $this->redirect(array('controller' => 'users', 'action' => 'customerlogin','customer'=>true));
					}
				} else {

					$this ->Session->setFlash('<p>'.__('Login failed, unauthorized', true).'</p>', 'default', 
											array('class' => 'alert alert-danger'));
					$this->redirect(array('controller' => 'users', 'action' => 'customerlogin','customer'=>true));
				}
			}   
    	}
   	}
   	public function store_changePassword(){
	   	$this->layout = 'assets';
	   	if($this->request->is('post') && $this->Auth->User('role_id') == 3) {
	   		$new_password     =  $this->Auth->password($this->request->data['user']['new_pass']);
	   		$confirm_password =  $this->Auth->password($this->request->data['user']['confirm_pass']);
	   		if ($new_password == $confirm_password) {
	   			$this->request->data['User']['password'] = $new_password;
	   			$this->request->data['User']['id']		 = $this->Auth->User('id'); 
	   			if($this->User->save($this->request->data['User'], null, null)){
					$this->Session->setFlash('<p>'.__('Password successfully Changed', true).'</p>', 'default', 
										array('class' => 'alert alert-success'));
					$this->redirect(array('controller' => 'dashboards','action' => 'index', 'store' => true));		
				}

	   		} else {
	   			$this -> Session -> setFlash('<p>'.__('Old Password not Matched', true).'</p>', 'default', 
												array('class' => 'alert alert-danger'));
	   		}
	   	}
   	} 

   	public function admin_changePassword(){
	   	if($this->request->is('post')) {
	   		$new_password     =  $this->Auth->password($this->request->data['user']['new_pass']);
	   		$confirm_password =  $this->Auth->password($this->request->data['user']['confirm_pass']);
	   		if ($new_password == $confirm_password) {
	   			$this->request->data['User']['password'] = $new_password;
	   			$this->request->data['User']['id']		 = $this->Auth->User('id'); 
	   			if($this->User->save($this->request->data['User'], null, null)){
					$this->Session->setFlash('<p>'.__('Password successfully Changed', true).'</p>', 'default', 
										array('class' => 'alert alert-success'));
					$this->redirect(array('controller' => 'dashboards','action' => 'index', 'admin' => true));		
				}

	   		} else {
	   			$this -> Session -> setFlash('<p>'.__('Old Password not Matched', true).'</p>', 'default', 
												array('class' => 'alert alert-danger'));
	   		}
	   	}
   	} 

   	// Customer Activation
    public function activeLink($id = null){

		if ($id) {
			$CustomerDetails = $this->Customer->findById($id);

			if (!empty($CustomerDetails)) {
				//if ($CustomerDetails['Customer']['status'] == 0) {

					if ($this->Customer->updateAll(array('Customer.status' => 1), array('Customer.id' => $id))) {
						$this->Session->setFlash('<p>'.__('Your account is activated', true).'</p>', 'default', 
													array('class' => 'alert alert-success'));
						$this->redirect(array('controller' => 'users', 'action' => 'customerlogin', 'customer' => true));
					} 
				/*} else {
					$this->Session->setFlash('<p>'.__('Your account is restricted please contact admin .', true).'</p>', 'default', 
												array('class' => 'alert alert-danger'));
					$this->redirect(array('controller' => 'searches', 'action' => 'index', 'customer' => false));
				}*/
			} else {
				$this->Session->setFlash('<p>'.__('You are not registered customer.', true).'</p>', 'default', 
												array('class' => 'alert alert-danger'));
				$this->redirect(array('controller' => 'users', 'action' => 'signup'));
			}
		}
	}


	//Social login process
	public function social_login($provider) {
		

			if( $this->Hybridauth->connect($provider) ){
				$this->_successfulHybridauth($provider,$this->Hybridauth->user_profile);
	        }else{
	            // error
				$this->Session->setFlash($this->Hybridauth->error);
				$this->redirect($this->Auth->loginAction);
	        }
	}

	public function social_endpoint($provider = null) {
		$this->Hybridauth->processEndpoint();
	}
	
	private function _successfulHybridauth($provider, $incomingProfile){

		$existingProfile = $this->User->find('first', array(
									'conditions' => array('User.username' => $incomingProfile['User']['email'])));

		if ($existingProfile) {
			$this->_doSocialLogin($existingProfile,true);
		} else {

			$this->request->data['User']['role_id']  = 4;
          	$this->request->data['User']['username'] = $incomingProfile['User']['email'];

          	$tmpPassword = $this->Functions->createTempPassword(7);
			$this->request->data['User']['password'] = $this->Auth->Password($tmpPassword);


          	$this->User->save($this->request->data['User'],null,null);
          	$this->request->data['Customer']['user_id'] = $this->User->id;
          	$this->request->data['Customer']['first_name'] = $incomingProfile['User']['first_name'];
          	$this->request->data['Customer']['last_name']  = $incomingProfile['User']['last_name'];
          	$this->request->data['Customer']['customer_email']  = $incomingProfile['User']['email'];
          
          	$this->Customer->save($this->request->data['Customer'],null,null);
          	//Mail Processing From Admin To Customer
     	 	$newRegisteration = $this->Notification->find('first',array(
                                                        'conditions'=>array(
                                                        'Notification.title'=>'Customer activation')));
          	if($newRegisteration){

				$regContent = $newRegisteration['Notification']['content'];
				$regsubject = $newRegisteration['Notification']['subject'];
         	}

            $adminEmail   = $this->siteSetting['Sitesetting']['admin_email']; 
            $source= $this->siteUrl.'/siteicons/logo.png';

	        $mailContent  = $regContent;
	        $userID       = $this->Customer->id;
	        $siteUrl      = $this->siteUrl;
	        $activation   = $this->siteUrl. '/users/activeLink/'.$userID;
	        $customerName = $this->request->data['Customer']['first_name'];

	        $store_name   = $this->siteSetting['Sitesetting']['site_name'];

	        $mailContent  = str_replace("{firstname}", $customerName, $mailContent);
	        $mailContent  = str_replace("{activation}", $activation, $mailContent);
	        $mailContent  = str_replace("{siteUrl}", $siteUrl, $mailContent);
	        $mailContent  = str_replace("{store name}",$store_name, $mailContent);
	        $mailContent .='<p> This is your tmp password:'. $tmpPassword.'</p>';

	        $email        = new CakeEmail();
	        $email->from($adminEmail);
	        $email->to($this->request->data['Customer']['customer_email']);
	        $email->subject($regsubject);
	        $email->template('register');
	        $email->emailFormat('html');
	        $email->viewVars(array('mailContent' => $mailContent,'source'=>$source));
	        $email->send();

	        //Mailchimp Process
          	$merge_vars = array(
				    'EMAIL' => $this->request->data['Customer']['customer_email'],
				    'FNAME' => $this->request->data['Customer']['first_name'],
				    'LNAME' => $this->request->data['Customer']['last_name']
				  );
			$this->Mailchimp->MCAPI($this->mailChimpKey);
			$list = $this->Mailchimp->listSubscribe($this->mailChimpListId, $this->request->data['Customer']['customer_email'], $merge_vars);

	        $newProfile = $this->User->findById($this->User->id);
	        $this->_doSocialLogin($newProfile);

		}
	}
	
	private function _doSocialLogin($user, $returning = false) {

		$userDetails 			 = $user['User'];
		$userDetails['Customer'] = $user['Customer'];

		if (!empty($user['Customer']['id'])) {
			$this->Session->write("preSessionid",$this->Session->id());
			if ($this->Auth->login($userDetails)) {
				if($this->Session->read("redirectpage")=='checkout') {
		            $this->Session->delete("redirectpage");
		            $this->redirect(array('controller' => 'checkouts', 'action' => 'index','customer'=>false));
		        }
			} else {
				$this->Session->setFlash(__('Unknown Error could not verify the user: '));
			}
		} else {
			$this ->Session->setFlash('<p>'.__('Login failed, unauthorized', true).'</p>', 'default', 
										array('class' => 'alert alert-danger'));
		}
		$this->redirect(array('controller' => 'users', 'action' => 'customerlogin', 'customer' => true));
	}
}
