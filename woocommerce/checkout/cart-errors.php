<?php
/**
 * Cart errors page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/cart-errors.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;
?>

<p class="woocommerce-cart-error">
    <?php esc_html_e( 
    ' There are some issues with the items in your cart. Someone is trying to purchase this course but it\'s status is "pending payment".
    ', 'woocommerce' ); ?>
    <?php esc_html_e('Thank you for your patience, Eurospine.')?>
</p>


<?php do_action( 'woocommerce_cart_has_errors' ); ?>

<p><a class="button wc-backward" href="/shop"><?php esc_html_e( 'Return to Eurospine shop', 'woocommerce' ); ?></a></p>
