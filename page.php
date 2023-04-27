<?php
  /**
   * Template Name: General page
   */


  // Need to loop for gutenberg the_content()
  while ( have_posts() ) :
    the_post();
    echo '<h1>'.the_title().'</h1>';
    the_content();
  endwhile; // End of the loop.
  
