<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
?>

  <main id="main" class="mx-auto my-10 px-6 max-w-5xl">

    <?php  while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class('mx-auto max-w-3xl'); ?>>
      <?php if ( ! twentynineteen_can_show_post_thumbnail() ) : ?>
      <header class="entry-header">
        <?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
      </header>
      <?php endif; ?>

      <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(
          array(
            'before' => '<div class="page-links">' . __( 'Pages:', 'twentynineteen' ),
            'after'  => '</div>',
          )
        );
        ?>
      </div><!-- .entry-content -->

      <?php if ( get_edit_post_link() ) : ?>
        <footer class="entry-footer">
          <?php
          edit_post_link(
            sprintf(
              wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                __( 'Edit <span class="screen-reader-text">%s</span>', 'twentynineteen' ),
                array(
                  'span' => array(
                    'class' => array(),
                  ),
                )
              ),
              get_the_title()
            ),
            '<span class="edit-link">',
            '</span>'
          );
          ?>
        </footer><!-- .entry-footer -->
      <?php endif; ?>
    </article><!-- #post-<?php the_ID(); ?> -->

    <?php endwhile; ?>

  </main><!-- #main -->

<?php
get_footer();
