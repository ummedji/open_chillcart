<?php
/* janakiraman */
App::uses('AppController', 'Controller');

class CountriesController extends AppController
{
    public $helpers = array('Html', 'Form', 'Session', 'Javascript');
    public $uses = array("State", "Country");

    /**
     * CountriesController::admin_index()
     * Country Management List Process
     * @return void
     */
    public function admin_index()
    {
        $country_list = $this->Country->find('all', array(
            'conditions' => array(
                'NOT' => array('Country.status' => 3))));
        $this->set("country_list", $country_list);
    }

    /**
     * CountriesController::admin_add()
     * Add Country Process
     * @return void
     */
    public function admin_add()
    {
        if ($this->request->is('post')) {
            $Country = $this->Country->find('all', array(
                'conditions' => array(
                    'country_name' => trim($this->request->data['Country']['country_name']))));
            if (!empty($Country)) {
                $this->Session->setFlash('<p>' . __('Already Exists Country', true) . '</p>', 'default',
                    array('class' => 'alert alert-danger'));
            } else {
                $this->Country->save($this->request->data, null, null);
                $this->Session->setFlash('<p>' . __('Your State has been saved', true) . '</p>', 'default',
                    array('class' => 'alert alert-success'));
                $this->redirect(array('controller' => 'Countries', 'action' => 'index'));
            }
        }
    }

    /**
     * CountriesController::admin_edit()
     * Edit Country Process
     * @param mixed $id
     * @return void
     */
    public function admin_edit($id = null)
    {
        if (!empty($this->request->data['Country']['country_name'])) {
            $Country = $this->Country->find('all', array(
                'conditions' => array(
                    'country_name' => trim($this->request->data['Country']['country_name']),
                    'NOT' => array('Country.id' => $this->request->data['Country']['id']))));
            if (!empty($Country)) {
                $this->Session->setFlash('<p>' . __('Unable to add your Country', true) . '</p>', 'default',
                    array('class' => 'alert alert-danger'));
            } else {
                $this->Country->save($this->request->data, null, null);
                $this->Session->setFlash('<p>' . __('Your Country has been saved', true) . '</p>', 'default',
                    array('class' => 'alert alert-success'));
                $this->redirect(array('controller' => 'Countries', 'action' => 'index'));
            }
        }
        $getStateData = $this->Country->findById($id);
        $this->request->data = $getStateData;
    }

    /**
     * CountriesController::admin_statelist()
     * State List Fillter
     * @param mixed $id
     * @return void
     */
    public function admin_stateList($id)
    {
        if ($id == 0) {
            $state_list = $this->State->find('all');
        } else {
            $state_list = $this->State->find('all', array(
                    'conditions' => array('State.country_id' => $id))
            );
        }
        $this->set("state_list", $state_list);
    }
}