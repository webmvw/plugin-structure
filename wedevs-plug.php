<?php

/*
Plugin Name: Wedevs Plug
Plugin URI: https://webmkit.com/wedevs-plug
Author: webmk
Author URI: https://webmkit.com
Description: something
Version:1.0.0
Text Domain: wedevs-plug
Domain Path: /languages

*/

if(! defined('ABSPATH')){
	exit;
}


require_once __DIR__ . '/vendor/autoload.php';



/** 
* The main plugin class
*/
final class Wedevs_Academy{

	/**
	* Plugin Version
	* @var string
	*/
	const wd_version = '1.0.0';

	/**
	* class constructor
	*/
	private function __construct(){
		$this->define_constants();
		register_activation_hook( __FILE__ , [$this, 'activate'] );
		add_action('plugins_loaded', [$this, 'init_plugin']);
	}


	/**
	* Initailize a single instance
	* @return \Wedevs_Academy
	*/
	public static function init(){
		static $instance = false;
		if(! $instance ){
			$instance = new self();
		}
		return $instance;
	}

	public function define_constants(){
		define('WD_ACADEMY_VERSION', self::wd_version);
		define('WD_ACADEMY_FILE', __FILE__ );
		define('WD_ACADEMY_PATH', __DIR__ );
		define('WD_ACADEMY_URL', plugins_url('', WD_ACADEMY_FILE) );
		define('WD_ACADEMY_ASSETS', WD_ACADEMY_URL . '/assets');
	}

	public function activate(){
		$installed = get_option('wd_academy_installed');
		if(! $installed){
			update_option('wd_academy_installed', time() );
		}
		update_option('wd_academy_version', WD_ACADEMY_VERSION );
	}

	public function init_plugin(){

		if( is_admin() ){
			new WeDevs\Academy\Admin();	
		}else{
			new WeDevs\Academy\Frontend();
		}

		// load plugin assets
		new WeDevs\Academy\Assets();

	}

}



/**
* Initializes the main plugin
* @return \Wedevs_Academy
*/
function wedevs_academy(){
	return Wedevs_Academy::init();
}
wedevs_academy();