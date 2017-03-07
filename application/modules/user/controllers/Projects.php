<?php

/* * ************************
  Project Name	: POS
  Created on		: 19 Feb, 2016
  Last Modified 	: 19 Feb, 2016
  Description		: Page contains dashboard related functions.

 * ************************* */
defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->module = "homepage";
        $this->module_label = "Home";
        $this->module_labels = "Home";
        $this->folder = "projects/";
        $this->user_folder = "user/";
        $this->login_table = 'users';
        $this->login_history_table = 'login_history';
        $this->user_type_table = 'user_type';
        $this->departments_table = 'departments';
        $this->countries = 'countries';
        $this->states_table = 'states';
        $this->cities_table = 'cities';
    }

    public function index() {
        echo "yes";
    }

    public function add() {
        $data = $this->load_module_info();
        $this->layout->display_frontend($this->folder . 'add-project', $data);
    }

    private function load_module_info() {
        $data = array();
        $data ['module_label'] = $this->module_label;
        $data ['module_labels'] = $this->module_labels;
        $data ['module'] = $this->module;
        return $data;
    }

}
