<?php

/* janakiraman */
App::uses('AppController', 'Controller');
App::uses('File', 'Utility');
class CategoriesController extends AppController
{
    public $helpers = array('Html', 'Form', 'Session', 'Javascript');
    public $uses = array('Category');
    /**
     * CategoriesController::admin_index()
     * Categories Management Process
     * @return void
     */
    public function admin_index()
    {
        $Category_list = $this->Category->find('all', array(
            'conditions' => array(
                'AND' => array('Category.parent_id' => 0),
                'NOT' => array('Category.status' => 3)),
            'order' => array('Category.id DESC'),
            'fields' => array(
                'Category.id', 'Category.category_name', 'Category.status')));
        $this->set('Category_list', $Category_list);
    }

    /**
     * CategoriesController::admin_add()
     * Categories Add Process
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $this->Category->set($this->request->data);
            if($this->Category->validates()) {

                $Category_check = $this->Category->find('first', array(
                    'conditions' => array(
                        'Category.parent_id' => 0,
                        'Category.category_name' => trim($this->request->data['Category']['category_name']),
                        'NOT' => array('Category.status' => 3))));

                if (!empty($Category_check)) {
                    $this->Session->setFlash('<p>' . __('Unable to add your Category', true) . '</p>', 'default',
                        array('class' => 'alert alert-danger'));
                } else {
                    $this->Category->save($this->request->data, null, null);
                    $this->Session->setFlash('<p>' . __('Your Category has been saved', true) . '</p>', 'default',
                        array('class' => 'alert alert-success'));
                    $this->redirect(array('controller' => 'Categories', 'action' => 'index'));
                }
            } else {
                $this->Category->validationErrors;
            }
        }
    }

    /**
     * CategoriesController::admin_edit()
     * Categories Edit Process
     * @param mixed $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Category->set($this->request->data);
            if($this->Category->validates()) {

                $Category = $this->Category->find('first', array(
                    'conditions' => array(
                        'Category.parent_id' => 0,
                        'Category.category_name' => trim($this->request->data['Category']['category_name']),
                        'NOT' => array('Category.id' => $this->request->data['Category']['id'],
                            'Category.status' => 3))));


                if (!empty($Category)) {
                    $this->Session->setFlash('<p>' . __('Unable to add your Category', true) . '</p>', 'default',
                        array('class' => 'alert alert-danger'));
                } else {
                    $this->Category->save($this->request->data, null, null);
                    $this->Session->setFlash('<p>' . __('Your Category has been saved', true) . '</p>', 'default',
                        array('class' => 'alert alert-success'));
                    $this->redirect(array('controller' => 'Categories', 'action' => 'index'));
                }
            } else {
                $this->Category->validationErrors;
            }
        }
        $getStateData = $this->Category->findById($id);
        $this->request->data = $getStateData;
    }

    /**
     * CategoriesController::admin_subCatAdd()
     * Categories SubCategories Add Process
     * @return void
     */
    public function admin_subCatAdd()
    {

        if ($this->request->is('post')) {
            $this->Category->set($this->request->data);
            if($this->Category->validates()) {

                $Category_check = $this->Category->find('first', array(
                    'conditions' => array(
                        'Category.parent_id' => $this->request->data['Category']['parent_id'],
                        'Category.category_name' => trim($this->request->data['Category']['category_name']),
                        'NOT' => array('Category.status' => 3))));

                if (!empty($Category_check)) {
                    $this->Session->setFlash('<p>' . __('Unable to add your Category', true) . '</p>', 'default',
                        array('class' => 'alert alert-danger'));
                } else {
                    $this->Category->save($this->request->data, null, null);
                    $this->Session->setFlash('<p>' . __('Your Category has been saved', true) . '</p>', 'default',
                        array('class' => 'alert alert-success'));
                    $this->redirect(array('controller' => 'Categories', 'action' => 'subcatindex'));
                }
            } else {
                $this->Category->validationErrors;
            }
        }

        $Category_list = $this->Category->find('list', array(
            'conditions' => array('Category.parent_id' => 0, ' Category.status' => 1),
            'fields' => array('Category.id', 'Category.category_name')));

        $this->set('Category_list', $Category_list);

    }

    /**
     * CategoriesController::admin_subCatIndex()
     * Categories SubCategories Management List
     * @return void
     */
    public function admin_subCatIndex()
    {
        $subCategory_list = $this->Category->find('all', array(
            'conditions' => array(
                'NOT' => array(
                    'Category.parent_id' => 0, 'Category.status' => 3)),
            'order' => 'Category.parent_id DESC'));
        $this->set('subCategory_list', $subCategory_list);
    }

    /**
     * CategoriesController::admin_subCatEdit()
     * Categories SubCategories Edit
     * @param mixed $id
     * @return void
     */
    public function admin_subCatEdit($id = null)
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Category->set($this->request->data);
            if($this->Category->validates()) {

                $category = $this->Category->find('all', array(
                    'conditions' => array(
                        'Category.category_name' => $this->request->data['Category']['category_name'],
                        'NOT' => array('Category.id' => $this->request->data['Category']['id'],
                            'Category.parent_id' => $this->request->data['Category']['parent_id'],
                            'Category.status' => 3))
                ));
                if (!empty($Category)) {
                    $this->Session->setFlash('<p>' . __('Unable to add your Category', true) . '</p>', 'default',
                        array('class' => 'alert alert-danger'));
                } else {
                    $this->Category->save($this->request->data, null, null);
                    $this->Session->setFlash('<p>' . __('Your Category has been saved', true) . '</p>', 'default',
                        array('class' => 'alert alert-success'));
                    $this->redirect(array('controller' => 'Categories', 'action' => 'subcatindex'));
                }
            } else {
                $this->Category->validationErrors;
            }
        }
        $getStateData = $this->Category->findById($id);
        $Category_list = $this->Category->find('list', array(
            'conditions' => array('Category.parent_id' => 0, 'Category.status' => 1),
            'fields' => array('Category.id', 'Category.category_name')));
        $this->set('Category_list', $Category_list);
        $this->request->data = $getStateData;
    }

    /**
     * CategoriesController::admin_subCatList()
     * Categories SubCategories Filleter Based Categories
     * @param mixed $id
     * @return void
     */
    public function admin_subCatList($id)
    {
        if ($id == 0) {
            $subCategory_list = $this->Category->find('all', array(
                'conditions' => array(
                    'NOT' => array('Category.parent_id' => 0, 'Category.status' => 3))));

        } else {
            $subCategory_list = $this->Category->find('all', array(
                'conditions' => array(
                    'Category.parent_id' => $id,
                    'NOT' => array('Category.status' => 3))));
        }
        $this->set('subCategory_list', $subCategory_list);
    }

    public function store_subCatList($id)
    {
        $this->layout = 'assets';
        if ($id == 0) {
            $subCategory_list = $this->Category->find('all', array(
                'conditions' => array(
                    'NOT' => array('Category.parent_id' => 0, 'Category.status' => 1))));

        } else {
            $subCategory_list = $this->Category->find('all', array(
                'conditions' => array(
                    'Category.parent_id' => $id,
                    'NOT' => array('Category.status' => 3))));
        }
        $this->set('subCategory_list', $subCategory_list);
    }

    public function store_add()
    {
        $this->layout = 'assets';
        if ($this->request->is('post')) {
            $this->Category->set($this->request->data);
            if($this->Category->validates()) {

                $Category_check = $this->Category->find('all', array(
                                    'conditions' => array('Category.parent_id' => 0,
                                        'Category.category_name' =>trim($this->request->data['Category']['category_name']),
                                                'NOT' => array('Category.status' => 3))));
                if (!empty($Category_check)) {
                    $this->Session->setFlash('<p>' . __('Unable to add your Category', true) . '</p>', 'default',
                        array('class' => 'alert alert-danger'));
                } else {
                    $this->Category->save($this->request->data, null, null);
                    $this->Session->setFlash('<p>' . __('Your Category has been saved', true) . '</p>', 'default',
                        array('class' => 'alert alert-success'));
                    $this->redirect(array('controller' => 'Categories', 'action' => 'index'));
                }
            } else {
                $this->Category->validationErrors;
            }
        }
    }

    public function store_index()
    {
        $this->layout = 'assets';
        //$id = $this->Auth->User();
        $Category_list = $this->Category->find('all', array(
            'conditions' => array(
                'AND' => array('Category.parent_id' => 0),
                'NOT' => array('Category.status' => 3)),
            'order' => array('Category.id DESC'),
            'fields' => array(
                'Category.id', 'Category.category_name', 'Category.status')));
        $this->set('Category_list', $Category_list);
    }

    public function store_edit($id = null)
    {
        $this->layout = 'assets';
        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Category->set($this->request->data);
            if($this->Category->validates()) {
                $Category = $this->Category->find('first', array(
                    'conditions' => array(
                            'Category.parent_id' => 0,
                            'Category.category_name' => trim($this->request->data['Category']['category_name']),
                            'NOT' => array('Category.id' =>$this->request->data['Category']['id'],
                                                'Category.status' => 3))));

                if(!empty($Category)) {
                    $this->Session->setFlash('<p>'.__('Unable to add your Category', true).'</p>', 'default', 
                                                  array('class' => 'alert alert-danger'));
                } else {
                    $this->Category->save($this->request->data,null,null);
                    $this->Session->setFlash('<p>'.__('Your Category has been saved', true).'</p>', 'default', 
                                                      array('class' => 'alert alert-success'));
                    $this->redirect(array('controller' => 'Categories','action' => 'index'));
                }
            } else {
                $this->Category->validationErrors;
            }
        } 
        $getStateData = $this->Category->findById($id);
        $this->request->data = $getStateData;
    }  
    public function store_subCatAdd(){

        $this->layout  = 'assets';
        if ($this->request->is('post')) {
            $this->Category->set($this->request->data);
            if($this->Category->validates()) {
                $Category_check = $this->Category->find('first', array(
                                      'conditions' => array(
                                                    'Category.parent_id' => $this->request->data['Category']['parent_id'],
                                                    'Category.category_name' => trim($this->request->data['Category']['category_name']),
                                        'NOT' => array('Category.status' => 3))));
                if(!empty($Category_check)) {
                    $this->Session->setFlash('<p>'.__('Unable to add your Category', true).'</p>', 'default', 
                                                      array('class' => 'alert alert-danger'));
                } else {
                    $this->Category->save($this->request->data,null,null);
                    $this->Session->setFlash('<p>'.__('Your Category has been saved', true).'</p>', 'default', 
                                                      array('class' => 'alert alert-success'));
                    $this->redirect(array('controller' => 'Categories','action' => 'subCatIndex','store'=>true));
                }
            } else {
                $this->Category->validationErrors;
            }
        }
        $Category_list = $this->Category->find('list',array(
                                'conditions'=>array('Category.parent_id'=>0,'Category.status'=>1),
                                'fields'=>array('Category.id','Category.category_name')));
        $this->set('Category_list',$Category_list);    
    }

    public function store_subCatIndex() {
        $this->layout  = 'assets';
        $subCategory_list = $this->Category->find('all',array(
                                  'conditions'=>array(
                                  'NOT'=>array(
                                  'Category.parent_id'=>0,'Category.status'=>3)),
                                    'order'=>'Category.id DESC'));
        $this->set('subCategory_list',$subCategory_list);
    }  
    public function store_subCatEdit($id=null){   
        $this->layout  = 'assets';

        if ($this->request->is('post') || $this->request->is('put')) {
            $this->Category->set($this->request->data);
            if($this->Category->validates()) {
                $category    = $this->Category->find('all',array(
                                'conditions'=>array(
                                    'Category.category_name'=>$this->request->data['Category']['category_name'],
                                'NOT'=>array('Category.id'=>$this->request->data['Category']['id'],
                                              'Category.parent_id'=>$this->request->data['Category']['parent_id'],
                                              'Category.status' => 3))));
                if(!empty($Category)) {
                    $this->Session->setFlash('<p>'.__('Unable to add your Category', true).'</p>', 'default', 
                                                  array('class' => 'alert alert-danger'));
                } else {
                    $this->Category->save($this->request->data,null,null);
                    $this->Session->setFlash('<p>'.__('Your Category has been saved', true).'</p>', 'default', 
                                                      array('class' => 'alert alert-success'));
                    $this->redirect(array('controller' => 'Categories','action' => 'subCatIndex'));
                }
            } else {
                $this->Category->validationErrors;
            }
        }   
        $getStateData = $this->Category->findById($id);
        $Category_list = $this->Category->find('list',array(
                                  'conditions'=>array('Category.parent_id'=>0,'Category.status'=>1),
                                  'fields'=>array('Category.id','Category.category_name')));
        $this->set('Category_list',$Category_list);
        $this->request->data = $getStateData;
    }
}