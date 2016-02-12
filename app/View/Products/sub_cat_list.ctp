<option value=""> Select Subcategory</option> <?php
if(isset($category_list) && !empty($category_list)) {
	foreach($category_list as $key=>$value) { ?>
        <option value="<?php echo $key; ?>"><?php echo $value; ?></option> <?php
    }
}