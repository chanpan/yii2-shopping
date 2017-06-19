<?php

namespace common\lib\sdii\models;

use yii\base\DynamicModel;

class SDDynamicModel extends DynamicModel {
    
    private $_attributeLabels = [];
    
    public function attributeLabels()
    {
        return $this->_attributeLabels;
    }
    
    public function addLabel($attributeLabels)
    {
        $this->_attributeLabels = $attributeLabels;
	
	return $this;
    }
    
    public function getAttributeLabel($attribute)
    {
        $labels = $this->attributeLabels();
        return (isset($labels[$attribute]) && !empty($labels[$attribute])) ? $labels[$attribute] : $this->generateAttributeLabel($attribute);
    }
    
}
