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

    <?php while (have_posts()): the_post();?>

	    <article id="post-<?php the_ID();?>" <?php post_class('mx-auto max-w-3xl');?>>
	      <?php if (!twentynineteen_can_show_post_thumbnail()): ?>
	      <header class="entry-header">
	        <?php get_template_part('template-parts/header/entry', 'header');?>
	      </header>
	      <?php endif;?>

      <div class="entry-content">
        <?php
        the_content(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'twentynineteen'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            )
        );

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . __('Pages:', 'twentynineteen'),
                'after' => '</div>',
            )
        );
        ?>
      </div><!-- .entry-content -->

      <footer class="entry-footer">
        <?php twentynineteen_entry_footer();?>
      </footer><!-- .entry-footer -->

      <?php if (!is_singular('attachment')): ?>
        <?php get_template_part('template-parts/post/author', 'bio');?>
      <?php endif;?>

    </article><!-- #post-<?php the_ID();?> -->

    <?php
    the_post_navigation(
        array(
            'next_text' => '<span class="meta-nav" aria-hidden="true">' . __('Next Post', 'twentynineteen') . '</span> ' .
            '<span class="screen-reader-text">' . __('Next post:', 'twentynineteen') . '</span> <br/>' .
            '<span class="post-title">%title</span>',
            'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous Post', 'twentynineteen') . '</span> ' .
            '<span class="screen-reader-text">' . __('Previous post:', 'twentynineteen') . '</span> <br/>' .
            '<span class="post-title">%title</span>',
        )
    );
    ?>

    <?php endwhile;?>

  </main><!-- #main -->

<?php
get_footer();
