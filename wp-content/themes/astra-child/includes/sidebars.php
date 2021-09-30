<?php

add_action( 'widgets_init', 'cbs_register_sidebar_products' );
function cbs_register_sidebar_products(){
 register_sidebar(array(
 'name' => 'Left Sidebar Products',
 'id' => 'archive-left-sidebarpage',
 'description' => 'Left sidebar for archive page products',
 'before_widget' => '<li id="%1$s" class="widget %2$s">',
 'after_widget' => '</li>',
 'before_title' => '<h2 class="widgettitle">',
 'after_title' => '</h2>',
 ));
}

add_action( 'widgets_init', 'cbs_register_sidebar' );
function cbs_register_sidebar(){
 register_sidebar(array(
 'name' => 'Left Sidebar Pages',
 'id' => 'single-page-sidebar',
 'description' => 'Sidebar for archive page',
 'before_widget' => '<li id="%1$s" class="widget %2$s">',
 'after_widget' => '</li>',
 'before_title' => '<h2 class="widgettitle">',
 'after_title' => '</h2>',
 ));
}

