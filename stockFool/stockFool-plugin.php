<?php
/*
Plugin Name: Stock Fool
Description:  Demonstrates just how amazing I am. Also displays
Version: 0.1
Author: (Fool Hopeful) Drew Teichman
Author URI: https://fool.ca
*/

// Include the framework only if another plugin has not already done so
$plugin_dir = ABSPATH . 'wp-content/plugins/stockFool/';

if (! class_exists('WordPress_Plugin_Settings')) {
    require('inc/wordpress-plugin-settings.php');
}

//Honestly did not have much call to use this Class besides for settings, but thought I'd show you I can work with OOP and not just WP Functions.
class stockFool extends WordPress_Plugin_Settings
{
    public $prefix = 'stockFool'; // this is super recommended

    public function __construct()
    {
        parent::__construct(); // this is required

        // Actions
        add_action('admin_menu', array($this, 'menu'));
        add_shortcode('stock', 'stock_shortcode');
    }


    public function menu()
    {
        add_options_page("stockFool", "stockFool", 'manage_options', "stockFool-plugin", array($this, 'admin_page'));
    }

    public function admin_page()
    {
        include 'stockFool-plugin-admin.php';
        wp_register_style('style', plugin_dir_url(__FILE__) . 'inc/style.css');
        wp_enqueue_style('style');
    }


    public function activate()
    {
				//My one lonely setting
        $this->add_setting('financialmodelingprep_API', '1a2abc9df3aed370108ba7b4db47314d');
    }
}


$stockFool = new stockFool();

//Style things up a bit
function your_namespace()
{
    wp_register_style('namespace', plugins_url('inc/style.css', __FILE__));
    wp_enqueue_style('namespace');
}
add_action('wp_enqueue_scripts', 'your_namespace');

//Shortcode for FoolBox and FoolBar useage [Stock display="Sample Text" symbol="TEST" type="bar|box"]
function stock_shortcode($params = array())
{
    $stockFool = new stockFool();
    extract(shortcode_atts(array(
            'symbol' => 'symbol',
            'display' => 'display',
            'type' => 'type'
        ), $params));

    $stockArray = array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'symbol' => $symbol,
                'display' => $display,
                'type' => $type,
                'apikey' => $stockFool->get_setting('financialmodelingprep_API')
        );

    wp_register_script('stock_shortcode', plugin_dir_url(__FILE__) . 'inc/scripts.js', array('jquery'), '1.1', true);

    wp_enqueue_script('stock_shortcode');

    wp_localize_script('stock_shortcode', 'stockFool_ajax_object', $stockArray);
    if ($type == 'bar') {
        return "<span class='activeSymbol stock highlight' data-symbol='" . $symbol . "' data-type='" . $type . "'>" . $display . "</span>";
    } elseif ($type == 'box') {
        return '<div class="stockBoxContainer">
				<div class="stockBoxHeader">
				</div>
				<div class="stockBoxHeader">
					<div id="box-chart-heading"><h4>Stock Profile</h4><h5><span class="boxData" id="companyName"></span> - <span class="boxData" id="symbol"></span></h5></div>
					<ul class="flex-container">
						<li class="flex-item"><span class="boxHeader">Price</span><br><span class="boxData" id="price"></span></li>
						<li class="flex-item"><span class="boxHeader">Changes</span><br><span class="boxData" id="changes"></span></li>
						<li class="flex-item"><span class="boxHeader">Change Percentage</span><br><span class="boxData" id="changePercentage"></span></li>
						<li class="flex-item"><span class="boxHeader">52 Week Range</span><br><span class="boxData" id="range"></span></li>
						<li class="flex-item"><span class="boxHeader">Beta</span><br><span class="boxData" id="beta"></span></li>
						<li class="flex-item"><span class="boxHeader">Volume Average</span><br><span class="boxData" id="volAvg"></span></li>
						<li class="flex-item"><span class="boxHeader">Market Capitalisation</span><br><span class="boxData" id="mktCap"></span></li>
						<li class="flex-item"><span class="boxHeader">Last Dividend</span><br><span class="boxData" id="lastDiv"></span></li>
					</ul>
				</div>
			</div>';
    }
}
add_shortcode('stock', 'stock_shortcode');

// This way it is always included so will be read by screen readers too
add_action('wp_footer', 'foolBar');
function foolBar()
{
    include 'inc/foolbar.php';
}





add_action('wp_enqueue_scripts', 'enqueue_load_fa');
function enqueue_load_fa()
{
    wp_enqueue_style('load-fa', 'https://use.fontawesome.com/releases/v5.15.3/css/all.css');
}
