<?php get_header();
include("nav.php"); ?>

<main class="single-page <?php single_post_title(); ?>">
  <?php
  if (have_posts()) {
    while (have_posts()) : the_post();
  ?>

      <?php woocommerce_breadcrumb(); ?>
      <?php
      if (get_the_title() === "Order" || get_the_title() === "Checkout") : ?>
        <div class='custom-cart-message-problems'>
          <p>Should you come across any registration issues during your online payment, please check whether you have entered your details correctly or check with your bank if there is any credit card limit.
            <br />Ideally, please use a different credit card.
            <br />If the problem persists, please contact us and we will be happy to assist you.
          </p>
          <a href='mailto:education@eurospine.org'>Contact us</a>
        </div>
  <?php endif;

      the_content();

    endwhile;
  } ?>

</main>