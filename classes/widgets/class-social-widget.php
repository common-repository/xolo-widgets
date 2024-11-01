<?php
if ( ! class_exists( 'xolo_social_icon_widget' ) ) :

	class xolo_social_icon_widget extends WP_Widget{
			// Construct
			public function __construct() {
			
				parent::__construct(
					"Social_Widget", 
					"Xolo Social Widget",
					array("description" => __( 'Social Icon Widgets', 'xolo-widgets' ), ) 
				);	
				
				$this->defaults = array(
					'title' => __( 'Social Icon', 'xolo_social_icon_widget' ),				
					'social' => array()
				);
			
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
			}
			function enqueue_scripts() {
				
				wp_enqueue_style( 'xolo-widgets' );
			}
			function enqueue_admin_scripts() {
				
			}

			
	// Widget Form Section  
	function form( $instance ) {
		if ( isset( $instance[ 'icon_font_size' ])){
			$icon_font_size = $instance[ 'icon_font_size' ];
		}
		else {
			$icon_font_size = '16';
		}
		
		if ( isset( $instance[ 'icon_border_radius' ])){
			$icon_border_radius = $instance[ 'icon_border_radius' ];
		}
		else {
			$icon_border_radius = '3';
		}
		
		
		if ( isset( $instance[ 'icon_color' ])){
			$icon_color = $instance[ 'icon_color' ];
		 }
		else {
			$icon_color = '#e3e3e3';
		 }
		 
		 if ( isset( $instance[ 'icon_bg_color' ])){
			$icon_bg_color = $instance[ 'icon_bg_color' ];
		 }
		else {
			$icon_bg_color = '#fff';
		 }
		$instance = wp_parse_args( (array) $instance, $this->defaults );

		//$social_links = $this->get_social();
		$social_links = get_social();
	?>
			<p>
				<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e( 'Title', 'xolo-widgets' ); ?>:</label>
				<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" type="text" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" />
			</p>
			<ul class="mks_social_container mks-social-sortable">
			  <?php foreach ( $instance['social'] as $link ) : ?>
				  <li>
					<?php $this->draw_social( $this, $social_links, $link ); ?>
				  </li>
				<?php endforeach; ?>
			</ul>
			<p>
				<a href="#" class="mks_add_social button"><?php _e( 'Add Icon', 'xolo-widgets' ); ?></a>
			</p>

		  <div class="mks_social_clone" style="display:none">
				<?php $this->draw_social( $this, $social_links ); ?>
		  </div>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'icon_font_size' )); ?>"><?php _e( 'Icon Font Size:','xolo-widget' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'icon_font_size' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_font_size' )); ?>" type="number" value="<?php if($icon_font_size) echo esc_attr( $icon_font_size ); ?>" />
			
			<label for="<?php echo esc_attr($this->get_field_id( 'icon_border_radius' )); ?>"><?php _e( 'Icon Border Radius:','xolo-widget' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'icon_border_radius' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_border_radius' )); ?>" type="number" value="<?php if($icon_border_radius) echo esc_attr( $icon_border_radius ); ?>" />
			
		</p>
		
		<p>
            <label for="<?php echo esc_attr($this->get_field_id( 'icon_color' )); ?>"><?php _e( 'Icon Color','xolo-widget'); ?></label>
            <input class="my-color-picker" type="text" id="<?php echo esc_attr($this->get_field_id( 'icon_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_color' )); ?>" value="<?php if($icon_color) echo esc_attr( $icon_color ); ?>" />                            
        </p>
		
		<p>
            <label for="<?php echo esc_attr($this->get_field_id( 'icon_bg_color' )); ?>"><?php _e( 'Background Color','xolo-widget'); ?></label>
            <input class="my-color-picker" type="text" id="<?php echo esc_attr($this->get_field_id( 'icon_bg_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_bg_color' )); ?>" value="<?php if($icon_bg_color) echo esc_attr( $icon_bg_color ); ?>" />                            
        </p>
			
	<?php
		}

		function draw_social( $widget, $social_links, $selected = array( 'icon' => '', 'url' => '' ) ) { ?>

					<label class="mks-sw-icon"><?php _e( 'Icon', 'xolo-widgets' ); ?> :</label>
					<select type="text" class="iconPicker" name="<?php echo esc_attr($widget->get_field_name( 'social_icon' )); ?>[]" value="<?php echo esc_attr($selected['icon']); ?>" style="font-family: 'FontAwesome', Arial; width: 82%">
						<?php foreach ( $social_links as $key => $link ) : ?>
							<option value="<?php echo esc_attr($key); ?>" <?php selected( $key, $selected['icon'] ); ?>><?php echo $link; ?></option>
						<?php endforeach; ?>
					</select>
					</br>
					<label class="mks-sw-icon"><?php _e( 'Url', 'meks-smart-social-widget' ); ?> :</label>
					<input type="text" name="<?php echo esc_attr($widget->get_field_name( 'social_url' )); ?>[]" value="<?php echo esc_attr($selected['url']); ?>" placeholder="Example.com" style="width: 82%">


					<span class="mks-remove-social dashicons dashicons-no-alt"></span>

		<?php }
		
		// Upadte data
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['title'] = strip_tags( $new_instance['title'] );	
			$instance['social'] = array();
			if ( !empty( $new_instance['social_icon'] ) ) {
				$protocols = wp_allowed_protocols();
				$protocols[] = 'skype'; 
				for ( $i=0; $i < ( count( $new_instance['social_icon'] ) - 1 ); $i++ ) {
					$temp = array( 'icon' => $new_instance['social_icon'][$i], 'url' => esc_url( $new_instance['social_url'][$i], $protocols ) );
					$instance['social'][] = $temp;
				}
			}
			$instance['icon_font_size'] = ( ! empty( $new_instance['icon_font_size'] ) ) ? sanitize_text_field( $new_instance['icon_font_size'] ) : '';
			$instance['icon_border_radius'] = ( ! empty( $new_instance['icon_border_radius'] ) ) ? sanitize_text_field( $new_instance['icon_border_radius'] ) : '';
			$instance['icon_color'] = sanitize_hex_color($new_instance['icon_color']);
			$instance['icon_bg_color'] = sanitize_hex_color($new_instance['icon_bg_color']);
			return $instance;
		}
		
		// Front page data
		function widget( $args, $instance ) {

			extract( $args );

			$instance = wp_parse_args( (array) $instance, $this->defaults );
			
			$title = apply_filters( 'widget_title', $instance['title'] );
			echo $before_widget;

			if ( !empty( $title ) ) {
				echo $before_title . $title . $after_title;
			}
	?>
			
			
			<ul>
			  <?php foreach ( $instance['social'] as $item ) : ?>
					<li><a href="<?php echo esc_url($item['url']); ?>" class="socicon-<?php echo esc_attr( $item['icon'] ); ?>" style="background-color:<?php if(!empty($instance['icon_bg_color'])) { echo esc_attr($instance['icon_bg_color']); }?>;border-radius:<?php if(!empty($instance['icon_border_radius'])) { echo esc_attr($instance['icon_border_radius']); } ?>px"><i class="fa <?php echo esc_attr($item['icon']); ?>" style="color:<?php if(!empty($instance['icon_color'])) { echo esc_attr($instance['icon_color']); }?>;font-size:<?php if(!empty($instance['icon_font_size'])) { echo esc_attr($instance['icon_font_size']); } ?>px"></i></a></li>
				<?php endforeach; ?>
			</ul>
			


			<?php
			echo $after_widget;
		}
		
		
		
		// Define social icon List
		protected function get_social_title( $social_name ) {
			$items = $this->get_social();
			return $items[$social_name];
		}
	}
endif;
?>