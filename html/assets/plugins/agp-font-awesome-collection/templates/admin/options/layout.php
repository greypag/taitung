<?php 
    $args = new stdClass();
    $args->settings = $params;
    $args->tabs = $args->settings->getTabs();
    if (!empty($args->tabs)) {
        reset($args->tabs);
        $firstTabKey = key($args->tabs);        
    } else {
        $firstTabKey = '';
    }
    $args->key = isset( $_GET['tab'] ) ? $_GET['tab'] : $firstTabKey;    
    $args->fieldSet = $args->settings->getFieldSet();
    $args->data = $args->settings->getSettings($args->key);
    $args->fields = $args->settings->getFields($args->key);
    $title = !empty($args->settings->getConfig()->admin->options->title) ? $args->settings->getConfig()->admin->options->title : '';
    $description = !empty($args->settings->getConfig()->admin->options->description) ? $args->settings->getConfig()->admin->options->description : '';
    $links = !empty($args->settings->getConfig()->admin->options->links) ? $args->settings->objectToArray( $args->settings->getConfig()->admin->options->links ) : '';
    $Id = $args->settings->getParentModule()->getKey();
?>
<div class="<?php echo $Id;?>">
    <?php if (!empty($title)) :?>
    <div class="agp-plugin-headline">
        <table style="width: 100%;">
            <tr>
                <td style="width: 128px;" class="agp-plugin-headline-icon">                                                                                               
                    <img src="<?php echo $args->settings->getParentModule()->getAssetUrl( 'images/icons/icon-options.png' )?>" width="128" height="128" />    
                </td>
                <td class="agp-plugin-headline-info">
                    <h1 style="margin: 0px; padding: 0 0 10px;"><?php echo $title;?></h1>
                    <p style="margin: 0px; padding: 0 0 5px;">How to use those features you can find on the <a href="http://www.profosbox.com/agp-font-awesome-collection/" target="_blank"><strong>Plugin Site</strong></a> in the <a href="http://www.profosbox.com/agp-font-awesome-collection/documentation/" target="_blank"><strong>Documentation</strong></a> section.</p> 
                    <p style="margin: 0px; padding: 0;">Also You can find <a href="http://www.profosbox.com/agp-font-awesome-collection/documentation/examples-of-usage/" target="_blank"><strong>Live Demo</strong></a> on the plugin site.</p>   
                </td>
                
                <?php if (!empty($links['list'])):?>
                <td style="width: 15%;" class="agp-plugin-headline-links">
                    <div class="agp-plugin-headline-links-wrapper">
                        <?php if (!empty($links['title'])) :?>
                        <h2><?php echo $links['title'];?></h2>
                        <?php endif;?>
                        
                        <ul>
                        <?php foreach ($links['list'] as $link) : ?>
                            <li><a href="<?php echo $link['url'];?>" target="<?php echo $link['target'];?>" title="<?php echo $link['title'];?>"><span class="dashicons <?php echo $link['icon'];?>"></span> <?php echo $link['title'];?></a></li>
                        <?php endforeach; ?>    
                        </ul>                 
                    </div>
                </td>
                <?php endif;?>
            </tr>
        </table>
    </div>
    <?php endif;?>

    <div class="wrap agp-form-wrap">
        <?php 
            screen_icon();
            settings_errors();

            echo $args->settings->getParentModule()->getTemplate('admin/options/render-tabs', $args);
        ?>
        <form method="post" action="options.php">
            <?php wp_nonce_field( 'update-options' ); ?>
            <?php settings_fields( $args->key ); ?>

            <?php echo $args->settings->getParentModule()->getTemplate('admin/options/render-page', $args); ?>

            <p class="submit">
                <input id="submit" class="button button-primary" type="submit" value="Save Changes" name="submit">
                <a class="button button-primary" href="?page=<?php echo $args->settings->getPage();?>&tab=<?php echo $args->key;?>&reset-settings=true" >Reset to Default</a>
            </p>
        </form>
    </div>
</div>

<script type="text/javascript">
(function($) {  
    $(document).ready(function() { 
        
        $('.agp-warning-hint .agp-field-settings-notice span.dashicons-editor-help').removeClass('dashicons-editor-help').addClass('dashicons-warning');
        
        $(window).click(function (event) {
            event = event || window.event;
            if ($(event.target).closest('.agp-field-settings-notice').length > 0 && ( $(event.target).hasClass('dashicons-editor-help') || $(event.target).hasClass('dashicons-warning'))) {
                var el = $(event.target).closest('.agp-field-settings-notice').children('.description');
                if ($(event.target).closest('.agp-field-settings-notice').hasClass('open')) {
                    el.fadeOut(100);                
                    $(event.target).closest('.agp-field-settings-notice').removeClass('open');
                } else {
                    $('.agp-field-settings-notice').each(function() {
                       $(this).removeClass('open');
                       $(this).children('.description').fadeOut(100);
                    }); 
                    el.fadeIn(100);                
                    $(event.target).closest('.agp-field-settings-notice').addClass('open');
                }                
            } else if ($(event.target).closest('.agp-field-settings-notice').length > 0 && $(event.target).hasClass('description')) {
                return;
            } else {
                $('.agp-field-settings-notice').each(function() {
                   $(this).removeClass('open');
                   $(this).children('.description').fadeOut(100);
                });                                                 
            }
        });
    });
})(jQuery);
</script>