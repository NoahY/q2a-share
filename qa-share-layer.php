<?php

	class qa_html_theme_layer extends qa_html_theme_base {

	// register default settings

		function option_default($option) {

			switch($option) {
				default:
					return false;
			}
			
		}

		function q_view_buttons($q_view) {
			$this->output('<DIV CLASS="qa-q-view-buttons">');
			if (!empty($q_view['form'])) {
				$this->form($q_view['form']);
			}
			
			$url = qa_path_html(qa_q_request($this->content['raw']['postid'], $this->content['title']), null, qa_opt('site_url'));
			
			
			$code = array(
				'facebook'=> '<iframe src="http://www.facebook.com/plugins/like.php?app_id=143472095738441&amp;href='.$url.'&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>',
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
			
			$output = '<span id="qa-share-buttons">';

			foreach ($weight as $key=>$val) {
				$output .= $code[$key];
			}

			$this->output_raw($output.'</span>');
			
			$this->output('</DIV>');
		}
	}
	
