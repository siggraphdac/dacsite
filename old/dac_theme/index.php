<?php get_header() ?>

<div id="content" class="site-content">
ddd
  <!-- START the Loop. -->
  <?php if ( have_posts() ) : ?>

    <?php while ( have_posts() ) : the_post(); ?>

    <h3 id="post-title"><?php the_title(); ?></h3>

    <?php the_content(); ?>

    <?php endwhile;?>

  <?php 
    else: 
      _e( 'Sorry, no posts matched your criteria.', 'textdomain' );
    endif; 
  ?>
  
  <!-- END the Loop. -->
  
</div><!-- #content -->

<?php get_footer() ?>