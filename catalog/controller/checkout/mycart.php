<?php
class ControllerCheckoutMycart extends Controller {
    public function index() {

    }
    public function sendmailCustom (){
        $this->load->model('catalog/product');
        $this->load->model('catalog/category');
        $this->load->language('checkout/cart');
        $products = $this->cart->getProducts();
        //print_r($products);
        $html='';
        $html.='
  <div class="addcart_form_title">
    Товар добавлен в корзину
  </div>
  <div class="addcart_form_subtitle">
    Всего в вашей корзине '.count($products).' товара. <a href="/checkout/cart">Просмотреть</a>
  </div>
  <div class="line"></div><div class="addcart_form_blocks" >';

        foreach($products as $product) { //print_r($product);
            $id=$product['product_id'];


            $product_info = $this->model_catalog_product->getProduct($id);
            $images = $this->model_catalog_product->getProductImages($id);
            $attrs = $this->model_catalog_product->getProductAttributes($id);
            $options = $this->model_catalog_product->getProductOptions($id);
            $rel = $this->model_catalog_product->getProductRelated($id);
            $cat = $this->model_catalog_product->getCategories($id);

            $category_info = $this->model_catalog_category->getCategory($cat[count($cat)-1]['category_id']);
            //print_r($product);
            $html.='<div class="addcart_form_block" >
    <div class="addcart_form_block_img" >
      <img src = "/image/'.$product['image'].'" />
    </div >
    <div class="addcart_form_block_desc" >
      <div class="addcart_form_block_desc_title" >
        '.$product['name'].'
      </div >
      <div class="addcart_form_block_desc_cat" >
      '.$category_info['name'].'
      </div>
      <div class="addcart_form_block_desc_options" >';
            $count=0;
            foreach($product['option'] as $option)
            {
                $html.=$option['name'].': '.$option['value'].'<br/>';
                if($option['quantity']>0)
                    $count=$option['quantity'];
            }
            $html.='</div >';
            if($count>0)
            {
                $html.='<div class="addcart_form_block_desc_count" >Осталось в наличии: '.$count.'</div>';
            }

    $html.='</div >';


    $html.='<div class="addcart_form_block_count" >
            '.$product['price'].'
      <br /><br/>
      '.$product['quantity'].' шт .
    </div >


  </div >
  <div class="clear" ></div >
  <div class="line" ></div >';
        }



        $html.='</div><div class="addcart_form_btns">
    <div class="addcart_form_btns_left">
      <a href="/dlya-zhenschin" class="btn_return">Продолжить покупки</a>
    </div>
    <div class="addcart_form_btns_right">
      <a href="/checkout/cart" class="btn_gocart">Перейти в корзину</a>
    </div>

  </div>

  <div class="clear"></div>
  <div class="close"></div>        
        ';

        echo $html;

        /*$json = array();
        $json['test'] = $this;
        $json['test1'] ='1111';
        print_r($json);*/
        /*$this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));*/
    }

    public function getProduct(){
        $this->load->model('catalog/product');
        $this->load->model('catalog/category');
        //print_r($this->request->post[]);
        $id=$this->request->post['product_id'];


        $product_info = $this->model_catalog_product->getProduct($id);
        $images = $this->model_catalog_product->getProductImages($id);
        $attrs = $this->model_catalog_product->getProductAttributes($id);
        $options = $this->model_catalog_product->getProductOptions($id);
        $rel = $this->model_catalog_product->getProductRelated($id);
        $cat = $this->model_catalog_product->getCategories($id);

        $category_info = $this->model_catalog_category->getCategory($cat[count($cat)-1]['category_id']);
        //print_r($category_info);

        /*print_r($product_info['sku']);
        print_r($images);
        print_r($attrs);*/
        $html='';
        //$html=$id;
        //$html.=print_R($options[0]['product_option_value'],true);
        //$html.='<a class="modal_add_cart">Добавить в корзину</a>';
        $html.='
<div class="view_form_title">
		<span>'.$product_info['name'].'</span>
		<a>'.$category_info['name'].'</a>
		
	</div>
	
	<div class="clear"></div>
<div class="view_form_info">
		<div class="view_form_info_price">';

        if($product_info['special'])
        {
            $html.=   number_format( $product_info['special'],0,'.',' ').' руб.';
        }
        else
        {
            $html.=    number_format( $product_info['price'],0,'.',' ').' руб.';
        }
		$html.='</div>
		<div class="view_form_info_option">';
		    foreach($options as $option)
            {
                $html.='			<div class="form_form_line">
				<select class="modal_options" name="option['.$option['product_option_id'].']" data-placeholder="Выберите размер">';
                $html.='<option value="0"></option>';
                foreach($option['product_option_value'] as $option_value)
                {
                    $html.='<option value="'.$option_value['product_option_value_id'].'">'.$option_value['name'].'</option>';
                }
                $html.='				</select>
			</div>';

            }
		$html.='</div>
		<div class="view_form_info_btn">
			<div class="form_form_line">
				<input type="submit" data-id="'.$id.'" class="modal_add_cart" value="Добавить в корзину" />
			</div>
		
		</div>
		<div class="view_form_info_fav">
			<a  onclick="wishlist.add('.$product_info['product_id'].');" class="btn_fav"></a>
		</div>		
		
		<div class="clear"></div>
	</div>';
        $html.='
         <div class="view_form_in">';
        //$html.=print_R($rel,true);
        $html.='
	
	<div class="clear"></div>
	<div class="view_form_images">';
        foreach($images as $img)
        {
            $html.='
		<div class="view_form_image">
			<div class="view_form_image_in">
				<img src="/image/'.$img['image'].'" />
			</div>
		</div>
            
            ';
        }
		$html.='<div class="clear"></div>
	</div>
	<div class="view_form_desc_short">
	    <div class="view_form_desc_short_title">
	    Товар продает и доставляет Bomoda

	    </div>
	    <p>
	        Мы предлагаем несколько способов доставки, среди которых всегда есть бесплатная. Товар находится на складе Bomoda и может быть доставлен вам в кратчайшие сроки. Узнать возможности доставки с примеркой в вашем городе.
	    </p>
	</div>
	<div class="view_form_options_title">
		ОПИСАНИЕ
	</div>
	<div class="view_form_desc">
		'.$product_info["description"].'
	</div>

	<div class="view_form_options">';
        foreach($attrs as $attr)
        {
            if($attr['attribute_group_id']==7)
            {
                foreach ($attr['attribute'] as $at) {
                    $html.=$at['name'].': '.$at['text'].'<br/>';
                }
            }
        }
        if($product_info['sku'])
        {
            $html.='Артикул: <strong style="text-transform: uppercase;">'.$product_info['sku'].'</strong>';
        }

	$html.='</div>';
    $html.='
	<div class="line"></div>
	<div class="view_form_title">
		<span>Рекомендуем</span>
	</div>
	<div class="view_form_slider">
		<div class="jcarousel-wrapper">
			<div class="jcarousel" data-col="4">
				<ul>';
                    foreach($rel as $r) {


                        $html.='<li>
						<div class="home_slider_block" >
							<div class="home_slider_block_img" >
								<a href = "'.$this->url->link('product/product', 'product_id=' . $r['product_id']).'" ><img src = "/image/'.$r['image'].'" /></a >
							</div >
							<div class="home_slider_block_title" >
								<a href = "'.$this->url->link('product/product', 'product_id=' . $r['product_id']).'" >'.$r['name'].'</a >
							</div >
							<div class="home_slider_block_cat" >
                        Брюки
							</div >
							<div class="home_slider_block_price" >
								<span > '.number_format( $product_info['price'],0,'.',' ').' руб .</span >
							</div >
						</div >
					</li >';
                    }


        $html.='</ul>
			</div>
			<a href="#" class="jcarousel-control-prev"></a>
			<a href="#" class="jcarousel-control-next"></a>
		</div>		
	</div>    
    ';

    $html.='<div class="view_form_bottom">
		<div class="view_form_bottom_left">
			<ul>
				<li>
					<a class="go_to active" href=".view_form_images">Фото</a>
				</li>
				<li>
					<a class="go_to" href=".view_form_desc">Описание</a>
				</li>
				<li>
					<a class="go_to" href=".view_form_slider">Рекомендуем</a>
				</li>
				
			</ul>
		</div>
		<div class="view_form_bottom_right">
			<div class="form_form_line">
			    <a class="btn_more_quick" href="'.$this->url->link('product/product', 'product_id=' . $product_info['product_id']).'">Подробнее</a>
				
			</div>
		
		</div>
		
	</div>
	</div>
	<div class="close"></div>        
        ';

        echo $html;

    }


}