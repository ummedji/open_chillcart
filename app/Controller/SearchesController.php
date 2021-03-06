<?php

/* MN */

App::uses('AppController', 'Controller');


class SearchesController extends AppController {

	var $helpers = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');

	public $uses = array('City', 'Location', 'Store', 'Product', 'Category',
						'ProductDetail', 'ShoppingCart', 'Storeoffer', 'Deal',
						'DeliveryLocation', 'Review', 'Stores', 'Order', 'Proreg');

	public $components = array('Updown');

	public function beforeFilter() {

		$this->Auth->allow(array('*'));
		parent::beforeFilter();

		$storeCity = $this->City->find('list', array(
							'fields' => array('City.id', 'City.city_name')));
		if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
			$storeArea = $this->Location->find('list', array(
		     							'fields' => array('id','zip_code')));
		} else {
			$storeArea = $this->Location->find('list', array(
		     							'fields' => array('id','area_name')));
		}

		$lastsessionid  = $this->Session->read("preSessionid");
		$this->SessionId = (!empty($lastsessionid)) ? $lastsessionid : $this->Session->id();

		$this->cityId = $cityId = $this->Session->read('Search.city');
		$this->areaId = $areaId = $this->Session->read('Search.area');
		$this->set(compact('storeCity', 'storeArea', 'cityId', 'areaId'));
	}

	public function index() {
		
		$this->layout = 'frontend';
		$cityList = array();
		$groceryStore = $this->getGroceryStores();
		$OrderCount = $this->getRelatedCount('Order');
		$StoreCount = $this->getRelatedCount('Stores');
		$this->set(compact('OrderCount'));
		$this->set(compact('StoreCount'));
		$this->set(compact('groceryStore'));
		
		/*if(isset($_POST['data']['Search']['city_cust']) && isset($_POST['data']['Search']['area_cust']))
		{ 
			$cityDetails = $this->City->findById($_POST['data']['Search']['city_cust']);
			if (!empty($_POST['data']['Search']['area_cust'])) {
				$areaDetails = $this->Location->findById($_POST['data']['Search']['area_cust']);
				/* echo $this->siteUrl.'/city/'.$cityDetails['City']['city_name'].'/'.
																$areaDetails['Location']['area_name'].'/'.
																$_POST['data']['Search']['city_cust'].'/'.
																$_POST['data']['Search']['area_cust']; exit; */
				/*$this->redirect($this->siteUrl.'/city/'.$cityDetails['City']['city_name'].'/'.
																$areaDetails['Location']['area_name'].'/'.
																$_POST['data']['Search']['city_cust'].'/'.
																$_POST['data']['Search']['area_cust']);
				exit;
			} else {
				$this->redirect($this->siteUrl.'/city/'.$cityDetails['City']['city_name'].'/'.
																$_POST['data']['Search']['city_cust']);
			}
			$this->redirect(array('controller' => 'searches', 'action' => 'stores', $_POST['data']['Search']['city_cust'], $_POST['data']['Search']['area_cust']));
		}
		else
		{*/
	
		if ($this->cityId != '') {
			$cityDetails = $this->City->findById($this->cityId);
			if (!empty($this->areaId)) {
				$areaDetails = $this->Location->findById($this->areaId);
				$this->redirect($this->siteUrl.'/city/'.$cityDetails['City']['city_name'].'/'.
																$areaDetails['Location']['area_name'].'/'.
																$this->cityId.'/'.
																$this->areaId);
			} else {
				$this->redirect($this->siteUrl.'/city/'.$cityDetails['City']['city_name'].'/'.
																$this->cityId);
			}
			
			$this->redirect(array('controller' => 'searches', 'action' => 'stores', $this->cityId, $this->areaId));
		}
		//}
		$this->changeLocation();

		if (!empty($this->request->data['Search']['city'])) {

			$cityId = $this->request->data['Search']['city'];
			$areaId = $this->request->data['Search']['area'];

			$this->Session->write('Search.city', $cityId);
			$this->Session->write('Search.area', (isset($areaId)) ? $areaId : '');

			$cityDetails = $this->City->findById($cityId);

			if (!empty($areaId)) {

				$areaDetails = $this->Location->findById($areaId);
				$this->redirect($this->siteUrl.'/city/'.$cityDetails['City']['city_name'].'/'.
																$areaDetails['Location']['area_name'].'/'.
																$cityId.'/'.
																$areaId);
			} else {
				$this->redirect($this->siteUrl.'/city/'.$cityDetails['City']['city_name'].'/'.
																$cityId);
			}
		}

		$siteCountry = $this->siteSetting['Sitesetting']['site_country'];

		$cityLists = $this->City->find('list', array(
								'conditions' => array('City.country_id' => $siteCountry,
													'City.status' => 1),
								'fields' => array('City.id', 'City.city_name')));

		foreach ($cityLists as $key => $value) {

			$storeDetails = $this->Product->find('first', array(
									'conditions' => array(
														'Store.status' => 1,
														'Store.store_city' => $key,
														'Product.status' => 1,
														'MainCategory.status' => 1,
														'SubCategory.status' => 1,
														//'Store.delivery_option' => 'Yes',
														//'Brand.status' => 1,
										'OR' => array('Store.collection' => 'Yes',
												  	  'Store.delivery'	 => 'Yes')),
									
									));
			if (!empty($storeDetails)) {

				$cityList[$key] = $value;

				/*if ($storeDetails['Store']['collection'] == 'Yes' ||
					$storeDetails['Store']['delivery'] == 'Yes' &&
					$storeDetails['Store']['delivery_option'] == 'Yes') {
					$cityList[$key] = $value;
				}*/
			}
		}
		$this->set(compact('cityList'));
	}


	public function storesList($cityId = null, $areaId = null) {
		$stores = array();

		$storeLists = $this->Product->find('all', array(
							'conditions' => array(
												'Store.status' => 1,
												'Store.store_city' => $cityId,
												'Product.status' => 1,
												'MainCategory.status' => 1,
												'SubCategory.status' => 1,
									'OR' => array('Store.collection' => 'Yes',
										  	  	   'Store.delivery'	 => 'Yes')),
							'group' => array('Store.id')));
		foreach ($storeLists as $key => $value) {
			if ($value['Store']['collection'] == 'Yes' ||
				$value['Store']['delivery'] == 'Yes' &&
				$value['Store']['delivery_option'] == 'Yes') {
				if (!empty($areaId)) {
					$storeDeliver = $this->DeliveryLocation->find('all', array(
							'conditions' => array('DeliveryLocation.location_id' => $areaId,
												  'Location.status' => 1,
												  'DeliveryLocation.store_id' => $value['Store']['id']),
							'group' => array('DeliveryLocation.store_id')));
					if (!empty($storeDeliver)) {
						$stores[] = $value['Store']['id'];
					} elseif ($value['Store']['collection'] != 'No') {
						$stores[] = $value['Store']['id'];
					}
				} else {
					$stores[] = $value['Store']['id'];
				}
			}
		}
		return $stores;
	}
	public function stores($cityName, $cityId, $areaName, $areaId) {
		$this->layout = 'frontend';
		$orderSuccess = '';
		$stores = array();
		if ($this->Session->read('orderplaced')) {
			$orderSuccess = $this->Session->read('orderplaced');
			$this->changeLocation();
			$this->Session->delete('orderplaced');
		}

		if ($this->Session->read('orderFailed')) {
			$this->changeLocation();
			$this->Session->delete('orderFailed');
		}

		if ($this->cityId != $cityId || $this->areaId != $areaId) {
			$this->redirect(array('controller' => 'searches', 'action' => 'index'));
		}

                
		$stores = $this->storesList($this->cityId, $this->areaId);

                
		$this->Store->recursive = 0;
		$storeList = $this->Store->find('all', array(
							'conditions' => array('Store.id' => $stores),
							'group' => array('Store.id')));
                

		foreach ($storeList as $key => $value) {
			$ratingDetail = $this->Review->find('first', array(
                              	'conditions'=>array('Review.store_id' => $value['Store']['id']),
								'fields' => array('SUM(Review.rating) AS rating',
												'Count(Review.rating) AS ratingCount')));
			$storeList[$key]['Store']['rating'] = (!empty($ratingDetail[0]['ratingCount'])) ? 
												$ratingDetail[0]['rating']/$ratingDetail[0]['ratingCount'] : 0;
		}

		if (empty($storeList)) {
			$this->Session->setFlash('<p>'.__('Store is not available', true).'</p>', 'default', 
                                          array('class' => 'alert alert-danger'));
			$this->redirect(array('controller' => 'searches', 'action' => 'index'));

		}
		$cityList = $this->getCityinfo();
		
		//$this->set(compact('cityList'));
		/*$this->Session->write('Search.city', $cityId);
		$this->Session->write('Search.area', (isset($areaId)) ? $areaId : '');*/
		$this->set(compact('storeList', 'cityList', 'orderSuccess'));
	}

		
	public function storeitems($storename, $storeId) {
		$this->layout = 'frontend';
		$cityId = $this->Session->read('Search.city');
		$areaId = $this->Session->read('Search.area');
                
              //  if (isset($cityId) && empty($cityId)) {
                    
                
		if (empty($cityId)) {
                    
                   
			$storeSession = $this->Store->find('first', array(
									'conditions' => array('Store.id' => $storeId,
											  				'Store.status' => 1)));
                      
                        
			if (!empty($storeSession)) {
				$this->Session->write('Search.city', $storeSession['Store']['store_city']);
				$cityId = $this->Session->read('Search.city');
			}
		}
		$stores = $this->storesList($cityId, $areaId);
                
		$this->Store->recursive = 0;
		$storeList = $this->Store->find('all', array(
							'conditions' => array('Store.id' => $stores),
							'group' => array('Store.id')));
		foreach ($storeList as $key => $value) {
			$ratingDetail = $this->Review->find('first', array(
                              	'conditions'=>array('Review.store_id' => $value['Store']['id']),
								'fields' => array('SUM(Review.rating) AS rating',
												'Count(Review.rating) AS ratingCount')));
			$storeList[$key]['Store']['rating'] = (!empty($ratingDetail[0]['ratingCount'])) ? 
												$ratingDetail[0]['rating']/$ratingDetail[0]['ratingCount'] : 0;
		}
		$storeDetails = $this->Store->find('first', array(
									'conditions' => array('Store.id' => $storeId,
															'Store.store_city' => $cityId,
											  				'Store.status' => 1)));
		
                if (empty($storeDetails)) {
			$this->redirect(array('controller' => 'searches', 'action' => 'index'));
		}
		if ($storeDetails['Store']['collection'] == 'Yes' ||
			$storeDetails['Store']['delivery'] == 'Yes' &&
			$storeDetails['Store']['delivery_option'] == 'Yes') {
			$productList = $this->Product->find('all', array(
								'conditions' => array('Product.store_id' => $storeId,
									'Product.status' => 1,
									'MainCategory.status' => 1,
									'SubCategory.status' => 1,
									'OR' => array('Store.collection' => 'Yes',
										'Store.delivery'	 => 'Yes')),
								'order' => array('Product.category_id', 'Product.sub_category_id'),
								'group' => array('Product.sub_category_id')));
			if (empty($productList)) {
				$this->redirect(array('controller' => 'searches', 'action' => 'index'));
			}
			$mainCategory = array();
			$subCategoryList = array();
			foreach ($productList as $key => $value) {
				if (!in_array($value['Product']['category_id'], $mainCategory)) {
					$mainCategory[] = $value['Product']['category_id'];
				}
				if (!in_array($value['Product']['sub_category_id'], $subCategoryList)) {
					$subCategoryList[] = $value['Product']['sub_category_id'];
				}
			}
			$mainCategoryList = $this->Category->find('all', array(
				'conditions' => array('Category.status' => 1,
									'Category.parent_id' => 0,
					'OR' => array('Category.id' => $mainCategory))));
			$this->Deal->recursive = 2;
			$dealProducts = $this->Deal->find('all', array(
				'conditions' => array('Deal.store_id' => $storeId,
					'Deal.status' => 1,
					'MainProduct.status' => 1,
				)));
			foreach ($dealProducts as $key => $value) {
				if ($value['MainProduct']['MainCategory']['status'] == 1 &&
					$value['MainProduct']['SubCategory']['status'] == 1
					//&& $value['MainProduct']['Brand']['status'] == 1
				) {

					$dealProduct[] = $value;
				}
			}
		}
		$metaTitle          = $storeDetails['Store']['meta_title'];
		$metakeywords       = $storeDetails['Store']['meta_keywords'];
		$metaDescriptions   = $storeDetails['Store']['meta_description'];

		$cityList = $this->getCityinfo();	
		$this->set(compact('storeList', 'cityList', 'productList', 'storeDetails', 'mainCategoryList',
					'subCategoryList', 'storeId', 'dealProduct', 'metaTitle',
					'metakeywords', 'metaDescriptions'));

	}

	public function productdetails() {

		$this->Product->recursive = 2 ;
		$id 	= $this->request->data['id'];
		$productDetails = $this->Product->find('first', array(
									'conditions' => array('Product.id' => $id)));
		echo $productDetails['ProductDetail'][0]['quantity'].'||@@||';
		$this->set(compact('productDetails'));
	}

	public function variantDetails() {

		$id 	= $this->request->data['id'];
		$productVariantDetails = $this->ProductDetail->find('first', array(
									'conditions' => array('ProductDetail.id' => $id)));
		echo $productVariantDetails['ProductDetail']['quantity'].'||@@||';
		$this->set(compact('productVariantDetails'));
	}


	public function cartProduct() {

		$id 		= $this->request->data['id'];
		$quantity 	= $this->request->data['quantity'];

		$this->ProductDetail->recursive = 2;
		$productDetails = $this->ProductDetail->find('first', array(
										'conditions' => array('ProductDetail.id' => $id)));
		$shopCart = $this->ShoppingCart->find('first', array(
									'conditions' => array('ShoppingCart.session_id' => $this->SessionId,
														  'ShoppingCart.product_id' => $id)));
														 
		if (empty($shopCart)) {

			if ($quantity <= $productDetails['ProductDetail']['quantity']) {

				$deal = $this->Deal->findByMainProduct($productDetails['ProductDetail']['product_id']);

				$shoppingCart['product_id'] 		 = $productDetails['ProductDetail']['id'];
				$shoppingCart['brand_name'] 		 = (isset($productDetails['Product']['Brand']['brand_name'])) ? 
														$productDetails['Product']['Brand']['brand_name'] : '';
				$shoppingCart['session_id'] 		 = $this->SessionId;
				$shoppingCart['product_image']		 = (isset($productDetails['Product']['ProductImage'][0]['image_alias'])) ?
														$productDetails['Product']['ProductImage'][0]['image_alias'] :
														'no-image.jpg';

				// Ternery Operator using product name (Deal or not)
				$shoppingCart['product_name']		= (!empty($deal) && $deal['Deal']['status'] != 0) ? 
																$productDetails['Product']['product_name'].' :: '.
																$productDetails['ProductDetail']['sub_name'].
																'[Deal :: '.$deal['SubProduct']['product_name'].']' :
																$productDetails['Product']['product_name'].' :: '.
																$productDetails['ProductDetail']['sub_name'];

				$shoppingCart['product_price'] 		 = (!empty($productDetails['ProductDetail']['compare_price'])) ? 
																$productDetails['ProductDetail']['compare_price'] :
																$productDetails['ProductDetail']['orginal_price'] ;
				$shoppingCart['category_name'] 		 = $productDetails['Product']['MainCategory']['category_name'];
				$shoppingCart['product_quantity'] 	 = $quantity;
				$shoppingCart['store_id']			 = $productDetails['Product']['store_id'];
				$shoppingCart['sub_category_name'] 	 = $productDetails['Product']['SubCategory']['category_name'];
				$shoppingCart['product_total_price'] = $shoppingCart['product_price'] * $quantity;
				if ($this->ShoppingCart->save($shoppingCart, null, null)) {
					echo 'Success';
				}
			}
		} else {
			$productQuantity = $shopCart['ShoppingCart']['product_quantity'] + $quantity;

			if ($productQuantity <= $productDetails['ProductDetail']['quantity']) {

				$shoppingCart = $shopCart;
				$shoppingCart['ShoppingCart']['product_quantity'] 	 = $productQuantity;
				$shoppingCart['ShoppingCart']['product_total_price'] = $shoppingCart['ShoppingCart']['product_price'] * $productQuantity;

				if ($this->ShoppingCart->save($shoppingCart, null, null)) {
					echo 'Success';
				}
			}
		}
		exit();
	}

	public function cart() {

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

               
                
		echo (!empty($cartCount[0]['productCount'])) ? $cartCount[0]['productCount'] : 0;
		echo '||@@||';
		echo (!empty($total[0][0]['cartTotal'])) ? $total[0][0]['cartTotal'] : 0;
		echo '||@@||';
		$this->set('cartTotal', $total[0][0]['cartTotal']);
		$this->set(compact('storeCart','storeProduct', 'cartCount'));
	}
        
        
        public function header_data_cart() {

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

                
             $html = "";
                
             if(!empty($storeCart)){
				
                foreach ($storeCart as $key => $value) {
                    
                
              $html .= '<li>
                  <a href="#">
                      <div class="productblock clearfix">
					  <h5 proid="'.$value['ProductDetail']['product_id'].'" style="display:none;"></h5>
                          <div class="prodtag pull-left">
                              <h2>';
                                  
                                

							if ($value['ShoppingCart']['product_quantity'] < $value['ProductDetail']['quantity']) { 
                                                  $html .= '<a rel="'.$value["ShoppingCart"]["product_id"].'" class="change-qty qty-inc pointer" onclick="qtyIncrement('.$value["ShoppingCart"]["id"].','.$value["ShoppingCart"]["product_id"].')" >
									<span class="up"></span>
								</a>'; 
							} else { 

								 $html .= '<a class="change-qty qty-inc" >
									<span class="up"></span>
								</a> ';
							} 
                                  
                                 $html .= '<span class="num">'. $value["ShoppingCart"]["product_quantity"].'</span>';
                                  
                                 
							if ($value["ShoppingCart"]["product_quantity"] > 1) { 
							 $html .= '<a rel="'. $value["ShoppingCart"]["product_id"].'" class="change-qty qty-dec pointer" onclick="qtyDecrement('.$value["ShoppingCart"]["id"].','.$value["ShoppingCart"]["product_id"].')">
									 <span class="down"></span>
								</a>'; 
							} 
                                                        elseif($value["ShoppingCart"]["product_quantity"] == 1){
                                                            
                                                      
                                                         $html .= '<a rel="'.$value["ShoppingCart"]["product_id"].'" class="change-qty qty-dec pointer" onclick="deleteCart('.$value["ShoppingCart"]["id"].','.$value['ProductDetail']['product_id'].');">
									 <span class="down"></span>
								</a>';
                                                      
                                                        
                                                        }
                                                        else { 
								 $html .= '<a class="change-qty qty-dec">
									 <span class="down"></span>
								</a> ';

							} 
                                 
                              
                             $html .= '  </h2>
                          </div>
                          <div class="prodimg pull-left">';
                              
                             //  $imageSrc = "https://s3.amazonaws.com/".$this->siteBucket."/stores/products/carts/".$value["ProductDetail"]["Product"]["ProductImage"][0]["image_alias"];
                             
                    $imageSrc = "https://dnrskjoxjtgst.cloudfront.net/stores/products/home/".$value["ShoppingCart"]["product_image"];
                             
                               $html .= '<img src="'.$imageSrc.'"  alt="'.$value["ShoppingCart"]["product_name"].'" title="'.$value["ShoppingCart"]["product_name"].'" onerror="this.onerror=null;this.src='. $siteUrl.'/images/no-imge.jpg" />';
                           
                         $html .= ' </div>
                          <div class="producttitle pull-left">
                              <p>'. $value["ShoppingCart"]["product_name"].'</p>
                                  
                            

                              <span class="productprize"> '.html_entity_decode('&euro;').' '. $value["ShoppingCart"]["product_total_price"].'</span></div>
                      </div>
                  </a>
              
              </li>';
              
                     
                }  
                
                
              //  $html .= 'sdsd'.$loggedUser["role_id"];
          
		//if ($loggedUser['role_id'] == 4) { 
		//	$html .= '<a class="btn checkout" href="'.$this->siteUrl.'/checkouts/index">Checkout </a> ';
		//} else {
		//	$html .= '<a class="btn checkout" href="'.$this->siteUrl.'/customer/users/customerlogin?page=checkout">Checkout </a> ';
		//} 
             }
             else{
                
             $html .= '<div class="cart-checkout">';
	     $html .= '<a class="btn-checkout">Cart is Empty</a>';
             $html .= '</div>';
             }  
                echo $html;
                
                //die;
		//echo (!empty($cartCount[0]['productCount'])) ? $cartCount[0]['productCount'] : 0;
		//echo '||@@||';
		//echo (!empty($total[0][0]['cartTotal'])) ? $total[0][0]['cartTotal'] : 0;
		//echo '||@@||';
		//$this->set('cartTotal', $total[0][0]['cartTotal']);
		//$this->set(compact('storeCart','storeProduct', 'cartCount'));
	}

        
         public function header_cart() {

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

                
             $html = "";
                
             if(!empty($storeCart)){
                foreach ($storeCart as $key => $value) {
              $html .= '<li>
                  <a href="#">
                      <div class="productblock clearfix">
					  <h5 proid="'.$value['ProductDetail']['product_id'].'" style="display:none;"></h5>
                          <div class="prodtag pull-left">
                              <h2>';
                                  
                                

							if ($value['ShoppingCart']['product_quantity'] < $value['ProductDetail']['quantity']) { 
                                                  $html .= '<a rel="'.$value["ShoppingCart"]["product_id"].'" class="change-qty qty-inc pointer" onclick="qtyIncrement('.$value["ShoppingCart"]["id"].','.$value["ShoppingCart"]["product_id"].')" >
									<span class="up"></span>
								</a>'; 
							} else { 

								 $html .= '<a class="change-qty qty-inc" >
									<span class="up"></span>
								</a> ';
							} 
                                  
                                 $html .= '<span class="num">'. $value["ShoppingCart"]["product_quantity"].'</span>';
                                  
                                 
							if ($value["ShoppingCart"]["product_quantity"] > 1) { 
							 $html .= '<a rel="'. $value["ShoppingCart"]["product_id"].'" class="change-qty qty-dec pointer" onclick="qtyDecrement('.$value["ShoppingCart"]["id"].','.$value["ShoppingCart"]["product_id"].')">
									 <span class="down"></span>
								</a>'; 
							} 
                                                        elseif($value["ShoppingCart"]["product_quantity"] == 1){
                                                            
                                                      
                                                         $html .= '<a rel="'.$value["ShoppingCart"]["product_id"].'" class="change-qty qty-dec pointer" onclick="deleteCart('.$value["ShoppingCart"]["id"].','.$value['ProductDetail']['product_id'].');">
									 <span class="down"></span>
								</a>';
                                                      
                                                        
                                                        }
                                                        else { 
								 $html .= '<a class="change-qty qty-dec">
									 <span class="down"></span>
								</a> ';

							} 
                                 
                              
                             $html .= '  </h2>
                          </div>
                          <div class="prodimg pull-left">';
                              
                             //  $imageSrc = "https://s3.amazonaws.com/".$this->siteBucket."/stores/products/carts/".$value["ProductDetail"]["Product"]["ProductImage"][0]["image_alias"];
                             
                    $imageSrc = "https://dnrskjoxjtgst.cloudfront.net/stores/products/home/".$value["ShoppingCart"]["product_image"];
                             
                               $html .= '<img src="'.$imageSrc.'"  alt="'.$value["ShoppingCart"]["product_name"].'" title="'.$value["ShoppingCart"]["product_name"].'" onerror="this.onerror=null;this.src='. $siteUrl.'/images/no-imge.jpg" />';
                           
                         $html .= ' </div>
                          <div class="producttitle pull-left">
                              <p>'. $value["ShoppingCart"]["product_name"].'</p>
                                  
                              <span class="productprize">'.html_entity_decode('&euro;').' '. $value["ShoppingCart"]["product_total_price"].'</span></div>
                      </div>
                  </a>
              
              </li>';
              
                     
                }  
                
                
             //   $html .= 'sdsd'.$this->Auth->user('role_id');
          
		//if ($this->Auth->user('role_id') == 4) { 
		//	$html .= '<a class="btn checkout" href="'.$this->siteUrl.'/checkouts/index">Checkout </a> ';
		//} else {
		//	$html .= '<a class="btn checkout" href="'.$this->siteUrl.'/customer/users/customerlogin?page=checkout">Checkout </a> ';
		//} 
             }
             else{
                
             $html .= '<div class="cart-checkout">';
	     $html .= '<a class="btn-checkout">Cart is Empty</a>';
             $html .= '</div>';
             }  
                echo $html;
                
                //die;
		//echo (!empty($cartCount[0]['productCount'])) ? $cartCount[0]['productCount'] : 0;
		//echo '||@@||';
		//echo (!empty($total[0][0]['cartTotal'])) ? $total[0][0]['cartTotal'] : 0;
		//echo '||@@||';
		//$this->set('cartTotal', $total[0][0]['cartTotal']);
		//$this->set(compact('storeCart','storeProduct', 'cartCount'));
	}
        
        
        public function header_array_data_cart() {

		
		$storeCart = $this->ShoppingCart->find('all', array(
								'conditions' => array('ShoppingCart.session_id' => $this->SessionId),
								'order' => array('ShoppingCart.store_id')));
                
                return $storeCart;

        }
        

	public function descriptionAdd() {

		$id 	= $this->request->data['id'];
		$description 	= $this->request->data['productDescription'];

		$shopCartDetails = $this->ShoppingCart->findById($id);
		$shopCartDetails['ShoppingCart']['product_description'] = $description;
		if ($this->ShoppingCart->save($shopCartDetails, null, null)) {
			echo 'success';
		}
		exit();

	}

	public function deleteCart() {

		$id 	= $this->request->data['id'];
		$this->ShoppingCart->delete($id);
		exit(); 
	}

	public function qtyUpdate() {

		$id 	= $this->request->data['id'];
		$type 	= $this->request->data['type'];

		$shopCart = $this->ShoppingCart->findById($id);

		if ($type == 'increment') {
			$shopCart['ShoppingCart']['product_quantity'] += 1;
		} else {
			$shopCart['ShoppingCart']['product_quantity'] -= 1;
		}

		if ($shopCart['ShoppingCart']['product_quantity'] <= $shopCart['ProductDetail']['quantity'] &&
			$shopCart['ShoppingCart']['product_quantity'] != 0) {

			$shopCart['ShoppingCart']['product_total_price'] = $shopCart['ShoppingCart']['product_price'] * $shopCart['ShoppingCart']['product_quantity'];

			$this->ShoppingCart->save($shopCart, null, null);

		}
		exit();
	}


	public function changeLocation() {
		
		$location 	= (isset($this->request->data['location'])) ? $this->request->data['location'] : '';

		$this->ShoppingCart->deleteAll(array("session_id"=> $this->SessionId,
											'ShoppingCart.order_id' => 0));

		$this->Session->write("preSessionid",'');

		session_regenerate_id();

		 if (!empty($location)) {
			 
			$this->Session->write("Search.city",'');
			$this->Session->write("Search.area",'');
			echo "success";
			exit();
		}
		return 1; 
		
	}
	

	public function locations() {

		$id 	= $this->request->data['id'];
		$model 	= $this->request->data['model'];
		$stores = array();

		$storeLists = $this->Product->find('all', array(
								'conditions' => array(
													'Store.status' => 1,
													'Store.store_city' => $id,
													'Product.status' => 1,
													'MainCategory.status' => 1,
													'SubCategory.status' => 1,
													//'Store.delivery_option' => 'Yes',
													//'Brand.status' => 1,
										'OR' => array('Store.collection' => 'Yes',
												  	  'Store.delivery'	 => 'Yes')),
								'group' => array('Store.id')));

		foreach ($storeLists as $key => $value) {

			if ($value['Store']['collection'] == 'Yes' ||
				$value['Store']['delivery'] == 'Yes' &&
				$value['Store']['delivery_option'] == 'Yes') {
				$stores[] = $value['Store']['id'];
			}
		}

		$storeList = $this->DeliveryLocation->find('all', array(
							'conditions' => array('DeliveryLocation.location_id !=' => '',
												  'DeliveryLocation.store_id' => $stores,
												  'Location.status' => 1
												  ),
							'group' => array('DeliveryLocation.location_id')
												  ));
		

		foreach ($storeList as $key => $value) {
			if ($this->siteSetting['Sitesetting']['search_by'] == 'zip') {
				$locations[$value['Location']['id']] = $value['Location']['zip_code'];
			} else {
				$locations[$value['Location']['id']] = $value['Location']['area_name'];
			}
		}

		$this->set(compact('model', 'locations'));
	}


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
				echo $value['Store']['store_name'].' Minimum order '. $value['Store']['minimum_order'];
			}
		}
		exit();
	}


	public function storeOffer() {

		$id 	= $this->request->data['id'];
		$today 	= date("m/d/Y");
		$storeOffers = $this->Storeoffer->find('first', array(
							'conditions' => array(
												'Storeoffer.store_id' => $id,
												'Storeoffer.status' => 1,
												"Storeoffer.from_date <=" => $today,
												"Storeoffer.to_date >="   => $today),
							'order' => 'Storeoffer.id DESC'));
		$this->set(compact('storeOffers'));
	}
	public function filtterByCategory(){
		$id      = $this->request->data['id'];
		$storeId = $this->request->data['storeId'];
		$count   = $this->request->data['count'];
		$searchKey   = (!empty($this->request->data['searchKey'])) ? trim($this->request->data['searchKey']) : '';

		$subId 	 = isset($this->request->data['subId']) ? $this->request->data['subId'] : '';
		$productList = array();

		if (!empty($subId)) {
			$productList = $this->Product->find('all', array(
									'conditions' => array('Product.category_id' => $id,
														'Product.status' => 1,
														'MainCategory.status' => 1,
														'SubCategory.status' => 1,
														'Product.store_id'=>$storeId,
														'Product.sub_category_id' => $subId),
									'order' => array('Product.category_id', 'Product.sub_category_id')));
		} elseif (!empty($searchKey)) {

			$productList = $this->Product->find('all', array(
									'conditions' => array('Product.category_id' => $id,
														'Product.status' => 1,
														'MainCategory.status' => 1,
														'SubCategory.status' => 1,
														'Product.store_id'=>$storeId,
														"Product.product_name LIKE" => "%".$searchKey."%"),
									'order' => array('Product.category_id', 'Product.sub_category_id')));
		} else {

			$subcategory = $this->Category->find('list', array(
									'conditions' =>array('Category.parent_id' => $id)));
			
			foreach ($subcategory as $key => $value) {
				$productLists = $this->Product->find('all', array(
									'conditions' => array('Product.category_id' => $id,
														'Product.status' => 1,
														'MainCategory.status' => 1,
														'SubCategory.status' => 1,
														'Product.store_id'=>$storeId,
														'Product.sub_category_id' => $value),
									'order' => array('Product.category_id', 'Product.sub_category_id'),
									'limit' => 6));
				if(!empty($productLists)) {

					foreach ($productLists as $key => $value) {

						if (isset($productLists[5])) {
							$value['moreProduct'] = 1;
						}
						$productList[] = $value;
					}
				}
			}
		}
                
                $session_data = $this->SessionId;
                
		$this->set(compact('productList', 'count','session_data'));
	}

	public function dealProducts() {

		$storeId = $this->request->data['storeId'];

		$this->Deal->recursive = 2;
		$dealProduct = $this->Deal->find('all', array(
							'conditions' => array('Deal.store_id' => $storeId,
											'Deal.status' => 1,
											'MainProduct.status' => 1,
										),
							'order' => array('MainProduct.category_id', 'MainProduct.sub_category_id')));

		$mainCategory = array();
		$subCategory = array();
		$main = $subCount = 0;

		foreach ($dealProduct as $key => $value) {
			if ($value['MainProduct']['MainCategory']['status'] == 1 &&
				$value['MainProduct']['SubCategory']['status'] == 1
			) {
				if ($subCount <= 2) {
					$dealProducts[] = $value;
				}
			}
		}
		$this->set(compact('dealProducts', 'mainCategoryList', 'subCategoryList'));
	}
	public function getGroceryStores()
	{
		$storeLists = $this->Stores->find('all');
		return $storeLists;
	}
	public function getRelatedCount($tbl)
	{
		$count = $this->$tbl->find('count');
		return $count;
	}
	public function ajaxpromotionalSignup()
	{
		$data = $this->request->query;
		$ProList = $this->Proreg->find('list', array(
								'conditions' => array('Proreg.email' => $data['email']),
								'fields' => array('Proreg.id')));
		if(count($ProList) > 0)
		{
			$returns['status'] = 0;
			$returns['msg']= '<span style="color:red;">Email alredy Exist.</span>';
		}
		else
		{
		$this->Proreg->set($this->request->query);
		$data = $this->Proreg->save();
		if($data['Proreg']['id'] == '')
		{
			$returns['status'] = 0;
			$returns['msg']= '<span style="color:red;">Email is not valid.</span>';
		}
		else
		{
			$returns['status'] = 1;
			$returns['msg']= '<span style="color:green;">You are successfully registered.</span>';
		}
		}
		echo json_encode($returns); exit;
	}
	public function getCityinfo()
	{
		$siteCountry = $this->siteSetting['Sitesetting']['site_country'];
		$cityLists = $this->City->find('list', array(
								'conditions' => array('City.country_id' => $siteCountry,
													'City.status' => 1),
								'fields' => array('City.id', 'City.city_name')));
		foreach ($cityLists as $key => $value) {
			$storeDetails = $this->Product->find('first', array(
									'conditions' => array(
														'Store.status' => 1,
														'Store.store_city' => $key,
														'Product.status' => 1,
														'MainCategory.status' => 1,
														'SubCategory.status' => 1,
														//'Store.delivery_option' => 'Yes',
														//'Brand.status' => 1,
										'OR' => array('Store.collection' => 'Yes',
												  	  'Store.delivery'	 => 'Yes')),
									));
			if (!empty($storeDetails)) {
				$cityList[$key] = $value;
				/*if ($storeDetails['Store']['collection'] == 'Yes' ||
					$storeDetails['Store']['delivery'] == 'Yes' &&
					$storeDetails['Store']['delivery_option'] == 'Yes') {
					$cityList[$key] = $value;
				}*/
			}
		}
	
                return $cityList;
	}
        
        public function aboutus(){
            $this->layout = 'frontend';
             $this->set('aboutus');
        }
        
}