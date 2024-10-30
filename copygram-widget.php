<?php
/*
Plugin Name: Copygram widget
Plugin URI: http://jonk.pirateboy.net/blog/category/bloggeriet/wordpress/plugins/
Description: Show your latest Instagram images in a widget. Images are linked to Copygram, where all your Instagram images are visible in a very nice grid. 
Version: 0.6
Author: Jonk
Author URI: http://jonk.pirateboy.net
*/
class Copygram_widget extends WP_Widget {
	
	// Settings
	var $default_copygramurl = 'http://copygr.am/copygram/';
	var $default_title = 'My images from Instagram';
	var $default_imageCount	= '4';
	var $default_imgSize = '150';
	var $default_padding = '5';
	var $default_target = '_blank';
	var $default_useOwnCss = null;
	var $default_linkLargeImgSrc = null;
	var $default_instagramOrCopygram = null;

	public function __construct() {
		// widget actual processes
		parent::__construct(
	 		'copygram-widget', // Base ID
			'Copygram widget', // Name
			array( 'description' => __( 'A Copygram Widget', 'text_domain' ), ) // Args
		);
	}

 	public function form( $instance ) {
		// outputs the options form on admin
		if ( isset( $instance[ 'copygramurl' ] ) ) {
			$copygramurl = $instance[ 'copygramurl' ];
		}
		else {
			$copygramurl = __( $this->default_copygramurl, 'text_domain' );
		}
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( $this->default_title, 'text_domain' );
		}
		if ( isset( $instance[ 'imageCount' ] ) ) {
			$imageCount = $instance[ 'imageCount' ];
		}
		else {
			$imageCount = __( $this->default_imageCount, 'text_domain' );
		}
		if ( isset( $instance[ 'imgSize' ] ) ) {
			$imgSize = $instance[ 'imgSize' ];
		}
		else {
			$imgSize = __( $this->default_imgSize, 'text_domain' );
		}
		if ( isset( $instance[ 'padding' ] ) ) {
			$padding = $instance[ 'padding' ];
		}
		else {
			$padding = __( $this->default_padding, 'text_domain' );
		}
		if ( isset( $instance[ 'target' ] ) ) {
			$target = $instance[ 'target' ];
		}
		else {
			$target = __( $this->default_target, 'text_domain' );
		}
		if ( isset( $instance[ 'useOwnCss' ] ) ) {
			$useOwnCss = $instance[ 'useOwnCss' ];
		}
		else {
			$useOwnCss = __( $this->default_useOwnCss, 'text_domain' );
		}
		if ( isset( $instance[ 'linkLargeImgSrc' ] ) ) {
			$linkLargeImgSrc = $instance[ 'linkLargeImgSrc' ];
		}
		else {
			$linkLargeImgSrc = __( $this->default_linkLargeImgSrc, 'text_domain' );
		}
		if ( isset( $instance[ 'instagramOrCopygram' ] ) ) {
			$instagramOrCopygram = $instance[ 'instagramOrCopygram' ];
		}
		else {
			$instagramOrCopygram = __( $this->default_instagramOrCopygram, 'text_domain' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'copygramurl' ); ?>"><?php _e( 'Instagram username:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'copygramurl' ); ?>" name="<?php echo $this->get_field_name( 'copygramurl' ); ?>" type="text" value="<?php echo esc_attr( $copygramurl ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'imageCount' ); ?>"><?php _e( 'Number of images:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'imageCount' ); ?>" name="<?php echo $this->get_field_name( 'imageCount' ); ?>" type="text" value="<?php echo esc_attr( $imageCount ); ?>" />
			<br/><span style="font-style:italic;">only numbers</span>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'imgSize' ); ?>"><?php _e( 'Image size:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'imgSize' ); ?>" name="<?php echo $this->get_field_name( 'imgSize' ); ?>" type="text" value="<?php echo esc_attr( $imgSize ); ?>" />
			<br/><span style="font-style:italic;">only numbers</span>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'padding' ); ?>"><?php _e( 'Padding:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'padding' ); ?>" name="<?php echo $this->get_field_name( 'padding' ); ?>" type="text" value="<?php echo esc_attr( $padding ); ?>" />
			<br/><span style="font-style:italic;">only numbers</span>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'target' ); ?>"><?php _e( 'Target:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'target' ); ?>" name="<?php echo $this->get_field_name( 'target' ); ?>" type="text" value="<?php echo esc_attr( $target ); ?>" />
			<br/><span style="font-style:italic;">_blank, _self or _top</span>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'useOwnCss' ); ?>" name="<?php echo $this->get_field_name( 'useOwnCss' ); ?>" type="checkbox" value="1" <?php if ($useOwnCss == 1) { ?>checked="checked"<?php } ?> />
			<label for="<?php echo $this->get_field_id( 'useOwnCss' ); ?>"><?php _e( 'Exclude css' ); ?></label> 
			<br/><span style="font-style:italic;">If you are using multiple Copygram-widgets on the same page, check this except for the first widget. Or check it if you want to write your own css.</span>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'linkLargeImgSrc' ); ?>" name="<?php echo $this->get_field_name( 'linkLargeImgSrc' ); ?>" type="checkbox" value="1" <?php if ($linkLargeImgSrc == 1) { ?>checked="checked"<?php } ?> />
			<label for="<?php echo $this->get_field_id( 'linkLargeImgSrc' ); ?>"><?php _e( 'Link to image' ); ?></label> 
			<br/><span style="font-style:italic;">Check this if you don't want to link to Copygram, and instead link directly to the large version of the image.</span>
		</p>
		<p>
			<input id="<?php echo $this->get_field_id( 'instagramOrCopygram' ); ?>" name="<?php echo $this->get_field_name( 'instagramOrCopygram' ); ?>" type="checkbox" value="1" <?php if ($instagramOrCopygram == 1) { ?>checked="checked"<?php } ?> />
			<label for="<?php echo $this->get_field_id( 'instagramOrCopygram' ); ?>"><?php _e( 'Link to Instagram' ); ?></label> 
			<br/><span style="font-style:italic;">Check this if you don't want to link to Copygram, and instead link to the Instagram page (overridden by 'Link to image'.</span>
		</p>
		<?php 
	}

	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array();
		$instance['copygramurl'] = strip_tags( $new_instance['copygramurl'] );
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['imageCount'] = strip_tags( $new_instance['imageCount'] );
		$instance['imgSize'] = strip_tags( $new_instance['imgSize'] );
		$instance['padding'] = strip_tags( $new_instance['padding'] );
		$instance['target'] = strip_tags( $new_instance['target'] );
		$instance['useOwnCss'] = strip_tags( $new_instance['useOwnCss'] );
		$instance['linkLargeImgSrc'] = strip_tags( $new_instance['linkLargeImgSrc'] );
		$instance['instagramOrCopygram'] = strip_tags( $new_instance['instagramOrCopygram'] );
		/*clear the cache when saved*/
		$delChars = array("/", ":", ".");
		$key = str_replace($delChars, "", $instance['copygramurl']);
		delete_transient( $key );
		/*/clear the cache when saved*/
		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		
		if (!$copygramurl = $instance['copygramurl'])
			$copygramurl = $this->default_copygramurl;
		if (!$title = $instance['title'])
			$title = $this->default_title;
		if (!$imageCount = $instance['imageCount'])
			$imageCount = $this->default_imageCount;
		if (!$imgSize = $instance['imgSize'])
			$imgSize = $this->default_imgSize;
		if (!$padding = $instance['padding'])
			$padding = $this->default_padding;
		if (!$target = $instance['target'])
			$target = $this->default_target;
		if (!$useOwnCss = $instance['useOwnCss'])
			$useOwnCss = $this->default_useOwnCss;
		if (!$linkLargeImgSrc = $instance['linkLargeImgSrc'])
			$linkLargeImgSrc = $this->default_linkLargeImgSrc;
		if (!$instagramOrCopygram = $instance['instagramOrCopygram'])
			$instagramOrCopygram = $this->default_instagramOrCopygram;
		
		if ($useOwnCss == null) {
			$style = '<!-- copygram-widget css -->
			<style type="text/css">
				.copygram-widget {
					display:block;
					clear:both;
				}
				.copygram-widget .copygram-widget-item {
					display:inline;
					float:left;
					padding:0 '.$padding.'px '.$padding.'px 0;
				}
				.copygram-widget a {
					display:block;
					clear:both;
					position:relative;
					cursor:pointer;
					overflow:hidden;
				}
				.copygram-widget a, .copygram-widget a * {
					text-decoration:none;
				}
				.copygram-widget a .copygram-widget-text {
					position:absolute;
					left:0;
					bottom:0;
					width:100%;
					display:none;
					clear:both;
					background-color:#000;
					color:#fff;
					opacity:0.8;
					font-size:0.9em;
					font-weight:normal;
				}
				.copygram-widget a:hover {
					opacity:0.8;
				}
				.copygram-widget a:hover .copygram-widget-text {
					display:block;
				}
				.copygram-widget a:hover .copygram-widget-text-p {
					padding:5px;
				}
				.copygram-widget a img {
					max-width:100%;
				}
				.copygram-widget-clear {
					clear: both;
					display: block;
					overflow: hidden;
					visibility: hidden;
					width: 0;
					height: 0;
				}
			</style>';
			print($style);
		}
		
		// outputs the content of the widget
		print($before_widget);
		
		if (!empty( $title)) {
			print($before_title . $title . $after_title);
		}
		print(copygramWidgetGetImages($copygramurl,$imageCount,$imgSize,$target,$linkLargeImgSrc,$instagramOrCopygram));
		print($after_widget);
	}
}

function copygramWidgetImgSize($imgSrc,$imgSize,$getWH) {
	if ($imgSize <= 225) {
		$imgSrc = str_replace("_7.jpg", "_5.jpg", $imgSrc);
	} elseif ($imgSize > 225 && $imgSize <= 450) {
		$imgSrc = str_replace("_7.jpg", "_6.jpg", $imgSrc);
	}
	if ($getWH) {
		return $imgSize . 'px';
	} else  {
		return $imgSrc;
	}
}

function copygramWidgetGetImages($url,$imageCount,$imgSize,$target,$linkLargeImgSrc,$instagramOrCopygram) {
	// Cache from "Twitter followers count using WordPress transients"
	// http://www.catswhocode.com/blog/wordpress-transients-api-practical-examples
	$delChars = array("/", ":", ".");
	$key = str_replace($delChars, "", $url);
	// Let's see if we have a cached version
	$copygramWidgetCode = get_transient($key);
	if ($copygramWidgetCode !== false) {
		// Returns cached code since cache is too young
		return $copygramWidgetCode;
	} else {
		if ($instagramOrCopygram != 1 || $linkLargeImgSrc != null) {
			if (strpos($url,'copygr.am') === false) {
				$url = 'http://copygr.am/' . $url . '/';
			}
			if (substr($url, -1) != '/') {
				$url = $url . '/';
			}
			$response = wp_remote_get($url . 'rss');
			$url = $url . 'rss';
		} else {
			$response = wp_remote_get('http://instagrss-mgng.rhcloud.com/' . $url);
			$url = 'http://instagrss-mgng.rhcloud.com/' . $url;
		}
		if (is_wp_error($response)) {
			// Returns cached code since rss is not responding
			return get_option($key);
		} else {
			$doc = new DOMDocument();
			$doc->load($url);
			$html = '<div class="copygram-widget">';
			$countImgs = 0;
			foreach ($doc->getElementsByTagName('item') as $node) {
				$countImgs++;
				if ($countImgs <= $imageCount) {
					$title = $node->getElementsByTagName('title')->item(0)->nodeValue;

					$imgThmbSrc = $node->getElementsByTagName('description')->item(0)->nodeValue;
					
					$imgThmb = copygramWidgetImgSize($imgThmbSrc,$imgSize,false);
					if ($linkLargeImgSrc == null) {
						$link = $node->getElementsByTagName('link')->item(0)->nodeValue;
					} else {
						$link = $imgThmbSrc;
					}
					$wH = 'style="width:'.copygramWidgetImgSize($imgThmbSrc,$imgSize,true).';height:'.copygramWidgetImgSize($imgThmbSrc,$imgSize,true).';"';
					if ($instagramOrCopygram != 1 || $linkLargeImgSrc != null) {
						$imgThmbCode = '<img src="'.$imgThmb.'" '.$wH.' alt="'.$title.'"/>';
					} else {
						$imgThmbCode = $node->getElementsByTagName('description')->item(0)->nodeValue;
					}
					$html .= '<div class="copygram-widget-item">
					<a href="'.$link.'" target="'.$target.'" '.$wH.'>
						'.$imgThmbCode.'
						<div class="copygram-widget-text"><div class="copygram-widget-text-p">'.$title.'</div></div>
					</a>
					</div>';
				} else {
					$countImgs--;
					break;
				}
			}
			$html .= '</div><!-- end .copygram-widget --><div class="copygram-widget-clear"></div>';
			// Only update the database if rss parsed ok
			if ($countImgs > 0) {
				// Store the result in a transient, expires after 1 day
				// Also store it as the last successful using update_option
				set_transient($key, $html, 60*60*1); // 1 hour
				update_option($key, $html);
			} else {
				// Let's not hammer the rss just because it's down
				set_transient($key, get_option($key), 60*30); // 0,5 hour
				update_option($key, get_option($key));
			}
		}
	}
	return $html;
}
add_action( 'widgets_init', create_function( '', 'register_widget( "Copygram_widget" );' ) );
?>
