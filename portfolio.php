<?php
/**
 * The template for displaying Portfolio.
 *
 * Template Name: Portfolio
 *
 * @package One Portfolio
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			
			<?php 	
				
				// Display all posts from Portfolio Custom Post Type
						
				$args = array(
					'post_type' => 'portfolio'
				);
				query_posts( $args );				
			?>
			
			<?php if ( have_posts() ) : ?> <?php?>

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content-portfolio', 'index' ); ?>

				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>

			<?php endwhile; // end of the loop. ?>
			
			<?php endif; ?>
			
			<?php wp_reset_query(); ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
