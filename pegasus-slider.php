<?php 
/*
Plugin Name: Pegasus Slider Plugin
Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
Description: This allows you to create sliders on your website with just a shortcode.
Version:     1.0
Author:      Jim O'Brien
Author URI:  https://visionquestdevelopment.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wporg
Domain Path: /languages
*/

	/**
	 * Silence is golden; exit if accessed directly
	 */
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	function pegasus_slider_menu_item() {
		//add_menu_page("Slider", "Slider", "manage_options", "pegasus_slider_plugin_options", "pegasus_slider_plugin_settings_page", null, 99);
		//add_submenu_page("pegasus_slider_plugin_options", "Shortcode Usage", "Usage", "manage_options", "pegasus_slider_plugin_shortcode_options", "pegasus_slider_plugin_shortcode_settings_page" );
	}
	add_action("admin_menu", "pegasus_slider_menu_item");

	function pegasus_slider_plugin_settings_page() { ?>
	    <div class="wrap">
	    <h1>Slider</h1>
		
		<form method="post" action="options.php">
	        <?php
	            settings_fields("section");
	            do_settings_sections("theme-options");      
	            submit_button(); 
	        ?>          
	    </form>
		
		</div>
	<?php
	}
	
	function pegasus_slider_plugin_shortcode_settings_page() { ?>
		<div class="wrap pegasus-wrap">
			<h1>Shortcode Usage</h1>
			<p>Slider Usage: <pre>[slider][slide class="testing"]<?php echo htmlspecialchars('<img class="alignnone size-full wp-image-12" src="http://www.fillmurray.com/960/550" alt="Gold-and-Black-Logo">'); ?>[/slide][slide]<?php echo htmlspecialchars('<img class="alignnone size-full wp-image-12" src="http://www.fillmurray.com/600/350" alt="Gold-and-Black-Logo">'); ?>[/slide][/slider]</pre></p>
			<p>Post Slider Usage: <pre>[news_slider the_query="showposts=100&post_type=post"]</pre> </p>
			<p>Thumb Slider Usage: <pre>[thumb_slider][thumb_slide title="slide1" number="1"]<?php echo htmlspecialchars('<img src="http://slippry.com/assets/img/image-1.jpg" alt="This is caption 1">'); ?>[/thumb_slide][thumb_slide title="slide2" number="2"]<?php echo htmlspecialchars('<img src="http://slippry.com/assets/img/image-2.jpg" alt="This is caption 2">'); ?>[/thumb_slide][thumb_slide title="slide3" number="3"]<?php echo htmlspecialchars('<img src="http://slippry.com/assets/img/image-3.jpg" alt="This is caption 3">'); ?>[/thumb_slide][thumb_slide title="slide4" number="4"]<?php echo htmlspecialchars('<img src="http://slippry.com/assets/img/image-4.jpg" alt="This is caption 4">'); ?>[/thumb_slide][/thumb_slider]</pre></p>
			
			
			<p style="color:red;">MAKE SURE YOU DO NOT HAVE ANY RETURNS OR <?php echo htmlspecialchars('<br>'); ?>'s IN YOUR SHORTCODES, OTHERWISE IT WILL NOT WORK CORRECTLY</p>
		
		</div>
		<?php
	}
	
	
	
	function pegasus_slider_plugin_styles() {
		
		wp_enqueue_style( 'slippery-css', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'css/slippery.css', array(), null, 'all' );
		wp_enqueue_style( 'slippery-slider-css', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'css/slippery-slider.css', array(), null, 'all' );
		
	}
	add_action( 'wp_enqueue_scripts', 'pegasus_slider_plugin_styles' );
	
	/**
	* Proper way to enqueue JS 
	*/
	function pegasus_slider_plugin_js() {
		
		wp_enqueue_script( 'slippery-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'js/slippery.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'pegasus-slider-plugin-js', trailingslashit( plugin_dir_url( __FILE__ ) ) . 'js/plugin.js', array( 'jquery' ), null, true );
		
	} //end function
	add_action( 'wp_enqueue_scripts', 'pegasus_slider_plugin_js' );
	
	
	
	
	
	/*~~~~~~~~~~~~~~~~~~~~
		SLIDER / carousel
	~~~~~~~~~~~~~~~~~~~~~*/
	
	/**
	* Slider Short Code
	*/
	if ( ! class_exists( 'SliderClass' ) ) {
	class SliderClass {

		protected $_slider_divs;

		public function __construct($slider_divs = '') {
			$this->_slider_divs = $slider_divs;
			add_shortcode( 'slider', array( $this, 'slider_wrap') );
			add_shortcode( 'slide', array( $this,'slider_block') );
		}

		function slider_wrap ( $args, $content = null ) {
			$wrapOutput = '';
			$wrapOutput .= '<ul class="slippry-slider-container ">';
			$wrapOutput .=  do_shortcode($content);
			$wrapOutput .= '</ul>';
		   return $wrapOutput;
		}

		function slider_block( $args, $content = null ) {
			extract(shortcode_atts(array(  
				'id' => '',
				'title' => '', 
				'class' => '', 
			), $args));
			
			
			$slideOutput = '<li class="'.$class.'"><a href="#'.$id.'" alt="'.$title.'">'.$content.'</a></li>';
			
			return $slideOutput;
		}

	}
	new SliderClass;
	}
	
	/*~~~~~~~~~~~~~~~~~~~~
		THUMB SLIDER / carousel
	~~~~~~~~~~~~~~~~~~~~~*/
	if ( ! class_exists( 'ThumbSliderClass' ) ) {
	class ThumbSliderClass {

		protected $_slider_divs;

		public function __construct($slider_divs = '') {
			$this->_slider_divs = $slider_divs;
			add_shortcode( 'thumb_slider', array( $this, 'slider_wrap') );
			add_shortcode( 'thumb_slide', array( $this,'slider_block') );
		}

		function slider_wrap ( $args, $content = null ) {
			$output = '';
			$output .= '<ul id="thumbnails">';
			$output .=  do_shortcode($content);
			$output .= '</ul>';
			$output .= '<div class="thumb-box"> <ul class="thumbs">';
			$output .= $this->_slider_divs;
			$output .= '</ul></div>';
			
		   return $output;
		}

		function slider_block( $args, $content = null ) {
			extract(shortcode_atts(array(  
				'id' => '',
				'title' => '', 
				'class' => '', 
				'number' => '', 
			), $args));

			$output = '<li><a href="#'.$title.'" alt="This is caption 2">'.$content.'</a></li>';

			$this->_slider_divs.= '<li><a href="#'.$number.'" data-slide="'.$number.'">'.$content.'</a></li>';

			return $output;
		}

	}
	new ThumbSliderClass;
	}
	
	
	/*~~~~~~~~~~~~~~~~~~~~
		News Slider shortcode
	~~~~~~~~~~~~~~~~~~~~~*/
	// [news_slider the_query="showposts=100&post_type=page&post_parent=453" bkg_color="#dedede" ]	
	function news_slider_query_shortcode($atts) {

		$a = shortcode_atts( array(
			//"bkg_color" => ''
		), $atts );
		
		// Defaults
		extract(shortcode_atts(array(
			"the_query" => '',
		), $atts));

		// de-funkify query
		//$the_query = preg_replace('~&#x0*([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $the_query);
		//$the_query = preg_replace('~&#0*([0-9]+);~e', 'chr(\\1)', $the_query);

		$the_query = preg_replace_callback('~&#x0*([0-9a-f]+);~', function($matches){
			return chr( dechex( $matches[1] ) );
		}, $the_query);

		$the_query = preg_replace_callback('~&#0*([0-9]+);~', function($matches){
			return chr( $matches[1] );
		}, $the_query);

		// query is made               
		query_posts($the_query);

		// Reset and setup variables
		$output = '';
		$temp_title = '';
		$temp_link = '';
		$temp_date = '';
		$temp_pic = '';
		$temp_content = '';
		$the_id = '';

		global $post;

		// the loop
		if (have_posts()) : while (have_posts()) : the_post();

			$temp_title = get_the_title($post->ID);
			$temp_link = get_permalink($post->ID);
			$temp_date = get_the_date($post->ID);
			$temp_pic = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
			if ( !$temp_pic ) {
				$temp_pic = get_template_directory_uri() . '/images/not-available.jpg';
			}
			$temp_excerpt = wp_trim_words( get_the_excerpt(), 150 );
			$temp_content = wp_trim_words( get_the_content(), 300 );
			$the_id = get_the_ID();
			

			// output all findings - CUSTOMIZE TO YOUR LIKING
			$output .= "<article>"; 
				$output .= "<div class='post-$the_id text-content'>";
				
					$output .= "<a href='$temp_link'><h2>$temp_title</h2></a>";
					$output .= "<i>$temp_date</i>";
					$output .= "<br>";
					$output .= "<p class='post-content'>";
					
					if(isset($temp_excerpt)) {
						$temporary_excerpt = substr(strip_tags($temp_excerpt), 0, 150);
						if($temporary_excerpt){
								$output .= $temporary_excerpt; 
								$output .= '...';
						}
					}else{  
						$more = 0; 
						$temporary = substr(strip_tags($temp_content), 0, 300); 
						if($temporary){ $output .= $temporary; $output .= '...'; } 
					}
					$output .= "</p>";
					$output .= "<a class='read-more-link clearfix' href='$temp_link'>Read More</a>";
				$output .= "</div>";

				if($temp_pic) { 
					$output .= "<div class='image-content'>";
					$output .= "<img class='post-img-feat' src='$temp_pic'>"; 
					$output .= "</div>";
				} 
				
				
			$output .= "</article>";
		endwhile; else:
			$output .= "nothing found.";
		endif;

		wp_reset_query();
		return '<section id="news-demo">' . $output . '</section>';
	   
	}
	add_shortcode("news_slider", "news_slider_query_shortcode");
	