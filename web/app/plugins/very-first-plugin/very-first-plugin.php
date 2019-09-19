<?php
/**
* Plugin Name: Very First Plugin
* Plugin URI: https://www.yourwebsiteurl.com/
* Description: This is the very first plugin I ever created.
* Version: 1.0
* Author: Your Name Here
* Author URI: http://yourwebsiteurl.com/
**/
function my_custom_post_event() {

  $labels = array(

    'name'               => _x( 'Events', 'post type general name' ),

    'singular_name'      => _x( 'Event', 'post type singular name' ),

    'add_new'            => _x( 'Add New', 'book' ),

    'add_new_item'       => __( 'Add New Event' ),

    'edit_item'          => __( 'Edit Event' ),

    'new_item'           => __( 'New Event' ),

    'all_items'          => __( 'All Events' ),

    'view_item'          => __( 'View Event' ),

    'search_items'       => __( 'Search Events' ),

    'not_found'          => __( 'No Events found' ),

    'not_found_in_trash' => __( 'No Events found in the Trash' ),

    'parent_item_colon'  => '',

    'menu_name'          => 'events'

  );

  $args = array(

    'labels'        => $labels,

    'description'   => 'Holds our events and product specific data',

    'public'        => true,

    'menu_position' => 5,

    'post_type'     => 'event',

    'supports'      => array( 'title', 'editor', 'thumbnail',  ),
    'menu_icon' => 'dashicons-calendar-alt',
    'menu_position' => 5,
    'exclude_from_search' => true,
    'taxonomies'          => array('post_tag', 'category' ),
    'has_archive'   => true,
    'register_meta_box_cb' => 'myplugin_add_meta_box',



  );

  register_post_type( 'event', $args );

  flush_rewrite_rules();

}


  add_action( 'init', 'my_custom_post_event' );
 function myplugin_add_meta_box() {

    add_meta_box(
        'event-date',
        'Event Date and Time',
        'myplugin_meta_box_callback',
        'event'
    );
}
function myplugin_meta_box_callback(){
    $date=null;
    $start_time=null;
    $end_time=null;

    if(@$_GET['post']){
    $date=($_GET['post'])?get_post_meta($_GET['post'], 'date', true):'';
    $start_time=($_GET['post'])?get_post_meta($_GET['post'], 'start_time', true):'';
    $end_time=($_GET['post'])?get_post_meta($_GET['post'], 'end_time', true):'';
   }

   echo '<lable>Event Date</lable>'.'<input type="date" id="datePick" name="date" value='.$date.'>';
   echo '<lable>Event Start Time</lable>'.'<input type="time" id="datePick2" name="start_time" value='.$start_time.'>';
   echo '<lable>Event end Time</lable>'.'<input type="time" id="datePick2" name="end_time" value='.$end_time.'>';
}


function wpt_save_events_meta( $post_id, $post ) {
	//print_r($post);die;

	// Return if the user doesn't have edit permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return $post_id;
	}

	if ( ! $_POST['date'] ||  ! $_POST['start_time']  ||  ! $_POST['end_time']  ) {

		return $post_id;

	}
	// Now that we're authenticated, time to save the data.
	// This sanitizes the data from the field and saves it into an array $events_meta.
	$events_meta['date'] = esc_textarea( $_POST['date'] );
	$events_meta['start_time'] = esc_textarea( $_POST['start_time'] );
	$events_meta['end_time'] = esc_textarea( $_POST['end_time'] );

	foreach ( $events_meta as $key => $value ) :

		if ( get_post_meta( $post_id, $key, false ) ) {
			// If the custom field already has a value, update it.
			update_post_meta( $post_id, $key, $value );
		} else {

			// If the custom field doesn't have a value, add it.
			add_post_meta( $post_id, $key, $value);
		}
		if ( ! $value ) {

			// Delete the meta key if there's no value
			delete_post_meta( $post_id, $key );
		}
	endforeach;
}
add_action( 'save_post', 'wpt_save_events_meta', 1, 2 );




