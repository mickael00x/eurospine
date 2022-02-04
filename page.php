<?php get_header();
include("nav.php"); ?>

<main class="single-page <?php single_post_title(); ?>">
  <?php
  if (have_posts()) {
    while (have_posts()) : the_post();
  ?>
      
      <?php woocommerce_breadcrumb(); ?>
      <?php 
        if(get_the_title() === "Order") {
          echo "<div class='custom-cart-message-problems'><p>If you encounter registration issues, please contact us and we will be happy to assist you</p> <a href='mailto:education@eurospine.org'>Contact us</a></div>";
        }
      ?>
      <?php the_content(); ?>

  <?php endwhile;
  } ?>

</main>