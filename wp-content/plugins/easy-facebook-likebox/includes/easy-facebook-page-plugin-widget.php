<?php
class Easy_Facebook_Page_Plugin_Widget extends WP_Widget {
 
	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'easy_facebook_page_plugin', // Base ID
			__('Easy Facebook Likebox', 'easy-facebook-likebox'), // Name
			array( 'description' => __( 'Drag and drop this widget for facebook page plugin integration', 'easy-facebook-likebox' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		global $efbl;
		$title = apply_filters( 'widget_title', $instance['title'] );
 
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
			
		echo $efbl->render_fb_page_plugin($instance);
		 
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
  		
  		//Get locales
	 	$locales = efbl_get_locales();
	 	
	 	//Get effects
	 	$css3_effects = get_css3_animations();

		$defaults = array(
						  'title'			=> '',
						  'fb_appid'		=>	'',
						  'fanpage_url' 	=> 'https://www.facebook.com/maltathemes',
						  'box_width'		=>	250,
						  'box_height' 		=>  '',
 						  'show_faces' 		=> 1,
						  'show_stream' 	=> 0,
 						  'hide_cover' 		=> 0,
						  'responsive'		=> 0,
						  'hide_cta'		=> 0,
						  'small_header'	=> 0,
						  'locale' 			=> 'en_US',
						  'locale_other'	=> '',
						  'animate_effect'	=> 'fadeIn',
						  );
 		
		$instance = wp_parse_args( (array) $instance, $defaults );
		
 		extract($instance, EXTR_SKIP);
 
 		?>
 
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' , 'easy-facebook-likebox' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'fanpage_url' ); ?>"><?php _e( 'Fanpage Url:', 'easy-facebook-likebox' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'fanpage_url' ); ?>" name="<?php echo $this->get_field_name( 'fanpage_url' ); ?>" type="text" value="<?php echo esc_attr( $fanpage_url ); ?>"><br />
		<i>Full url including http://</i>
		</p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'fb_appid' ); ?>"><?php _e( 'Application ID:', 'easy-facebook-likebox' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'fb_appid' ); ?>" name="<?php echo $this->get_field_name( 'fb_appid' ); ?>" type="text" value="<?php echo esc_attr( $fb_appid ); ?>"><br />
		<i>Optional</i>
		</p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'box_width' ); ?>"><?php _e( 'Width:', 'easy-facebook-likebox' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'box_width' ); ?>" name="<?php echo $this->get_field_name( 'box_width' ); ?>" type="text" value="<?php echo esc_attr( $box_width ); ?>"><br />
 		</p>
        
        <p>
		<label for="<?php echo $this->get_field_id( 'box_height' ); ?>"><?php _e( 'Height:', 'easy-facebook-likebox' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'box_height' ); ?>" name="<?php echo $this->get_field_name( 'box_height' ); ?>" type="text" value="<?php echo esc_attr( $box_height ); ?>"><br />
 		</p>
          
       
       <p >
		<label for="<?php echo $this->get_field_id( 'locale' ); ?>"><?php _e( 'Locale:', 'easy-facebook-likebox' ); ?></label>
        
        
            <select class="widefat" id="<?php echo $this->get_field_id( 'locale' ); ?>" name="<?php echo $this->get_field_name( 'locale' ); ?>">
            <?php if($locales){
						foreach ($locales as $key=>$value){?>
                <option <?php selected( $locale, $key , $echo = true); ?> value="<?php echo $key?>"><?php echo $value?></option>
                <?php }
				}?>
             </select> 
             <i><?php _e( 'Language of your page' , 'easy-facebook-likebox' ); ?></i>
  		</p>

  		  <p >
		<label for="<?php echo $this->get_field_id( 'animate_effect' ); ?>"><?php _e( 'Animation:', 'easy-facebook-likebox' ); ?></label>
        	
        
            <select class="widefat" id="<?php echo $this->get_field_id( 'animate_effect' ); ?>" name="<?php echo $this->get_field_name( 'animate_effect' ); ?>">
            <?php if($css3_effects){
						foreach ($css3_effects as $key=>$value){?>
						<optgroup label="<?php echo $key?>">

							<?php 
								if($value){
									foreach ($value as $val){?>
							
							 <option <?php selected( $animate_effect, $val , $echo = true); ?> value="<?php echo $val?>"><?php echo $val?></option>
			                <?php }
							}?>
						</optgroup>
                <?php }
				}?>
             </select> 
             <i><?php _e( 'Select the CSS three animation effect' , 'easy-facebook-likebox' ); ?></i>
  		</p>
        
         <p>
		<label for="<?php echo $this->get_field_id( 'locale_other' ); ?>"><?php _e( 'Locale (Other):', 'easy-facebook-likebox' ); ?></label>
        <input class="widefat" id="<?php echo $this->get_field_id( 'locale_other' ); ?>" name="<?php echo $this->get_field_name( 'locale_other' ); ?>" type="text" value="<?php echo esc_attr( $locale_other ); ?>" placeholder="en_US">
              
             <i><?php _e( 'input locale if you can not find yours in dropdown list in this format e.g fr_FR for frecnh.' , 'easy-facebook-likebox' ); ?></i>
  		</p>
           
           <p class="widget-half">
	        <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'responsive' ); ?>" name="<?php echo $this->get_field_name( 'responsive' ); ?>" value="1" <?php checked( $responsive, 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'responsive' ); ?>">Responsive</label>
			
		</p>
        
        <p class="widget-half">
	        <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_faces' ); ?>" name="<?php echo $this->get_field_name( 'show_faces' ); ?>" value="1" <?php checked( $show_faces, 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_faces' ); ?>"><?php _e( 'Show Faces', 'easy-facebook-likebox' ); ?></label>
			
		</p>
        
         <p class="widget-half">
	        <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'hide_cover' ); ?>" name="<?php echo $this->get_field_name( 'hide_cover' ); ?>" value="1" <?php checked( $hide_cover, 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'hide_cover' ); ?>"><?php _e( 'Hide Cover Photo', 'easy-facebook-likebox' ); ?></label>
			
		</p>
        
        <p class="widget-half">
        <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'show_stream' ); ?>" name="<?php echo $this->get_field_name( 'show_stream' ); ?>" value="1" <?php checked( $show_stream, 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'show_stream' ); ?>"><?php _e( 'Show Posts', 'easy-facebook-likebox' ); ?></label>
			
		</p>
         <p class="widget-half">
        <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'hide_cta' ); ?>" name="<?php echo $this->get_field_name( 'hide_cta' ); ?>" value="1" <?php checked( $hide_cta, 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'hide_cta' ); ?>"><?php _e( 'Hide CTA button', 'easy-facebook-likebox' ); ?></label>
			
		</p>
        <p class="widget-half">
        <input type="checkbox" class="widefat" id="<?php echo $this->get_field_id( 'small_header' ); ?>" name="<?php echo $this->get_field_name( 'small_header' ); ?>" value="1" <?php checked( $small_header, 1 ); ?>>
			<label for="<?php echo $this->get_field_id( 'small_header' ); ?>"><?php _e( 'Use small header', 'easy-facebook-likebox' ); ?></label>
			
		</p>
        
        
        
         <div class="clearfix"></div>
        
        <p><?php _e( 'Use below shortcode to display like box inside pages, posts or in any shortcode aware textarea/editor', 'easy-facebook-likebox' ); ?></p>
        <?php 
		if( empty($show_stream) ){
			$show_stream = 0;
		}
		
		if( empty($show_faces) ){
			$show_faces = 0;
		}
		
		if( empty($show_header) ){
			$show_header = 0;
		}
		
		if( empty($hide_cover) ){
			$hide_cover = 0;
		}
		
		if( !empty($locale_other) ){
			$locale = $locale_other;
		}
		
		if( !empty($fb_appid) ){
			$fb_appid = 'fb_appid="'.$fb_appid.'"';
		}
		
	 
		$fanpage_url = efbl_parse_url(  $fanpage_url );
		/*echo "<pre>";
		print_r( $fb_url  );
  		echo "</pre>";*/
 		
		$responsive = (  empty( $responsive ) ) ? strip_tags( 0 ) : $responsive;
		
		$hide_cta = (  empty( $hide_cta ) ) ? strip_tags( 0 ) : $hide_cta;
		
		$small_header = (  empty( $small_header ) ) ? strip_tags( 0 ) : $small_header;
		
		?>
        
        <p style="background:#ddd; padding:5px; "><?php echo '[efb_likebox fanpage_url="'.$fanpage_url.'" '.$fb_appid.' box_width="'.$box_width.'" box_height="'.$box_height.'"  locale="'.$locale.'" responsive="'.$responsive.'" show_faces="'.$show_faces.'"  show_stream="'.$show_stream.'" hide_cover="'.$hide_cover.'" small_header="'.$small_header.'" hide_cta="'.$hide_cta.'" animate_effect="'.$animate_effect.'" ]'?></p>
         
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['fanpage_url'] = ( ! empty( $new_instance['fanpage_url'] ) ) ? strip_tags( $new_instance['fanpage_url'] ) : '';
		$instance['fb_appid'] = ( ! empty( $new_instance['fb_appid'] ) ) ? strip_tags( $new_instance['fb_appid'] ) : '';
		$instance['show_faces'] = ( ! empty( $new_instance['show_faces'] ) ) ? strip_tags( $new_instance['show_faces'] ) : '';
		$instance['show_stream'] = ( ! empty( $new_instance['show_stream'] ) ) ? strip_tags( $new_instance['show_stream'] ) : '';
		$instance['hide_cover'] = ( ! empty( $new_instance['hide_cover'] ) ) ? strip_tags( $new_instance['hide_cover'] ) : '';
 		$instance['box_height'] = ( ! empty( $new_instance['box_height'] ) ) ? strip_tags( $new_instance['box_height'] ) : '';
		$instance['box_width'] = ( ! empty( $new_instance['box_width'] ) ) ? strip_tags( $new_instance['box_width'] ) : '';
 		
		$instance['responsive'] = ( ! empty( $new_instance['responsive'] ) ) ? strip_tags( $new_instance['responsive'] ) : '';
		$instance['small_header'] = ( ! empty( $new_instance['small_header'] ) ) ? strip_tags( $new_instance['small_header'] ) : '';
		$instance['hide_cta'] = ( ! empty( $new_instance['hide_cta'] ) ) ? strip_tags( $new_instance['hide_cta'] ) : '';
		
 		$instance['locale'] = ( ! empty( $new_instance['locale'] ) ) ? strip_tags( $new_instance['locale'] ) : '';
		$instance['locale_other'] = ( ! empty( $new_instance['locale_other'] ) ) ? strip_tags( $new_instance['locale_other'] ) : '';
		
		$instance['animate_effect'] = ( ! empty( $new_instance['animate_effect'] ) ) ? strip_tags( $new_instance['animate_effect'] ) : '';

		
		
		return $instance;
	}
	
} // class Foo_Widget
?>