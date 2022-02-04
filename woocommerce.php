<?php get_header();
include("nav.php"); ?>
<?php $checkout_url = wc_get_checkout_url(); ?>

<main class="page-products">
    <div id="customCheckout" class="custom-checkout-empty">
        <div class="emptySelectionCart">
            <div>Select the module you wish to attend</div>
            <div>
                <p>The registration fees cover the costs of the eLearning and live session components of the course, coffee breaks and lunch.</p>
                <p>Participants are required to book and pay for their travel and accommodation expenses themselves since those expenses are not included in the registration fees.

                </p>
            </div>
        </div>
        <div class="recapItemsInCart">
            <div class="recap-title">Selected items:</div>
            <div class="item-in-cart"></div>
            <div class="button-checkout">
                <div class="recap-total-container">Total: <span class="recap-total"></span></div>
                <a href="#" class="custom-checkout-button">Checkout</a>
            </div>
        </div>

    </div>
    <div class="days">
        <div class="days-day day-1">Monday <br> 27 June 2022</div>
        <div class="days-am-pm day-1-start">AM</div>
        <div class="days-am-pm day-1-end">PM</div>
        <div class="days-day day-2">Tuesday <br> 28 June 2022</div>
        <div class="days-am-pm day-2-start">AM</div>
        <div class="days-am-pm day-2-end">PM</div>
        <div class="days-day day-3">Wednesday <br> 29 June 2022</div>
        <div class="days-am-pm day-3-start">AM</div>
        <div class="days-am-pm day-3-end">PM</div>
    </div>
    <div class="products">

        <?php

        $args = array(
            'post_status' => 'publish',
            'post_type' => 'product_variation',
            'meta_value' => 'yes',
            'posts_per_page' => -1,
        );
        $products = new WP_Query($args); //Pourrait utiliser la fonction de WooCommerce get_products()
        if ($products->have_posts()) :
            while ($products->have_posts()) :
                $products->the_post(); // met dans $post le post suivant de la query
                $product = get_product($post->ID);

                $class = "product " . $product->get_slug() . " " . extractClass($product->get_title()) . ' ';
                if (!$product->is_in_stock()) {
                    $class .= 'euro-out-of-stock';
                }
                $title = formatTitle($product->get_title());

                if (isset($_GET['member']) && $_GET['member'] === "deleguates" && $post->post_excerpt == "member: Delegates") {
                    echo "<div class='" . $class . "'>";
                    echo "<div class='product-title'>" . $title . "</div>";
                    echo "<div class='product-description'>" . get_the_excerpt() . "</div>";
                    echo "<div class='product-price'>" . $product->get_price_html() . "</div>";
                    echo "<input type='checkbox' value=" . get_the_ID() . " class='product-checkbox'>";
                    echo "</div>";
                }

                if (!isset($_GET['member']) && $post->post_excerpt == "member: Visitors") {
                    echo "<div class='" . $class . "'>";
                    echo "<div class='product-title'>" . $title . "</div>";
                    echo "<div class='product-description'>" . get_the_excerpt() . "</div>";
                    echo "<div class='product-price'>" . $product->get_price_html() . "</div>";
                    echo "<input type='checkbox' value=" . get_the_ID() . " class='product-checkbox'>";
                    echo "</div>";
                }


            endwhile;
        endif;
        wp_reset_query();
        ?>
        <div class="empty-product"></div>
        <div class="empty-product"></div>
        <div class="empty-product"></div>
        <div class="empty-product"></div>
        <div class="empty-product"></div>
        <div class="empty-product"></div>
        <div class="empty-product"></div>
        <div class="empty-product"></div>
        <div class="empty-product"></div>
        <div class="empty-product"></div>
        <div class="empty-product"></div>
        <div class="empty-product"></div>
    </div>
</main>