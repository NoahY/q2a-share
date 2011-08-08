<?php

/*
        Plugin Name: Share
        Plugin URI: 
        Plugin Description: Adds social sharing buttons to questions
        Plugin Version: 0.1
        Plugin Date: 2011-08-08
        Plugin Author: NoahY
        Plugin Author URI: 
        Plugin License: GPLv2
        Plugin Minimum Question2Answer Version: 1.3
*/


	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
			header('Location: ../../');
			exit;
	}
	
	qa_register_plugin_layer('qa-share-layer.php', 'Share Button Layer');	
	
	qa_register_plugin_module('module', 'qa-share-admin.php', 'qa_share_admin', 'Share Admin');

/*
	Omit PHP closing tag to help avoid accidental output
*/
