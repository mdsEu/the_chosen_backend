<?php
/**
 * Plugin Name: b2i Investor Tools
 * Plugin URI:  http://www.b2itech.com
 * Description: SEC, press releases, stock chart, quote data, email notifications and more. Tools that automatically keep your Investors and website up-to-date.
 * Version:     1.0.7.7
 * Author:      b2itech
 * Author URI:  http://www.b2itech.com
 * License:     GPLv2
 * Text Domain: b2i
 * Domain Path: /languages
 * @link https://www.b2itech.com
 * @package b2i
 * @version 1.0.7.7
 */

/**
 * Copyright (c) 2018 b2itech (contact us on our website www.b2itech.com)
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License, version 2 or, at
 * your discretion, any later version, as published by the Free
 * Software Foundation.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */
 
 
//Plugin Settings Page
function my_plugin_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=b2i_options">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}


$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'my_plugin_settings_link' );

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


/**
 * Autoloads files with classes when needed
 * @since  0.2.0
 * @param  string $class_name Name of the class being requested.
 * @return void
 */
function b2i_autoload_classes( $class_name ) {
	if ( 0 !== strpos( $class_name, 'B2i_' ) ) {
		return;
	}

	$filename = strtolower( str_replace(
		'_', '-',
		substr( $class_name, strlen( 'B2i_' ) )
	) );

	B2i::include_file( $filename );
}

spl_autoload_register( 'b2i_autoload_classes' );

include( plugin_dir_path( __FILE__ ) . 'includes/helper-functions.php' );



/**
 * Main initiation class
 * @since  0.2.0
 */
final class B2i {


	/**
	 * Current version
	 * @var  string
	 * @since  0.2.0
	 */
	const VERSION = '1.0.7.7';
	protected $bversion;


	/**
	 * URL of plugin directory
	 * @var string
	 * @since  0.2.0
	 */
	protected $url = '';


	/**
	 * Path of plugin directory
	 * @var string
	 * @since  0.2.0
	 */
	protected $path = '';


	/**
	 * Plugin basename
	 * @var string
	 * @since  0.2.0
	 */
	protected $basename = '';


	/**
	 * Singleton instance of plugin
	 * @var B2i
	 * @since  0.2.0
	 */
	protected static $single_instance = null;


	/**
	 * Instance of B2i_Shortcode
	 * @since 0.2.0
	 * @var B2i_Shortcode
	 */
	protected $shortcode;


	/**
	 * Instance of B2i_Options
	 * @since 0.2.0
	 * @var B2i_Options
	 */
	protected $options;
	protected $B2iErr = '';
	protected $biz_id = '';
	protected $postkey = '';
	protected $postips = '66.111.109.135 66.111.109.141 66.111.109.108 66.111.109.109';
	protected $surl;
	protected $handle;
	protected $contents;
	
	protected $business_id = '';
	protected $iplist = '';
	protected $ticker = '';
	protected $do_not_use_ip_list=false;
	protected $use_call_home;
	
	
	/**
	 * Creates or returns an instance of this class.
	 * @since  0.2.0
	 * @return B2i A single instance of this class.
	 */
	public static function get_instance() {
		if ( null === self::$single_instance ) {
			self::$single_instance = new self();
		}
		return self::$single_instance;
	}

	
/*
https://code.tutsplus.com/articles/new-wp-config-tweaks-you-probably-dont-know--wp-35396
*/
	function my_filter( $string ) {
		global $allowedposttags;
		$allowedposttags['style'] = array();
		$allowedposttags['link'] = array( 'type' => array (''), 'rel' => array (''), 'href' => array ('') );
		return $string;
	}


	/**
	 * Sets up our plugin
	 * @since  0.2.0
	 */
	protected function __construct() {
		$this->basename = plugin_basename( __FILE__ );
		$this->url      = plugin_dir_url( __FILE__ );
		$this->path     = plugin_dir_path( __FILE__ );
		
		add_filter( 'pre_kses', array( $this, 'my_filter' ) );
        add_filter( 'template_redirect', array($this,'b2i_custom_post'), 99 );
        add_filter( 'template_redirect', array($this,'importItemsFromXMLUrl'), 99 );
		add_filter ( 'plugin_row_meta', array (	$this, 'b2i_custom_plugin_row_meta'	), 10, 2 );	
		add_action( 'cmb2_init', array( $this, 'setup_vars' ) );
	}

	
	
	public function setup_vars() {
		$this->business_id = cmb2_get_option( 'b2i_options', 'business_id' );
		$this->postkey = cmb2_get_option( 'b2i_options', 'postkey' );
		$this->iplist = cmb2_get_option( 'b2i_options', 'iplist' );
		$this->ticker = cmb2_get_option( 'b2i_options', 'ticker' );
		$this->do_not_use_ip_list = cmb2_get_option( 'b2i_options', 'do_not_use_ip_list' );
		$this->use_call_home = cmb2_get_option( 'b2i_options', 'use_call_home' );
	}
	
	
  
    function b2i_custom_post() {
		$ipfound='';
		$B2iErr='';
		$biz_id='';
		$item_id='';
		$itemkey='';
		$postkey='';
		$postlink='';
		$contents='';
		$bversion='1.0.4';
		
		
        //global $wpdb,$wp_query;
        if(isset($_POST['bizid'])) {
			
			
			/*
			global $wpdb;
			$query = $wpdb->prepare('SELECT ID FROM ' . $wpdb->posts . ' WHERE post_name = %s', sanitize_title_with_dashes($_POST['post_title']));
			$cID = $wpdb->get_var( $query );

			if ( !empty($cID) ) {
            	$B2iErr='Title already exist ';
				print $B2iErr;
				die;              
        	}
			*/
			
			$postips = cmb2_get_option( 'b2i_options', 'iplist' );
			$do_not_use_ip_list = cmb2_get_option( 'b2i_options', 'do_not_use_ip_list' );
			$use_call_home = cmb2_get_option( 'b2i_options', 'use_call_home' );
			
			$post_source = $_SERVER["REMOTE_ADDR"];
			if($post_source==''){ $post_source=$_SERVER["HTTP_X_FORWARDED_FOR"]; }
			if($post_source=='::1'){ $post_source='127.0.0.1'; }
			//exit($post_source);
			
			
            $biz_id = $_POST['bizid'];
            $postkey = $_POST['postkey'];
			$item_id = $_POST['itemid'];
			$itemkey = $_POST['itemkey'];
			
            if(!$postkey) {
				print 'No postkey';
				die;
            }
			
            if($biz_id != $this->business_id) {
				//print $biz_id . ' sdff ' . $this->business_id;
				$B2iErr='BizID Failed match ' . $biz_id;
				print $B2iErr;
				die;
            }
			
            if($postkey != $this->postkey) {
				//print $biz_id . ' sdff ' . $this->business_id;
				$B2iErr='PostKey Failed match ' . $biz_id;
				print $B2iErr;
				die;
            }
			
			
			//Check IP posting in
			if($do_not_use_ip_list != true){
				$ips = explode(" ", $postips);
				foreach ($ips as &$value) {
					//print('IP:' . $value . ' ');
					if ($value === $post_source){
						$ipfound = 'matched';
						break;
					}
				}
				unset($value);
				
				if($ipfound!=='matched'){
					$B2iErr='No matching IP';
					print $B2iErr . ' ' . $post_source;
					die;
				}
			}
			
			if($use_call_home){
				$surl = "https://www.b2i.us/VerifyPost.asp?b=" . $biz_id . "&k=" . $itemkey . "&id=" . $item_id;
				//$surl = "http://192.168.1.55/VerifyPost.asp?b=" . $biz_id . "&k=" . $itemkey . "&id=" . $item_id;
				$handle = wp_remote_get($surl);
				$contents = wp_remote_retrieve_body($handle);
				
				if($contents!=$itemkey){
					$B2iErr='Itemkey Failed match ' . $contents . '!=' . $itemkey;
					print $B2iErr;
					die;
				}
			}
			
			
			
			
			$my_post = array(
				'post_status'   => 'publish',
				'post_author'   => 1,
				'post_type' => 'post'
			);
			
			$my_post['post_title']  = $_POST['post_title'];
			$my_post['post_content']  = $_POST['post_content'];
			
			
			if(isset($_POST['post_date']) && $_POST['post_date'] != ''){
				$my_post['post_date'] = $_POST['post_date'];
			}
			
			$sCatString = "";
			$sCategory = "";
			
			if($_POST['post_category']!=''){
				
				$sCategory = $_POST['post_category'];
				
				//take passed in value and convert to array
				$arrCategory = explode(',',$sCategory);
				
				//get arrary length and loop array
				$arrlength = count($arrCategory);
				for($x = 0; $x < $arrlength; $x++) {
					//build string list of cat IDs
					if($sCatString != ''){
						$sCatString .= ',' . get_cat_ID($arrCategory[$x]);
					}else{
						$sCatString = get_cat_ID($arrCategory[$x]);
					}
				}
				$arrCatIDs = explode(",", $sCatString);
				$my_post['post_category'] = $arrCatIDs;
			}
			
			//Catch when Category not matched and Tag not set
			if($sCatString=='' && $sTag==''){
				$B2iErr='Category not matched and Tag not set ' . $biz_id;
				print $B2iErr;
				die;
			}
			
			//SEND IT !!! post into WP blog
			$post_id = wp_insert_post($my_post);
			
			
			//Get Link based on Post ID
			if($post_id!=0){
				$postlink = get_permalink($post_id);
			}
			
			if ( $B2iErr!=''){
			//   exit( 'ERROR: ' . $B2iErr);
			} 
			
			$sTag = "";
			if($_POST['post_tag']!=''){
				$sTag = $_POST['post_tag'];
				wp_set_post_tags( $post_id, $sTag, true);
			}
			
			if($postlink!='' ){
				print 'viewlink=' . $postlink;
				die;
			}
            return;
        }
    }
	
	
	
	// FUNCTION FOR IMPORT RSS IN B2INEWS START
    function importItemsFromXMLUrl(){
		$B2iErr='';
		if(isset($_REQUEST['rss']) && isset($_REQUEST['b']) ){
			
			if(!isset($_REQUEST['id'])){die;}
			if(!isset($_REQUEST['g'])){die;}
			if(!isset($_REQUEST['api'])){die;}
			
			//global $wpdb,$wp_query;
			if($_REQUEST['rss']=='1' && $_REQUEST['b']!='' && $_REQUEST['id']!='' && $_REQUEST['g']!='' &&  $_REQUEST['api']!='') {		
					
					$rbizid = sanitize_text_field($_REQUEST['b']);
					$rid = sanitize_text_field($_REQUEST['id']);
					$rgroup = sanitize_text_field($_REQUEST['g']);
					$rapi = sanitize_text_field($_REQUEST['api']);
					$rurd = sanitize_text_field($_REQUEST['urd']);
					
					
					//Allow duplicate titles
					$adup='';
					if(isset($_REQUEST['adup'])){
						$adup = '1';
					}
					

					$business_id = sanitize_text_field(cmb2_get_option('b2i_options', 'business_id'));
					$key = sanitize_text_field(cmb2_get_option('b2i_options', 'key'));
					
					
					if ($business_id==$rbizid && $key==$rapi && !empty($rid) && !empty($rgroup)) {
						$url = "https://www.rss-view.com/rss/newsrss.asp?f=1&L=1&B=$business_id&id=$rid&G=$rgroup&api=$rapi";
						//$url = "http://192.168.1.56/rss/newsrss.asp?f=1&L=1&B=$business_id&id=$rid&G=$rgroup&api=$rapi";
						$content = file_get_contents($url);

						try {
							$a = simplexml_load_string($content,'SimpleXMLElement', LIBXML_NOCDATA);
							$totalObject = count($a->channel->item);

							// get all publish post
							$allPublishPostsLite = getAllB2iPostsLite();
							$totalInsert = 0;

							for($i=0;$i<$totalObject;$i++){
								
								//$title = strip_tags($a->channel->item[$i]->title);
								//$category = strip_tags($a->channel->item[$i]->category);
								//$categoryArray = explode(",", $category);
								//$description = trim($a->channel->item[$i]->description);
								//$pubDate = date('Y-m-d H:i:s', strtotime($a->channel->item[$i]->pubDate));
								//$curDate = date('Y-m-d H:i:s');
								//$guid = json_decode(json_encode($a->channel->item[$i]->guid), true)[0];
								//$strReplaceFrm = ['https://b2i.irpass.com/', 'irpass.asp?', '=', '&', '$', '--'];
								//$strReplaceTo = ['', '', '', '', '', '-'];
								//$post_name_slug = strtolower(str_replace($strReplaceFrm, $strReplaceTo, $guid));
								//$checkIfExist = filterArrayByKeyValueLite($allPublishPostsLite, 'post_name', $post_name_slug);
								
								//Create any category that are not present
								//$postcat = checkAndInsertCategoryLite($categoryArray);
								
								$my_post = array(
									'post_status'   => 'publish',
									'post_author'   => 1,
									'post_type' => 'post'
								);
								
								$post_title = $a->channel->item[$i]->title;
								
								// allow/prevent Dup posts
								if($adup == ''){
									global $wpdb;
									$query = $wpdb->prepare('SELECT ID FROM ' . $wpdb->posts . ' WHERE post_name = %s', sanitize_title_with_dashes($post_title));
									$cID = $wpdb->get_var( $query );
									if ( !empty($cID) ) {
										//print 'Post ID: ' . $cID;
										$B2iErr=' Title already exist ' . sanitize_title_with_dashes($post_title);
										print $B2iErr;
										die;              
									}
								}
								
								
								$my_post['post_title']  = strip_tags($post_title);
								$my_post['post_content']  = trim($a->channel->item[$i]->description);
								
								if($rurd=='1'){
									$my_post['post_date'] = date('Y-m-d H:i:s', strtotime($a->channel->item[$i]->pubDate));
								}
								
								$sCatString = "";
								$sCategory = "";
								
								$sCategory = strip_tags($a->channel->item[$i]->category);
								
								if($sCategory !=''){
									//take passed in value and convert to array
									$arrCategory = explode(',',$sCategory);
									
									//get arrary length and loop array
									$arrlength = count($arrCategory);
									for($x = 0; $x < $arrlength; $x++) {
										//build string list of cat IDs
										if($sCatString != ''){
											$sCatString .= ',' . get_cat_ID($arrCategory[$x]);
										}else{
											$sCatString = get_cat_ID($arrCategory[$x]);
										}
									}
									$arrCatIDs = explode(",", $sCatString);
									$my_post['post_category'] = $arrCatIDs;
								}
								
								//Catch when Category not matched and Tag not set
								if($sCatString=='' && $sTag==''){
									$B2iErr='No Category or Tag sent ID:' . $rid;
									print $B2iErr;
									die;
								}
								
								//SEND IT !!! post into WP blog
								$post_id = wp_insert_post($my_post);
								
								
								//Get Link based on Post ID
								if($post_id!=0){
									$postlink = get_permalink($post_id);
								}
								
								if(isset($B2iErr)){
									if ( $B2iErr!=''){
									   exit( 'ERROR: ' . $B2iErr);
									} 
								}
								
								$sTag = "";
								if (isset($_POST['post_tag'])){
									if($_POST['post_tag']!=''){
										$sTag = $_POST['post_tag'];
										wp_set_post_tags( $post_id, $sTag, true);
									}
								}
								
								if($postlink!='' ){
									print 'viewlink=' . $postlink;
									die;
								}
									
							}
						}
						catch (Exception $e) {
							echo 'Caught exception: ', $e->getMessage(), "\n";
						}
					} else {
						echo 'Adding item failed';
					}
			}
		}
    }
	
	
	
	function b2i_custom_plugin_row_meta( $links, $file ) {
		if ( strpos( $file, 'b2i.php' ) !== false ) {
			$new_links = array(
					'demo' => '<a href="https://demo.b2itech.com/" target="_blank">Live View</a>',
			);
			$links = array_merge( $links, $new_links );
		}
		return $links;
	}
	
	
	
	/* http://www.wordpressaddicted.com/wordpress-get-tag-id-by-tag-name/ */
	function get_tag_ID($tag_name) {
		$tag = get_term_by('name', $tag_name, 'post_tag');
		if ($tag) {
			return $tag->term_id;
		} else {
			return 0;
		}
	}
	
	
	
	/**
	 * Attach other plugin classes to the base plugin class.
	 * @since  0.2.0
	 * @return void
	 */
	public function plugin_classes() {
		// Attach other plugin classes to the base plugin class.
		$this->options = new B2i_Options( $this );
		$this->shortcode = new B2i_Shortcode( $this );
	} // END OF PLUGIN CLASSES FUNCTION



	/**
	 * Add hooks and filters
	 * @since  0.2.0
	 * @return void
	 */
	public function hooks() {
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'admin_notices', array( $this, 'maybe_display_activation_notice' ) );
	}



	/**
	 * Set the activation message if the plugin was just activated
	 * @since  0.2.0
	 * @return void
	 */
	public function set_activation_message() {
		$html = '<div class="notice notice-info is-dismissable">';
		$html .= '<p>';
		$html .= __( 'Thank you for installing the B2i plugin! Visit the <a href="' . admin_url( 'options-general.php?page=b2i_options' ) . '">settings page</a> to get started.', 'b2i' );
		$html .= '</p>';
		$html .= '</div>';

		update_option( 'b2i_activation_message', $html );
	}


	/**
	 * Display the activation message if it is set
	 * @since  0.2.0
	 * @return void
	 */
	public function maybe_display_activation_notice() {
		$message = get_option( 'b2i_activation_message', false );

		if ( $message ) {
			update_option( 'b2i_activation_message', false );
			echo $message;
		}
	}


	/**
	 * Activate the plugin
	 * @since  0.2.0
	 * @return void
	 */
	public function _activate() {
		// Make sure any rewrite functionality has been loaded.
		flush_rewrite_rules();
		$this->set_activation_message();
	}


	/**
	 * Deactivate the plugin
	 * Uninstall routines should be in uninstall.php
	 * @since  0.2.0
	 * @return void
	 */
	public function _deactivate() {}


	/**
	 * Init hooks
	 * @since  0.2.0
	 * @return void
	 */
	public function init() {
		load_plugin_textdomain( 'b2i', false, dirname( $this->basename ) . '/languages/' );
		$this->plugin_classes();
	}


	/**
	 * Deactivates this plugin, hook this function on admin_init.
	 * @since  0.2.0
	 * @return void
	 */
	public function deactivate_me() {
		deactivate_plugins( $this->basename );
	}


	/**
	 * Magic getter for our object.
	 * @since  0.2.0
	 * @param string $field Field to get.
	 * @throws Exception Throws an exception if the field is invalid.
	 * @return mixed
	 */
	public function __get( $field ) {
		switch ( $field ) {
			case 'version':
				return self::VERSION;
			case 'basename':
			case 'url':
			case 'path':
			case 'shortcode':
			case 'options':
				return $this->$field;
			default:
				throw new Exception( 'Invalid '. __CLASS__ .' property: ' . $field );
		}
	}



	/**
	 * Include a file from the includes directory
	 * @since  0.2.0
	 * @param  string $filename Name of the file to be included.
	 * @return bool   Result of include call.
	 */
	public static function include_file( $filename ) {
		$file = self::dir( 'includes/class-'. $filename .'.php' );
		if ( file_exists( $file ) ) {
			return include_once( $file );
		}
		return false;
	}


	/**
	 * This plugin's directory
	 * @since  0.2.0
	 * @param  string $path (optional) appended path.
	 * @return string       Directory and path
	 */
	public static function dir( $path = '' ) {
		static $dir;
		$dir = $dir ? $dir : trailingslashit( dirname( __FILE__ ) );
		return $dir . $path;
	}


	/**
	 * This plugin's url
	 * @since  0.2.0
	 * @param  string $path (optional) appended path.
	 * @return string       URL and path
	 */
	public static function url( $path = '' ) {
		static $url;
		$url = $url ? $url : trailingslashit( plugin_dir_url( __FILE__ ) );
		return $url . $path;
	}
}


	/**
	 * Grab the B2i object and return it.
	 * Wrapper for B2i::get_instance()
	 * @since  0.2.0
	 * @return B2i  Singleton instance of plugin class.
	 */
	function b2i() {
		return B2i::get_instance();
	}


// Kick it off.
add_action( 'plugins_loaded', array( b2i(), 'hooks' ) );

register_activation_hook( __FILE__, array( b2i(), '_activate' ) );
register_deactivation_hook( __FILE__, array( b2i(), '_deactivate' ) );
