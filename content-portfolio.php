<?php
/**
 * @package One Portfolio
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
<?php the_post_thumbnail();?>
	<header class="entry-header">
		<h2 class="entry-title"><?php the_title(); ?></h2>
		
		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php gc_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		
	
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'gc' ) ); ?>
		<div class="skills"><p><?php echo get_the_term_list( $post->ID, 'skills', 'Skills: ', ', ', '' ); ?></p></div>
		<?php
			$key1 = 'buttonlabel';
			$key2 = 'buttonlink';
			if (get_post_meta($wp_query->post->ID, $key2, true) != '') {
				echo '<a class="link" target="_blank" href="'.get_post_meta($wp_query->post->ID, $key2, true).'">'.get_post_meta($wp_query->post->ID, $key1, true).'</a>';
			}
			else {
				echo '<span class="linkOff">'.get_post_meta($wp_query->post->ID, $key1, true).'</span>';
			}
		?>	
		
		
		
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'gc' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

</article><!-- #post-## -->
