<?php
return array(
    'page' => 'agp_core',
    'title' => 'Page Title',
    'description' => 'Page Description',
    'links' => array(
        'title' => 'Useful Links',
        'list' => array(
            array(
                'url' => '#',
                'title' => 'Documentation',
                'target' => '_blank',
                'icon' => 'dashicons-book',
            ),
            array(
                'url' => '#',
                'title' => 'FAQ',
                'target' => '_blank',
                'icon' => 'dashicons-info',
            ),
            array(
                'url' => '#',
                'title' => 'Support Form',
                'target' => '_blank',
                'icon' => 'dashicons-sos',
            ),        
            array(
                'url' => '#',
                'title' => 'Live Demo',
                'target' => '_blank',
                'icon' => 'dashicons-email-alt',
            ),                            
        ),
    ),
    'tabs' => include (__DIR__ . '/admin-options-tabs.php'),
    'fields' => include (__DIR__ . '/admin-options-fields.php'),
    'fieldSet' => include (__DIR__ . '/admin-options-fieldset.php'),
);