<?php

/*
        Plugin Name: Share
        Plugin URI: https://github.com/NoahY/q2a-share
        Plugin Update Check URI: https://raw.github.com/NoahY/q2a-share/master/qa-plugin.php
        Plugin Description: Adds social sharing buttons to questions
        Plugin Version: 1.2
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

	qa_register_plugin_module('widget', 'qa-share-widget.php', 'qa_share_widget', 'Share Widget');

/*
	Omit PHP closing tag to help avoid accidental output
*/
