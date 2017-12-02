<?php
$args = $params;
if (!empty($args->fields)):
    $sections = !empty($args->fields['sections']) ? $args->fields['sections'] : array('default' => array());
    $fields = !empty($args->fields['fields']) ? $args->fields['fields'] : NULL;
    
    if (!empty($fields)) :
    
        foreach ($sections as $sk => $sv) : ?>
        <div class="agp-settings-content">
            
            <?php if (!empty($sv['label'])) : ?>        
            <div class="agp-settings-title"> 
                <h3>
                    <?php echo $sv['label'] ?>
                </h3>
            </div>    
            <?php endif; ?>
            
            <div class="agp-settings-inner-table">
                <?php if (!empty($sv['description_before'])) : ?>        
                <div class="agp-settings-description before"> 
                    <?php echo $sv['description_before'] ?>
                </div>                    
                <?php endif; ?>
                <table class="form-table">
                    <tbody>
                    <?php        
                        foreach ($fields as $fk => $fv) :
                            if (!empty($fv['section']) && $fv['section'] == $sk || $sk == 'default' ) :
                                if (!empty($fv['type'])) :
                                    $args->field = $fk;
                                    echo $args->settings->getParentModule()->getTemplate('admin/options/fields/' . $fv['type'] , $args);
                                endif;                    
                            endif;
                        endforeach;                
                    ?>
                    </tbody>        
                </table>   
                <?php if (!empty($sv['description_after'])) : ?>        
                <div class="agp-settings-description after"> 
                    <?php echo $sv['description_after'] ?>
                </div>                    
                <?php endif; ?>                
            </div>    
        </div>    
            <?php 
        endforeach;        
    endif;
endif;