<?php
if (!empty($params) && !empty($params['icon'])) :
    $id = !empty($params['id']) ? $params['id'] : 'fac_' . uniqid();
    $name = !empty($params['name']) ? $params['name'] : '';
    $title = !empty($params['title']) ? $params['title'] : '';
    $icon = !empty($params['icon']) ? $params['icon'] : '';
    $link = !empty($params['link']) ? $params['link'] : '';    
    $target = !empty($params['target']) ? $params['target'] : '';        
    $text = !empty($params['text']) ? $params['text'] : '';    
    $background = !empty($params['background']) ? $params['background'] : '';
    $background_hover = !empty($params['background_hover']) ? $params['background_hover'] : '';
    $border_radius = isset($params['border_radius']) ? $params['border_radius'] : '';
    $border_width = !empty($params['border_width']) ? $params['border_width'] : '';
    $border_color = !empty($params['border_color']) ? $params['border_color'] : '';
    $color = !empty($params['color']) ? $params['color'] : '';
    $color_hover = !empty($params['color_hover']) ? $params['color_hover'] : '';
    
    Fac()->doDynamicCss( Fac()->getAssetPath('less/button.less'), array(
        'id' => $id,
        'background' => $background,
        'border_radius' => $border_radius,
        'border_width' => $border_width,
        'border_color' => $border_color,
        'color' => $color,
        'background_hover' => $background_hover,
        'color_hover' => $color_hover,
    ));            
?>
<span id="<?php echo $id;?>" class="fac fac-button-template">
    <a href="<?php echo (!empty($link)) ? $link : '#';?>" 
        class="fac-button<?php echo (!empty($text)) ? ' fac-text' : '';?>" 
        <?php echo (!empty($name)) ? ' id="' . $name . '"'  : '';?>       
        <?php echo (!empty($target)) ? ' target="' . $target . '"'  : '';?>              
        title="<?php echo $title;?>"
    >
             <i class="fa fa-<?php echo $icon;?>"></i>
             <?php echo (!empty($text)) ? '<span>' . $text . '</span>' : '';?>
    </a>    
</span>
<?php
endif;
