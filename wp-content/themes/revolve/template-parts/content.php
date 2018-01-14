<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Revolve
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php revolve_posted_on(); ?>
		</div><!-- .entry-meta -->
		</header><!-- .entry-header -->
		<?php
		endif;
        ?>
        
        <?php if ( has_post_thumbnail() ) : ?>
		<div class="blog-post_feat-image">
			<?php
                $revolve_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
                $revolve_img_src = $revolve_img[0];
            ?>
            <img src="<?php echo esc_url($revolve_img_src); ?>" />
		</div><!-- .entry-meta -->
		<?php
		endif; ?>


	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'revolve' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'revolve' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php revolve_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->