<?php 
    $args = $params;
    $label = !empty($args->fields['fields'][$args->field]['label']) ? $args->fields['fields'][$args->field]['label'] : '';
    $class = !empty($args->fields['fields'][$args->field]['class']) ? $args->fields['fields'][$args->field]['class'] : ''; 
    $note = !empty($args->fields['fields'][$args->field]['note']) ? $args->fields['fields'][$args->field]['note'] : '';
    $atts = !empty($args->fields['fields'][$args->field]['atts']) ? $args->fields['fields'][$args->field]['atts'] : '';
    if (is_array($atts)) {
        $atts_s = '';
        foreach ($atts as $key => $value) {
            $atts_s .= $key . '="' . $value . '"';
        }
        $atts = $atts_s;
    }
    
    $value = html_entity_decode( htmlspecialchars_decode( $args->data[$args->field] ) );
    $tinymce_atts = array(
        'wpautop' => true,
        'textarea_name' => "{$args->key}[{$args->field}]", 
        'textarea_rows' => 8, 
        'editor_class' => $class, 
    );
?>
<tr>
    <th scope="row"><?php echo $label;?></th>
    <td>
        <div class="agp-field-settings-row">
            <div class="agp-field-tinymce">
                 <?php wp_editor($value, "{$args->key}_{$args->field}", $tinymce_atts);?> 
            </div>
        <?php if (!empty($note)): ?>
            <div class="agp-field-settings-notice">
                <span class="dashicons dashicons-editor-help"></span>
                <p class="description"><?php echo $note;?><span class="dashicons dashicons-no-alt"></span></p><?php endif;?>
            </div>  
        </div>      
    </td>
</tr>    
 