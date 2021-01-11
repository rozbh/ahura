<div id="topbar" class="topbar header-mode-1">
    <div class="topbar-main">
        <div class="row">
            <div class="col-md-3 logo-wrapper">
            <a href="#" class="menu-icon" id="mw_open_side_menu">
            <i class="fa fa-bars"></i>
            </a>
            <a href="<?php bloginfo('url');?>" class="logo">
                <img src="<?php echo \ahura\app\mw_options::get_mod_theme_logo(); ?>" alt="<?php echo bloginfo('title'); ?>">
            </a>
            </div>
            <div class="col-md-6">
            <form action="<?php bloginfo('url'); ?>" method="get" class="search-form">
                <?php $ajax_search_status = \ahura\app\mw_options::get_mod_is_ajax_search(); ?>
            <input <?php echo $ajax_search_status ? 'autocomplete="off"' : ''; ?> required type="text" name="s" placeholder="<?php _e('Search...','ahura');?>"/>
                <?php if($ajax_search_status): ?>
                    <div id="ajax_search_loading"><span class="fa fa-spinner fa-spin"></span></div>
                    <div id="ajax_search_res"></div>
                <?php endif; ?>
            </form>
            </div>
            <div class="col-md-3 panel_menu_wrapper">
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
            <?php \ahura\app\mini_cart::init_mini_cart(1);?>
                <?php endif;?>    
        </div>
        </div>
        <div class="row">
            <div class="col-md-3 cats-list<?php if(!is_front_page() OR !get_theme_mod( 'openmenuinfrontpage') ){ ?> isnotfront<?php } ?> mobile_hide">
                <span class="cats-list-title"><?php echo \ahura\app\mw_options::get_mod_header_cats_menu_title(); ?></span>
                <?php render_mega_menu(); ?>
            </div>
            <div id="top-menu" class="col-md-9 top-menu">
            <?php rd_topmenu(); ?>
            </div>
        </div>
        <div class="mgmenuresponsive">
            <a href="#" class="menu-icon" id="mw_open_side_mgmenu">
            <span style="width: 70%;background-color:<?php echo \ahura\app\mw_options::get_mod_theme_color();?>;color:<?php echo \ahura\app\mw_options::get_mod_secondary_color();?>;display:block;margin:20px auto 0 auto;font-size:16px;font-weight:700;padding:10px;border-radius:10px 10px 0 0;"><?php echo \ahura\app\mw_options::get_mod_header_cats_menu_title(); ?></span>
            </a>
            </div>
    </div>
</div>