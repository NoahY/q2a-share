<?php

	class qa_html_theme_layer extends qa_html_theme_base {

	// register default settings

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
		
		function q_view_buttons($q_view) {
			$url = qa_path_html(qa_q_request($this->content['raw']['postid'], $this->content['title']), null, qa_opt('site_url'));
			
			if((bool)qa_opt('share_plugin_facebook')) {
				$q_view['form']['fields'][] = array(
					'note'=>'<iframe src="http://www.facebook.com/plugins/like.php?app_id=143472095738441&amp;href='.$url.'&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:450px; height:21px;" allowTransparency="true"></iframe>',
					'type'=>'static'
				);
			}
			if((bool)qa_opt('share_plugin_twitter')) {
				$q_view['form']['fields'][] = array(
					'note'=>'<a href="http://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>',
					'type'=>'static'
				);
			}
			if((bool)qa_opt('share_plugin_google')) {
				$q_view['form']['fields'][] = array(
					'note'=>'<g:plusone count="false"></g:plusone>
<script type="text/javascript">
  (function() {
    var po = document.createElement(\'script\'); po.type = \'text/javascript\'; po.async = true;
    po.src = \'https://apis.google.com/js/plusone.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>',
					'type'=>'static'
				);
			}
			if((bool)qa_opt('share_plugin_linkedin')) {
				$q_view['form']['fields'][] = array(
					'note'=>'<script type="text/javascript" src="http://platform.linkedin.com/in.js"></script><script type="in/share"></script>',
					'type'=>'static'
				);
			}
			qa_html_theme_base::q_view_buttons($q_view);
		}
	}
	
