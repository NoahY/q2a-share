<?php

	class qa_html_theme_layer extends qa_html_theme_base {

	// register default settings

		function option_default($option) {

			switch($option) {
				case 'share_plugin_suggest_text':
					return 'Looking for an answer?&nbsp; Share this question via # or @email@.';
				case 'share_plugin_facebook':
					return 1;
				case 'share_plugin_twitter':
					return 2;
				case 'share_plugin_google':
					return 3;
				case 'share_plugin_linkedin':
					return 4;
				default:
					return false;
			}
			
		}
		
		function head_css()
		{
			qa_html_theme_base::head_css();
			
			$this->output('
			<style>
				#qa-share-buttons > span, #qa-share-buttons > div, #qa-share-buttons > iframe {
				  vertical-align: middle !important;
				}
			</style>');
		}
		
		// this is an example, the share buttons may be moved elsewhere by changing this function.
		
		function q_view_buttons($q_view) {  
			$this->output('<DIV CLASS="qa-q-view-buttons">');
			if (!empty($q_view['form'])) {
				$this->form($q_view['form']);
			}
			
			// get buttons
			
			$buttons = $this->qa_share_buttons($q_view);
			
			// show inline if answers or text suggest is off
			
			if(!empty($a_list) || !qa_opt('share_plugin_suggest')) {
				$this->output_raw($buttons);
			}			
			
			$this->output('</DIV>');

			// show text if no answers.

			if(empty($a_list) && qa_opt('share_plugin_suggest')) {
				$this->output('<h2>');
				
				$text = qa_opt('share_plugin_suggest_text');

				$text = str_replace('#',$buttons,$text);
				
				$subject = str_replace('&','%26','['.qa_opt('site_title').'] '.$q_view['raw']['title']);
				
				$body = str_replace('&amp;','%26',qa_path_html(qa_q_request($q_view['raw']['postid'], $q_view['raw']['title']), null, qa_opt('site_url')));
				
				$text = preg_replace('/@([^@]+)@/','<a href="mailto:?subject='.$subject.'&body='.$body.'">$1</a>',$text);
				
				$this->output_raw($text);
				
				$this->output('</h2>');
			}
		}
		
		function qa_share_buttons($q_view) {
			
			$url = qa_path_html(qa_q_request($q_view['raw']['postid'], $q_view['raw']['title']), null, qa_opt('site_url'));
			
			$code = array(
				'facebook'=> '<iframe src="http://www.facebook.com/plugins/like.php?app_id=143472095738441&amp;href='.$url.'&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:20px;" allowTransparency="true"></iframe>',
				'twitter'=>'<a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>',
				'google'=>'<g:plusone size="medium" count="false"></g:plusone><script type="text/javascript">(function() { var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true; po.src = \'https://apis.google.com/js/plusone.js\'; var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s); })();</script>',
				'linkedin'=>'<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share"></script>'
			);

			// sort by weight

			$weight = array(
				'facebook' => qa_opt('share_plugin_facebook_weight'),
				'twitter' => qa_opt('share_plugin_twitter_weight'),
				'google' => qa_opt('share_plugin_google_weight'),
				'linkedin' => qa_opt('share_plugin_linkedin_weight')
			);
			
			asort($weight);
			
			// output
			
			foreach ($weight as $key=>$val) {
				if(qa_opt('share_plugin_'.$key)) $shares[] = $code[$key];
			}
			
			$output = '<span id="qa-share-buttons">'.implode('&nbsp;',$shares).'</span>';
			
			return $output;		
		}
		
	}
	
