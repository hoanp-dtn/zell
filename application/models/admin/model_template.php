<?php
/**
 *
 */
class Model_template extends MY_Model
{

    public function getTemplateName($template_id) {
        return $this->_get('name', PREFIX .'template',array('id'=>(int)$template_id));
    }
}
?>