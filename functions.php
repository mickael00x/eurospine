<?php

// =========== register CSS ===============
function eurospine_custom_theme()
{
    wp_register_style('custom_css', get_template_directory_uri() . '/assets/css/style.css', false, filemtime(__DIR__ . "/assets/css/style.css"));
    wp_register_style('roboto_font_cdn', 'https://fonts.googleapis.com/css2?family=Roboto&display=swap', false, '1.0');

    wp_register_script('script_js', get_template_directory_uri() . '/assets/js/index.js', false, filemtime(__DIR__ . "/assets/js/index.js"));
    wp_register_script('tarteaucitron', get_template_directory_uri() . '/assets/js/tarteaucitron/tarteaucitron.js', false, filemtime(__DIR__ . "/assets/js/index.js"));
    wp_register_script('init', get_template_directory_uri() . '/assets/js/tarteaucitron/init.js', false, filemtime(__DIR__ . "/assets/js/index.js"));

    wp_enqueue_style('custom_css');
    wp_enqueue_style('roboto_font_cdn');

    wp_enqueue_script('script_js');
    wp_enqueue_script('tarteaucitron');
    wp_enqueue_script('init');
}

add_action('wp_enqueue_scripts', 'eurospine_custom_theme');


if (class_exists('WooCommerce')) {


    global $woocommerce;

    /* WooCommerce support */
    function woocommerceshop_add_woocommerce_support()
    {
        add_theme_support('woocommerce');
    }
    add_action('after_setup_theme', 'woocommerceshop_add_woocommerce_support');



    add_action('init', 'clear_cart_before_every_checkout');

    function clear_cart_before_every_checkout()
    {
        global $woocommerce;
        if (isset($_GET['empty-cart'])) {
            $woocommerce->cart->empty_cart();
        }
    }

    //https://avada.io/woocommerce/docs/select-multiple-variations.html

    function add_multiple_products_to_cart($url = false)
    {
        // Make sure WC is installed, and add-to-cart qauery arg exists, and contains at least one comma.
        if (!class_exists('WC_Form_Handler') || empty($_REQUEST['add-to-cart']) || false === strpos($_REQUEST['add-to-cart'], ',')) {
            return;
        }

        // Remove WooCommerce's hook, as it's useless (doesn't handle multiple products).
        remove_action('wp_loaded', array('WC_Form_Handler', 'add_to_cart_action'), 20);

        $product_ids = explode(',', $_REQUEST['add-to-cart']);
        $count       = count($product_ids);
        $number      = 0;

        foreach ($product_ids as $id_and_quantity) {
            // Check for quantities defined in curie notation (<product_id>:<product_quantity>)

            $id_and_quantity = explode(':', $id_and_quantity);
            $product_id = $id_and_quantity[0];

            $_REQUEST['quantity'] = !empty($id_and_quantity[1]) ? absint($id_and_quantity[1]) : 1;

            if (++$number === $count) {
                // Ok, final item, let's send it back to woocommerce's add_to_cart_action method for handling.
                $_REQUEST['add-to-cart'] = $product_id;

                return WC_Form_Handler::add_to_cart_action($url);
            }

            $product_id        = apply_filters('woocommerce_add_to_cart_product_id', absint($product_id));
            $was_added_to_cart = false;
            $adding_to_cart    = wc_get_product($product_id);

            if (!$adding_to_cart) {
                continue;
            }

            $add_to_cart_handler = apply_filters('woocommerce_add_to_cart_handler', $adding_to_cart->get_type(), $adding_to_cart);

            // Variable product handling
            if ('variable' === $add_to_cart_handler) {
                woo_hack_invoke_private_method('WC_Form_Handler', 'add_to_cart_handler_variable', $product_id);

                // Grouped Products
            } elseif ('grouped' === $add_to_cart_handler) {
                woo_hack_invoke_private_method('WC_Form_Handler', 'add_to_cart_handler_grouped', $product_id);

                // Custom Handler
            } elseif (has_action('woocommerce_add_to_cart_handler_' . $add_to_cart_handler)) {
                do_action('woocommerce_add_to_cart_handler_' . $add_to_cart_handler, $url);

                // Simple Products
            } else {
                woo_hack_invoke_private_method('WC_Form_Handler', 'add_to_cart_handler_simple', $product_id);
            }
        }
    }

    // Fire before the WC_Form_Handler::add_to_cart_action callback.
    add_action('wp_loaded', 'add_multiple_products_to_cart', 15);


    /**
     * Invoke class private method
     *
     * @since   0.1.0
     *
     * @param   string $class_name
     * @param   string $methodName
     *
     * @return  mixed
     */
    function woo_hack_invoke_private_method($class_name, $methodName)
    {
        if (version_compare(phpversion(), '5.3', '<')) {
            throw new Exception('PHP version does not support ReflectionClass::setAccessible()', __LINE__);
        }

        $args = func_get_args();
        unset($args[0], $args[1]);
        $reflection = new ReflectionClass($class_name);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        //$args = array_merge( array( $class_name ), $args );
        $args = array_merge(array($reflection), $args);
        return call_user_func_array(array($method, 'invoke'), $args);
    }
}

add_action( 'woocommerce_review_order_before_order_total', 'custom_vat_message' );
function custom_vat_message () {
    echo "<tr class='tax-total no-vat'><th>*VAT exemption - article 261-7-1??b) of the C.G.I.</th><td>0</td></tr>";
}


add_filter( 'woocommerce_get_order_item_totals', 'add_row_email', 10, 2 );
 
function add_row_email( $total_rows, $myorder_obj ) {
 
$total_rows['recurr_not'] = array(
   'label' => "*VAT exemption - article 261-7-1??b) of the C.G.I.",
   'value'   => '0'
);
$total_rows['_vat_number'] = array(
    'label' => 'VAT number',
    'value'   => get_post_meta( $myorder_obj->get_order_number(), '_vat_number', true )
 );
 
return $total_rows;
}



add_action( 'woocommerce_after_order_notes', 'custom_vat_field' );
/**
* VAT Number in WooCommerce Checkout
*/
function custom_vat_field( $checkout ) {
    echo '<div id="custom_vat_field"><h2>' . __('VAT Number') . '</h2>';
    
    woocommerce_form_field( 'vat_number', array(
        'type'          => 'number',
        'class'         => array( 'vat-number-field form-row-wide') ,
        'label'         => __( 'VAT Number' ),
        'placeholder'   => __( 'Enter your VAT number' ),
    ), $checkout->get_value( 'vat_number' ));
    
    echo '</div>';
}


add_action( 'woocommerce_checkout_update_order_meta', 'custom_checkout_vat_number_update_order_meta' );
/**
* Save VAT Number in the order meta
*/
function custom_checkout_vat_number_update_order_meta( $order_id ) {
    if ( ! empty( $_POST['vat_number'] ) ) {
        update_post_meta( $order_id, '_vat_number', sanitize_text_field( $_POST['vat_number'] ) );
    }
}


    


//=== function templating

function extractClass($product_title)
{
    $class = '';
    $arrayTitle = explode('/', $product_title, 3);
    $modCo = trim(explode('Module', $arrayTitle[1])[1]);
    $mod = 0;
    $cohort = 0;
    if (is_numeric($modCo)) $mod = $modCo;
    else {
        $modCo = explode(' Cohort ', $modCo);
        $mod = $modCo[0];
        $cohort = $modCo[1];
    }
    if (strpos($product_title, ' Advanced Module')) {
        $mod .= 'a';
    }

    $class = ' euro-mod' . $mod;
    if ($cohort > 0)
        $class .= ' euro-co' . $cohort . ' ';

    return $class;
}

function formatTitle($product_title)
{
    $arrayTitle = explode('/', $product_title, 3);
    $title = '<div class="product-title-real"  >' . $arrayTitle[0] . '</div>';
    $meta = '<div class="product-title-meta"  > 
        <div class="product-title-mod">' . $arrayTitle[1] . '</div>
        <div class="product-title-time">' . str_replace('/', '<br>', $arrayTitle[2]) . '</div>
    </div>';

    return $title . $meta;
}

function formatTitleCart($product_title)
{
    $arrayTitle = explode('/', $product_title, 3);
    $title = '<div><b>' . $arrayTitle[0] . '</b></div>';
    $meta =  '<div>' . $arrayTitle[1] . '</div>' . $arrayTitle[2];

    return $title . $meta;
}

// Hooks / Filters 

function filter_woocommerce_order_item_name($item_name, $item)
{
    return formatTitleCart(strip_tags($item_name));
};

function filter_woocommerce_cart_item_name($product_get_name, $cart_item, $cart_item_key)
{
    return  formatTitleCart($product_get_name);
};

// add the filter 
add_filter('woocommerce_cart_item_name', 'filter_woocommerce_cart_item_name', 10, 3);
add_filter('woocommerce_order_item_name', 'filter_woocommerce_order_item_name', 10, 2);


function eurospine_woocommerce_coupon_links()
{

    // Sort si WooCommerce ou la session sont indisponibles.

    if (!function_exists('WC') || !WC()->session) {
        return;
    }

    // Pas d'AJAX

    if (defined('DOING_AJAX') && DOING_AJAX) {
        return;
    }


    $query_var = apply_filters('woocommerce_coupon_links_query_var', 'coupon_code');


    if (empty($_GET[$query_var])) {
        return;
    }
    // securise la chaine de caract??re 
    $coupon = sanitize_text_field($_GET[$query_var]);

    // Cr??e un cookie de session ?? persister si le panier est vide

    WC()->session->set_customer_session_cookie(true);

    // Applique le code si c'est possible

    if (!WC()->cart->has_discount($coupon)) {

        // WC_Cart::add_discount() resanitizes le code coupon .

        WC()->cart->add_discount($coupon);
    }
}
add_action('wp_loaded', 'eurospine_woocommerce_coupon_links', 30);
add_action('woocommerce_add_to_cart', 'eurospine_woocommerce_coupon_links');

function eurospine_woocommerce_after_order_details($order)
{
    if ($order->get_payment_method_title() === 'Direct bank transfer') {
        echo
        '<div class="eurospine_after_order_details">
            <p><b>Bank details: IBAN FR76 1027 8010 0100 0209 3370 180 </b></p>
            <p>To secure your place at EduWeek you must complete the payment process. Until then your booking is on hold.</p>
        </div>';
    }
}
add_action('woocommerce_after_order_details', 'eurospine_woocommerce_after_order_details');




function save_extra_checkout_fields( $order_id, $posted ){
    // don't forget appropriate sanitization if you are using a different field type
    if( isset( $posted['_vat_number'] ) ) {
        update_post_meta( $order_id, '_vat_number', sanitize_text_field( $posted['vat_number'] ) );
    }
    if( isset( $posted['_vat_number'] ) && in_array( $posted['_vat_number'], array( 'first', 'second', 'third' ) ) ) {
        update_post_meta( $order_id, '_vat_number', $posted['_vat_number'] );
    }
}
add_action( 'woocommerce_checkout_update_order_meta', 'save_extra_checkout_fields', 10, 2 );


add_action( 'woocommerce_admin_order_data_after_order_details', 'vat_editable_order_meta' );

function vat_editable_order_meta( $order ) {
    $vat_number_field = get_post_meta( $order->get_id(), '_vat_number', true );

    woocommerce_wp_text_input( array(
        'id' => '_vat_number',
        'label' => 'VAT number:',
        'value' => $vat_number_field,
        'wrapper_class' => 'form-field-wide'
    ) );
}

add_action( 'woocommerce_process_shop_order_meta', 'save_general_details' );

function save_general_details( $ord_id ){
	update_post_meta( $ord_id, '_vat_number', wc_clean( $_POST[ '_vat_number' ] ) );
}