<?php

	class qa_share_widget {
	
	var $urltoroot;

	function load_module($directory, $urltoroot)
	{
		$this->urltoroot = $urltoroot;
	}
	
		function allow_template($template)
		{

			return ($template == 'question');
		}

		function allow_region($region)
		{
			return ($region=='side');
		}

		function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
		{
			$themeobject->output(
				'<H2 STYLE="margin-top:0; padding-top:0;">',
				qa_opt('share_plugin_widget_title'),
				'</H2>'
			);
			
			$url = qa_path($request, null, qa_opt('site_url'));

			$code = array(
				'facebook'=> '<div class="fb-like" data-href="'.$url.'" data-send="false" data-layout="button_count" data-width="36" data-show-faces="false"></div>',
				
				'twitter'=>'<a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a>',
				
				'google'=>'<g:plusone size="medium" annotation="none"></g:plusone>',
				
				'linkedin'=>'<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share"></script>',
				
				'email'=>'<a title="Share this question via email" id="share-button-email" href="mailto:?subject='.rawurlencode('['.qa_opt('site_title').'] '.@$qa_content['q_view']['raw']['title']).'&body='.rawurlencode($url).'"><img height="24" src="'.$this->urltoroot.'qa-share-mail.png'.'"/></a>'
				
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
				if(qa_opt('share_plugin_'.$key)) $shares[] = '<div class="qa-share-button qa-share-button-'.$key.'">'.$code[$key].'</div>';
			}
			if(empty($shares)) return null;
			
			$output = '<div class="share-widget-container">'.implode('&nbsp;',$shares).'</div>';
			
			$themeobject->output(
				$output
			);			
		}
	};


/*
	Omit PHP closing tag to help avoid accidental output
*/
