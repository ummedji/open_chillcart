jQuery().ready(function() {

	setTimeout(function(){				
	    $('#flashMessage').fadeOut();
	},3000);

	var UserStoreStoreLoginForm = jQuery("#UserStoreStoreLoginForm").validate({
	    rules: {     
	        "data[User][username]": {
	        required: true,
	      },
	      "data[User][password]": {
	        required: true,
	      }
	    },
	    messages: { 
	      "data[User][username]": {
	        required: "Please enter the username",
	      },
	      "data[User][password]": {
	        required: "Please enter the password",
	      },
	    }
	});

	var ProductAdminIndexForm = jQuery("#ProductAdminIndexForm").validate({
		rules: {
			"data[Product][store_id]": {
				required: true,
			},
			"data[excel]": {
				required: true,
			}
		},
		messages: { 
			"data[Product][store_id]": {
				required: "Please select store",
			},
			"data[excel]": {
				required: "Please select xls file",
			}

		}
	});

	/*var paymentAddvalidator = jQuery("#paymentAdminPaymentSettingForm").validate({
		rules: {
			"data[payment][url]": {
				required: true,
			},
			"data[payment][account]": {
				required: true,
			}
		},
		messages: { 
			"data[payment][url]": {
				required: "Please Enter Url detail",
			},
			"data[payment][account]": {
				required: "Please Enter the account detail",
			}

		}
	});*/

	var CategoryAddvalidator = jQuery("#CategoryAdminAddForm").validate({
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

	var CategoryEditvalidator = jQuery("#CategoryAdminEditForm").validate({
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

	var BrandAddvalidator = jQuery("#BrandAdminAddForm").validate({
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


	var BrandEditvalidator = jQuery("#BrandAdminEditForm").validate({
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

	var SubCatAddvalidator = jQuery("#CategoryAdminSubcataddForm").validate({
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

	var SubCatEditvalidator = jQuery("#CategoryAdminSubcateditForm").validate({
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

	var UserAdminAddvalidator = jQuery("#UserAdminAddForm").validate({
		rules: {
			"data[Customer][first_name]": {
				required: true,
			},
			"data[Customer][last_name]": {
				required: true,
			},
			"data[Customer][customer_phone]": {
				required: true,
				number:true,
			},
			"data[Customer][customer_email]": {
				required: true,
				email:true,
			},
			"data[User][password]": {
				required: true,
			}
		},
		messages: { 
			"data[Customer][first_name]": {
				required: "Please Enter the firstname",
			},
			"data[Customer][last_name]": {
				required: "Please Enter the lastname",
			},
			"data[Customer][customer_phone]": {
				required: "Please Enter the Phone nmber",
			},
			"data[Customer][customer_email]": {
				required: "Please Enter the Email",
			},
			"data[User][password]": {
				required: "Please Enter the password",
			}
		}
	});

	var UserAdminEditvalidator = jQuery("#UserAdminEditForm").validate({
		rules: {
			"data[Customer][first_name]": {
				required: true,
			},
			"data[Customer][last_name]": {
				required: true,
			},
			"data[Customer][customer_phone]": {
				required: true,
				number:true,
			},
			"data[Customer][customer_email]": {
				required: true,
				email:true,
			},
			"data[User][password]": {
				required: true,
			}
		},
		messages: { 
			"data[Customer][first_name]": {
				required: "Please Enter the firstname",
			},
			"data[Customer][last_name]": {
				required: "Please Enter the lastname",
			},
			"data[Customer][customer_phone]": {
				required: "Please Enter the Phone nmber",
			},
			"data[Customer][customer_email]": {
				required: "Please Enter the Email",
			},
			"data[User][password]": {
				required: "Please Enter the password",
			}
		}
	});

	var CustomerBookvalidator = jQuery("#EditCustomerAddressBook").validate({
		rules: {
			"data[CustomerAddressBooks][address_title]": {
				required: true,
			},
			"data[CustomerAddressBooks][address_phone]": {
				required: true,
				number :true,
			},
			"data[CustomerAddressBooks][landmark]": {
				required: true,
				number:true,
			},
			"data[CustomerAddressBooks][address]": {
				required: true,				
			},
			"data[CustomerAddressBooks][city_id]": {
				required: true,
			},
			"data[CustomerAddressBooks][location_id]": {
				required: true,
			}
		},
		messages: { 
			"data[CustomerAddressBook][address_title]": {
				required: "Please Enter the address_title",
			},
			"data[CustomerAddressBooks][address_phone]": {
				required: "Please Enter the Phone nmber",
			},
			"data[CustomerAddressBooks][landmark]": {
				required: "Please Enter the landmark",
			},
			"data[CustomerAddressBooks][address]": {
				required: "Please Enter the address",
			},
			"data[CustomerAddressBooks][city_id]": {
				required: "Please select the city",
			},
			"data[CustomerAddressBooks][location_id]": {
				required: "Please select the location",
			}
		}
	});
    
    var ProductAddvalidator = jQuery("#ProductAdminAddForm").validate({
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
				required: "Please Select the sub category",
			},
			"data[product_image][]": {
					required: "Please select image",
			},
		}
	});

	var ProductEditvalidator = jQuery("#ProductAdminEditForm").validate({
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
				required: "Please Select the sub category",
			},

			"data[product_image][]": {
					required: "Please select image",
			},
		}
	});
    
    var VoucherAddvalidator = jQuery("#form-username").validate({
		rules: {
			"data[Voucher][voucher_code]": {
				required: true,
			},
			"data[Voucher][type_offer]": {
				required: true,
				
			},
			"data[Voucher][offer_mode]": {
				required: true,
				
			},
             "data[Voucher][offer_value]": {
				required: true,
                number:true,
			},
            "data[Voucher][from_date]": {
				required: true,
			},
            "data[Voucher][to_date]": {
				required: true,
			}
           
		},

		errorPlacement: function(error, element) {
            if(element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        
		messages: { 
		      "data[Voucher][voucher_code]": {
    				required: "Please Enter Code",
    			},
    			"data[Voucher][type_offer]": {
    			 required: "Please Enter offertype",
    				
    			},
    			"data[Voucher][offer_mode]": {
    			required: "Please Enter offermode",
    				
    			},
                 "data[Voucher][offer_value]": {
    				required: "Please Enter offervalue",
    			},
                "data[Voucher][from_date]": {
    				required: "Please Enter from_date",
    			},
                "data[Voucher][to_date]": {
    				required: "Please Enter to_date",
    			}
            }
	});
    
     var VoucherEditvalidator = jQuery("#form-username1").validate({
		rules: {
			"data[Voucher][voucher_code]": {
				required: true,
			},
			"data[Voucher][type_offer]": {
				required: true,
				
			},
			"data[Voucher][offer_mode]": {
				required: true,
				
			},
             "data[Voucher][offer_value]": {
				required: true,
                number:true,
			},
            "data[Voucher][from_date]": {
				required: true,
			},
            "data[Voucher][to_date]": {
				required: true,
			}
           
		},
		messages: { 
		      "data[Voucher][voucher_code]": {
    				required: "Please Enter Code",
    			},
    			"data[Voucher][type_offer]": {
    			 required: "Please Enter offertype",
    				
    			},
    			"data[Voucher][offer_mode]": {
    			required: "Please Enter offermode",
    				
    			},
                 "data[Voucher][offer_value]": {
    				required: "Please Enter offervalue",
    			},
                "data[Voucher][from_date]": {
    				required: "Please Enter from_date",
    			},
                "data[Voucher][to_date]": {
    				required: "Please Enter to_date",
    			}
            }
	});
    
    
    var StoreofferAdminAddForm = jQuery("#StoreofferAdminAddForm").validate({
		rules: {
			"data[Storeoffer][store_id]": {
				required: true,
			},
			"data[Storeoffer][offer_percentage]": {
				required: true,
                number:true,
                min:1,
                max:99,
				
			},
			"data[Storeoffer][offer_price]": {
				required: true,
                number:true,
                min:1
				
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
				required: "Please select store Name",
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
                number:true,
                min:1,
                max:99,
				
			},
			"data[Storeoffer][offer_price]": {
				required: true,
                number:true,
                min:1
				
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
				required: "Please select store Name",
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

	var dealAddValidator = jQuery("#DealAdminAddForm").validate({
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
				required: "Please select store",
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

	var dealEditValidator = jQuery("#DealAdminEditForm").validate({
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
				required: "Please select store",
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


	var newsletterSelectValidator = jQuery("#NewsletterAdminSendselectcustomerForm").validate({
		rules: {
			"data[Newsletter][subject]": {
				required: true,
			},
			"data[Newsletter][to]": {
				required: true,
				
			}
           
		},
		messages: { 
		    "data[Newsletter][subject]": {
				required: "Please enter subject",
			},
			"data[Newsletter][to]": {
				required: "Please enter to address",
				
			},
   		}
	});

	var changepasswordValidator = jQuery("#userAdminChangePasswordForm").validate({
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

	var newsletterAllValidator = jQuery("#NewsletterAdminSendallForm").validate({
		rules: {
			"data[Newsletter][subject]": {
				required: true,
			},
			"data[Newsletter][to]": {
				required: true,
			}
           
		},
		messages: { 
		    "data[Newsletter][subject]": {
				required: "Please enter subject",
			},
			"data[Newsletter][to]": {
				required: "Please enter to address",
			},
   		}
	});
	
});
//Find SubCategory List Detail
function subcatList() {
	var id = $('#ProductCategoryId').val();
	$.post(rp+'/Products/subCatList',{'id':id}, function(response) {
	   $("#ProductSubCategoryId").html(response);
	});
}
//Enable and Diable For single and Multiple Option
$(document).ready(function(){
	productOptions();
	batchCodeCheck();
	paymentShow();
	$("input[name='data[Product][price_option]']").click(function() {
		productOptions();
	});

	$("input[name='data[Sitesetting][stripe_mode]']").click(function() {
		paymentShow();
	});
});


function batchCodeCheck () {
	var storeId 	= $('#ProductStoreId').val();
	var productId 	= ($('#ProductId').val()) ? $('#ProductId').val() : 0;
	$.post(rp+'/Products/batchCodeCheck',{'storeId':storeId, 'productId': productId}, function(response) {
	   $('#batchCodes').val(response);
	});
}

//Hide Show Process Based On Radio Selection
function productOptions () {
	if ($("#ProductPriceOptionMultiple").is(":checked")) {
		$("#multiple").show();
        $("#single").hide();
	} else {
		$("#multiple").hide();
        $("#single").show();
	}
}
//original price and compare price checking
function valueCheck(){
    var original_price  = $('#ProductDetailOrginalPrice').val();
    var compare_price = $('#ProductDetailComparePrice').val();
    if (parseInt(compare_price) > parseInt(original_price))  {
        alert("The Compare Price Should Be Lesserthen or Equal To  The Original Price");
    }
}
//Status Changes Process 
function statusChange(ids,models) {
    var id    = ids;
    var model = models;
   	$.post(rp+'/Commons/statusChanges',{'id':id,'model':model}, function(response) {
	});
}
//Delete process
function deleteprocess(ids,models) {
	var check = confirm("Are Sure You Want Delete");
	if($.trim(check) == 'true') {
		var id    = ids;
		var model = models;
		$.post(rp+'/Commons/deleteProcess',{'id':id,'model':model}, function(response) {
		});
		$("#record"+id).remove();
	}
}


var i = (typeof j != 'undefined') ? j : 1;
var html = '';

function multipleOption () {

	html =  '<div id = "moreProuct'+i+'" class="row addPriceTop">'+
				'<div class="col-lg-7">'+
					'<div class="row">'+
						'<div class="col-md-6">'+
							'<div class="input text">'+
								'<input type="text" id="ProductDetailSubName" data-attr="product name" maxlength="100" placeholder="Product Name" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][sub_name]">'+
							'</div>'+
						'</div>'+
						'<div class="col-md-3">'+
							'<div class="input number">'+
								'<input type="text" id="ProductDetailOrginalPrice" data-attr="original price" step="any" placeholder="Price" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][orginal_price]">'+
							'</div>'+
						'</div>'+
						'<div class="col-md-3">'+
							'<div class="input number">'+
								'<input type="text" id="ProductDetailComparePrice" data-attr="compare price" step="any" placeholder="Sale" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][compare_price]">'+
							'</div>'+
						'</div>'+
					'</div>'+
				'</div>'+
				'<div class="col-lg-5">'+
					'<div class="row">'+
						'<div class="col-md-5">'+
							'<div class="input number">'+
								'<input type="text" id="ProductDetailQuantity" data-attr="quantity" placeholder="Quantity" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][quantity]">'+
							'</div>'+
						'</div>'+
						'<div class="col-md-5">'+
							'<div class="input text">'+
								'<input type="text" id="ProductDetailProductCode" data-attr="batch code" maxlength="100" placeholder="Batchcode" class="form-control multipleValidate" name="data[ProductDetail][' + i + '][product_code]">'+
							'</div>'+
						'</div>'+
						'<span class="ItemRemove" onclick="removeOption('+i+');"><i class="fa fa-times"></i></span>'+
					'</div>'+					
				'</div>'+
			'</div>';

    i++;
    $('#moreOption').append(html);
    html = '';
    return false;
}

function removeOption (id) {
	$('#moreProuct'+id).remove();
}

function optionValidate () {

	//var batchCodess 	= '"'+[$('#batchCodes').val().slice(0,-1)]+'"';
	var batchCodess 	= $('#batchCodes').val();
	var batchArr 		= batchCodess.split(',');
	var optionMultiple 	= $("#ProductPriceOptionMultiple").is(":checked");

	/*for(i=0; i < batchArr.length; i++)
    console.log(batchArr[i]);*/
    
	var name   = $('#ProductProductName').val();
	var cat    = $('#ProductCategoryId').val();
	var subcat = $('#ProductSubCategoryId').val();

	if(name != '' && cat != '' && subcat != '') {

		var error = 0;
		$('.AddError').remove();

		if (optionMultiple) {

			$(".multipleValidate[type = 'text']").each(function() {

		    	var attrs	= $(this).attr('data-attr');

		    	if($(this).val() == "" && attrs != "compare price") {
		    		$(this).after('<span class="AddError"> Please enter '+attrs+'</span>');
		    		error = 1;
		    	} else if (attrs == 'batch code') {
		    		if(jQuery.inArray($(this).val(), batchArr) !== -1) {
		    			$(this).after('<span class="AddError"> Batch code already exists</span>');
		    			error = 1;
		    		} else {
		    			batchArr.push($(this).val());
		    		}
		    	}

		    	if(attrs == "original price" || attrs == "quantity") {
		    		if ($(this).val() < 0 || isNaN($(this).val())) {
		    			$(this).after('<span class="AddError"> Please enter valid '+attrs+'</span>');
		    			error = 1;
		    		} else if ($(this).val() < 0 || isNaN($(this).val())) {
		    			$(this).after('<span class="AddError"> Please enter valid '+attrs+'</span>');
		    			error = 1;
		    		}
		    	}

		    	if(attrs == "compare price") {
		    		if ($(this).val() != '' && isNaN($(this).val())) {
		    			$(this).after('<span class="AddError"> Please enter valid '+attrs+'</span>');
		    			error = 1;
		    		} else if ($(this).val() < 0 || isNaN($(this).val())) {
		    			$(this).after('<span class="AddError"> Please enter valid '+attrs+'</span>');
		    			error = 1;
		    		}
		    	}
		    });
		   
		} else {

			$(".singleValidate[type = 'text']").each(function() {

		    	var attrs	= $(this).attr('data-attr');

		    	if($(this).val() == "" && attrs != "compare price") {
		    		$(this).after('<span class="AddError"> Please enter '+attrs+'</span>');
		    		error = 1;
		    	} else if (attrs == 'batch code') {
		    		if(jQuery.inArray($(this).val(), batchArr) !== -1) {
		    			$(this).after('<span class="AddError"> Batch code already exists</span>');
		    			error = 1;
		    		}
		    	}

		    	if(attrs == "original price" || attrs == "quantity") {
		    		if ($(this).val() < 0 || isNaN($(this).val())) {
		    			$(this).after('<span class="AddError"> Please enter valid '+attrs+'</span>');
		    			error = 1;
		    		} else if ($(this).val() < 0 || isNaN($(this).val())) {
		    			$(this).after('<span class="AddError"> Please enter valid '+attrs+'</span>');
		    			error = 1;
		    		}
		    	}
		    	if(attrs == "compare price") {
		    		if ($(this).val() != '' && isNaN($(this).val())) {
		    			$(this).after('<span class="AddError"> Please enter valid '+attrs+'</span>');
		    			error = 1;
		    		} else if ($(this).val() < 0 || isNaN($(this).val())) {
		    			$(this).after('<span class="AddError"> Please enter valid '+attrs+'</span>');
		    			error = 1;
		    		}
		    	}
		    });
		}
		if(error == 1) {
	    	return false;
	    }
	}
}

var k = 0;
function multipleimage () {
	k++;
	$("#multipleImage").append('<div id="Image'+k+'" class="margin-t-10" ><input class="inline-block" type="file" id="ProductProductImage'+k+'"  name="data[ProductImage][]" >'+
								'<a  class="inline-block" href="javascript:void(0);" onclick="return deleteImage('+k+');">Delete</a></div>'); 
}

function deleteImage (id) {
	$('#Image'+id).remove();
}

function deleteProductImage(deleteId) {

	$.post(rp+'/products/deleteProductImage/',{'id':deleteId}, function(response) {
        if (response == 'success') {
           $('#image'+deleteId).remove();    
        }
    });
}
//City Fillter Process
function cityFillters() {
    var id = $('#CustomerAddressBookStateId').val();
    $.post(rp+'/customer/customers/cityfillter',{'id':id}, function(response) {
        $("#CustomerAddressBookCityId").html(response);
    
	})
}
//Location Fillter Process
function locationFillters() {
var id = $('#CustomerAddressBookCityId').val();
    $.post(rp+'/customer/customers/locationfillter',{'id':id}, function(response) {
        $("#CustomerAddressBookLocationId").html(response);
    
	})
}
$(document).ready(function(){
   $(".checktable th input[type='checkbox']").change(function(){
        if($(this).prop("checked") == true){
            $(".checktable td input[type='checkbox']").prop("checked",true);
            $(".checktable td input[type='checkbox']").parent().addClass("checked");
            
        }
        else{
            $(".checktable td input[type='checkbox']").prop("checked",false);
            $(".checktable td input[type='checkbox']").parent().removeClass("checked");
        }
   }); 
   $(".checktable td input[type='checkbox']").change(function(){
        var length = $(".checktable tbody tr td input[type='checkbox']").length;
        var checklength = $(".checktable tbody tr td input[type='checkbox']:checked").length;
        
        if (checklength != 0) {

        };

        if(length == checklength){
            $(".checktable th input[type='checkbox']").prop("checked",true);
            $(".checktable th input[type='checkbox']").parent().addClass("checked");
        }
        else{
            $(".checktable th input[type='checkbox']").prop("checked",false);
            $(".checktable th input[type='checkbox']").parent().removeClass("checked");
        }
   });

   	$("#test").on("click", function(){
	   	if ($(".checkboxes").is(":checked")) {
	   		$("#send").show();
	   	} else {
	   		$("#send").hide();
	   	}
	});
	
	$("#uniform-PaybalPaypal").on("click", function(){
		$(".paypalDiv").show();
	   	$(".stipeDiv").hide();
	   		
	   	
	});
	$("#uniform-StripeStripe").on("click", function(){
	     	$(".stipeDiv").show();
	   		$(".paypalDiv").hide();	
	   	
	});


});


//Editor Js file
jQuery(document).ready(function() {       
   Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	Demo.init(); // init demo features
   ComponentsEditors.init();
});


$('.date-picker input').datepicker({ minDate: 0 });

$('.date-pickers input').datepicker({ maxDate: 0 });

var dateToday = new Date();
var dates = $("#StoreofferFromDate, #StoreofferToDate").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    numberOfMonths: 1,
    minDate: dateToday,
    onSelect: function(selectedDate) {
        var option = this.id == "StoreofferFromDate" ? "minDate" : "maxDate",
            instance = $(this).data("datepicker"),
            date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
        dates.not(this).datepicker("option", option, date);
    }
});


function productImageDelete() {

	var imagesProduct = $('#imagesProduct').val();
	var storeId = $('#storeId').val();
	imagesProduct = imagesProduct.substr(0, imagesProduct.length-1);
	var imageArray = imagesProduct.split(",");
	var line = 'Are you sure want to change Store. if you lost prouct images ?';

   	if (confirm(line)) {
   		batchCodeCheck();
   		for (var i = 0; i < imageArray.length; i++) {
			deleteProductImage(imageArray[i]);
		};
   	} else {
   		$('#ProductStoreId').val(storeId);
   		return false;
   	}
}


function productList() {
	var id = $('#DealStoreId').val();
	$.post(rp+'/admin/Deals/productList',{'id':id, 'model':'mainProduct'}, function(response) {
		$("#DealMainProduct").html(response);
	});

	$.post(rp+'/admin/Deals/productList',{'id':id, 'model':'subProduct'}, function(response) {
		$("#DealSubProduct").html(response);
	});
}

function orderStatus(orderId) {

	var status =  $('#orderStatus_'+orderId).val();
	var type   =  $('#orderType_'+orderId).val();

	if (status != 'Failed' && status != 'Pending') {
		$.post(rp+'/admin/orders/orderStatus',{'orderId':orderId, 'status':status}, function(response) {
			$('#orderList_'+orderId).remove();
			var message = 'This order moves to delivered';
			if (status != 'Delivered') {
				message = 'This order moves to ';
				message += (type == 'Delivery') ? 'dispatch system' : 'collection management';
			}
			
			$('#orderMessage').html(message);
			$('#orderMessage').show();
			setTimeout(function(){				
			    $('#orderMessage').fadeOut();
			},3000);
		});
	} else if (status == 'Failed') {
		html = '<textarea class="form-control margin-t-10 margin-b-10" id="failedReason_'+orderId+'" rows="4" cols="10"></textarea>'+
				'<input type="button" value="Submit" class="btn btn-default" onclick="return changeOrderStatus('+orderId+');">';
    	$( "#reason_"+orderId).append(html);
	} else {
		$( "#reason_"+orderId).html('');
	}
}


function changeOrderStatus(orderId) {

	var reason =  $('#failedReason_'+orderId).val();

	if (reason != '') {
		$.post(rp+'/admin/orders/orderStatus',{'orderId':orderId, 'status':'Failed', 'reason':reason}, function(response) {
			$('#orderList_'+orderId).remove();
			$('#orderMessage').html('This order moves to failed with reason');
			$('#orderMessage').show();
			setTimeout(function(){				
			    $('#orderMessage').fadeOut();
			},3000);
		});
	} else {
		alert('Please enter the reason for failed order');
	}
}

function deleteOrder(orderId) {

	var line = 'Are you sure want to delete order ?';
	
   	if (confirm(line)) {
   		$.post(rp+'/admin/orders/orderStatus',{'orderId':orderId, 'status':'Deleted'}, function(response) {
			$('#orderList_'+orderId).remove();
		});
   	}
}
function Fillter(){
	var id = $('#store_id').val();
	window.location.href = rp+'/admin/Reviews/list/'+id;
	return false;
	
}
$(".test").on("click", function(){
    if ($(".checkboxes").is(":checked")) {
        $("#send").show();
    } else {
        $("#send").hide();
    }
});

 var checkbox=1;
   $(".test1").on("click", function(){
        if (checkbox==0) {
            checkbox=1;
            $("#send").hide();
        } else {
            checkbox=0;
            $("#send").show();
        }
});

   
$(document).ready(function(){
	$(".allcheck").on("click", function(){
		var id = $(this).attr('id');	
		var classVal = $(this).attr('class');	
		if($('#'+id).children(".btn").hasClass("btn-success")){
           $('#'+id).children(".btn").removeClass("btn-success").addClass("grey-cascade");
           $('#'+id).children().children(".glyphicon").removeClass("glyphicon-ok").addClass("glyphicon-remove");          
        }
        else{
            $('#'+id).children(".btn").removeClass("grey-cascade").addClass("btn-success");
            $('#'+id).children().children(".glyphicon").removeClass("glyphicon-remove").addClass("glyphicon-ok");       
        }
           $.ajax({
           type: 'post',
           url:rp + "brands/changeStatus/"+id,
           data: 'id='+id,
           success : function(data) {
                
            }
       });
	});
});

function recorddelete (obj) {
		
		 var line = 'Are you sure want to '+ obj.value + '?';
   	if (confirm(line)) {
   		//$('#BrandIndexForm').submit();
   		window.location.href=rp+'/admin/Commons/multipleSelect';
   	} else {
   		return false;
   	}
}

function paymentShow () {

	if ($("#SitesettingStripeModeLive").is(":checked")) {
		$("#Live").show();
        $("#Test").hide();
	} else {
		$("#Live").hide();
        $("#Test").show();
	}

}

function paymentSettingvalidate () {

	var SitesettingStripeSecretkey 		= $.trim($('#SitesettingStripeSecretkey').val());
	var SitesettingStripePublishkey 	= $.trim($('#SitesettingStripePublishkey').val());

	var SitesettingStripeSecretkeyTest 	= $.trim($('#SitesettingStripeSecretkeyTest').val());
	var SitesettingStripePublishkeyTest = $.trim($('#SitesettingStripePublishkeyTest').val());

	$("#paymentError").html("");

	if ($("#SitesettingStripeModeLive").is(":checked")) {

		if(SitesettingStripeSecretkey == ''){
			$("#paymentError").html("Please enter stripe secret key");
			$("#SitesettingStripeSecretkey").focus();
			return false;
		} else if(SitesettingStripePublishkey == ''){
			$("#paymentError").html("Please enter stripe publish key");
			$("#SitesettingStripePublishkey").focus();
			return false;		
		}
	} else {

		if(SitesettingStripeSecretkeyTest == ''){
			$("#paymentError").html("Please enter stripe secret key");
			$("#SitesettingStripeSecretkeyTest").focus();
			return false;
		} else if(SitesettingStripePublishkeyTest == ''){
			$("#paymentError").html("Please enter stripe publish key");
			$("#SitesettingStripePublishkeyTest").focus();
			return false;		
		}
	}
}

function storeProducts() {
	var id = $('#Storeproduct').val();
	window.location.href = rp+'/admin/products/index/'+id;
	return false;
}