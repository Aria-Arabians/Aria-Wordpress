<?php


// Widget for search form //
class horse_Widget_Searchform extends WP_Widget {

	function horse_Widget_Searchform() {
		$widget_ops = array('classname' => 'horse_Widget_Searchform', 'description' => __( 'Let visitors search for horses in your site','wp_horse') );
		$this->WP_Widget('horse_Widget_Searchform', __('horse Search','wp_horse'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		if ( !empty($instance['title']) ) {
			$title = $instance['title'];
		} else {
			if ( 'horse_search_widget') {
				$title = __('horse Search','wp_horse');
			} else {

				$title = $tax->labels->name;
			}
		}
		$title = apply_filters('widget_title', $title, $instance, $this->id_base);

		echo $before_widget;
		if ( $title )
		echo $before_title . $title . $after_title;
    echo do_shortcode('[horse_search]');
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags(stripslashes($new_instance['title']));
		return $instance;
	}

	function form( $instance ) {
?>
	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title') ?></label>
	<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if (isset ( $instance['title'])) {echo esc_attr( $instance['title'] );} ?>" /></p>
	<?php
	}
}

/**
 * horse_Widget_Display Class
 */
class horse_Widget_Display extends WP_Widget {

    /** constructor */
    function horse_Widget_Display() {
        parent::WP_Widget(false, $name = 'Adahorse', $widget_options = array('name' => __('horse Display', 'wp_horse'),'description' => _x('Display horses by category or status, recent horses, etc','widget horse','wp_horse')));;
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract( $args );
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title'], $instance, $this->id_base);
        $text = apply_filters( 'widget_text', $instance['text'], $instance );
        $sortby = empty( $instance['sortby'] ) ? 'comment_count' : $instance['sortby'];
        $r = $instance['rss'] ? '1' : '0';
        $status = isset($instance['horse-status']) ? $instance['horse-status'] : false;
        $number = isset($instance['number']) ? $instance['number'] : false;
        $category = isset($instance['horse-category']) ? $instance['horse-category'] : false;
        $q = new WP_Query(array('post_type'=>'horse', 'posts_per_page'=>$number, 'orderby'=>$sortby, 'horse-status' => $status,'horse-category' => $category));
        ?>

        <?php echo $before_widget; ?>
        <?php if ( $title ) echo $before_title . $title . $after_title; ?>


         <?php echo '<div>'.$instance['filter'].'</div>' ? wpautop($text) : $text; ?>

         <?php if ( $r ) {  ?>
		     <span><a href="<?php echo home_url(); ?>/?feed=rss2&amp;post_type=horse"><span class="horse_rss">RSS</span></a></span>
         <?php } ?>

     		  <?php  while ($q->have_posts()) : $q->the_post(); ?>

          <ul class="widget horse_info">
            <li><span class="horse_image"><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('horse_img'); ?></a></span></li>
            <li class="horse_name"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>         
            <li class="horse_category"><?php $category = wp_get_object_terms(get_the_ID(), 'horse-category') ; echo '<span>'.__('In', 'wp_horse') . '</span> '. $category[0]->name ; ?></li>
            <li class="horse_gender"><?php $gender = wp_get_object_terms(get_the_ID(), 'horse-gender') ; echo '<span>' . __('Gender', 'wp_horse') . '</span> '. $gender[0]->name ; ?></li>
            <li class="horse_age"><?php $age = wp_get_object_terms(get_the_ID(), 'horse-age') ; echo '<span>' . __('Age', 'wp_horse') . '</span> '. $age[0]->name ; ?></li>
            <li class="horse_size"><?php $size = wp_get_object_terms(get_the_ID(), 'horse-size') ; echo '<span>' . __('Size', 'wp_horse') . '</span> '. $size[0]->name ; ?></li>
            
                <li class="horse_btn">
                 <a href="<?php the_permalink() ?>" title="<?php _e('Read about', 'wp_horse'); ?> <?php the_title(); ?>">
                 <span class="icon <?php $status = wp_get_object_terms(get_the_ID(), 'horse-status') ; echo $status[0]->slug ; ?>"></span><?php  $pd=get_the_ID(); $taxo = wp_get_object_terms($pd, 'horse-status') ; echo $taxo[0]->name ; ?>
                 </a>
                </li>
                
          </ul>


            <div class="clear"></div>
     		  <?php endwhile; ?>



		<?php echo $after_widget; ?>

    <?php
   		// Reset the global $the_post as this query will have stomped on it
   		wp_reset_postdata();
   		$cache[$args['widget_id']] = ob_get_flush();
   		wp_cache_set('widget_recent_posts', $cache, 'widget');
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
      $instance = $old_instance;
      $instance['title'] = strip_tags($new_instance['title']);
      $instance['number'] = ($new_instance['number']);
      $instance['horse-status'] = ($new_instance['horse-status']);
      $instance['horse-category'] = ($new_instance['horse-category']);
      $instance['rss'] = !empty($new_instance['rss']) ? 1 : 0;

	 		if ( current_user_can('unfiltered_html') )
			  $instance['text'] =  $new_instance['text'];
		  else
			  $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		    $instance['filter'] = isset($new_instance['filter']);
    	if ( in_array( $new_instance['sortby'], array( 'title', 'date', 'author', 'ID', 'rand', 'modified', 'comment_count' ) ) ) {
			  $instance['sortby'] = $new_instance['sortby']; }
      else {
			$instance['sortby'] = 'comment_count';
	    	}
     return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        $title = apply_filters('widget_title', empty($instance['title']) ? '&nbsp;' : $instance['title'], $instance, $this->id_base);
        $instance = wp_parse_args( (array) $instance, array(  'text' => '', 'sortby' => 'comment_count','horse-category' => false,'horse-status' => false, 'number'=> false ) );
        $text = esc_textarea($instance['text']);
        $rss = isset($instance['rss']) ? (bool) $instance['rss'] :false;
        $link_cats = get_terms('horse-category', array('hide_empty' => 1));
        $lost_sts = get_terms('horse-status', array('hide_empty' => 1));
        $items = array('1','2','3','4','5');
    ?>
        <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

         <p>
          <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Arbitrary text or HTML'); ?></label>
	      	<textarea class="widefat" rows="6" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
         </p>

	      <p>
          <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('How many items would you like to display?'); ?></label>

          <select id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>">
        	<?php
          	foreach ( $items as $item ) {
        		echo '<option value="' . $item . '"'
        				 .( $item == $instance['number'] ? ' selected="selected"' : '' )
        			   . '>' . $item . "</option>\n"; } ?>
        	</select>
        </p>

    		<p>
    			<label for="<?php echo $this->get_field_id('sortby'); ?>"><?php _e( 'Sort by:' ); ?></label>
    			<select name="<?php echo $this->get_field_name('sortby'); ?>" id="<?php echo $this->get_field_id('sortby'); ?>" class="widefat">
    				<option value="title"<?php selected( $instance['sortby'], 'title' ); ?>><?php _e('Post title','wp_horse'); ?></option>
    				<option value="date"<?php selected( $instance['sortby'], 'date' ); ?>><?php _e('Post data','wp_horse'); ?></option>
    				<option value="author"<?php selected( $instance['sortby'], 'author' ); ?>><?php _e( 'Post author','wp_horse'); ?></option>
    				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>><?php _e( 'Post ID','wp_horse'); ?></option>
    				<option value="rand"<?php selected( $instance['sortby'], 'rand' ); ?>><?php _e( 'Random' ); ?></option>
    				<option value="modified"<?php selected( $instance['sortby'], 'modified' ); ?>><?php _e( 'Modified date','wp_horse'); ?></option>
    				<option value="comment_count"<?php selected( $instance['sortby'], 'comment_count' ); ?>><?php _e( 'Popularity','wp_horse'); ?></option>
    			</select>
    		</p>

      	<p>
          <label for="<?php echo $this->get_field_id('horse-category'); ?>"><?php _e('Category'); ?>:</label>
      		<select class="widefat" id="<?php echo $this->get_field_id('horse-category'); ?>" name="<?php echo $this->get_field_name('horse-category'); ?>">
          <option value=""><?php _e('All','wp_horse'); ?></option>
       		<?php
       		foreach ( $link_cats as $link_cat ) {
       			echo '<option value="' . ($link_cat->slug) . '"'
       				. ( $link_cat->slug == $instance['horse-category'] ? ' selected="selected"' : '' )
       				. '>' . $link_cat->name ." (". $link_cat->count .")"."</option>\n";  } ?>
      	 </select>
        </p>

      	<p>
          <label for="<?php echo $this->get_field_id('horse-status'); ?>"><?php _e('horse Status','wp_horse'); ?>:</label>
      		<select class="widefat" id="<?php echo $this->get_field_id('horse-status'); ?>" name="<?php echo $this->get_field_name('horse-status'); ?>">
      		<option value=""><?php _e('All','wp_horse'); ?></option>
      	 	<?php
      		  foreach ( $lost_sts as $lost_st ) {
      			echo '<option value="' . ($lost_st->slug) . '"'
      				.( $lost_st->slug == $instance['horse-status'] ? ' selected="selected"' : '' )
      				.'>' . $lost_st->name ." (". $lost_st->count .")"."</option>\n";
      		}
      		?>
      		</select>
        </p>

    <input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id('rss'); ?>" name="<?php echo $this->get_field_name('rss'); ?>"<?php checked( $rss ); ?> />
		<label for="<?php echo $this->get_field_id('rss'); ?>"><?php _e( 'Show RSS link','wp_horse' ); ?></label><br />
        <?php
    }

} // class horse_Widget_Display




?>
