<?php

function createPages () {

  $pageTitles = array("Slider", "Description", "Announcements", "Opportunities", "Exhibitions", "Community", "Archives");

  foreach ($pageTitles as $key => $value) {
    if(get_page_by_title($value) == NULL) {

      // Create post object
      $my_post = array(
        'post_title'    => wp_strip_all_tags( $value ),
        'post_content'  => 'content of '.$value,
        'post_status'   => 'publish',
        'post_type'			=> 'page',
        'page_template' => 'No Title',
        'menu_order'		=> $key
      );

      // Insert the post into the database
      wp_insert_post( $my_post );
    }
  }

  $pageNoTitles = array("Slider", "Description");

  foreach ($pageNoTitles as $key => $value) {
    $page = get_page_by_title($value);
    update_post_meta( $page->ID, "_wp_page_template", "page-templates/page_no-title.php");
  }


  //get menu id to assign it to the primary menu location created
  $menu_name = 'All Sections';
  $menu_obj = get_term_by('name', $menu_name, 'nav_menu');
  $menu_id = $menu_obj->term_id;
  $menu = wp_get_nav_menu_object($menu_id );

  //if menu not found, create a new one
  if(!$menu) {
    $menu_id = wp_create_nav_menu($menu_name);

    // wp_update_nav_menu_item($menu_id, 0, array(
    //   'menu-item-title' =>  __("Home"),
    //   'menu-item-url' => home_url( '/' ), 
    //   'menu-item-status' => 'publish'));
    
    foreach ($pageTitles as $key => $value) {
      if ($value != "Slider" ) {
        if ($value != "Description" ) {
          wp_update_nav_menu_item($menu_id, 0, array(
            'menu-item-title' =>  __($value),
            'menu-item-url' => home_url( '#post-'.$value ), 
            'menu-item-status' => 'publish'));
        }
      }
    }
  }

  //Get all locations (including the one we just created above)
  $locations = get_theme_mod('nav_menu_locations');

  //set the menu to the new location and save into database
  $locations['primary'] = $menu_id;
  set_theme_mod( 'nav_menu_locations', $locations );

}

add_filter( 'after_setup_theme', 'createPages' );

?>