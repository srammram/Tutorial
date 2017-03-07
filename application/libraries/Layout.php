<?php

/* * ************************
  Project Name	: Pos
  Created on		: 22  Feb, 2016
  Last Modified 	: 22  Dec, 2016
  Description		: load all layout
 * ************************* */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Layout {

    protected $ci;

    public function __construct() {
        $this->ci = & get_instance();
    }

    /* display for Master adminpanel */

    function display_admin($file_paths, $data = null) {
        $admin_path = "adminpanel/";
        if (!is_array($file_paths)) {
            $file_paths = array($file_paths);
        }
        $data ['admin_body'] = '';
        foreach ($file_paths as $file_path) {
            $data ['admin_body'] .= $this->ci->load->view($file_path, $data, true);
        }
        $this->ci->load->view($admin_path . 'layout/layout', $data);
    }

    function display_frontend($file_paths, $data = null) {
        $site_path = "user/";
        if (!is_array($file_paths)) {
            $file_paths = array($file_paths);
        }
        $data ['site_body'] = '';
        foreach ($file_paths as $file_path) {
            $data ['site_body'] .= $this->ci->load->view($file_path, $data, true);
        }

        $this->ci->load->view($site_path . 'layout/layout', $data);
    }

}

/* End of file layout.php */
/* Location: ./system/application/libraries/layout.php */
