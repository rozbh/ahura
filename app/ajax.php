<?php
namespace ahura\app;
class ajax
{
    static function update_mini_cart_btn()
    {
        $mode = isset($_POST['mode']) && $_POST['mode'] ? $_POST['mode'] : 1;
        $mini_cart_btn = \ahura\app\mini_cart::get_mini_cart_btn_html($mode);
        $res['edit']['#mcart-stotal'] = $mini_cart_btn;
        die(json_encode($res));
    }
    static function search_result()
    {
        $keyword = isset($_POST['keyword']) && $_POST['keyword'] ? esc_attr($_POST['keyword']) : false;
        $args = [
                's' => $keyword,
            'posts_per_page' => 5
        ];
        $res = new \WP_Query($args);
        if ($res->have_posts())
        {
            while ($res->have_posts())
            {
                $res->the_post();
                echo '<a href="'.get_the_permalink().'">'.get_the_title().'</a>';
            }
        }else{
            echo '<p>'.__("Nothing Found!", "ahura").'</p>';
        }
        die;
    }
}