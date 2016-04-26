jQuery().ready(function () {

    setTimeout(function(){
        $("#flashMessage").hide();
    }, 3000);

    var ProductStoreIndexForm = jQuery("#ProductStoreIndexForm").validate({
        rules: {
            "data[excel]": {
                required: true,
                type: 'xls'
            }
        },
        messages: {

            "data[excel]": {
                required: "Please select xls file",
            }

        }
    });

    var CategoryAddvalidator = jQuery("#CategoryStoreAddForm").validate({
        rules: {
            "data[Category][category_name]": {
                required: true,
            }
        },
        messages: {
            "data[Category][category_name]": {
                required: "Please Enter the CategoryName",
            }

        }
    });

    var CategoryEditvalidator = jQuery("#CategoryStoreEditForm").validate({
        rules: {
            "data[Category][category_name]": {
                required: true,
            }
        },
        messages: {
            "data[Category][category_name]": {
                required: "Please Enter the CategoryName",
            }

        }
    });

    var BrandAddvalidator = jQuery("#BrandStoreAddForm").validate({
        rules: {
            "data[Brand][brand_name]": {
                required: true,
            }
        },
        messages: {
            "data[Brand][brand_name]": {
                required: "Please Enter the BrandName",
            }

        }
    });


    var BrandEditvalidator = jQuery("#BrandStoreEditForm").validate({
        rules: {
            "data[Brand][brand_name]": {
                required: true,
            }
        },
        messages: {
            "data[Brand][brand_name]": {
                required: "Please Enter the BrandName",
            }

        }
    });

    var SubCatAddvalidator = jQuery("#CategoryStoreSubCatAddForm").validate({
        rules: {
            "data[Category][parent_id]": {
                required: true,
            },
            "data[Category][category_name]": {
                required: true,
            }
        },
        messages: {
            "data[Category][parent_id]": {
                required: "Please Enter the Maincategory",
            },
            "data[Category][category_name]": {
                required: "Please Enter the Subcategory",
            }

        }
    });

    var SubCatEditvalidator = jQuery("#CategoryStoreSubCatEditForm").validate({
        rules: {
            "data[Category][parent_id]": {
                required: true,
            },
            "data[Category][category_name]": {
                required: true,
            }
        },
        messages: {
            "data[Category][parent_id]": {
                required: "Please Enter the Maincategory",
            },
            "data[Category][category_name]": {
                required: "Please Enter the Subcategory",
            }

        }
    });


    var ProductAddvalidator = jQuery("#ProductStoreAddForm").validate({
        rules: {
            "data[Product][store_id]": {
                required: true,
            },
            "data[Product][product_name]": {
                required: true,
            },
            "data[Product][category_id]": {
                required: true,

            },
            "data[Product][sub_category_id]": {
                required: true,

            },

            "data[product_image][]": {
                required: true,
            },

        },
        messages: {
            "data[Product][store_id]": {
                required: "Please Select the store",
            },
            "data[Product][product_name]": {
                required: "Please Enter the Product Name",
            },
            "data[Product][category_id]": {
                required: "Please Select the category",
            },
            "data[Product][sub_category_id]": {
                required: "Please Select the subcategory",
            },

            "data[product_image][]": {
                required: "Please Selete image",
            },
        }
    });

    var ProductEditvalidator = jQuery("#ProductStoreEditForm").validate({
        rules: {
            "data[Product][store_id]": {
                required: true,
            },
            "data[Product][product_name]": {
                required: true,
            },
            "data[Product][category_id]": {
                required: true,

            },
            "data[Product][sub_category_id]": {
                required: true,

            },


            "data[product_image][]": {
                required: true,
            },

        },
        messages: {
            "data[Product][store_id]": {
                required: "Please Select the store",
            },
            "data[Product][product_name]": {
                required: "Please Enter the Product Name",
            },
            "data[Product][category_id]": {
                required: "Please Select the category",
            },
            "data[Product][sub_category_id]": {
                required: "Please Select the subcategory",
            },

            "data[product_image][]": {
                required: "Please Selete image",
            },
        }
    });

    var StoreOfferAddvalidator = jQuery("#StoreofferStoreAddForm").validate({
        rules: {
            "data[Storeoffer][store_id]": {
                required: true,
            },
            "data[Storeoffer][offer_percentage]": {
                required: true,
                number: true,
                min: 1,
                max: 99,

            },
            "data[Storeoffer][offer_price]": {
                required: true,
                number: true,
                min: 1,
            },
            "data[Storeoffer][from_date]": {
                required: true,

            },
            "data[Storeoffer][to_date]": {
                required: true,
            }

        },
        messages: {
            "data[Storeoffer][store_id]": {
                required: "Please Selete store Name",
            },
            "data[Storeoffer][offer_percentage]": {
                required: "Please Enter Offer percentage",

            },
            "data[Storeoffer][offer_price]": {
                required: "Please Enter Offer price",

            },
            "data[Storeoffer][from_date]": {
                required: "Please Enter from_date",
            },
            "data[Storeoffer][to_date]": {
                required: "Please Enter to_date",
            }
        }

    });


    var StoreOfferEditvalidator = jQuery("#form-storeofferEdit").validate({
        rules: {
            "data[Storeoffer][store_id]": {
                required: true,
            },
            "data[Storeoffer][offer_percentage]": {
                required: true,
                number: true,
                min: 1,
                max: 99,

            },
            "data[Storeoffer][offer_price]": {
                required: true,
                number: true,
                min: 1,

            },
            "data[Storeoffer][from_date]": {
                required: true,

            },
            "data[Storeoffer][to_date]": {
                required: true,
            }

        },
        messages: {
            "data[Storeoffer][store_id]": {
                required: "Please Selete store Name",
            },
            "data[Storeoffer][offer_percentage]": {
                required: "Please Enter Offer percentage",

            },
            "data[Storeoffer][offer_price]": {
                required: "Please Enter Offer price",

            },
            "data[Storeoffer][from_date]": {
                required: "Please Enter from_date",
            },
            "data[Storeoffer][to_date]": {
                required: "Please Enter to_date",
            }
        }

    });

    var dealAddValidator = jQuery("#DealStoreAddForm").validate({
        rules: {
            "data[Deal][store_id]": {
                required: true,
            },
            "data[Deal][deal_name]": {
                required: true,

            },
            "data[Deal][main_product]": {
                required: true,

            },
            "data[Deal][sub_product]": {
                required: true,

            }

        },
        messages: {
            "data[Deal][store_id]": {
                required: "Please selete store",
            },
            "data[Deal][deal_name]": {
                required: "Please enter deal name",

            },
            "data[Deal][main_product]": {
                required: "Please select product",

            },
            "data[Deal][sub_product]": {
                required: "Please select product",
            }
        }

    });

    var dealAddValidator = jQuery("#DealStoreEditForm").validate({
        rules: {
            "data[Deal][store_id]": {
                required: true,
            },
            "data[Deal][deal_name]": {
                required: true,

            },
            "data[Deal][main_product]": {
                required: true,

            },
            "data[Deal][sub_product]": {
                required: true,

            }

        },
        messages: {
            "data[Deal][store_id]": {
                required: "Please selete store",
            },
            "data[Deal][deal_name]": {
                required: "Please enter deal name",

            },
            "data[Deal][main_product]": {
                required: "Please select product",

            },
            "data[Deal][sub_product]": {
                required: "Please select product",
            }
        }

    });


    var changepasswordValidator = jQuery("#userStoreChangePasswordForm").validate({
        rules: {
            "data[user][new_pass]": {
                required: true,
            },
            "data[user][confirm_pass]": {
                required: true,
                equalTo: '#userNewPass',

            }

        },
        messages: {
            "data[user][new_pass]": {
                required: "Please Enter password",
            },
            "data[user][confirm_pass]": {
                required: "Please Enter confirmpassword",

            }
        }

    });

});
function validateStoreEdit() {
    var StoreContactName = $.trim($("#StoreContactName").val());
    var StoreContactPhone = $.trim($("#StoreContactPhone").val());
    var StoreContactEmail = $.trim($("#StoreContactEmail").val());
    var StoreStreetAddress = $.trim($("#StoreStreetAddress").val());
    var StoreStoreState = $.trim($("#StoreStoreState").val());
    var StoreStoreCity = $.trim($("#StoreStoreCity").val());
    var StoreStoreZip = $.trim($("#StoreStoreZip").val());

    var StoreStoreName = $.trim($("#StoreStoreName").val());
    var StoreStorePhone = $.trim($("#StoreStorePhone").val());
    var UserUsername = $.trim($("#UserUsername").val());
    var UserPassword = $.trim($("#UserPassword").val());

    var StoreDeliveryOptionYes = $.trim($("#StoreDeliveryOptionYes").val());
    var StoreStoreCity = $.trim($("#StoreStoreCity").val());
    var StoreMinimumOrder = $.trim($("#StoreMinimumOrder").val());
    var StoreTax = $.trim($("#StoreTax").val());
    var DeliveryLocationLocationId = $.trim($("#DeliveryLocationLocationId").val());

    var StoreOrderEmail = $.trim($("#StoreOrderEmail").val());
    var StoreSmsPhone = $.trim($("#StoreSmsPhone").val());

    var StoreCommission = $.trim($("#StoreCommission").val());

    var emailRegex = new RegExp(/^([\w\.\-]+)@([\w\-]+)((\.(\w){2,3})+)$/i);


    $("#contactError").html("");
    $("#shopError").html("");
    $("#deliveryError").html("");
    $("#orderError").html("");
    $("#comissionError").html("");

    if (StoreContactName == '') {
        $("[href=#contact]").trigger('click');
        $("#contactError").html("Please enter contact name");
        $("#StoreContactName").focus();
        return false;
    } else if (StoreContactPhone == '') {
        $("[href=#contact]").trigger('click');
        $("#contactError").html("Please enter contact phone");
        $("#StoreContactPhone").focus();
        return false;
    } else if ((isNaN(StoreContactPhone))) {
        $("[href=#contact]").trigger('click');
        $("#contactError").html("Please enter the valid phone number");
        $("#StoreContactPhone").focus();
        return false;
    } else if (StoreContactEmail == '') {
        $("[href=#contact]").trigger('click');
        $("#contactError").html("Please enter contact email");
        $("#StoreContactEmail").focus();
        return false;
    } else if (!emailRegex.test(StoreContactEmail)) {
        $("[href=#contact]").trigger('click');
        $("#contactError").html("Please enter valid email");
        $("#StoreContactEmail").focus();
        return false;
    } else if (StoreStreetAddress == '') {
        $("[href=#contact]").trigger('click');
        $("#contactError").html("Please enter street address");
        $("#StoreStreetAddress").focus();
        return false;
    } else if (StoreStoreState == '') {
        $("[href=#contact]").trigger('click');
        $("#contactError").html("Please select the state");
        $("#StoreStoreState").focus();
        return false;
    } else if (StoreStoreCity == '') {
        $("[href=#contact]").trigger('click');
        $("#contactError").html("Please select the city");
        $("#StoreStoreCity").focus();
        return false;
    } else if (StoreStoreZip == '') {
        $("[href=#contact]").trigger('click');
        $("#contactError").html("Please select the zipcode/area name");
        $("#StoreStoreZip").focus();
        return false;
    } else if (StoreStoreName == '') {
        $("[href=#shop]").trigger('click');
        $("#shopError").html("Please enter store name");
        $("#StoreStoreName").focus();
        return false;
    } else if (StoreStorePhone == '') {
        $("[href=#shop]").trigger('click');
        $("#shopError").html("Please enter store phone");
        $("#StoreStorePhone").focus();
        return false;
    } else if ((isNaN(StoreStorePhone))) {
        $("[href=#shop]").trigger('click');
        $("#shopError").html("Please enter the valid phone number");
        $("#StoreStorePhone").focus();
        return false;
    } else if (UserUsername == '') {
        $("[href=#shop]").trigger('click');
        $("#shopError").html("Please enter username");
        $("#UserUsername").focus();
        return false;
    } else if (!emailRegex.test(UserUsername)) {
        $("[href=#shop]").trigger('click');
        $("#shopError").html("Please enter valid email");
        $("#UserUsername").focus();
        return false;
    } else if ($("#StoreDeliveryOptionYes").is(":checked")) {

        if (DeliveryLocationLocationId == '') {
            $("[href=#delivery]").trigger('click');
            $("#deliveryError").html("Please select atlease 1 location");
            $("#DeliveryLocationLocationId").focus();
            return false;
        } else if (StoreMinimumOrder == '') {
            $("[href=#delivery]").trigger('click');
            $("#deliveryError").html("Please enter minimum order");
            $("#StoreMinimumOrder").focus();
            return false;
        } else if (StoreTax == '') {
            $("[href=#delivery]").trigger('click');
            $("#deliveryError").html("Please enter tax");
            $("#StoreTax").focus();
            return false;
        }

    }

    if ($("#StoreEmailOrderYes").is(":checked")) {
        if (StoreOrderEmail == '') {
            $("[href=#order]").trigger('click');
            $("#orderError").html("Please enter order email");
            $("#StoreOrderEmail").focus();
            return false;
        } else if (!emailRegex.test(StoreOrderEmail)) {
            $("[href=#order]").trigger('click');
            $("#orderError").html("Please enter valid email");
            $("#StoreOrderEmail").focus();
            return false;
        }
    }

    if ($("#StoreSmsOptionYes").is(":checked")) {
        if (StoreSmsPhone == '') {
            $("[href=#order]").trigger('click');
            $("#orderError").html("Please enter phone number");
            $("#StoreSmsPhone").focus();
            return false;
        } else if ((isNaN(StoreSmsPhone))) {

            $("[href=#order]").trigger('click');
            $("#orderError").html("Please enter the valid phone number");
            $("#StoreSmsPhone").focus();
            return false;
        }
    }

    if (StoreCommission == '') {

        $("[href=#comission]").trigger('click');
        $("#comissionError").html("Please enter comission");
        $("#StoreCommission").focus();
        return false;
    }

}

$(document).ready(function () {
    slotCheck();
    batchCodeCheck();
    productOptions();
    $(".checktable .itemHead input[type='checkbox']").change(function () {
        if ($(this).prop("checked") == true) {
            $(".checktable .itemCont input[type='checkbox']").prop("checked", true);
            $(".checktable .itemCont input[type='checkbox']").parent().addClass("checked");
        } else {
            $(".checktable .itemCont input[type='checkbox']").prop("checked", false);
            $(".checktable .itemCont input[type='checkbox']").parent().removeClass("checked");
        }
    });

    $(".checktable .itemCont input[type='checkbox']").change(function () {
        slotCheck();
    });

    //Enable and Diable For single and Multiple Option
    $("input[name='data[Product][price_option]']").click(function () {
        productOptions();
    });
});

function batchCodeCheck() {
    var storeId = $('#storeId').val();
    var productId = ($('#ProductId').val()) ? $('#ProductId').val() : 0;
    $.post(rp + '/Products/batchCodeCheck', {'storeId': storeId, 'productId': productId}, function (response) {
        $('#batchCodes').val(response);
    });
}

function slotCheck() {
    var length = $(".checktable .itemCont input[type='checkbox']").length;
    var checklength = $(".checktable .itemCont input[type='checkbox']:checked").length;
    if (length == checklength) {
        $(".checktable .itemHead input[type='checkbox']").prop("checked", true);
        $(".checktable .itemHead input[type='checkbox']").parent().addClass("checked");
    }
    else {
        $(".checktable .itemHead input[type='checkbox']").prop("checked", false);
        $(".checktable .itemHead input[type='checkbox']").parent().removeClass("checked");
    }
}
//Find SubCategory List Detail
function subcatList() {
    var id = $('#ProductCategoryId').val();
    $.post(rp + '/Products/subCatList', {'id': id}, function (response) {
        $("#ProductSubCategoryId").html(response);

    });
}

//Hide Show Process Based On Radio Selection
function productOptions() {
    if ($("#ProductPriceOptionMultiple").is(":checked")) {
        $("#multiple").show();
        $("#single").hide();
    } else {
        $("#multiple").hide();
        $("#single").show();
    }
}
//original price and compare price checking
function valueCheck() {
    var original_price = $('#ProductDetailOrginalPrice').val();
    var compare_price = $('#ProductDetailComparePrice').val();
    if (parseInt(compare_price) > parseInt(original_price)) {
        alert("The Compare Price Should Be Lesserthen or Equal To  The Original Price");
    }
}
//Status Changes Process 
function statusChange(ids, models) {
    var id = ids;
    var model = models;

    $.post(rp + '/Commons/statusChanges', {'id': id, 'model': model}, function (response) {

    });
}
//Delete process
function deleteprocess(ids, models) {
    var check = confirm("Are Sure You Want Delete");
    if ($.trim(check) == 'true') {
        var id = ids;
        var model = models;
        $.post(rp + '/Commons/deleteProcess', {'id': id, 'model': model}, function (response) {
        });
        $("#record" + id).remove();
    }
}


var i = (typeof j != 'undefined') ? j : 1;
var html = '';

function multipleOption() {

    html = '<div id = "moreProuct' + i + '" class="row addPriceTop margin-b-15">' +
        '<div class="col-lg-7">' +
        '<div class="row">' +
        '<div class="col-md-6">' +
        '<div class="input text">' +
        '<input type="text" id="ProductDetailSubName" data-attr="product name" maxlength="100" placeholder="Product Name" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][sub_name]">' +
        '</div>' +
        '</div>' +
        '<div class="col-md-3">' +
        '<div class="input number">' +
        '<input type="text" id="ProductDetailOrginalPrice" data-attr="original price" step="any" placeholder="Price" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][orginal_price]">' +
        '</div>' +
        '</div>' +
        '<div class="col-md-3">' +
        '<div class="input number">' +
        '<input type="text" id="ProductDetailComparePrice" data-attr="compare price" step="any" placeholder="Sale" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][compare_price]">' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="col-lg-5">' +
        '<div class="row">' +

        '<div class="col-md-5">' +
        '<div class="input number">' +
        '<input type="text" id="ProductDetailQuantity" data-attr="quantity" placeholder="Quantity" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][quantity]">' +
        '</div>' +
        '</div>' +
        '<div class="col-md-5">' +
        '<div class="input text">' +
        '<input type="text" id="ProductDetailProductCode" data-attr="batch code" maxlength="100" placeholder="BatchCode" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][product_code]">' +
        '</div>' +
        '</div>' +
        '<span class="ItemRemove" onclick="removeOption(' + i + ');"><i class="fa fa-times"></i></span>' +
        '</div>' +
        '</div>' +
        '</div>';

    i++;
    $('#moreOption').append(html);
    html = '';
    return false;
}

function removeOption(id) {
    $('#moreProuct' + id).remove();
}

function optionValidate(argument) {

    //var batchCodess 	= '"'+[$('#batchCodes').val().slice(0,-1)]+'"';
    var batchCodess = $('#batchCodes').val();
    var batchArr = batchCodess.split(',');
    var optionMultiple = $("#ProductPriceOptionMultiple").is(":checked");

    var name = $('#ProductProductName').val();
    var cat = $('#ProductCategoryId').val();
    var subcat = $('#ProductSubCategoryId').val();

    if (name != '' && cat != '' && subcat != '') {

        var error = 0;
        $('.AddError').remove();

        if (optionMultiple) {

            $(".multipleValidate[type = 'text']").each(function () {

                var attrs = $(this).attr('data-attr');

                if ($(this).val() == "" && attrs != "compare price") {
                    $(this).after('<span class="AddError"> Please enter ' + attrs + '</span>');
                    error = 1;
                } else if (attrs == 'batch code') {
                    if (jQuery.inArray($(this).val(), batchArr) !== -1) {
                        $(this).after('<span class="AddError"> Batch code already exists</span>');
                        error = 1;
                    } else {
                        batchArr.push($(this).val());
                    }
                }

                if (attrs == "original price" || attrs == "quantity") {
                    if ($(this).val() < 0 || isNaN($(this).val())) {
                        $(this).after('<span class="AddError"> Please enter valid ' + attrs + '</span>');
                        error = 1;

                    } else if ($(this).val() < 0 || isNaN($(this).val())) {
                        $(this).after('<span class="AddError"> Please enter valid ' + attrs + '</span>');
                        error = 1;
                    }
                }

                if (attrs == "compare price") {
                    if ($(this).val() != '' && isNaN($(this).val())) {
                        $(this).after('<span class="AddError"> Please enter valid ' + attrs + '</span>');
                        error = 1;

                    } else if ($(this).val() < 0 || isNaN($(this).val())) {
                        $(this).after('<span class="AddError"> Please enter valid ' + attrs + '</span>');
                        error = 1;
                    }
                }
            });

        } else {

            $(".singleValidate[type = 'text']").each(function () {

                var attrs = $(this).attr('data-attr');

                if ($(this).val() == "" && attrs != "compare price") {
                    $(this).after('<span class="AddError"> Please enter ' + attrs + '</span>');
                    error = 1;
                } else if (attrs == 'batch code') {
                    if (jQuery.inArray($(this).val(), batchArr) !== -1) {
                        $(this).after('<span class="AddError"> Batch code already exists</span>');
                        error = 1;
                    }
                }

                if (attrs == "original price" || attrs == "quantity") {
                    if ($(this).val() < 0 || isNaN($(this).val())) {
                        $(this).after('<span class="AddError"> Please enter valid ' + attrs + '</span>');
                        error = 1;
                    } else if ($(this).val() < 0 || isNaN($(this).val())) {
                        $(this).after('<span class="AddError"> Please enter valid ' + attrs + '</span>');
                        error = 1;
                    }
                }
                if (attrs == "compare price") {
                    if ($(this).val() != '' && isNaN($(this).val())) {
                        $(this).after('<span class="AddError"> Please enter valid ' + attrs + '</span>');
                        error = 1;
                    } else if ($(this).val() < 0 || isNaN($(this).val())) {
                        $(this).after('<span class="AddError"> Please enter valid ' + attrs + '</span>');
                        error = 1;
                    }
                }
            });
        }

        if (error == 1) {
            return false;
        }
    }
}

var k = 0;
function multipleimage() {
    k++;
    $("#multipleImage").append('<div id="Image' + k + '" class="margin-t-10"><input  class="inline-block" type="file" id="ProductProductImage' + k + '"  name="data[ProductImage][]" >' +
        '<a  class="inline-block" href="javascript:void(0);" onclick="return deleteImage(' + k + ');">Delete</a></div>');
}

function deleteImage(id) {
    $('#Image' + id).remove();
}

function deleteProductImage(deleteId) {

    $.post(rp + '/products/deleteProductImage/', {'id': deleteId}, function (response) {
        if (response == 'success') {
            $('#image' + deleteId).remove();
        }
    });
}
//City Fillter Process
function cityFillters() {
    var id = $('#CustomerAddressBookStateId').val();
    $.post(rp + '/customer/customers/cityfillter', {'id': id}, function (response) {
        $("#CustomerAddressBookCityId").html(response);

    })
}
//Location Fillter Process
function locationFillters() {
    var id = $('#CustomerAddressBookCityId').val();
    $.post(rp + '/customer/customers/locationfillter', {'id': id}, function (response) {
        $("#CustomerAddressBookLocationId").html(response);

    })
}
$(document).ready(function () {
    $(".checktable th input[type='checkbox']").change(function () {
        if ($(this).prop("checked") == true) {
            $(".checktable td input[type='checkbox']").prop("checked", true);
            $(".checktable td input[type='checkbox']").parent().addClass("checked");

        }
        else {
            $(".checktable td input[type='checkbox']").prop("checked", false);
            $(".checktable td input[type='checkbox']").parent().removeClass("checked");
        }
    });
    $(".checktable td input[type='checkbox']").change(function () {
        var length = $(".checktable tbody tr td input[type='checkbox']").length;
        var checklength = $(".checktable tbody tr td input[type='checkbox']:checked").length;
        if (length == checklength) {
            $(".checktable th input[type='checkbox']").prop("checked", true);
            $(".checktable th input[type='checkbox']").parent().addClass("checked");
        }
        else {
            $(".checktable th input[type='checkbox']").prop("checked", false);
            $(".checktable th input[type='checkbox']").parent().removeClass("checked");
        }
    });

    $('#StoreofferFromDate').datepicker({
        minDate: 0,
        maxDate: "+60D",
        numberOfMonths: 1,
        onSelect: function(selected) {
          $("#StoreofferToDate").datepicker("option","minDate", selected)
        }
    });

    $('#StoreofferToDate').datepicker({
        minDate: 0,
        maxDate:"+60D",
        numberOfMonths: 1,
        onSelect: function(selected) {
           $("#StoreofferFromDate").datepicker("option","maxDate", selected)
        }
    });

    $('#DriversFromDate').datepicker({
        maxDate:0,
        numberOfMonths: 1,
        onSelect: function(selected) {
           $("#DriversToDate").datepicker("option","minDate", selected)
        }
    });

    $('#DriversToDate').datepicker({
        maxDate: 0,
        numberOfMonths: 1,
        onSelect: function(selected) {
           $("#DriversFromDate").datepicker("option","maxDate", selected)
        }
    });

});


function productImageDelete() {

    var imagesProduct = $('#imagesProduct').val();
    var storeId = $('#storeId').val();
    imagesProduct = imagesProduct.substr(0, imagesProduct.length - 1);
    var imageArray = imagesProduct.split(",");
    var line = 'Are you sure want to change Store. if you lost prouct images ?';

    if (confirm(line)) {
        for (var i = 0; i < imageArray.length; i++) {
            deleteProductImage(imageArray[i]);
        }
        ;
    } else {
        $('#ProductStoreId').val(storeId);
        return false;
    }
}


function productList() {
    var id = $('#DealStoreId').val();
    $.post(rp + '/admin/Deals/productList', {'id': id, 'model': 'City'}, function (response) {
        $("#DealMainProduct").html(response);
        $("#DealSubProduct").html(response);

    });
}


function orderStatus(orderId) {

    var status = $('#orderStatus_' + orderId).val();
    var type = $('#orderType_' + orderId).val();

    if (status != 'Failed' && status != 'Pending') {
        $.post(rp + '/store/orders/orderStatus', {'orderId': orderId, 'status': status}, function (response) {
            $('#orderDetails' + orderId).remove();
            var message = 'This order moves to delivered';
            if (status != 'Delivered') {
                message = 'This order moves to ';
                message += (type == 'Delivery') ? 'dispatch system' : 'collection management';
            }

            $('#orderMessage').html(message);
            $('#orderMessage').show();
            setTimeout(function () {
                $('#orderMessage').fadeOut();
            }, 3000);

        });
    } else if (status == 'Failed') {
        html = '<textarea class="form-control margin-t-10 margin-b-10" id="failedReason_' + orderId + '" rows="4" cols="10"></textarea>' +
            '<input type="button" value="Submit" class="btn btn-default" onclick="return changeOrderStatus(' + orderId + ');">';
        $("#reason_" + orderId).append(html);
    } else {
        $("#reason_" + orderId).html('');
    }
}


function changeOrderStatus(orderId) {

    var reason = $('#failedReason_' + orderId).val();

    if (reason != '') {
        $.post(rp+'/store/orders/orderStatus',{'orderId':orderId, 'status':'Failed', 'reason':reason}, function(response) {
            $('#orderDetails'+orderId).remove();
            $('#orderMessage').html('This order moves to failed with reason');
            $('#orderMessage').show();
            setTimeout(function () {
                $('#orderMessage').fadeOut();
            }, 3000);
        });
    } else {
        alert('Please enter the reason for failed order');
    }
}

function deleteOrder(orderId) {

    var line = 'Are you sure want to delete order ?';

    if (confirm(line)) {
        $.post(rp + '/store/orders/orderStatus', {'orderId': orderId, 'status': 'Deleted'}, function (response) {
            $('#orderDetails' + orderId).remove();
        });
    }
}


$(document).ready(function () {
    $(".allcheck").on("click", function () {
        var id = $(this).attr('id');
        var classVal = $(this).attr('class');
        if ($('#' + id).children(".btn").hasClass("btn-success")) {
            $('#' + id).children(".btn").removeClass("btn-success").addClass("grey-cascade");
            $('#' + id).children().children(".glyphicon").removeClass("glyphicon-ok").addClass("glyphicon-remove");
        }
        else {
            $('#' + id).children(".btn").removeClass("grey-cascade").addClass("btn-success");
            $('#' + id).children().children(".glyphicon").removeClass("glyphicon-remove").addClass("glyphicon-ok");
        }
        $.ajax({
            type: 'post',
            url: rp + "brands/changeStatus/" + id,
            data: 'id=' + id,
            success: function (data) {

            }
        });
    });
    $(".test").on("click", function () {

        if ($(".checkboxes").is(":checked")) {
            $("#send").show();
        } else {
            $("#send").hide();
        }
    });

    var checkbox = 1;
    $(".test1").on("click", function () {
        if (checkbox == 0) {
            checkbox = 1;
            $("#send").hide();
        } else {
            checkbox = 0;
            $("#send").show();
        }
    });
});
function recorddelete(obj) {

    var line = 'Are you sure want to ' + obj.value + '?';
    if (confirm(line)) {
        //$('#BrandIndexForm').submit();
        window.location.href = rp + '/store/Commons/multipleSelect';
    } else {
        return false;
    }
}
