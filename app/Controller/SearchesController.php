<?php

/* MN */

App::uses('AppController', 'Controller');


class SearchesController extends AppController {

	var $helpers = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');

	public $uses = array('City', 'Location', 'Store', 'Product', 'Category',
						'ProductDetail', 'ShoppingCart', 'Storeoffer', 'Deal',
						'DeliveryLocation', 'Review');

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

		$this->changeLocation();

		if (!empty($this->request->data['Search']['city'])) {

			$cityId = $this->request->data['Search']['city'];
			$areaId = $this->request->data['Search']['area'];

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

	public function stores($cityName, $cityId, $areaName, $areaId) {


		$this->layout = 'frontend';
		$orderSuccess = '';
		if ($this->Session->read('orderplaced')) {
			$orderSuccess = $this->Session->read('orderplaced');
			$this->changeLocation();
			$this->Session->delete('orderplaced');
		}

		$storeLists = $this->Product->find('all', array(
							'conditions' => array(
												'Store.status' => 1,
												'Store.store_city' => $cityId,
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

		$this->Session->write('Search.city', $cityId);
		$this->Session->write('Search.area', $areaId);

		$this->set(compact('storeList', 'orderSuccess'));

	}

	public function storeitems($storename, $storeId) {

		$this->layout = 'frontend';


		$cityId = $this->Session->read('Search.city');
		$areaId = $this->Session->read('Search.area');

		$storeLists = $this->Product->find('all', array(
			'conditions' => array(
				'Store.status' => 1,
				'Store.store_city' => $cityId,
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
											'conditions' => array('Store.id' => $storeId)));

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
								'order' => array('Product.category_id', 'Product.sub_category_id')));

			$mainCategory = array();
			$subCategory = array();

			foreach ($productList as $key => $value) {
				if (!in_array($value['Product']['category_id'], $mainCategory)) {
					$mainCategory[] = $value['Product']['category_id'];
				}

				if (!in_array($value['Product']['sub_category_id'], $subCategory)) {
					$subCategory[] = $value['Product']['sub_category_id'];
				}
			}

			$mainCategoryList = $this->Category->find('all', array(
				'conditions' => array('Category.status' => 1,
					'OR' => array('Category.id' => $mainCategory))));

			$subCategoryList = $this->Category->find('list', array(
				'conditions' => array('Category.status' => 1,
					'OR' => array('Category.id' => $subCategory))));

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


		$this->set(compact('storeList', 'productList', 'storeDetails', 'mainCategoryList',
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
				$shoppingCart['brand_name'] 		 = ($productDetails['Product']['Brand']['brand_name']) ? 
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
		
		$this->ShoppingCart->recursive = 3;
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

		$location 	= $this->request->data['location'];

		$this->ShoppingCart->deleteAll(array("session_id"=> $this->SessionId,
											'ShoppingCart.order_id' => 0));

		$this->Session->write("preSessionid",'');

		session_regenerate_id();

		if (!empty($location)) {
			$this->Session->write("Search.city",'');
			$this->Session->write("Search.area",'');
			exit();
		}
		return 1;
		
	}


	public function locations() {

		$id 	= $this->request->data['id'];
		$model 	= $this->request->data['model'];

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
		$today= date("m/d/Y");
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
		$storeid = $this->request->data['storeid'];
		$count   = $this->request->data['count'];
		$productList = $this->Product->find('all', array(
			'conditions' => array('Product.category_id' => $id,
				'Product.status' => 1,
				'MainCategory.status' => 1,
				'SubCategory.status' => 1,
				'Product.store_id'=>$storeid,
				'OR' => array('Store.collection' => 'Yes',
					'Store.delivery'	 => 'Yes')),
			'order' => array('Product.category_id', 'Product.sub_category_id')));

		$mainCategory = array();
		$subCategory = array();

		foreach ($productList as $key => $value) {
			if (!in_array($value['Product']['category_id'], $mainCategory)) {
				$mainCategory[] = $value['Product']['category_id'];
			}

			if (!in_array($value['Product']['sub_category_id'], $subCategory)) {
				$subCategory[] = $value['Product']['sub_category_id'];
			}
		}

		$mainCategoryList = $this->Category->find('all', array(
			'conditions' => array('Category.status' => 1,
				'OR' => array('Category.id' => $mainCategory))));

		$subCategoryList = $this->Category->find('list', array(
			'conditions' => array('Category.status' => 1,
				'OR' => array('Category.id' => $subCategory))));

		$this->set(compact('productList', 'mainCategoryList',
			'subCategoryList', 'count'));
	}

}