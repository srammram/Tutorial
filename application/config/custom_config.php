<?php

defined('BASEPATH') OR exit('No direct script access allowed');



$config['news_thumbnail_path'] = 'media\news\thumbnail';

$config['news_type'] = array('draft' => 'Draft', 'submitted' => 'Submitted', 'published' => 'Published', 'rework' => 'Rework', 'reject' => 'Rejected');

$config['amazon_s3_bucket_names'] = array('image' => 'electtv-images', 'audio' => 'electtv-audios', 'video' => 'electtv-videos', 'livetv' => 'electtv-livetv');
$config['amazon_s3_bucket_permission'] = array('all' => 'public-read');
?>