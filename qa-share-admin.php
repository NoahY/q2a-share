<?php
	class qa_share_admin {
		
		function allow_template($template)
		{
			return ($template!='admin');
		}

		function option_default($option) {

			switch($option) {
				case 'share_plugin_widget_title':
					return 'Share this question';
				case 'share_plugin_suggest_text':
					return 'Looking for an answer?&nbsp; Share this question: #';
				case 'share_plugin_css':
					return '#qa-share-buttons-container {
	background: none repeat scroll 0 0 #DDDDDD;
	font-size: 125%;
	font-weight: bold;
	margin: 20px 0;
	padding: 20px;
	text-align: center;

}
#qa-share-buttons {
	vertical-align:middle;
}
.share-widget-container {
	display:inline-block;
	position:relative;
}
.qa-share-button {
	width: 54px;

}';
				case 'share_plugin_facebook_weight':
					return 1;
				case 'share_plugin_twitter_weight':
					return 2;
				case 'share_plugin_google_weight':
					return 3;
				case 'share_plugin_linkedin_weight':
					return 4;
				case 'share_plugin_email_weight':
					return 5;
				default:
					return null;
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
				qa_opt('share_plugin_email',(bool)qa_post_text('share_plugin_email'));
				
				qa_opt('share_plugin_facebook_weight',(int)qa_post_text('share_plugin_facebook_weight'));
				qa_opt('share_plugin_twitter_weight',(int)qa_post_text('share_plugin_twitter_weight'));
				qa_opt('share_plugin_google_weight',(int)qa_post_text('share_plugin_google_weight'));
				qa_opt('share_plugin_linkedin_weight',(int)qa_post_text('share_plugin_linkedin_weight'));
				qa_opt('share_plugin_email_weight',(int)qa_post_text('share_plugin_email_weight'));
				
				qa_opt('share_plugin_css',qa_post_text('share_plugin_css'));
				qa_opt('share_plugin_widget_only',(bool)qa_post_text('share_plugin_widget_only'));
				qa_opt('share_plugin_widget_title',qa_post_text('share_plugin_widget_title'));
				
				qa_opt('share_plugin_suggest',(int)qa_post_text('share_plugin_suggest'));
				qa_opt('share_plugin_suggest_text',qa_post_text('share_plugin_suggest_text'));
				
				$ok = qa_lang('admin/options_saved');
			}
			else if (qa_clicked('share_reset_button')) {
				foreach($_POST as $i => $v) {
					$def = $this->option_default($i);
					if($def !== null) qa_opt($i,$def);
				}
				$ok = qa_lang('admin/options_reset');
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
				'label' => 'Show email button',
				'tags' => 'NAME="share_plugin_email"',
				'value' => qa_opt('share_plugin_email'),
				'type' => 'checkbox',
			);
			
			$fields[] = array(
				'type' => 'blank',
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
						
			$fields[] = array(
				'label' => 'Email button weight:',
				'tags' => 'NAME="share_plugin_email_weight" title="smaller values come before larger values in the DOM"',
				'value' => qa_opt('share_plugin_email_weight'),
				'type' => 'number',
			);

			$fields[] = array(
				'type' => 'blank',
			);			
			
			$fields[] = array(
				'label' => 'Share buttons custom css',
				'tags' => 'NAME="share_plugin_css"',
				'value' => qa_opt('share_plugin_css'),
				'type' => 'textarea',
				'rows' => 20
			);
									
			$fields[] = array(
				'label' => 'Widget only',
				'tags' => 'NAME="share_plugin_widget_only"',
				'value' => qa_opt('share_plugin_widget_only'),
				'type' => 'checkbox',
				'note' => 'disables inline buttons - widget must be enabled via admin/layout',
			);
			$fields[] = array(
				'label' => 'Widget Title',
				'tags' => 'NAME="share_plugin_widget_title"',
				'value' => qa_opt('share_plugin_widget_title'),
			);

			$fields[] = array(
				'type' => 'blank',
			);			
			
			$fields[] = array(
				'label' => 'Show notification text while there are still no answers to a question',
				'tags' => 'NAME="share_plugin_suggest" onclick="if(this.checked) jQuery(\'#share_options_container\').fadeIn(); else jQuery(\'#share_options_container\').fadeOut();"',
				'value' => qa_opt('share_plugin_suggest'),
				'type' => 'checkbox',
				'note' => '<table id="share_options_container" style="display:'.(qa_opt('share_plugin_suggest')?'block':'none').'"><tr><td>',
			);		
							
			$fields[] = array(
				'tags' => 'NAME="share_plugin_suggest_text"',
				'value' => qa_opt('share_plugin_suggest_text'),
				'type' => 'text',
				'note' => '<i style="font-size:10px;">(use <b>#</b> to specify button location)</i></td></tr></table>',
			);						

			$fields[] = array(
				'type' => 'blank',
			);			
						
			return array(
				'ok' => ($ok && !isset($error)) ? $ok : null,
				
				'fields' => $fields,
				
				'buttons' => array(
					array(
					'label' => qa_lang_html('main/save_button'),
					'tags' => 'NAME="share_save_button"',
					),
					array(
					'label' => qa_lang_html('admin/reset_options_button'),
					'tags' => 'NAME="share_reset_button"',
					),
				),
			);
		}
	}
