<?php get_header(); ?>
test
  <main id="main" class="mx-auto max-w-3xl px-6">

  <?php
  if ( have_posts() ) {

    // Load posts loop.
    while ( have_posts() ) {
      the_post();
      get_template_part( 'template-parts/content/content' );
    }

    // Previous/next page navigation.
    twentynineteen_the_posts_navigation();

  } else {

    // If no content, include the "No posts found" template.
    get_template_part( 'template-parts/content/content', 'none' );

  }
  ?>

  </main><!-- .site-main -->

<?php get_footer();
