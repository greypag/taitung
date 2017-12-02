<?php
return array(
    'agp_core' => array(
        'page_title' => 'Menu Item', 
        'menu_title' => 'Menu Item', 
        'capability' => 'manage_options',
        'function' => array( 'Fac\Core\Settings', 'renderSettingsPage'),
        'position' => null, 
        'hideInSubMenu' => TRUE,
        'icon_url'   => '',    
//        'submenu' => array(
//            'agp_core_options' => array(
//                'page_title' => 'Settings', 
//                'menu_title' => 'Settings', 
//                'capability' => 'manage_options',
//                'function' => '',                         
//            ),   
//        ),
    ),
);
    