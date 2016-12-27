<?php
/**
 * The template for displaying the front 
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>
		
		<?php
		/// display latest posts using WP_Query
		$args = array(
			'post_type' => 'post',
			'posts_per_page' => '5'
		);
		$query = new WP_query ( $args );
		if ( $query->have_posts() ) { ?>
		
		  <section class="latest-posts">
		  	<h2>Latest Posts</h2>
		  		
		  		<?php
		  		while ( $query->have_posts() ) : $query->the_post(); ?>
  
		  		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			  		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			  		<?php the_excerpt(); ?>
		  		</article>
		  		
		  		<?php 
			  	endwhile;
			  	rewind_posts();
			  	?>
			  	
		  	</section>
		  
		<?php } ?>

	</main><!-- .site-main -->

	<?php get_sidebar( 'content-bottom' ); ?>

</div><!-- .content-area -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
