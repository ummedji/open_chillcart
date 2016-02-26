<div class="products-category mainCatProduct" id="Deal" >
    <header class="products-header">
        <h4 class="category-name">
            <span> <?php echo __('Deal Products', true); ?></span>
        </h4>                   
    </header>
    <h5> </h5>
<?php
$main = $subCat = $subCatCount = $count = 0;
foreach ($dealProducts as $key => $value) {
    $nextValue = $key+1;
    if ($value['MainProduct']['category_id'] != $main) {
        $main = $value['MainProduct']['category_id']; ?>
        <div class="products-category mainCatProduct" id="<?php echo $value['MainProduct']['MainCategory']['category_name']; ?>">
        <header class="products-header">
            <h4 class="category-name">
                <span> <?php echo $value['MainProduct']['MainCategory']['category_name']; ?></span>
            </h4>
        </header><?php
    }



if ($value['MainProduct']['SubCategory']['id'] != $subCat) {

    $subCat = $value['MainProduct']['SubCategory']['id']; ?>
    <h5 id="<?php echo $value['MainProduct']['SubCategory']['category_name']; ?>" class="sub_category-name">
        <span><?php echo $value['MainProduct']['SubCategory']['category_name']; ?></span>
     <?php 

    if (isset($value['moreProduct'])) { ?>
        <a title="active" class="buttonStatus" href="javascript:void(0);" onclick="dealsProduct(<?php echo $value['MainProduct']['category_id'].','.$value['MainProduct']['SubCategory']['id'].','.$value['Store']['id'];?>);">
        View More </a> <?php
    } ?> </h5>

    <ul class="products productsCat<?php echo $count; ?>"> <?php
        $subCatCount = $subCatCount+1;
}

    $imageSrc = $cdn.'/stores/products/home/'.$value['MainProduct']['ProductImage'][0]['image_alias'];
    $imageSrcSub = $cdn.'/stores/products/scrollimg/'.$value['SubProduct']['ProductImage'][0]['image_alias']; ?>

    <li class="product searchresulttoshow col-sm-2 searchresulttoshow<?php echo $count.$subCatCount; ?>">

        <div class="product__inner">
            <figure class="product__image relative" onclick="productDetails(<?php echo $value['MainProduct']['id']; ?>);">
                <!-- <span class="onsale"></span> -->

                <span class="ribn-red onsale"><span><?php echo $value['Deal']['deal_name']; ?></span></span>

                <img src="<?php echo $imageSrc; ?>" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/images/no-imge.jpg"; ?>'" alt="<?php echo $value['MainProduct']['product_name']; ?>" title="<?php echo $value['MainProduct']['product_name']; ?>" >
                <figcaption hidden>
                   <div class="product-addon">
                      <a href="javascript:void(0);" class="yith-wcqv-button"><span></span><i class="fa fa-plus"></i></a>
                   </div>
                </figcaption>
                <span class="free_section">
                    <h5>Free</h5>
                    <img width="50" class="image-lazy image-loaded" onerror="this.onerror=null;this.src='<?php echo $siteUrl."/images/no-imge.jpg"; ?>'" src="<?php echo $imageSrcSub; ?>" alt="<?php echo $value['SubProduct']['product_name']; ?>" title="<?php echo $value['SubProduct']['product_name']; ?>">
                </span>
            </figure>
            <div class="product__detail">
                <div class="top-section">
                    <h2 class="product__detail-title"><a href="javascript:void(0);"><?php echo $value['MainProduct']['product_name'].'+'.$value['SubProduct']['product_name']; ?></a></h2>
                    <div class="product__detail-category">
                        <a href="javascript:void(0);" rel="tag"><?php echo $value['MainProduct']['ProductDetail'][0]['sub_name']; ?></a>
                    </div>                         

                    <?php if (isset($value['MainProduct']['ProductDetail'][1]['sub_name'])) { ?>
                        <div class="show-on-hover">
                            <?php  foreach ($value['MainProduct']['ProductDetail'] as $keyVal => $val) {
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

                                </div>
                                <?php }
                            } ?>
                        </div> 
                    <?php } ?>
                    <div class="clear"></div>
                </div>
                <div class="bottom-section clearfix">
                    <span class="price product__detail-price">
                        <?php
                            if ($value['MainProduct']['ProductDetail'][0]['compare_price'] != 0) {
                                echo '<del><span class="amount">'. html_entity_decode($this->Number->currency($value['MainProduct']['ProductDetail'][0]['orginal_price'], $siteCurrency)).'</span></del>';
                                echo '<ins class="margin-l-5"><span class="amount">'.html_entity_decode($this->Number->currency($value['MainProduct']['ProductDetail'][0]['compare_price'], $siteCurrency)).'</span></ins>';
                            } else {
                                echo html_entity_decode($this->Number->currency($value['MainProduct']['ProductDetail'][0]['orginal_price'], $siteCurrency));
                            } ?>
                    </span>
                    <div class="product__detail-action">
                        <a href="javascript:void(0);" rel="nofollow" class="button add_to_cart_button"> <?php
                            if ($value['MainProduct']['price_option'] == 'single') {
                                if($value['MainProduct']['ProductDetail'][0]['quantity'] != 0) { ?>
                                    <div class="add_btn"><i onclick="addToCart(<?php echo $value['MainProduct']['ProductDetail'][0]['id']; ?>);" class="fa fa-plus plushide"></i></div> <?php
                                } else { ?>
                                    <span class=" outofstock"><b class=""><?php echo __('Out of Stock'); ?></b> <i class=""></i></span> <?php
                                }
                            } else { ?>
                                <div class="add_btn"><i onclick="productDetails(<?php echo $value['MainProduct']['id']; ?>);" class="fa fa-plus plushide"></i></div>
                                <?php
                            } ?>                                                
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </li>

    <?php
if (!isset($dealProducts[$nextValue]['MainProduct']['SubCategory']['id']) || $dealProducts[$nextValue]['MainProduct']['SubCategory']['id'] != $subCat) { ?>
    </ul>
    <!-- </div> -->
    <div class="clr"></div> <?php
}

    if (!isset($dealProducts[$nextValue]['MainProduct']['category_id']) || $dealProducts[$nextValue]['MainProduct']['category_id'] != $main) { ?>
        <!-- </ul> -->
        </div>
        <div class="clr"></div> <?php
    }

} ?>
</header>