<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */

?>

<?php if (have_posts()) : ?>

	<?php if (is_home() && !is_front_page()) : ?>
		<header>
			<h1 class="screen-reader-text">
				<?php single_post_title(); ?>
			</h1>
		</header>
	<?php endif; ?>

<?php
	// Start the loop.
	while (have_posts()) :
		the_post();

		/*
		 * Include the Post-Format-specific template for the content if it's a post, otherwise include the Post-Type-specific template.
		 */
		get_template_part(
			'template-parts/item',
			get_post_type() !== 'post' ? get_post_type() : get_post_format()
		);

	// End the loop.
	endwhile;

	// Previous/next page navigation.
	the_posts_pagination(
		array(
			'prev_text'          => __('Previous page', 'custom'),
			'next_text'          => __('Next page', 'custom'),
			'before_page_number' => '<span class="meta-nav screen-reader-text">' . __('Page', 'custom') . ' </span>',
		)
	);

// If no content, include the "No posts found" template.
else :
	get_template_part('content', 'none');

endif;
?>