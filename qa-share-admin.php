<?php
	class qa_share_admin {
		
		function allow_template($template)
		{
			return ($template!='admin');
		}

		function option_default($option) {

			switch($option) {
				default:
					return false;
			}
			
		}

		function admin_form(&$qa_content)
		{

		//	Process form input

			$ok = null;
			if (qa_clicked('share_save_button')) {
				qa_opt('share_plugin_facebook',(bool)qa_post_text('share_plugin_facebook'));
				qa_opt('share_plugin_twitter',(bool)qa_post_text('share_plugin_twitter'));
				qa_opt('share_plugin_google',(bool)qa_post_text('share_plugin_google'));
				qa_opt('share_plugin_linkedin',(bool)qa_post_text('share_plugin_linkedin'));
				qa_opt('share_plugin_facebook_weight',(int)qa_post_text('share_plugin_facebook_weight'));
				qa_opt('share_plugin_twitter_weight',(int)qa_post_text('share_plugin_twitter_weight'));
				qa_opt('share_plugin_google_weight',(int)qa_post_text('share_plugin_google_weight'));
				qa_opt('share_plugin_linkedin_weight',(int)qa_post_text('share_plugin_linkedin_weight'));
				$ok = 'Options saved.';
			}
			
		//	Create the form for display
			
		
			$fields = array();

			$fields[] = array(
				'label' => 'Show Facebook button',
				'tags' => 'NAME="share_plugin_facebook"',
				'value' => qa_opt('share_plugin_facebook'),
				'type' => 'checkbox',
			);
			
			$fields[] = array(
				'label' => 'Show Twitter button',
				'tags' => 'NAME="share_plugin_twitter"',
				'value' => qa_opt('share_plugin_twitter'),
				'type' => 'checkbox',
			);

			$fields[] = array(
				'label' => 'Show Google+ button',
				'tags' => 'NAME="share_plugin_google"',
				'value' => qa_opt('share_plugin_google'),
				'type' => 'checkbox',
			);
						
			$fields[] = array(
				'label' => 'Show LinkedIn button',
				'tags' => 'NAME="share_plugin_linkedin"',
				'value' => qa_opt('share_plugin_linkedin'),
				'type' => 'checkbox',
			);
			
			$fields[] = array(
				'label' => 'Facebook button weight:',
				'tags' => 'NAME="share_plugin_facebook_weight" title="smaller values come before larger values in the DOM"',
				'value' => qa_opt('share_plugin_facebook_weight'),
				'type' => 'number',
			);
			
			$fields[] = array(
				'label' => 'Twitter button weight:',
				'tags' => 'NAME="share_plugin_twitter_weight" title="smaller values come before larger values in the DOM"',
				'value' => qa_opt('share_plugin_twitter_weight'),
				'type' => 'number',
			);

			$fields[] = array(
				'label' => 'Google+ button weight:',
				'tags' => 'NAME="share_plugin_google_weight" title="smaller values come before larger values in the DOM"',
				'value' => qa_opt('share_plugin_google_weight'),
				'type' => 'number',
			);
						
			$fields[] = array(
				'label' => 'LinkedIn button weight:',
				'tags' => 'NAME="share_plugin_linkedin_weight" title="smaller values come before larger values in the DOM"',
				'value' => qa_opt('share_plugin_linkedin_weight'),
				'type' => 'number',
			);
						
			
			return array(
				'ok' => ($ok && !isset($error)) ? $ok : null,
				
				'fields' => $fields,
				
				'buttons' => array(
					array(
						'label' => 'Save',
						'tags' => 'NAME="share_save_button"',
					),
				),
			);
		}
	}
