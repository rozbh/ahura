<footer class="website-footer">
<?php if ( get_theme_mod( 'ahura_legend' ) ) : ?>
<section class="footer-legend">
<div class="footer-legend-inner">
<h5><?php echo get_theme_mod( 'ahura_legend_text' );?></h5>
<a href="<?php echo get_theme_mod( 'ahura_legend_ctalink' );?>" target="_blank"><?php echo get_theme_mod( 'ahura_legend_ctatext' );?></a>
<div class="clear"></div>
</div>
</section>
<?php endif;?>
<div class="footer-center">
	<div class="row">
<?php if ( is_active_sidebar( 'ahura_footer_widget' ) ) : ?>
		<?php dynamic_sidebar( 'ahura_footer_widget' ); ?>
<?php endif; ?>
<div class="clear"></div>
<div class="<?php if(get_theme_mod('footer_namad_check') == true){echo 'footer-end-100';}else{echo 'footer-end';}?>">
<?php if ( get_theme_mod( 'footer-copyright' ) ) : ?>
<p class="footer-copyright"><?php echo get_theme_mod( 'footer-copyright' ); ?></p>
<?php else:?>
<p class="footer-copyright"><?php echo __('All rights reserved.','ahura');?></p>
<?php endif;?>
<?php if(get_theme_mod('footer_namad_check')):?>
<div class="footer-namad">
	<?php
		$enamad = "".get_template_directory_uri()."/img/enamad.png";
		$samandehi = "".get_template_directory_uri()."/img/samandehi.png";
	?>
	<?php if(get_theme_mod('show_symbol1') == true):?>
		<a href="<?php echo get_theme_mod('footer_namad1_url');?>">
			<img width="70" src="<?php echo (get_theme_mod('footer_namad1') == true ? get_theme_mod('footer_namad1') : $enamad);?>">
		</a>
	<?php endif;?>
	<?php if(get_theme_mod('show_symbol2') == true):?>
		<a href="<?php echo get_theme_mod('footer_namad2_url');?>">
			<img width="70" src="<?php echo (get_theme_mod('footer_namad2') == true ? get_theme_mod('footer_namad2') : $samandehi);?>">
		</a>
	<?php endif;?>
	</div>
<?php endif;?>
</div>
<?php if ( get_theme_mod( 'footer-copyright2' ) ) : ?>
	<p class="footer-copyright2 <?php if(get_theme_mod('footer_namad_check') == true){echo 'copy-rigth2-100';}?>"><?php echo get_theme_mod( 'footer-copyright2' ); ?></p>
	<?php endif;?>
<div class="clear"></div>
</div>
</div>
</footer>
<div id="goto-top" class="<?php echo \ahura\app\mw_options::get_mod_goto_top_btn_position();?>">
	<span class="fa fa-arrow-up"></span>
</div>
<?php wp_footer(); ?>
</body>
</html>