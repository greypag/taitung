<?php
namespace Agp\Plugin\Fac\Persistence;

use Fac\Core\Persistence\RepositoryAbstract;
use Agp\Plugin\Fac\Icons;

class IconRepository extends RepositoryAbstract {
    
    private $version;
    
    public $entityClass ='Agp\Plugin\Fac\Persistence\IconEntity';

    public function init() {
    }    
    
    public function refreshRepository() {
        $icons = new Icons ();      
        
        $this->version = $icons->getVersion();

        $data = $icons->getData();
        parent::refresh($data);        
    }
    
    public function getAllCategories() {
        $result = array();
        $icons = $this->getAll();
        if (!empty($icons) && is_array($icons)) {
            foreach ($icons as $icon) {
                $categories = $icon->getCategories();
                if (!empty($categories) && is_array($categories)) {
                    foreach ($categories as $category) {
                        if (!in_array($category, $result)) {
                            $result[] = $category;
                        }
                    }
                }
            }            
        }
        sort($result);        
        return $result;
    }

    public function getAllByCategory ($category = NULL) {
        $result = array();
        
        $categories = $this->getAllCategories();
        if (!empty($category) && !in_array($category, $categories) ) {
            exit();
        }
        if (!empty($category)) {
            $categories = array();
            $categories[] = $category;    
        }

        if (!empty($categories) && is_array($categories)) {
            $icons = $this->getAll();
            if (!empty($icons) && is_array($icons)) {
                foreach ($icons as $icon) {
                    if ($icon->hasCategory($categories)) {
                        $result[$icon->getName()] = $icon;
                    }
                }
            }
            
        }
        asort($result);
        return $result;
    }
    
    public function getVersion() {
        return $this->version;
    }
    
}
