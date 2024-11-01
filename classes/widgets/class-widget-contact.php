<?php 
if ( ! class_exists( 'xolo_contact_widget' ) ) :
	class xolo_contact_widget extends WP_Widget {
	 
	function __construct() {
		parent::__construct(
			'xolo_contact_widget', // Base ID
			__('Xolo Contact Widget','xolo-widget'), // Widget Name
			array(
				'classname' => 'xolo_contact_widget',
				'description' => __('Contact Widget Area','xolo-widget'),
			)
		);
	 }
	 
	 public function widget($args,$instance) {
	 $args['before_widget']; ?>
		<?php if(!empty($instance['contact_widget_icon']) || !empty($instance['widget_style'])) : ?>
				<div class="<?php echo ($instance['widget_style'] == 'widget_contact')? esc_attr('widget'):'';?><?php echo esc_attr($instance['widget_style']); ?>">
					<div class="contact-area" style="background:<?php if(!empty($instance['bg_color'])) { echo esc_attr($instance['bg_color']); }?>;border-color:<?php if(!empty($instance['bg_color'])) { echo esc_attr($instance['bg_color']); } ?>">
						<?php if(!empty($instance['contact_widget_icon'])) { ?>
							<div class="contact-icon"><i class="fa <?php echo esc_attr($instance['contact_widget_icon']);?>" style="color:<?php if(!empty($instance['icon_color'])) { echo esc_attr($instance['icon_color']); }?>;font-size:<?php if(!empty($instance['icon_font_size'])) { echo esc_attr($instance['icon_font_size']); } ?>px"></i></div>
						<?php } ?>
						<a href="javascript:void(0)" class="contact-info">
							<?php if(!empty($instance['contact_widget_title'])) { ?>
								<span class="text" style="color:<?php if(!empty($instance['text_color'])) { echo esc_attr($instance['text_color']); }?>;font-size:<?php if(!empty($instance['text_font_size'])) { echo esc_attr($instance['text_font_size']); } ?>px"><?php echo esc_html($instance['contact_widget_title']);?></span>
							<?php } ?>
							<?php if(!empty($instance['contact_widget_subtitle'])) { ?>	
							<span class="title" style="color:<?php if(!empty($instance['text_color'])) { echo esc_attr($instance['text_color']); }?>;font-size:<?php if(!empty($instance['text_font_size'])) { echo esc_attr($instance['text_font_size']); } ?>px"><?php echo esc_html($instance['contact_widget_subtitle']);?></span>
							<?php } ?>
						</a>
					</div>
				</div>
		<?php endif; ?>
	<?php
	echo $args['after_widget'];
	}
	// Widget Backend
	public function form( $instance ) {
	$instance = wp_parse_args( (array) $instance, array( 'widget_style' => 'widget_contact' ) );	
	if ( isset( $instance[ 'contact_widget_title' ])){
	$contact_widget_title = $instance[ 'contact_widget_title' ];
	}
	else {
	$contact_widget_title = 'CALL FOR EMRGENCY';
	}
	
	if ( isset( $instance[ 'contact_widget_subtitle' ])){
	$contact_widget_subtitle = $instance[ 'contact_widget_subtitle' ];
	}
	else {
	$contact_widget_subtitle = '+1-900-242-23-23';
	}
	
	if ( isset( $instance[ 'contact_widget_icon' ])){
	$contact_widget_icon = $instance[ 'contact_widget_icon' ];
	}
	else {
	$contact_widget_icon = 'fa fa-phone';
	}
	
	if ( isset( $instance[ 'icon_font_size' ])){
	$icon_font_size = $instance[ 'icon_font_size' ];
	}
	else {
	$icon_font_size = '32';
	}
	
	if ( isset( $instance[ 'text_font_size' ])){
	$text_font_size = $instance[ 'text_font_size' ];
	}
	else {
	$text_font_size = '20';
	}
	
	if ( isset( $instance[ 'icon_color' ])){
	 $icon_color = $instance[ 'icon_color' ];
	 }
	else {
	 $icon_color = '#e3e3e3';
	 }
	 if ( isset( $instance[ 'text_color' ])){
	 $text_color = $instance[ 'text_color' ];
	 }
	else {
	 $text_color = '#e3e3e3';
	 }
	 if ( isset( $instance[ 'bg_color' ])){
	 $bg_color = $instance[ 'bg_color' ];
	 }
	else {
	 $bg_color = '#FF8F00';
	 }
	?>
	
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_widget_title' )); ?>"><?php _e( 'Title:','xolo-widget' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'contact_widget_title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'contact_widget_title' )); ?>" type="text" value="<?php if($contact_widget_title) echo esc_attr( $contact_widget_title ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_widget_subtitle' )); ?>"><?php _e( 'Subtitle:','xolo-widget' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'contact_widget_subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'contact_widget_subtitle' )); ?>" type="text" value="<?php if($contact_widget_subtitle) echo esc_attr( $contact_widget_subtitle ); ?>" />
		</p>
		<?php $icons = get_social(); ?>
		<p class="contact-icon-picker">
			<label for="<?php echo esc_attr($this->get_field_id( 'contact_widget_icon' )); ?>"><?php _e( 'Icons:','xolo-widget' ); ?></label>
			
			<select class="iconPicker" id="<?php echo esc_attr($this->get_field_id('contact_widget_icon')); ?>"
					name="<?php echo esc_attr($this->get_field_name('contact_widget_icon')); ?>" value="<?php if($contact_widget_icon) echo esc_attr( $contact_widget_icon ); ?>"type="text" style="font-family: 'FontAwesome', Arial; width: 82%">
			<?php foreach($icons as $key => $value) { ?>
				<option value="<?php echo $key; ?>" <?php if ($contact_widget_icon==$key) { echo 'selected="selected"'; } ?>>
				<?php echo $value; ?></option>
			<?php } ?>
			</select>        
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'icon_font_size' )); ?>"><?php _e( 'Icon Font Size:','xolo-widget' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'icon_font_size' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_font_size' )); ?>" type="number" value="<?php if($icon_font_size) echo esc_attr( $icon_font_size ); ?>" />
		</p>
		
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'text_font_size' )); ?>"><?php _e( 'Text Font Size:','xolo-widget' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'text_font_size' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'text_font_size' )); ?>" type="number" value="<?php if($text_font_size) echo esc_attr( $text_font_size ); ?>" />
		</p>
		
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'icon_color' )); ?>"><?php _e( 'Icon Color','xolo-widget'); ?></label>
            <input class="my-color-picker" type="text" id="<?php echo esc_attr($this->get_field_id( 'icon_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'icon_color' )); ?>" value="<?php if($icon_color) echo esc_attr( $icon_color ); ?>" /> </br> 
				
            <label for="<?php echo esc_attr($this->get_field_id( 'text_color' )); ?>"><?php _e( 'Text Color','xolo-widget'); ?></label>
            <input class="my-color-picker" type="text" id="<?php echo esc_attr($this->get_field_id( 'text_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'text_color' )); ?>" value="<?php if($text_color) echo esc_attr( $text_color ); ?>" /></br>

			<label for="<?php echo esc_attr($this->get_field_id( 'bg_color' )); ?>"><?php _e( 'Background Color','xolo-widget'); ?></label>
            <input class="my-color-picker" type="text" id="<?php echo esc_attr($this->get_field_id( 'bg_color' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'bg_color' )); ?>" value="<?php if($bg_color) echo esc_attr( $bg_color ); ?>" />
        </p>
		
		<p>
		  <label for="<?php echo esc_attr($this->get_field_id('widget_style')); ?>"><?php _e( 'Widget Style:','xolo-widget' ); ?></label>
			<select class='widefat' id="<?php echo esc_attr($this->get_field_id('widget_style')); ?>"
					name="<?php echo esc_attr($this->get_field_name('widget_style')); ?>" type="text">
			  <option value='widget_contact'<?php if($instance['widget_style']) echo ($instance['widget_style'] =='widget_contact')?'selected':'widget_contact'; ?>>
				<?php _e( 'Style 1','xolo-widget' ); ?>
			  </option>
			  <option value='emergency-call'<?php if($instance['widget_style']) echo ($instance['widget_style'] =='emergency-call')?'selected':'emergency-call'; ?>>
				<?php _e( 'Style 2','xolo-widget' ); ?>
			  </option>
			</select>                
			  
		 </p>
	
	<?php
    }
	     
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
	
	$instance = array();
		$instance['contact_widget_title'] = ( ! empty( $new_instance['contact_widget_title'] ) ) ? sanitize_text_field( $new_instance['contact_widget_title'] ) : '';
		
		$instance['contact_widget_subtitle'] = ( ! empty( $new_instance['contact_widget_subtitle'] ) ) ? sanitize_text_field( $new_instance['contact_widget_subtitle'] ) : '';
		
		$instance['contact_widget_icon'] = ( ! empty( $new_instance['contact_widget_icon'] ) ) ? sanitize_text_field( $new_instance['contact_widget_icon'] ) : '';
		
		$instance['icon_font_size'] = ( ! empty( $new_instance['icon_font_size'] ) ) ? sanitize_text_field( $new_instance['icon_font_size'] ) : '';
		
		$instance['text_font_size'] = ( ! empty( $new_instance['text_font_size'] ) ) ? sanitize_text_field( $new_instance['text_font_size'] ) : '';
		
		$instance['icon_color'] = sanitize_hex_color($new_instance['icon_color']);
		
		$instance['text_color'] = sanitize_hex_color($new_instance['text_color']);
		
		$instance['bg_color'] = sanitize_hex_color($new_instance['bg_color']);
		
		$instance['widget_style'] = ( ! empty( $new_instance['widget_style'] ) ) ? sanitize_text_field( $new_instance['widget_style'] ) : '';
		
		return $instance;
	}
	}
endif;	
?>