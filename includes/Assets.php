<?php 
namespace WeDevs\Academy;

/**
* The Assets class
*/
class Assets{
	
	function __construct(){
		add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
		add_action('admin_wp_enqueue_scripts', [$this, 'enqueue_assets']);
	}

	public function enqueue_assets(){
		//register script
		wp_register_script('academy-script', WD_ACADEMY_ASSETS.'js/frontend.js', false, filemtime(WD_ACADEMY_PATH.'/assets/js/frontend.js'), true);
		// enqueue script
		wp_enqueue_script('academy-script');



		// register style
		wp_register_style('academy-style', WD_ACADEMY_ASSETS.'css/frontend.css', false, filemtime(WD_ACADEMY_PATH.'/assets/css/frontend.css'), true);

		// enqueue style
		wp_enqueue_style('academy-style');
	}

}