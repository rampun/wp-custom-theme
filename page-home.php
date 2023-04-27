<?php
/**
 * Template Name: Home page
 */

// Need to loop for gutenberg the_content()
while ( have_posts() ) :
    the_post();
    the_content();
endwhile; // End of the loop.

get_template_part('template-parts/home/home', 'content');
