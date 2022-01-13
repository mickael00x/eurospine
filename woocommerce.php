<?php get_header(); ?>

<?php $checkout_url = wc_get_checkout_url(); ?>

<main class="page-products">
<div id="customCheckout" style="display: none;">
    <div class="recapItemsInCart">
        <span class="recap-title">Selected items: 
            <div class="notes">
                Notes &#9432;
                <div class="notes-infos">
                    <h4>Fees:</h4>
                    <p>
                        The registration fee covers the cost of the eLearning and live components of the course, coffee breaks and lunch.<br>
                        Modules 1 to 5 are delivered twice during the EduWeek. <br>Participants can only register for ONE of the module's cohort, at their preferred time/dates. 
                    </p>
                    <h4>Travel and accommodation:</h4>
                    <p>
                        Participants are required to book and pay for their travel and accommodation themselves.<br>This is not included in the registration fee.
                    </p>
                    <h4>Accompanying persons:</h4>
                    <p>
                        There are no accompanying persons fees nor accompanying persons programme during this course.
                    </p>
                </div>
            </div>
        </span>
        <span class="item-in-cart">
        </span>
    </div>
    <div class="button-checkout"/>
        <a href="#" class="custom-checkout-button">Checkout</a>
    </div>
</div>
<div class="days">
    <div class="days-day day-1">Monday <br> 27 June 2022</div>
    <div class="days-am-pm day-1-start">AM</div>
    <div class="days-am-pm">PM</div>
    <div class="days-day day-2">Tuesday <br> 28 June 2022</div>
    <div class="days-am-pm day-2-start">AM</div>
    <div class="days-am-pm">PM</div>
    <div class="days-day day-3">Wednesday <br> 29 June 2022</div>
    <div class="days-am-pm day-3-start">AM</div>
    <div class="days-am-pm">PM</div>
</div>
<div class="products">
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
    <?php

    $args = array(  
        'post_status' => 'publish',
        'post_type' => 'product_variation',  
        'meta_value' => 'yes',  
        'posts_per_page' => -1, 
    );  
    $products = new WP_Query( $args ); 
    if ($products->have_posts()) :   
        while ($products->have_posts()) :  
            $products->the_post();
            $product = get_product( $products->post->ID );

        if($_GET['member'] === "deleguates" && $product->post->post_excerpt == "member: Delegates") {
            echo "<div class='product ".$product->get_slug(). "'>";
                echo "<div class='product-title'>" .$product->get_title() ."</div>";
                echo "<div class='product-description'>" .get_the_excerpt( $product->id ) ."</div>";
                echo "<div class='product-price'>" .$product->get_price_html() ."</div>";
                echo "<input type='checkbox' value=".$product->get_id()." id='product-selection'>";
            echo "</div>";

        } 

        if(is_null($_GET['member']) && $product->post->post_excerpt == "member: Visitors") {
            echo "<div class='product ".$product->get_slug(). "'>";
                echo "<div class='product-title'>" .$product->get_title() ."</div>";
                echo "<div class='product-description'>" .get_the_excerpt( $product->id ) ."</div>";
                echo "<div class='product-price'>" .$product->get_price_html() ."</div>";
                echo "<input type='checkbox' value=".$product->get_id()." id='product-selection'>";
            echo "</div>";

        }

    
        endwhile;  
    endif;  
    wp_reset_query();

    ?>
</div>
</main>
