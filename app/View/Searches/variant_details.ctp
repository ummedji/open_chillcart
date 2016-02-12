<?php if (!empty($productVariantDetails['ProductDetail']['compare_price'])) {?>
     <div class="detailPopCont_top">
                <div class="price_height">
                    <h5 class="addcart_popup_head"><?php echo __('Original Price'); ?> :</h5>
                    <h2><s> <?php
                            echo html_entity_decode($this->Number->currency($productVariantDetails['ProductDetail']['orginal_price'],
                                $siteCurrency)); ?></s></h2>
                    <h5 class="addcart_popup_head"><?php echo __('Compare Price'); ?> :</h5><h2><?php
                        echo html_entity_decode($this->Number->currency($productVariantDetails['ProductDetail']['compare_price'],
                            $siteCurrency)); ?></h2>
                </div>
        <?php } else {?>
                <div class="detailPopCont_top">
                        <div class="price_height">
                            <h5 class="addcart_popup_head"><?php echo __('Original Price'); ?> :</h5>
                            <h2>
                                <?php
                                echo html_entity_decode($this->Number->currency($productVariantDetails['ProductDetail']['orginal_price'],
                                 $siteCurrency)); ?>

                            </h2>
                        </div>
                        <?php } if ($productVariantDetails['ProductDetail']['quantity'] != 0) {?>
                        <div class="row">
                            <div class="col-md-8">
                                <input id="quantity" class="form-control text-center" type="text" value="">
                            </div>
                        </div>
                        <label class="error" id="addcart_failed" style="display:none;"><?php echo __('Quantity Exceeded..!'); ?></label><?php
                        if (!empty($productVariantDetails['Product']['product_description'])) {?>

                        <h5 class="addcart_popup_head"><?php echo  __('Product Description'); ?> :</h5>
                        <p><?php echo $productVariantDetails['Product']['product_description'];?></p>
                        <?php }?>
                </div>
                 <div class="col-sm-12 text-center">
                    <button type="submit" onclick="variantCart();" class="btn btn-primary margin-t-25"><?php echo __('Add To Cart'); ?></button>
                </div><?php
                } else {
                if (!empty($productVariantDetails['Product']['product_description'])) {?>
                <h5 class="addcart_popup_head"><?php echo  __('Product Description'); ?> :</h5>
                <p><?php echo $productVariantDetails['Product']['product_description'];?></p>
               <?php  }?>
    </div>
    <div class="col-sm-12 text-center">
        <button type="submit" class="btn btn-primary margin-t-25 opacity_5"><?php echo __('Out of Stock'); ?></button>
    </div><?php
}
?>