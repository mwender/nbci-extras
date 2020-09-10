<?php

namespace NBCI\siteContainer;

function site_container_open(){
	echo '<div class="site-container">';
}
add_action( 'elementor/theme/before_do_header', __NAMESPACE__ . '\\site_container_open' );

function site_container_close(){
	echo '</div><!-- .site-container -->';
}
add_action( 'elementor/theme/after_do_footer', __NAMESPACE__ . '\\site_container_close' );