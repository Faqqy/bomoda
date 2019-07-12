<?php
/*
@author Dmitriy Kubarev
@link   http://www.simpleopencart.com
*/

class ModelToolSimpleApiCustom extends Model {
    public function example($filterFieldValue) {
        $values = array();

        $values[] = array(
            'id'   => 'my_id',
            'text' => 'my_text'
        );

        return $values;
    }

    public function test($value) {
        echo '222';
        $values = array();

        $values[] = array(
            'id'   => '1111111111',
            'text' => '123'
        );
        $value='999';
        return $value;
    }

    public function checkCaptcha($value, $filter) {
        if (isset($this->session->data['captcha']) && $this->session->data['captcha'] != $value) {
            return false;
        }

        return true;
    }

    public function getYesNo($filter = '') {
        return array(
            array(
                'id'   => '1',
                'text' => $this->language->get('text_yes')
            ),
            array(
                'id'   => '0',
                'text' => $this->language->get('text_no')
            )
        );
    }
}