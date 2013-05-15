<?php
/**
 * @package One Portfolio
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="entry-meta">
			<?php one_portfolio_posted_on(); ?>
		</div><!-- .entry-meta -->
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_post_thumbnail(); ?>
		<?php the_content(); ?>
		<div class="share">
			<h3>Share the Article</h3>
			<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/share_fb.png" alt="Share on Facebook"></a>
			<a target="_blank"  href="http://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/share_tw.png" alt="Share on Twitter"></a>
		</div>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'one_portfolio' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	
</article><!-- #post-## -->
