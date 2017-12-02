<?php
if (!empty($params) && !empty($params['icon'])) :
    $id = !empty($params['id']) ? $params['id'] : 'fac_' . uniqid();
    $icon = !empty($params['icon']) ? $params['icon'] : '';
    $color = !empty($params['color']) ? $params['color'] : '';
    $color_hover = !empty($params['color_hover']) ? $params['color_hover'] : '';
    $font_size = $params['font_size'];

    Fac()->doDynamicCss( Fac()->getAssetPath('less/icon.less'), array(
        'id' => $id,
        'color' => $color,
        'font_size' => $font_size,
        'color_hover' => $color_hover,
    ));
?>
<i id="<?php echo $id;?>" class="fa fa-<?php echo $icon?>"></i>
<?php
endif;
