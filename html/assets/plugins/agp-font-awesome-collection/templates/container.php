<?php
if (!empty($params) && !empty($params['shortcode'])) :
    $id = !empty($params['id']) ? $params['id'] : 'fac_' . uniqid();
    $text_align = !empty($params['text_align']) ? $params['text_align'] : '';
    $shortcode = !empty($params['shortcode']) ? $params['shortcode'] : '';
    
    Fac()->doDynamicCss( Fac()->getAssetPath('less/container.less'), array(
        'id' => $id,
        'text_align' => $text_align,
    ));    
?>
<span id="<?php echo $id;?>">
    <?php echo do_shortcode("[$shortcode]"); ?>
</span>
<?php
endif;
