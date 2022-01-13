<?php get_header(); ?>

<main class="single-page">
<?php
if (have_posts ()) {
  while(have_posts()) : the_post();
?>


<?php woocommerce_breadcrumb(); ?>
<?php the_content (); ?>


<?php endwhile; } ?>

</main>
