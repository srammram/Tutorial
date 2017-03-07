<?php

/* * ************************
  Project Name	: POS
  Created on		: 19 Feb, 2016
  Last Modified 	: 19 Feb, 2016
  Description		: Page contains dashboard related functions.

 * ************************* */
defined('BASEPATH') or exit('No direct script access allowed');

class Frontend extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->module = "homepage";
        $this->module_label = "Home";
        $this->module_labels = "Home";
        $this->folder = "home/";
    }

    /* this method used to show all dashboard all details... */

    public function index() {


        $data = array();
        $data['module_label'] = $this->module_label;
        $data['module_labels'] = $this->module_label;
        $data['module'] = $this->module;
        $this->layout->display_frontend($this->folder . 'homepage', $data);
    }

    public function login() {
        echo "yes";
    }

    public function logout() {
        $this->session->sess_destroy();

        redirect(frontend_url());
    }

}
