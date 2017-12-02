<?php
if (!empty($params) && !empty($params['icon'])) :
    $id = !empty($params['id']) ? $params['id'] : 'fac_' . uniqid();
    $icon = !empty($params['icon']) ? $params['icon'] : '';
    $text = !empty($params['text']) ? $params['text'] : '';
    $shape_type = !empty($params['shape_type']) && in_array($params['shape_type'], array('square','rounded','round')) ? $params['shape_type'] : '';
    $shape_bg = !empty($params['shape_bg']) ? $params['shape_bg'] : '';
    $shape_bg_hover = !empty($params['shape_bg_hover']) ? $params['shape_bg_hover'] : '';
    $icon_color = !empty($params['icon_color']) ? $params['icon_color'] : '';    
    $icon_color_hover = !empty($params['icon_color_hover']) ? $params['icon_color_hover'] : '';    
    $text_color = !empty($params['text_color']) ? $params['text_color'] : '';    
    $text_color_hover = !empty($params['text_color_hover']) ? $params['text_color_hover'] : '';    
    
    Fac()->doDynamicCss( Fac()->getAssetPath('less/icontext.less'), array(
        'id' => $id,
        'icon_color' => $icon_color,
        'shape_bg' => $shape_bg,
        'icon_color_hover' => $icon_color_hover,
        'shape_bg_hover' => $shape_bg_hover,
        'text_color' => $text_color,
        'text_color_hover' => $text_color_hover,
    ));
?>
<span id="<?php echo $id;?>" class="fac fac-icontext-template">
    <span <?php echo !empty($shape_type) ? ' class="fac-shape fac-' . $shape_type . '"' : '';?>>
        <i class="fa fa-<?php echo $icon?>"></i>
    </span>
    <?php echo (!empty($text)) ? '<span class="fac-text">' . $text . '</span>' : '';?>
</span>
<?php
endif;
