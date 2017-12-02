<?php
namespace Fac\Core;

/**
 * ModuleHelper class
 */
class ModuleHelper {
    
    public function getFeaturedImage ($size = 'full', $post_id = false) {
        global $post;
        if (empty($post_id)) {
            $post_id = $post->ID;
        }
        $post_thumbnail_id = get_post_thumbnail_id( $post_id );      
        
        if (!empty($post_thumbnail_id)) {
            $image = wp_get_attachment_image_src( $post_thumbnail_id, $size );
            if (!empty($image[0])) {
                return $image[0];
            }
        }
    }  
    
    public function getFieldImage($selector, $size = 'full', $post_id = false) {
        $result = '';
        $image = get_field($selector, $post_id);
        if (!empty($image)) {
            if (is_numeric($image)) {
                $src = wp_get_attachment_image_src( $image, $size );
                if (!empty($src[0])) {
                    $result = $src[0];
                }
            } else {
                if ($size == 'full' && !empty($image['url'])) {
                    $result = $image['url'];
                } elseif (!empty($image['sizes'][$size])) {
                    $result = $image['sizes'][$size];
                }            
            }            
        }
        return $result;
    }    
    
    public function getSubFieldImage($selector, $size = 'full') {
        $result = '';
        $image = get_sub_field($selector);
        if (!empty($image)) {
            if (is_numeric($image)) {
                $src = wp_get_attachment_image_src( $image, $size );
                if (!empty($src[0])) {
                    $result = $src[0];
                }
            } else {
                if ($size == 'full' && !empty($image['url'])) {
                    $result = $image['url'];
                } elseif (!empty($image['sizes'][$size])) {
                    $result = $image['sizes'][$size];
                }            
            }            
        }
        return $result;
    }        
    
    public function getArrayToRowHtml ( $value, $title = '', $class = '' ) {
        $result = '';
        if ( !empty($value) && is_array($value) ) {
            
            if (!empty($class)) {
                $result .= '<div class='.$class.'>';
            }
            
            if (!empty($title)) {
                $result .= "<span>{$title}</span> ";
            }
            
            foreach ($value as &$item) {
                if (is_array($item) && !empty($item)) {
                    $item = array_pop($item);
                }
            }
            
            $result .= implode(', ', $value);
            
            if (!empty($class)) {
                $result .= '</div>';
            }
        }
        return $result;
    }
    
    public function getArrayToListHtml ( $value, $title = '', $class = '', $ul_class = '', $li_class = '' ) {
        $result = '';
        if ( !empty($value) && is_array($value) ) {
            if (!empty($class)) {
                $result .= '<div class="'.$class.'">';
            }
            
            if (!empty($title)) {
                $result .= "<span>{$title}</span> ";
            }
            
            if (!empty($ul_class)) {
                $result .= '<ul class="'.$ul_class.'">';
            } else {
                $result .= '<ul>';    
            }
            
            foreach ($value as $key => $item) {
                if (!empty($li_class)) {
                    $result .= '<li class="'.$li_class.'">';
                } else {
                    $result .= '<li>';    
                }
            
                if (!is_numeric($key)) {
                    $k = ucfirst($key).': ';
                    $result .= "<span>{$k}</span>";
                }

                if (is_array($item) && !empty($item)) {
                    $item = array_pop($item);
                }
                $result .= $item;
                $result .= '</li>';
            }

            if (!empty($class)) {
                $result .= '</div>';
            }            
        }
        return $result;
    }    
}