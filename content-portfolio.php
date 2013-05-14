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
		?>	
		
		
		
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'gc' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'gc' ) );
				if ( $categories_list && gc_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'gc' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'gc' ) );
				if ( $tags_list ) :
			?>
			<span class="sep"> | </span>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'gc' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="sep"> | </span>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'gc' ), __( '1 Comment', 'gc' ), __( '% Comments', 'gc' ) ); ?></span>
		<?php endif; ?>

		
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
