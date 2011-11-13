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
		
		function head_custom()
		{
			qa_html_theme_base::head_custom();
			
			$this->output('
<style>
'.qa_opt('share_plugin_css').'				
</style>');
		}
		
		// this is an example, the share buttons may be moved elsewhere by changing this function.
		
		function q_view_buttons($q_view) {  
			qa_html_theme_base::q_view_buttons($q_view);		
			
			if(qa_opt('share_plugin_widget_only')) return;
			
			
			if($this->template != 'question') return;
			
			// get buttons
			
			$buttons = $this->qa_share_buttons($q_view);
			
			// show inline if answers or text suggest is off
			
			if(!empty($this->content['a_list']['as']) || !qa_opt('share_plugin_suggest') && $buttons) {
				$this->output('<div id="qa-share-buttons">',$buttons,'</div>');
			}			
			else if(empty($this->content['a_list']['as']) && qa_opt('share_plugin_suggest')) {
				$this->output('<div id="qa-share-buttons-container">');
				
				$text = qa_opt('share_plugin_suggest_text');

				if($buttons) $text = str_replace('#','<span id="qa-share-buttons">'.$buttons.'</span>',$text);
				
				$this->output_raw($text);
				
				$this->output('</div>');
			}
		}
		
		function footer() {
			qa_html_theme_base::footer();
			if(qa_opt('share_plugin_facebook')) {
				$this->output('<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) {return;}
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, "script", "facebook-jssdk"));</script>');
			}
			if(qa_opt('share_plugin_twitter')) {
				$this->output('<script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>');
			}
			if(qa_opt('share_plugin_google')) {
				$this->output('<script type="text/javascript">(function() {var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;po.src = "https://apis.google.com/js/plusone.js";var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);})();</script>');
			}
			
		}
		
		
		function qa_share_buttons($q_view) {
			
			$url = qa_path(qa_q_request($q_view['raw']['postid'], $q_view['raw']['title']), null, qa_opt('site_url'));

			$code = array(
				'facebook'=> '<iframe src="http://www.facebook.com/plugins/like.php?app_id=143472095738441&amp;href='.$url.'&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:50px; height:20px;" allowTransparency="true"></iframe>',
				
				'twitter'=>'<a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>',
				
				'google'=>'<g:plusone size="medium" count="false"></g:plusone>',
				
				'linkedin'=>'<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share"></script>',
				
				'email'=>'<a title="Share this question via email" id="share-button-email" href="mailto:?subject='.rawurlencode('['.qa_opt('site_title').'] '.$q_view['raw']['title']).'&body='.rawurlencode($url).'"><img height="24" src="'.QA_HTML_THEME_LAYER_URLTOROOT.'qa-share-mail.png'.'"/></a>'
			);

			// sort by weight

			$weight = array(
				'facebook' => qa_opt('share_plugin_facebook_weight'),
				'twitter' => qa_opt('share_plugin_twitter_weight'),
				'google' => qa_opt('share_plugin_google_weight'),
				'linkedin' => qa_opt('share_plugin_linkedin_weight'),
				'email' => qa_opt('share_plugin_email_weight')
			);
			
			asort($weight);
			
			// output
			
			foreach ($weight as $key=>$val) {
				if(qa_opt('share_plugin_'.$key)) $shares[] = $code[$key];
			}
			if(empty($shares)) return null;
			
			$output = implode('&nbsp;',$shares);
			
			return $output;		
		}
		
	}
	
