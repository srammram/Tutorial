<?php

/* * ************************
  Project Name	: Pos
  Created on		: 22 Feb, 2016
  Last Modified 	: 22 Feb, 2016
  Description		: Page contains common validation and upload libraie
 * ************************* */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Common {

    protected $ci;

    public function __construct() {
        $this->ci = & get_instance();
    }

    /* this function used to validate image */

    function valid_image($files = null) {
        if (isset($files) && !empty($files)) {
            $allowedExts = array(
                "gif",
                "jpeg",
                "jpg",
                "png",
                "GIF",
                "JPEG",
                "JPG",
                "PNG"
            );
            $temp = explode(".", $files ['name']);
            $extension = end($temp);

            if (!in_array($extension, $allowedExts)) {
                return 'No';
            }
        }
        return "Yes";
    }

    /* this function used to upload image */

    function upload_image($files = null, $image_path = null, $filename = null) {

        if (isset($files) && !empty($files) && $image_path != "") {
            $this->ci->load->helper('string');
            $file_name = $files;
            $config ['upload_path'] = FCPATH . 'media/' . $image_path;
            $config ['allowed_types'] = 'gif|jpg|jpeg|png|pdf|txt|doc|docx';
            $config ['file_name'] = random_string('alnum', 50);
            $this->ci->load->library('upload', $config);
            $this->ci->upload->initialize($config);
            if (!$this->ci->upload->do_upload($file_name)) {
                return "";
            } else {
                $data = $this->ci->upload->data();
                return $data ['file_name'];
            }
        }
    }

}

/* End of file Common_validation.php */
/* Location: ./application/libraries/Common_validation.php */
