<?php

/* MN */
App::uses('AppController', 'Controller');

class DealsController extends AppController {

	var $helpers       = array('Html', 'Session', 'Javascript', 'Ajax', 'Common');
	public $uses       = array('Deal', 'Store', 'Product');


	public function admin_index() {
		$deals = $this->Deal->find('all', array(
									'group' => array('Deal.id'),
									'conditions'=>array('NOT'=>array('Deal.status'=>3)),
									'order'=>'Deal.id DESC'));
		$this->set(compact('deals'));
	}
	public function store_index() {
		$this->layout  = 'assets';
    	$id = $this->Auth->User();
		$deals = $this->Deal->find('all', array(
									'group' => array('Deal.id'),
									'conditions'=>array(
									'Deal.store_id'=>$id['Store']['id'],
									'NOT'=>array('Deal.status'=>3)),
									'order'=>'Deal.id DESC'));
		$this->set(compact('deals'));
	}
	public function admin_add() {

		if (!empty($this->request->data)) {

			$dealData = $this->Deal->find('first', array(
            					'conditions' => array('Deal.deal_name'=>trim($this->request->data['Deal']['deal_name']),
                                                    'Deal.store_id' => $this->request->data['Deal']['store_id'])));

			if (!empty($dealData)) {
                    $this->Session->setFlash('<p>'.__('Deal Name already exists', true).'</p>', 'default', 
                                                              array('class' => 'alert alert-danger'));
            } else {
            	if ($this->Deal->save($this->request->data, null, null)) {
            		$this->Session->setFlash('<p>'.__('Your Deal has been saved', true).'</p>', 'default', 
                                                  array('class' => 'alert alert-success'));
                	$this->redirect(array('controller' => 'deals','action' => 'index'));
            	}
			}
		}
		$stores = $this->Store->find('list', array(
								'conditions'=>array('Store.status'=>1),
                              'fields' => array('Store.id', 'Store.store_name')));

		$this->set(compact('stores'));

	}
	public function store_add() {
		$this->layout  = 'assets';
		$id 		   = $this->Auth->User();
		if (!empty($this->request->data)) {

			$dealData = $this->Deal->find('first', array(
            					'conditions' => array('Deal.deal_name'=>trim($this->request->data['Deal']['deal_name']),
                                                    'Deal.store_id' => $id['Store']['id'])));

			if (!empty($dealData)) {
                    $this->Session->setFlash('<p>'.__('Deal Name already exists', true).'</p>', 'default', 
                                                              array('class' => 'alert alert-danger'));
            } else {
            	$this->request->data['Deal']['store_id'] =  $id['Store']['id'];         	
            	if ($this->Deal->save($this->request->data, null, null)) {
            		$this->Session->setFlash('<p>'.__('Your Deal has been saved', true).'</p>', 'default', 
                                                  array('class' => 'alert alert-success'));
                	$this->redirect(array('controller' => 'deals','action' => 'index'));
            	}
			}
		}


		$productss = $this->Product->find('all', array(
							'conditions'=> array(
											'Product.store_id' => $id['Store']['id'],
											'Product.status'=>1,
											'Deal.id' => ''),
     						'fields' => array('id','product_name')));
		
		foreach ($productss as $key => $value) {
			$products[$value['Product']['id']] = $value['Product']['product_name'];
		}



		$subproducts = $this->Product->find('list', array(
                                'conditions'=> array('Product.store_id' => $id['Store']['id'],
                                					'Product.status'=>1),
     							'fields' => array('id','product_name')));
		
		$this->set(compact('products', 'subproducts'));


	}


	public function admin_edit($id = null) {

		if (!empty($this->request->data)) {

			$dealData = $this->Deal->find('first', array(
								'conditions' => array(
                                      'Deal.deal_name' =>trim($this->request->data['Deal']['deal_name']),
                                      'Deal.store_id' => $this->request->data['Deal']['store_id'],
                                      'NOT' => array('Deal.id' => $this->request->data['Deal']['id']))));

			if(!empty($dealData)) {
                $this->Session->setFlash('<p>'.__('Deal name already exists', true).'</p>', 'default', 
                                                            array('class' => 'alert alert-danger'));
          	} else {

          		if ($this->Deal->save($this->request->data, null, null)) {
            		$this->Session->setFlash('<p>'.__('Your Deal has been saved', true).'</p>', 'default', 
                                                  array('class' => 'alert alert-success'));
                	$this->redirect(array('controller' => 'deals','action' => 'index'));
            	}
            }
		}	

		$stores = $this->Store->find('list', array(
                              'fields' => array('Store.id', 'Store.store_name')));
		$getDealData = $this->Deal->findById($id);
		$this->request->data = $getDealData;
		$this->Product->recursive = 0;
		$productss = $this->Product->find('all', array(
							'conditions'=> array(
											'Product.store_id' => $getDealData['Deal']['store_id'],
											'Product.status'=>1,
                                			'OR' => array('Product.id' => $getDealData['Deal']['main_product'],
                                							'Deal.id' => '')),
     						'fields' => array('id','product_name')));
		
		foreach ($productss as $key => $value) {
			$products[$value['Product']['id']] = $value['Product']['product_name'];
		}

		$subproducts = $this->Product->find('list', array(
							'conditions'=> array(
											'Product.store_id' => $getDealData['Deal']['store_id'],
											'Product.status'=>1),
     						'fields' => array('id','product_name')));
		$this->set(compact('stores', 'products', 'subproducts'));

	}
	public function store_edit($id = null) {
		$this->layout  = 'assets';
		$ids		   = $this->Auth->User();
		if (!empty($this->request->data)) {

			$dealData = $this->Deal->find('first', array(
                                      'conditions' => array(
                                      'Deal.deal_name' =>trim($this->request->data['Deal']['deal_name']),
                                      'Deal.store_id' => $ids['store_id']['id'],
                                      'NOT' => array('Deal.id' => $this->request->data['Deal']['id']))));
			if(!empty($dealData)) {
                $this->Session->setFlash('<p>'.__('Deal name already exists', true).'</p>', 'default', 
                                                            array('class' => 'alert alert-danger'));
          	} else {

          		if ($this->Deal->save($this->request->data, null, null)) {
            		$this->Session->setFlash('<p>'.__('Your Deal has been saved', true).'</p>', 'default', 
                                                  array('class' => 'alert alert-success'));
                	$this->redirect(array('controller' => 'deals','action' => 'index'));
            	}
            }

		}
		$getDealData = $this->Deal->findById($id);
			
		$this->request->data = $getDealData;

		$productss = $this->Product->find('all', array(
							'conditions'=> array(
											'Product.store_id' => $getDealData['Deal']['store_id'],
											'Product.status'=>1,
                                	'OR' => array('Product.id' => $getDealData['Deal']['main_product'],
                                					'Deal.id' => '')),
     						'fields' => array('id','product_name')));
		
		foreach ($productss as $key => $value) {
			$products[$value['Product']['id']] = $value['Product']['product_name'];
		}



		$subproducts = $this->Product->find('list', array(
                                'conditions'=> array('Product.store_id' => $getDealData['Deal']['store_id'],
                                					'Product.status'=>1),
     							'fields' => array('id','product_name')));
		
		$this->set(compact('products', 'subproducts'));

	}
    public function admin_productList() {
		$id 	= $this->request->data['id'];
		$model 	= $this->request->data['model'];
		$this->Product->recursive = 0;
		switch (trim($model)) {
        	case 'mainProduct':
				$productss = $this->Product->find('all', array(
									'conditions'=> array(
                              						'Product.store_id' => $id,
                              						'Deal.id' => '',
                              						'Product.status'=>1),
     								'fields' => array('id','product_name')));

				foreach ($productss as $key => $value) {
					$products[$value['Product']['id']] = $value['Product']['product_name'];
				}
			break;

			case 'subProduct':
				$products = $this->Product->find('list', array(
									'conditions'=> array('Product.store_id' => $id,
															'Product.status'=>1),
     								'fields' => array('id','product_name')));
			break;
		}

		$this->set(compact('products'));
	}	
}