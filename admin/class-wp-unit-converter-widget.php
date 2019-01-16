<?php

/**
 * This class registers creates the Widget for WP Unit Converter in the Widget Page.
 *
 * @link       centangle.com
 * @since      1.0.0
 *
 * @package    Wp_Unit_Converter/admin
 * @subpackage Wpuc_Widget
 */

class Wpuc_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'wpuc_widget',
            __('WP Unit Converter', 'wpuc'),
            array('description' => __('This widget displays the WP Unit Converter in Widget area', 'wpuc'))
        );
    }

// Creating widget front-end
    public function widget($args, $instance) {
        $title = apply_filters('widget_title', $instance['title']);

// before and after widget arguments are defined by themes
        echo $args['before_widget'];
        if (!empty($title)) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

// This is where you run the code and display the output
        echo do_shortcode( '[wpuc_unit_converter]' );
        echo $args['after_widget'];
    }

// Widget Backend
    public function form($instance) {
        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = __('WP Unit Converter', 'wpuc');
        }

// Widget admin form
        ?>
        <p>
        <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:');?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('wpuc-shortcode'); ?>"><?php _e('Shortcode:');?></label>
        <input class="widefat" id="<?php echo $this->get_field_id('wpuc-shortcode'); ?>" name="<?php echo $this->get_field_name('wpuc-shortcode'); ?>" type="text" value="[wpuc_unit_converter]" readonly/>
        </p>
        <?php
    }

// Updating widget replacing old instances with new
    public function update($new_instance, $old_instance) {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        return $instance;
    }
} // Class wpb_widget ends here
