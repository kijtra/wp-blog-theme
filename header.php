<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?><!doctype html>
<html <?php language_attributes(); ?> class="h-full font-sans text-gray-900 antialiased leading-relaxed">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

  <header>
    <div class="mx-auto px-6 max-w-5xl">

    <div class="site-branding-container">
      <?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
    </div><!-- .site-branding-container -->

    <?php if ( is_singular() && twentynineteen_can_show_post_thumbnail() ) : ?>
      <div class="site-featured-image">
        <?php
          twentynineteen_post_thumbnail();
          the_post();
          $discussion = ! is_page() && twentynineteen_can_show_post_thumbnail() ? twentynineteen_get_discussion_data() : null;

          $classes = 'entry-header';
        if ( ! empty( $discussion ) && absint( $discussion->responses ) > 0 ) {
          $classes = 'entry-header has-discussion';
        }
        ?>
        <div class="<?php echo $classes; ?>">
          <?php get_template_part( 'template-parts/header/entry', 'header' ); ?>
        </div><!-- .entry-header -->
        <?php rewind_posts(); ?>
      </div>
    <?php endif; ?>

    </div><!-- .container -->
  </header>

