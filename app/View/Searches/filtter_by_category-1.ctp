<?php //$main = $subCat = $subCatCount = 0;
//print_r($productList);
?>
<!--<div class="col-md-10 col-sm-8">-->

<div class="productdiv mrgB20 mr_top_20">
<?php 

//echo "<pre>";
//print_r($productList);

$ic = 1;
$main = $subCat = $subCatCount = 0;
foreach ($productList as $key => $value) {
	$nextValue = $key+1;
		
	
	//print_r($value['MainCategory']['id']); echo "=>"; echo $main; echo "<br>";
	if ($value['MainCategory']['id'] != $main) {
	$main = $value['MainCategory']['id'];		?> 
	<!--<div class="productdiv mrgB20">-->
		<div class="row title greenbut">
            <div class="pull-left">
              <h4 class="ribbontag"><span class="ribbon-arrow"></span><?php echo $value['MainCategory']['category_name']; ?>
              
              </h4>
            </div>
		<?php } ?>
			<?php if ($value['SubCategory']['id'] != $subCat) {
			$subCat = $value['SubCategory']['id']; ?>
			<h5 id="<?php echo $value['SubCategory']['category_name']; ?>" class="sub_category-name sub_title">
		 <span><i class="fa fa-arrow-right" aria-hidden="true"></i> <?php echo $value['SubCategory']['category_name']; ?></span> 		 <?php
		if (isset($value['moreProduct'])) { ?>
			<div class="pull-right">
              <button class="btn buttonStatus" type="button" onclick="categoriesProduct(<?php echo $value['MainCategory']['id'].','.$value['SubCategory']['id'].','.$value['Store']['id'];?>);">View More</button>
            </div>
		<?php } ?>
			</h5>
			<div class="clearfix"></div>
        </div>
		<?php /* <div style="margin-top:10px"><?php echo $value['SubCategory']['category_name']; ?></div> */ ?>
		<div class="row products padTB20 productsCat<?php echo $count; ?>">
		<?php
		$subCatCount = $subCatCount+1;
		}
		$imageName = (isset($value['ProductImage'][0]['image_alias'])) ? $value['ProductImage'][0]['image_alias'] : '';
		$imageSrc = $cdn.'/stores/products/home/'.$imageName;
		$imageSrc = 'https://dnrskjoxjtgst.cloudfront.net/stores/products/home/'.$imageName;

		?>
		<div class="col-md-2 col-sm-4 productblock">
              <div class="product hr_products">
                <div class="image"> <a href="detail.html"> <img class="img-responsive image1" alt="" src="<?php echo $imageSrc; ?>"> </a> <span class="prod-id">2</span> </div>

                <div class="text">
                  <h3><a href="#"><?php echo $value['Product']['product_name']; ?> </a></h3>
                  <p class="prodesc"><?php echo $value['ProductDetail'][0]['sub_name']; ?></p>
                  <p class="price"><span class="black-rs-icon"></span>
				  <?php if ($value['Product']['price_option'] != 'single') {  
                            ?>
						
                        <?php }else{ 
                        $product_name = $value['ProductDetail'][0]['sub_name'];
						$quantity = explode(" ",$product_name);
						$get_key =array_search ('Grams', $quantity);
						
						$quantity_value = $quantity[$get_key-1];
						
						if ($value['ProductDetail'][0]['compare_price'] != 0) {
							echo '<del><span class="amount">'.html_entity_decode($this->Number->currency($value['ProductDetail'][0]['orginal_price'], $siteCurrency)).'</span></del>'." ".html_entity_decode($this->Number->currency($value['ProductDetail'][0]['compare_price'], $siteCurrency))." / ". $quantity_value."g";
						}
						else
						{
							echo html_entity_decode($this->Number->currency($value['ProductDetail'][0]['orginal_price'], $siteCurrency))." / ".$quantity_value."g";
						}
                            
                                            
                                        } ?>
				  <?php
                       /* if ($value['ProductDetail'][0]['compare_price'] != 0) {
                            echo '<del><span class="amount">'. html_entity_decode($this->Number->currency($value['ProductDetail'][0]['orginal_price'], $siteCurrency)).'</span></del>';
                            echo '<ins class="margin-l-5"><span class="amount">'.html_entity_decode($this->Number->currency($value['ProductDetail'][0]['compare_price'], $siteCurrency)).'</span></ins>';
                        } else {
                            echo html_entity_decode($this->Number->currency($value['ProductDetail'][0]['orginal_price'], $siteCurrency));
                }*/ ?>					
				</p>
				<div class="clearfix"></div>
                </div>
                <div class="product__detail-action">
                                 <ul class="detail-action_li">
                                    <li>
                                        <a href="#" class="price_part pull-left"><i class="fa fa-inr" aria-hidden="true"></i> 50.00<span>/1kg</span</a>
                                        <a href="#" class="pull-right plus_ii"><i class="fa fa-plus plushide" onclick="addToCart(<?php echo $value['ProductDetail'][0]['id']; ?>);"></i></a>
                                    <div class="clearfix"></div>
                                    </li>
                                    <li>
                                        <a href="#" class="price_part pull-left"><i class="fa fa-inr" aria-hidden="true"></i> 50.00<span>/1kg</span</a>
                                        <a href="#" class="pull-right plus_ii"><i class="fa fa-plus plushide" onclick="addToCart(<?php echo $value['ProductDetail'][0]['id']; ?>);"></i></a>
                                    <div class="clearfix"></div>
                                    </li>
                                 </ul>
                              </div>
                
              </div>

             
		
	<?php if (!isset($productList[$nextValue]['SubCategory']['id']) || $productList[$nextValue]['SubCategory']['id'] != $subCat) { ?>
		</div>	
    <?php
	} ?>
	 <?php
if (!isset($productList[$nextValue]['MainCategory']['id']) || $productList[$nextValue]['MainCategory']['id'] != $main) { ?>
    <!--</div>-->
    <?php
	}
	$ic++;
 } ?>
</div>
<?php 
/*
$main = $subCat = $subCatCount = 0;
foreach ($productList as $key => $value) {

    $nextValue = $key+1;
    if ($value['MainCategory']['id'] != $main) {
        $main = $value['MainCategory']['id']; ?>
        <div class="products-category mainCatProduct" id="<?php echo $value['MainCategory']['category_name']; ?>">
        <header class="products-header">
            <h4 class="category-name">
                <span><?php echo $value['MainCategory']['category_name']; ?></span>
            </h4>
        </header><?php
    }



if ($value['SubCategory']['id'] != $subCat) {
    $subCat = $value['SubCategory']['id']; ?>
    <h5 id="<?php echo $value['SubCategory']['category_name']; ?>" class="sub_category-name">
        <span><?php echo $value['SubCategory']['category_name']; ?></span>
     <?php 

    if (isset($value['moreProduct'])) { ?>
        <a title="active" class="buttonStatus" href="javascript:void(0);" onclick="categoriesProduct(<?php echo $value['MainCategory']['id'].','.$value['SubCategory']['id'].','.$value['Store']['id'];?>);">
        View More </a> <?php
    } ?> </h5>

    <ul class="products productsCat<?php echo $count; ?>"> <?php
        $subCatCount = $subCatCount+1;
}

    $imageName = (isset($value['ProductImage'][0]['image_alias'])) ? $value['ProductImage'][0]['image_alias'] : '';
    $imageSrc = $cdn.'/stores/products/home/'.$imageName; ?>

    <li class="product searchresulttoshow searchresulttoshow<?php echo $count.$subCatCount; ?>">
        <div class="product__inner">
            <figure class="product__image" onclick="productDetails(<?php echo $value['Product']['id']; ?>);">
                <!-- <span class="onsale">Sale!</span> -->
                <img src="<?php echo $imageSrc; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/images/no-imge.jpg"; ?>'" alt="<?php echo $value['Product']['product_name']; ?>" title="<?php echo $value['Product']['product_name']; ?>">
                <figcaption hidden>
                    <div class="product-addon">
                        <a href="javascript:void(0);" class="yith-wcqv-button"><span></span><i class="fa fa-plus"></i></a>
                    </div>
                </figcaption>
            </figure>
            <div class="product__detail">
                <div class="top-section">
                    <h2 class="product__detail-title"><a href="javascript:void(0);"><?php echo $value['Product']['product_name']; ?></a></h2>
                    <div class="product__detail-category">
                        <a href="javascript:void(0);" rel="tag"><?php echo $value['ProductDetail'][0]['sub_name']; ?></a>
                    </div> <?php 
                    if (isset($value['ProductDetail'][1]['sub_name'])) { ?>
                        <div class="show-on-hover">
                            <?php foreach ($value['ProductDetail'] as $keyVal => $val) {
                                if ($keyVal != 0) { ?>
                                    <div class="yith-wcwl-add-to-wishlist">
                                        <div  style="display:block">
                                            <a href="javascript:void(0);" rel="nofollow" class="add_to_wishlist">
                                                <?php
                                                echo '<p class="contain"> '.$val['sub_name']. ' : ';

                                                if ($val['compare_price'] != 0) {
                                                    echo '<s>'. html_entity_decode($this->Number->currency($val['orginal_price'], $siteCurrency)).'</s> ';
                                                    echo '<span class="margin-l-5">'.html_entity_decode($this->Number->currency($val['compare_price'], $siteCurrency)).'</span>';
                                                } else {
                                                    echo html_entity_decode($this->Number->currency($val['orginal_price'], $siteCurrency));
                                                }

                                                echo '</p>';
                                                ?>
                                            </a>
                                        </div>
                                    </div> <?php
                                }
                            } ?>
                        </div> <?php 
                    } ?>
                    <div class="clear"></div>
                </div>
                <div class="bottom-section">
	                <span class="price product__detail-price">
	                	<?php
                        if ($value['ProductDetail'][0]['compare_price'] != 0) {
                            echo '<del><span class="amount">'. html_entity_decode($this->Number->currency($value['ProductDetail'][0]['orginal_price'], $siteCurrency)).'</span></del>';
                            echo '<ins class="margin-l-5"><span class="amount">'.html_entity_decode($this->Number->currency($value['ProductDetail'][0]['compare_price'], $siteCurrency)).'</span></ins>';
                        } else {
                            echo html_entity_decode($this->Number->currency($value['ProductDetail'][0]['orginal_price'], $siteCurrency));
                        } ?>

           			</span>
                    <div class="product__detail-action">
                        <a href="javascript:void(0);" rel="nofollow" class="button add_to_cart_button " >
                            <?php if ($value['Product']['price_option'] == 'single') { //echo "<pre>";print_r($value);die();
                                if($value['ProductDetail'][0]['quantity'] != 0){?>
                                    <div class="add_btn">
									<i onclick="addToCart(<?php echo $value['ProductDetail'][0]['id']; ?>);" class="fa fa-plus plushide"></i></div>
                                <?php } else {?>
                                    <span class=" outofstock">
									   <b class=""><?php echo __('Out of Stock'); ?></b> <i class=""></i></span>
                                <?php }

                            } else { ?>
                                <div class="add_btn"><i onclick="productDetails(<?php echo $value['Product']['id']; ?>);" class="fa fa-plus plushide"></i></div>
                                <?php

                            } ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </li>

    <?php
if (!isset($productList[$nextValue]['SubCategory']['id']) || $productList[$nextValue]['SubCategory']['id'] != $subCat) { ?>
    </ul>
    <!-- </div> -->
    <div class="clr"></div> <?php
}

    if (!isset($productList[$nextValue]['MainCategory']['id']) || $productList[$nextValue]['MainCategory']['id'] != $main) { ?>
        <!-- </ul> -->
        </div>
        <div class="clr"></div> <?php
    }

} /*?>