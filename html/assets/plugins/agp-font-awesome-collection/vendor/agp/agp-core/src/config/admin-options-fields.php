<?php
return array(
    'agp_core_tab_1' => array(
        'sections' => array(
            'agp_core_section_1' => array(
                'label' => 'Section 1',
                'description_before' => 'Description Before',
                'description_after' => 'Description After',
            ),            
        ),
        'fields' => array(
            'field_text' => array(
                'type' => 'text',
                'label' => 'Caption',
                'default' => 'Text Field',
                'section' => 'agp_core_section_1',
                'class' => 'widefat regular-text',
                'note' => 'note...',
                'atts' => array(                
                ),
            ),
            'field_textarea' => array(
                'type' => 'textarea',
                'label' => 'Caption',
                'default' => 'Textarea Field',
                'section' => 'agp_core_section_1',
                'class' => 'widefat regular-text',
                'note' => 'note...',
                'atts' => array(                
                ),
            ),            
            'field_tinymce' => array(
                'type' => 'tinymce',
                'label' => 'Caption',
                'default' => 'Tinymce Field',
                'section' => 'agp_core_section_1',
                'class' => 'widefat regular-text',
                'note' => 'note...',
                'atts' => array(                
                ),
            ),          
            'field_select' => array(
                'type' => 'select',
                'label' => 'Caption',
                'fieldSet' => 'selectFieldSet',
                'default' => 'item_1',
                'section' => 'agp_core_section_1',
                'class' => 'widefat regular-select',
                'note' => 'option allows to set submit button position',
            ),    
            //.....
        ),
    ),
);
