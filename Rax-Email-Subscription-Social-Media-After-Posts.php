<?php
/*
Plugin Name: RAX - Email Subscription And Social Media Links After Posts
Plugin URI: http://www.programmingfacts.com
Description: You can add Box after posts which contain Email Subscription and Social Media Links.
Version: 1.0
Author: Rakshit Patel
Author URI: http://www.programmingfacts.com
License: GPL2
*/

/*  Copyright 2010  Rakshit Patel  (email : raxit4u2@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

	add_option("rax_feedurl","http://feedburner.google.com/fb/a/mailverify?uri=ProgrammingFacts"); //Enter Your Feed URL
	add_option("rax_feedid","ProgrammingFacts"); //Enter Your Feed ID
	add_option("rax_rssfeedid","http://feeds.feedburner.com/ProgrammingFacts"); //Enter Your RSS Feed
	add_option("rax_twitterid","http://www.twitter.com/raxit4u2"); //Enter Your Twitter Username
	add_option("rax_facebookid","http://www.facebook.com/raxit4u2"); //Enter Your Facebook Username
	add_action('admin_menu', 'rax_menu_options');
	
	add_action("the_content",'rax_show_subscription_social_options');
	
	function rax_menu_options() {
	
	  add_options_page('RAX - Email Subscription And Social Media Links After Posts', ' RAX - Email Subscription And Social Media Links After Posts', 'manage_options', 'rax-subscription-social-options', 'rax_subscription_social_options');
	
	}
	
	function rax_subscription_social_options() {
	
	  if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );
	  }
?>	
	  <div style="width:95%; font-size:11px; padding:3px 3px 3px 15px;">
	  <p style="font-size:20px; background-color:#4086C7; color:#FFF; width:70%; padding:2px;">Set Options for RAX - Email Subscription And Social Media Links After Posts</p>
	  <p>
			<form method="post" action="options.php">
				<h2>Feedburner Email Subscription Options</h2>
				<?php wp_nonce_field('update-options');?>
				Feed URL : <input type="text" size="55" name="rax_feedurl" id="rax_feedurl" value="<?php echo get_option('rax_feedurl'); ?>" />
					<span style="font-size:10px; color:#333333;">(For e.g. http://feedburner.google.com/fb/a/mailverify?uri=ProgrammingFacts)</span>
				<br />
				<br />
				Feed ID : <input type="text" size="55" name="rax_feedid" id="rax_feedid" value="<?php echo get_option('rax_feedid'); ?>" />
					<span style="font-size:10px; color:#333333;">(For e.g. ProgrammingFacts)</span>
				<br />
				<br />
				RSS Feed : <input type="text" size="55" name="rax_rssfeedid" id="rax_rssfeedid" value="<?php echo get_option('rax_rssfeedid'); ?>" />
					<span style="font-size:10px; color:#333333;">(For e.g. http://feeds.feedburner.com/ProgrammingFacts)</span>
				<br />
				<br />	
				<h2>Social Media Options</h2>
				Twitter : <input type="text" size="55" name="rax_twitterid" id="rax_twitterid" value="<?php echo get_option('rax_twitterid'); ?>" />
					<span style="font-size:10px; color:#333333;">(For e.g. http://www.twitter.com/raxit4u2)</span>
				<br />
				<br />	
				Facebook : <input type="text" size="55" name="rax_facebookid" id="rax_facebookid" value="<?php echo get_option('rax_facebookid'); ?>" />
					<span style="font-size:10px; color:#333333;">(For e.g. http://www.facebook.com/raxit4u2)</span>
				<br />
				<br />	
				<input type="submit" value="<?php _e('Update Options')?>" />
				<input type="hidden" name="action" value="update" />
				<input type="hidden" name="page_options" value="rax_feedurl,rax_feedid,rax_rssfeedid,rax_twitterid,rax_facebookid" />
			</form>
	  </p>
	  </div>
<?php				
	}

	function rax_show_subscription_social_options($post_content)
	{
		if( is_single() )
		{
			$post_content .= '<style type="text/css">
			div.rax_subscribe
			{
				width:60%;
				float:left;
				border:8px solid #EBEBEB;
				text-align:center;
				background-color:#D0E4F5;
			}
			div.rax-email-subscribe
			{
				background-color:#4086C7;
				padding:5px 8px;
				height:60px;
			}
			div.rax-email-subscribe span
			{
				color:#FFF;
				font-size:12px;
			}
			div.rax-email-subscribe input.rax-button
			{
				font-size:14px !important;
				padding:2px !important;
				*padding:0px;
			}
			div.rax-other-subscribe
			{
				margin:10px 5px;
			}
			.clear
			{
				padding:0;
				margin:0;
			}
			.rax-credit
			{
				width:60%;
				text-align:right;
			}
			.rax-credit a
			{
				text-decoration:none;
				font-size:9px;
				color:#CCC;
			}
			.rax-credit a:hover
			{
				text-decoration:none;
			}
			</style>
			<div class="rax_subscribe">
				<div class="rax-email-subscribe">
				<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit=window.open('.get_option("rax_feedurl").', "popupwindow", "scrollbars=yes,width=550,height=520");return true class="emsb">
						<span>Subscribe to '.get_option("blogname").' via Email</span>
						<input type="text" size="25" name="email" />
						<input type="hidden" value='.get_option("rax_feedid").' name="uri" />
						<input type="hidden" name="loc" value="en_US" />
						<input type="submit" value="Subscribe" class="rax-button" />
				</form>
				</div>
				<div class="rax-other-subscribe">
				<a href='.get_option("rax_rssfeedid").' target="_blank"><img src='.get_bloginfo("url").'/wp-content/plugins/rax-email-subscription-and-social-media-links-after-posts/images/rax-rss.jpg /></a>&nbsp;&nbsp;
				<a href='.get_option("rax_twitterid").' target="_blank"><img src='.get_bloginfo("url").'/wp-content/plugins/rax-email-subscription-and-social-media-links-after-posts/images/rax-twitter.jpg /></a>&nbsp;&nbsp;
				<a href='.get_option("rax_facebookid").' target="_blank"><img src='.get_bloginfo("url").'/wp-content/plugins/rax-email-subscription-and-social-media-links-after-posts/images/rax-facebook.jpg /></a>
				</div>
			</div> 
			<div class="rax-credit">
				<a href="http://www.programmingfacts.com">Plugin By - PHP Programmer India</a>
			</div>';
		}
		
		return  $post_content;

	}
?>