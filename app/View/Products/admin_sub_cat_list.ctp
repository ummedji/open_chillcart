<option value=""> Select Subcategory</option> <?php
if(isset($category_list) && !empty($category_list)) {
	foreach($category_list as $key=>$value) { ?>
        <option value="<?php echo $key; ?>"><?php echo $value; ?></option> <?php
    }
} else {?>
    <option value="<?php echo "0"; ?>"><?php echo "No Subcategory Found"; ?></option> <?php
}?>