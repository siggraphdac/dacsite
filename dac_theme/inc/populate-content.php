<?php

function populateContent () {

  if(get_theme_mod('pop_conent_toggle')) {

    // What pages do you want...
    $pageTitles = array("Slider", "Description", "Announcements", "Opportunities", "Exhibitions", "Community", "Archives");
    
    $pageSlugs = [];

    $pageIDS = [];
    
    foreach ($pageTitles as $key => $value) {
      $pageSlugs[] = get_page_by_title( $value )->post_name;
    }

    foreach ($pageTitles as $key => $value) {
      $pageIDS[] = get_page_by_title( $value )->ID;
    }

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

    // //get menu id to assign it to the primary menu location created
    // $menu_name = 'All Sections';
    // $menu_obj = get_term_by('name', $menu_name, 'nav_menu');
    // $menu_id = $menu_obj->term_id;
    // $menu = wp_get_nav_menu_object($menu_id );

    // //if menu not found, create a new one
    // if(!$menu) {
    //   $menu_id = wp_create_nav_menu($menu_name);
    //   foreach ($pageSlugs as $key => $value) {
    //     if(get_page_template_slug( $pageIDS[$key] ) != "page-templates/page_no-title.php"){
    //         wp_update_nav_menu_item($menu_id, 0, array(
    //           'menu-item-title' =>  __($pageTitles[$key]),
    //           'menu-item-url' => home_url( '#post-'.$value ), 
    //           'menu-item-status' => 'publish'));
    //     }
    //   }
    // }

    // //Get all locations (including the one we just created above)
    // $locations = get_theme_mod('nav_menu_locations');

    // //set the menu to the new location and save into database
    // $locations['primary'] = $menu_id;
    // set_theme_mod( 'nav_menu_locations', $locations );

  }
  

}

// After customizer saves
// add_action( 'customize_save_after', 'populateContent' );

// After a page loads
add_filter( 'after_setup_theme', 'populateContent' );

// After theme is activated
// add_action("after_switch_theme", "populateContent");

// add_action('save_post', 'updateNavMenu' );
// add_filter('after_setup_theme', 'updateNavMenu' );

function updateNavMenu() {

  $menu_name = 'All Sections';
  
  if(wp_get_nav_menu_object($menu_name) != NULL){
    wp_delete_nav_menu($menu_name);
    makeNavMenu($menu_name);
  } 
  
  else {
    makeNavMenu($menu_name);
  }

}

function makeNavMenu($menu_name) {

  $menu_id = wp_create_nav_menu($menu_name);
  $pages = get_pages(); 

  foreach ($pages as $key => $value ) {
    if(get_page_template_slug( $value->ID ) != "page-templates/page_no-title.php"){
      wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' => $value->post_title,
        'menu-item-url' => '#post-'.$value->post_name,
        'menu-item-status' => 'publish',
      ));
    }
  }

  //Get all locations (including the one we just created above)
  $locations = get_theme_mod('nav_menu_locations');

  //set the menu to the new location and save into database
  $locations['primary'] = $menu_id;
  set_theme_mod( 'nav_menu_locations', $locations );
}


add_action( 'save_post', 'set_post_default_category', 10,3 );
 
function set_post_default_category( $post_id, $post, $update ) {
    // Only want to set if this is a new post!
    if ( $update ){
        return;
    }
     
    // Only set for post_type = post!
    if ( 'page' !== $post->post_type ) {
        return;
    }
     
    // Get the default term using the slug, its more portable!
    $term = get_term_by( 'slug', 'my-custom-term', 'category' );

    $menu_name = 'All Sections';
    $menu_id = wp_create_nav_menu($menu_name);

    wp_update_nav_menu_item($menu_id, 0, array(
      'menu-item-title' => $value->post_title,
      'menu-item-url' => '#post-'.$value->post_name,
      'menu-item-status' => 'publish',
    ));
 
    // wp_set_post_terms( $post_id, $term->term_id, 'category', true );
}

?>