<?php
/* janakiraman */
App::uses('AppController','Controller');
class BrandsController extends AppController {    
  public $helpers = array('Html','Form', 'Session', 'Javascript');  
  public $uses    = array('Brand');  
  /**
   * BrandsController::admin_index()
   * Brand Management  Process
   * @return void
   */
  public function admin_index() {
    
  	$brand_list = $this->Brand->find('all',array(
                    'conditions'=>array('NOT'=>array('Brand.status'=>3)),
                    'order'=>array('Brand.id DESC')));
    $this->set('brand_list',$brand_list);
  }
  /**
   * BrandsController::admin_add()
   * Brand Add Process
   * @return void
   */
  public function admin_add(){
     if($this->request->is('post')) {
      $brand_check = $this->Brand->find('all',array(
                            'conditions'=>array(
                            'brand_name'=>
                            trim($this->request->data['Brand']['brand_name'])
                            )));
      if(!empty($brand_check)) {
        $this->Session->setFlash('<p>'.__('Unable to add your Brand', true).'</p>', 'default', 
                                          array('class' => 'alert alert-danger'));
      } else {
        $this->Brand->save($this->request->data,null,null);
        $this->Session->setFlash('<p>'.__('Your Brand has been saved', true).'</p>', 'default', 
                                          array('class' => 'alert alert-success'));
        $this->redirect(array('controller' => 'Brands','action' => 'index'));
      }
    }    
  }
   /**
    * BrandsController::admin_edit()
    * Brand Edit Process
    * @param mixed $id
    * @return void
    */
   public function admin_edit($id = null) {
    if(!empty($this->request->data['Brand']['brand_name'])) {
        $Brand = $this->Brand->find('all',array(
                       'conditions'=>array(
                        'OR'=>array(array(
                        'brand_name'=>trim($this->request->data['Brand']['brand_name'])))
                      )));
      if(!empty($Brand)) {
          $this->Session->setFlash('<p>'.__('Unable to add your Brand', true).'</p>', 'default', 
                                              array('class' => 'alert alert-danger'));
      } else {
            $this->Brand->save($this->request->data,null,null);
            $this->Session->setFlash('<p>'.__('Your Brand has been saved', true).'</p>', 'default', 
                                              array('class' => 'alert alert-success'));
            $this->redirect(array('controller' => 'Brands','action' => 'index'));
      }
    } 
    $getStateData        = $this->Brand->findById($id);
    $this->request->data = $getStateData;
  }  
  public function store_index() {
      $this->layout  = 'assets';
      $id            = $this->Auth->User();
      $brand_list   = $this->Brand->find('all',array(
                        'conditions'=>array(
                        'NOT'=>array('Brand.status'=>3)),
                        'order'=>array('Brand.id DESC')));
      $this->set('brand_list',$brand_list);
  } 
   public function store_add() {
      $this->layout  = 'assets';
      if($this->request->is('post')) {

      $brand_check = $this->Brand->find('all',array(
                            'conditions'=>array(
                            'Brand.brand_name'=>
                            trim($this->request->data['Brand']['brand_name'])
                            )));
      if(!empty($brand_check)) {
        $this->Session->setFlash('<p>'.__('Unable to add your Brand', true).'</p>', 'default', 
                                          array('class' => 'alert alert-danger'));
      } else {
        $this->Brand->save($this->request->data,null,null);
        $this->Session->setFlash('<p>'.__('Your Brand has been saved', true).'</p>', 'default', 
                                          array('class' => 'alert alert-success'));
        $this->redirect(array('controller' => 'Brands','action' => 'index'));
      }
    }    
    
  } 
  public function store_edit($id = null) {
    $this->layout  = 'assets';
    if(!empty($this->request->data['Brand']['brand_name'])) {
        $Brand = $this->Brand->find('all',array(
                       'conditions'=>array(
                        'OR'=>array(array(
                        'brand_name'=>trim($this->request->data['Brand']['brand_name'])))
                      )));
      if(!empty($Brand)) {
          $this->Session->setFlash('<p>'.__('Unable to add your Brand', true).'</p>', 'default', 
                                              array('class' => 'alert alert-danger'));
      } else {
            $this->Brand->save($this->request->data,null,null);
            $this->Session->setFlash('<p>'.__('Your Brand has been saved', true).'</p>', 'default', 
                                              array('class' => 'alert alert-success'));
            $this->redirect(array('controller' => 'Brands','action' => 'index'));
      }
    } 
    $getStateData        = $this->Brand->findById($id);
    $this->request->data = $getStateData;
  }  
}