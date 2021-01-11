<?php
namespace ahura\app;
class mini_cart
{
    static function init_mini_cart($mode=1)
    {
        if(!woocommerce::is_active())
        {
            return false;
        }
        ?>
            <div class="mini-cart-header">
                <?php
                echo self::get_mini_cart_btn_html($mode);
                woocommerce_mini_cart();?>
            </div>
        <?php
        // load mini cart assets
        \ahura\app\mw_assets::load_woocommerce_mini_cart();
    }
    static function get_mini_cart_btn_html($mode)
    {
        $method = 'get_btn_mode_header_' . $mode;
        if(!method_exists(__CLASS__, $method))
        {
            return false;
        }
        $items_count = self::get_items_count();
        return self::{$method}($items_count);
    }
    static function get_items_count()
    {
        return WC()->cart->get_cart_contents_count();
    }
    static function get_btn_mode_header_1($items_count)
    {
        return '<a id="mcart-stotal" cart-mode="1" href="#">'.__( 'Cart', 'ahura' ).' - '.$items_count.' '.__( 'Item', 'ahura' ).'</a>';
    }
    static function get_btn_mode_header_3($items_count)
    {
        return '<a href="#" cart-mode="3" cart-count="'.$items_count.'" id="mcart-stotal" class="cart-icon"><i class="fa fa-shopping-bag"></i></a>';
    }
}