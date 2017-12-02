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
    $checked = !empty($args->data[$args->field]);
?>
<tr>
    <th scope="row"><?php echo $label;?></th>
    <td>
        <div class="agp-field-settings-row agp-field-settings-row-checkbox">
            <input <?php echo $atts;?><?php echo !empty($class) ? ' class="'.$class.'"': '';?> type="checkbox" id="<?php echo "{$args->key}[{$args->field}]"; ?>" name="<?php echo "{$args->key}[{$args->field}]"; ?>" <?php checked( $checked ); ?>>                
            <?php if (!empty($note)): ?>
            <div class="agp-field-settings-notice">
                <span class="dashicons dashicons-editor-help"></span>
                <p class="description"><?php echo $note;?><span class="dashicons dashicons-no-alt"></span></p>
            </div>    
            <?php endif;?>  
        </div>
    </td>
</tr>    
