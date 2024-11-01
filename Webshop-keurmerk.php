<?php

/*
Plugin Name: Webshop Keurmerk
Plugin URI: http://www.keurmerk.info/
Description: Gemakkelijk het keurmerk op uw website plaatsen!
Author: Riotweb.nl
Version: 1.0
Author URI: https://riotweb.nl/plugins
License: GPLv2
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( !defined('ABSPATH') )
  die('-1');




//Webshop Keurmerk
 
class keurmerk_widget extends WP_Widget {
 
   /** constructor */
   function __construct() {
    parent::__construct(
      'keurmerk_widget', 
      __('Webshop Keurmerk', 'text_domain'),
      array( 'description' => __( 'Plaats het keurmerk!', 'text_domain' ), )
    );
  }
 
    /** @see WP_Widget::widget */
    function widget($args, $instance) { 
        extract( $args );
        $title    = apply_filters('widget_title', $instance['title']);
        $link  = $instance['link'];
        $select  = $instance['select'];
        
        echo $before_widget; 
          if ( $title )
            echo $before_title . $title . $after_title; ?>
  
	<?php

	if (!empty($link))
      echo '<a href="'. $link .'" target="_blank">
  		
  			<img src="' . esc_url( plugins_url( 'images/Webshop-Keurmerk-' . $select . '.png', __FILE__ ) ) . '" alt="Webshop Keurmerk" >
			</a>'; 

	?>

        <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update  */
    function update($new_instance, $old_instance) {   
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['link'] = strip_tags($new_instance['link']);
    $instance['select'] = strip_tags($new_instance['select']);
  
        return $instance;
    }
 
    /** @see WP_Widget::form */
    function form($instance) {  
 
        $title    = esc_attr($instance['title']);
        $link  = esc_attr($instance['link']);
        $select = esc_attr($instance['select']); 
      
        ?>

         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Titel:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
          <label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link naar uw keurmerk pagina:'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo $link; ?>" />
          <br>
          <em>Bijvoorbeeld: http://www.keurmerk.info/Leden-en-Partners/Lid-Details/12345</em>
        </p>
        <p>
		<label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('Grootte:'); ?></label>
		<select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
		<?php
		$options = array('Groot', 'Normaal', 'Klein');
		foreach ($options as $option) {
		echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';}
		?>
		</select>
        <?php 
    }
 
 
} // end class
add_action('widgets_init', create_function('', 'return register_widget("keurmerk_widget");'));

