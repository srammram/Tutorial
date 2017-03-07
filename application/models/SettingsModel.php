<?php

/* * ************************
  This is for site settings hooks
 * ************************* */
if (!defined('BASEPATH'))
    exit('No direct gscript access allowed');

class SettingsModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->LoadSitewideSettings();
    }

    public function LoadSitewideSettings() {
        $settings = array();

        // Get the settings from the database
        $query = $this->db->get('site_setting');

        foreach ($query->result() as $settingRow) {
            $settings[$settingRow->setting_key] = $settingRow->setting_value;
        }
        $this->config->set_item('siteSettings', $settings);
    }

}
