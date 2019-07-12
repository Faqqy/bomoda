<?php
// catalog/controller/ajax/index.php
class ControllerAjaxIndex extends Controller {
    public function index() {
    }

    // метод вызова ajax
    public function ajaxGetStatus() {

        $result=array();
        $result['error']=0;

        $this->load->model('account/order');

        $order_info = $this->model_account_order->getOrder1($this->request->post['number']);

        if($order_info)

        {
            $post_phone=$this->request->post['phone'];
            $post_phone=str_replace('(','',$post_phone);
            $post_phone=str_replace(')','',$post_phone);
            $post_phone=str_replace(' ','',$post_phone);
            $post_phone=str_replace('-','',$post_phone);
            $post_phone=str_replace('+7','',$post_phone);
            //print_r($post_phone);
            $user_phone=$order_info['telephone'];
            $user_phone=str_replace('(','',$user_phone);
            $user_phone=str_replace(')','',$user_phone);
            $user_phone=str_replace(' ','',$user_phone);
            $user_phone=str_replace('-','',$user_phone);
            $user_phone=str_replace('+7','',$user_phone);
            
            //print_r($user_phone);
            if($user_phone==$post_phone)
            {
                $results = $this->model_account_order->getOrderHistories($this->request->post['number']);
                //print_r($results[count($results)-1]['status']);
                $result['status']=$results[count($results)-1]['status'];

                /*foreach ($results as $result) {
                    $data['histories'][] = array(
                        'date_added' => date($this->language->get('date_format_short'), strtotime($result['date_added'])),
                        'status'     => $result['status'],
                        'comment'    => $result['notify'] ? nl2br($result['comment']) : ''
                    );
                }*/

            }
            else
            {
                $result['error']=1;
                $result['error_message']='Введен не верный номер телефона!';

            }
        }
        else
        {
            $result['error']=1;
            $result['error_message']='Не существует заказа с указанным номером!';
        }


        print_r(json_encode($result));



    }




}