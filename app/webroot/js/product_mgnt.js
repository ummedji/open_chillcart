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
            $("#send").show();
        }
        else{
            $(".checktable td input[type='checkbox']").prop("checked",false);
            $(".checktable td input[type='checkbox']").parent().removeClass("checked");
            $("#send").hide();
        }
   }); 
   $(".checktable td input[type='checkbox']").change(function(){
        var length = $(".checktable tbody tr td input[type='checkbox']").length;
        var checklength = $(".checktable tbody tr td input[type='checkbox']:checked").length;
        
        if(length == checklength){
            $(".checktable th input[type='checkbox']").prop("checked",true);
            $(".checktable th input[type='checkbox']").parent().addClass("checked");
            $("#send").show();
        } else if(checklength > 0){
        	$(".checktable th input[type='checkbox']").prop("checked",false);
            $(".checktable th input[type='checkbox']").parent().removeClass("checked");
        	$("#send").show();
        } else{
            $(".checktable th input[type='checkbox']").prop("checked",false);
            $(".checktable th input[type='checkbox']").parent().removeClass("checked");
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
		$('.ui-loadercont').show();
		$.post(rp+'/admin/orders/orderStatus',{'orderId':orderId, 'status':'Failed', 'reason':reason}, function(response) {
			$('.ui-loadercont').hide();
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