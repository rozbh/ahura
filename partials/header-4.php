<div id="topbar" class="topbar header-mode-4 <?php echo \ahura\app\mw_options::check_is_transparent_header() ? 'ahura_transparent' : ''; ?>" style="display: table;">
    <div class="topbar-main">
        <div class="header-mode-4-container">
            <div class="hedaer-mode-4-logo">
                <a href="#" class="menu-icon" id="mw_open_side_menu">
                    <i class="fa fa-bars"></i>
                </a>
                <a href="<?php bloginfo('url'); ?>" class="logo">
                    <?php if (\ahura\app\mw_options::check_is_transparent_header() && $trs_logo = \ahura\app\mw_options::get_mod_ahorua_transparent_logo()) : ?>
                        <img class="ahura_transparent_logo" src="<?php echo $trs_logo; ?>" />
                    <?php endif; ?>
                    <img src="<?php echo \ahura\app\mw_options::get_mod_theme_logo(); ?>" alt="<?php echo bloginfo('title'); ?>">
                </a>
            </div>
            <div class="header-mode-4-action-box">
                <div class="header-mode-4-search">
                    <form action="<?php bloginfo('url'); ?>" method="get" class="search-form">
                        <?php $ajax_search_status = \ahura\app\mw_options::get_mod_is_ajax_search(); ?>
                        <input <?php echo $ajax_search_status ? 'autocomplete="off"' : ''; ?> required type="text" name="s" placeholder="<?php _e('Search...', 'ahura'); ?>" />
                        <?php if ($ajax_search_status) : ?>
                            <div id="ajax_search_loading"><span class="fa fa-spinner fa-spin"></span></div>
                            <div id="ajax_search_res"></div>
                        <?php endif; ?>
                    </form>
                </div>
                <div class="header-mode-4-action">
                    <?php if(get_theme_mod('ahorua_header_popup_login')):?>
                <div id="popup_login">
                    <?php if(is_user_logged_in() == true){
                        if(class_exists( 'woocommerce' )){
                    echo '<a class="header-popup-login-icon" href="'.get_permalink( get_option('woocommerce_myaccount_page_id') ).'"><i class="fa fa-user"></i></a>';
                    }
                else{
                    echo '<a class="header-popup-login-icon" href="'.admin_url().'"><i class="fa fa-user"></i></a>';
                }}
                else{
                        echo '<a class="header-popup-login-icon" href="#ex1" rel="modal:open"><i class="fa fa-user"></i></a>';
                    }
                
                    ?>
                </div>
                <div id="ex1" class="modal">
                    <h2 class="header-popup-title"><?php echo __('Login To Account','ahura');?></h2>
                <?php headerpopup();?>
                </div>
                <?php endif;?>
                <?php if(get_theme_mod('ahorua_show_mini_cart')):?>
                    <div class="header-mode-4-cart">
                        <?php \ahura\app\mini_cart::init_mini_cart(3); ?>
                    </div>
                <?php endif;?>
                    <div class="header-mode-4-cta">
                        <a href="<?php echo \ahura\app\mw_options::get_mod_header_cta_btn_url();?>" class="header-mode-4-cta"><?php echo \ahura\app\mw_options::get_mod_header_cta_btn_text(); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-mode-4-menu">
        <div class="header-mode-4-menu-container">
            <div class="topbar-main">
                <?php rd_topmenu(); ?>
            </div>
        </div>
    </div>
</div>