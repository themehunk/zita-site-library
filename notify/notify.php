<?php
// Exit if accessed directly.
if (!defined('ABSPATH')){
    exit;
}

if ( ! class_exists( 'ThemeHunk_Notify' ) ){

class ThemeHunk_Notify{

    function __construct(){
		if(isset($_GET['notice-disable']) && $_GET['notice-disable'] == true){
		add_action('admin_init', array($this,'set_cookie'));
		}


		if(!isset($_COOKIE['thc_time'])) {

			add_action( 'admin_notices', array($this,'notify'));

		}

		if(isset($_COOKIE['thc_time'])) {
			add_action( 'admin_notices', array($this,'unset_cookie'));
		}

	}


	function set_cookie() { 
 
		$visit_time = date('F j, Y  g:i a');

			$cok_time = time()+(86457*30);
 
		if(!isset($_COOKIE['thc_time'])) {
 
			// set a cookie for 1 year
		setcookie('thc_time', $cok_time, time()+(86457*30));
			 
		}
 
	}

		function unset_cookie(){

			$visit_time = time();
  			$cookie_time = $_COOKIE['thc_time'];

			if ($cookie_time < $visit_time) {
				setcookie('thc_time', null, strtotime('-1 day'));
			}
	}

	function notify(){
		  $my_theme = wp_get_theme();
		  $theme =  esc_html( $my_theme->get( 'TextDomain' ) );
		  		  $display = isset($_GET['notice-disable'])?'none':'block';

		?>
		  <div class="notice th-notice-slide-wrap" style="display:<?php echo $display; ?>;">
		    <a href="?notice-disable=1" style="float: right; margin-top: 5px; color: #b30000;" class="notice-hide dashicons dashicons-dismiss dashicons-dismiss-icon"></a>
		    <iframe src="https://themehunk.com/feature/plugin-notify/?theme=<?php echo $theme; ?>" height="300" width="100%"></iframe>
		</div>

<?php } 


}

$obj = New ThemeHunk_Notify();

 } // if class end ?>
