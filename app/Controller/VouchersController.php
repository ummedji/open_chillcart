<?php
/* janakiraman */
App::uses('AppController','Controller');
class VouchersController extends AppController {    
  public $helpers = array('Html','Form', 'Session', 'Javascript');
  public $uses    = array('Voucher');
  /**
   * VouchersController::admin_index()
   * Display detail of voucher management
   * @return void
   */
  public function admin_index() {
    $status          = 1;
  	$Voucher_list    = $this->Voucher->find('all',array(
                                            'conditions'=>array(
                                            'NOT'=>array('Voucher.status'=>3)),
                                            'order'=>array('Voucher.id DESC')));
    $this->set('Voucher_list',$Voucher_list);
  } 
  /**
   * VouchersController::admin_add()
   * Add Vocher Detail
   * @return void
   */
  public function admin_add() {
    if($this->request->data['Voucher']['voucher_code'] != null){
        $voucher     = $this->Voucher->find('all',array(
                                'conditions'=>array(
                                'voucher_code'=>trim($this->request->data['Voucher']['voucher_code']))
                                            ));                             
        if(!empty($voucher)) {
            $this->Session->setFlash('<p>'.__('Unable to add your Voucher', true).'</p>', 'default', 
                                              array('class' => 'alert alert-danger'));
        } else {
            $this->Voucher->save($this->request->data,null,null);
            $this->Session->setFlash('<p>'.__('Your Voucher has been saved', true).'</p>', 'default', 
                                              array('class' => 'alert alert-success'));
            $this->redirect(array('controller' => 'Vouchers','action' => 'index'));
        }
    } 
  } 
   /**
    * VouchersController::admin_edit()
    * Edit Vocher Detail
    * @param mixed $id
    * @return void
    */
  public function admin_edit($id = null) {
    if(!empty($this->request->data['Voucher']['voucher_code'])){        
        $voucher   = $this->Voucher->find('all',array(
                              'conditions'=>array(
                              'Voucher.voucher_code'=> trim($this->request->data['Voucher']['voucher_code']),
                              'NOT'=>array('Voucher.id'=>trim($this->request->data['Voucher']['id'])))
                                          ));
        if(!empty($voucher)) {
             $this->Session->setFlash('<p>'.__('Unable to add your voucher', true).'</p>', 'default', 
                                          array('class' => 'alert alert-danger'));
        } else {
            $this->Voucher->save($this->request->data,null,null);
            $this->Session->setFlash('<p>'.__('Your voucher has been saved', true).'</p>', 'default', 
                                              array('class' => 'alert alert-success'));
            $this->redirect(array('controller' =>'Vouchers','action' => 'index'));
        }
    }
    $getStateData        = $this->Voucher->findById($id);
    $this->request->data = $getStateData;
  }
}