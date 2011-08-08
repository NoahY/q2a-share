<?php
	class qa_share_admin {
		
		function allow_template($template)
		{
			return ($template!='admin');
		}

		function option_default($option) {

			switch($option) {
				case 'share_plugin_facebook':
				case 'share_plugin_twitter':
				case 'share_plugin_google':
				case 'share_plugin_linkedin':
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
				$ok = 'Options saved.';
			}
			
		//	Create the form for display
			
			
			$fields = array();
			
			$fields[] = array(
				'label' => 'Show Facebook Button',
				'tags' => 'NAME="share_plugin_facebook"',
				'value' => qa_opt('share_plugin_facebook'),
				'type' => 'checkbox',
			);
			
			$fields[] = array(
				'label' => 'Show Twitter Button',
				'tags' => 'NAME="share_plugin_twitter"',
				'value' => qa_opt('share_plugin_twitter'),
				'type' => 'checkbox',
			);

			$fields[] = array(
				'label' => 'Show Google+ Button',
				'tags' => 'NAME="share_plugin_google"',
				'value' => qa_opt('share_plugin_google'),
				'type' => 'checkbox',
			);
						
			$fields[] = array(
				'label' => 'Show LinkedIn Button',
				'tags' => 'NAME="share_plugin_linkedin"',
				'value' => qa_opt('share_plugin_linkedin'),
				'type' => 'checkbox',
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
