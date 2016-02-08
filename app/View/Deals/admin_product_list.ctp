<option value=""> Select Product</option> <?php

if(isset($products) && !empty($products)) {
	foreach($products as $key=>$value) { ?>
        <option value="<?php echo $key; ?>"><?php echo $value; ?></option> <?php
    }
}