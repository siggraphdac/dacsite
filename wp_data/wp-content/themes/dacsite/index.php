<?php get_header() ?>

<div id="content" class="site-content">

  <!-- START the Loop. -->
  <?php while ( have_posts() ) : the_post(); ?>

  <h3 id="post-title"><?php the_title(); ?></h3>

  <?php the_content(); ?>

  <?php endwhile;?>
  <!-- END the Loop. -->
  
</div><!-- #content -->

<?php get_footer() ?>