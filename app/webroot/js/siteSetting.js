function smtpDetails () {
	if ($("#SitesettingMailOptionSMTP").is(":checked")) {
		$("#smtp").show();
	} else {
		$("#smtp").hide();
	}
}

$(document).ready(function(){
	smtpDetails();
	offlineDetails();
	$("input[name='data[Sitesetting][mail_option]']").click(function() {
		smtpDetails();
	});
	$("input[name='data[Sitesetting][offline_status]']").click(function() {
		offlineDetails();
	});

	$(".otherLanguage").click(function(){
		$("#others").slideToggle(500);

	});

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

	setTimeout(function(){				
	    $('#flashMessage').fadeOut();
	},3000);


});



function offlineDetails () {
	if ($("#SitesettingOfflineStatusYes").is(":checked")) {
		$("#offlineReason").show();
	} else {
		$("#offlineReason").hide();
	}
}



function validate () {

	var SitesettingSiteName 		= $.trim($("#SitesettingSiteName").val());

	var SitesettingAdminName 		= $.trim($("#SitesettingAdminName").val());
	var SitesettingAdminEmail 		= $.trim($("#SitesettingAdminEmail").val());
	var SitesettingContactUsEmail 	= $.trim($("#SitesettingContactUsEmail").val());
	var SitesettingInvoiceEmail 	= $.trim($("#SitesettingInvoiceEmail").val());
	var SitesettingContactPhone 	= $.trim($("#SitesettingContactPhone").val());
	var SitesettingOrderEmail 		= $.trim($("#SitesettingOrderEmail").val());

	var SitesettingSiteAddress		= $.trim($("#SitesettingSiteAddress").val());
	var SitesettingSiteCountry 		= $.trim($("#SitesettingSiteCountry").val());
	var SitesettingSiteState 		= $.trim($("#SitesettingSiteState").val());
	var SitesettingSiteCity 		= $.trim($("#SitesettingSiteCity").val());
	var SitesettingSiteZip 			= $.trim($("#SitesettingSiteZip").val());

	var SitesettingSmtpHost 		= $.trim($("#SitesettingSmtpHost").val());
	var SitesettingSmtpPort 		= $.trim($("#SitesettingSmtpPort").val());
	var SitesettingSmtpUsername 	= $.trim($("#SitesettingSmtpUsername").val());
	var SitesettingSmtpPassword 	= $.trim($("#SitesettingSmtpPassword").val());

	var SitesettingVatNo 			= $.trim($("#SitesettingVatNo").val());
	var SitesettingVatPercent 		= $.trim($("#SitesettingVatPercent").val());
	var SitesettingCardFee 			= $.trim($("#SitesettingCardFee").val());
	var SitesettingInvoiceDuration 	= $.trim($("#SitesettingInvoiceDuration").val());

	var SitesettingSmsToken			= $.trim($("#SitesettingSmsToken").val());
	var SitesettingSmsId 			= $.trim($("#SitesettingSmsId").val());
	var SitesettingSmsSourceNumber	= $.trim($("#SitesettingSmsSourceNumber").val());

	var SitesettingOtherLanguage	= $.trim($('#SitesettingOtherLanguage').val());

	if(SitesettingSiteName == ''){
        $("[href=#site]").trigger('click');
		$("#siteError").html("Please enter site name");
		$("#SitesettingSiteName").focus();
		return false;
	} else if(SitesettingAdminName == ''){
        $("[href=#contact]").trigger('click');
		$("#contactError").html("Please enter admin name");
		$("#SitesettingAdminName").focus();
		return false;		
	} else if(SitesettingAdminEmail == ''){
        $("[href=#contact]").trigger('click');
		$("#contactError").html("Please enter admin email");
		$("#SitesettingAdminEmail").focus();
		return false;		
	} else if(SitesettingContactUsEmail == ''){
        $("[href=#contact]").trigger('click');
		$("#contactError").html("Please enter contact us email");
		$("#SitesettingContactUsEmail").focus();
		return false;		
	} else if(SitesettingInvoiceEmail == ''){
        $("[href=#contact]").trigger('click');
		$("#contactError").html("Please enter invoice email");
		$("#SitesettingInvoiceEmail").focus();
		return false;		
	} else if(SitesettingContactPhone == ''){
        $("[href=#contact]").trigger('click');
		$("#contactError").html("Please enter site contact phone");
		$("#SitesettingContactPhone").focus();
		return false;		
	} else if(SitesettingOrderEmail == ''){
        $("[href=#contact]").trigger('click');
		$("#contactError").html("Please enter order email");
		$("#SitesettingOrderEmail").focus();
		return false;		
	} else if(SitesettingSiteAddress == ''){
        $("[href=#location]").trigger('click');
		$("#locationError").html("Please enter site address");
		$("#SitesettingSiteAddress").focus();
		return false;		
	} else if(SitesettingSiteCountry == ''){
        $("[href=#location]").trigger('click');
		$("#locationError").html("Please enter site country");
		$("#SitesettingSiteCountry").focus();
		return false;		
	} else if(SitesettingSiteState == ''){
        $("[href=#location]").trigger('click');
		$("#locationError").html("Please enter site state");
		$("#SitesettingSiteState").focus();
		return false;		
	} else if(SitesettingSiteCity == ''){
        $("[href=#location]").trigger('click');
		$("#locationError").html("Please enter site city");
		$("#SitesettingSiteCity").focus();
		return false;		
	} else if(SitesettingSiteZip == ''){
        $("[href=#location]").trigger('click');
		$("#locationError").html("Please enter site zipcode/area name");
		$("#SitesettingSiteZip").focus();
		return false;		
	} else if ($("#SitesettingMailOptionSMTP").is(":checked")) {

		if(SitesettingSmtpHost == ''){
	        $("[href=#mail]").trigger('click');
			$("#mailError").html("Please enter smtp host");
			$("#SitesettingSmtpHost").focus();
			return false;		
		} else if(SitesettingSmtpPort == ''){
	        $("[href=#mail]").trigger('click');
			$("#mailError").html("Please enter smtp port");
			$("#SitesettingSmtpPort").focus();
			return false;		
		} else if(SitesettingSmtpUsername == ''){
	        $("[href=#mail]").trigger('click');
			$("#mailError").html("Please enter smtp username");
			$("#SitesettingSmtpUsername").focus();
			return false;		
		} else if(SitesettingSmtpPassword == ''){
	        $("[href=#mail]").trigger('click');
			$("#mailError").html("Please enter smtp password");
			$("#SitesettingSmtpPassword").focus();
			return false;		
		}
	} else if(SitesettingVatNo == ''){
        $("[href=#invoice]").trigger('click');
		$("#invoiceError").html("Please enter VAT no");
		$("#SitesettingVatNo").focus();
		return false;		
	} else if(SitesettingVatPercent == ''){
        $("[href=#invoice]").trigger('click');
		$("#invoiceError").html("Please enter VAT");
		$("#SitesettingVatPercent").focus();
		return false;		
	} else if(SitesettingCardFee == ''){        
		$("#invoiceError").html("Please enter card fee");
		$("#SitesettingCardFee").focus();
		return false;		
	} else if(SitesettingInvoiceDuration == ''){
        $("[href=#invoice]").trigger('click');
		$("#invoiceError").html("Please select invoice time period");
		$("#SitesettingInvoiceDuration").focus();
		return false;		
	} else if(SitesettingSmsToken == ''){
        $("[href=#sms]").trigger('click');
		$("#smsError").html("Please enter sms token id");
		$("#SitesettingSmsToken").focus();
		return false;		
	} else if(SitesettingSmsId == ''){
        $("[href=#sms]").trigger('click');
		$("#smsError").html("Please enter sms auth id");
		$("#SitesettingSmsId").focus();
		return false;		
	} else if(SitesettingSmsSourceNumber == ''){
        $("[href=#sms]").trigger('click');
		$("#smsError").html("Please enter sms source number");
		$("#SitesettingSmsSourceNumber").focus();
		return false;		
	} else if ($('#others').is(':visible') && SitesettingOtherLanguage == '') {

		$("[href=#Language]").trigger('click');
		$("#languageError").html("Please enter other language");
		$("#SitesettingOtherLanguage").focus();
		return false;


	}
}

function save () {
	//alert('You cannot access payment setting at the moment');
	//return false;
}

function storeProducts() {
	var id = $('#Storeproduct').val();
	if (id != '') {
		window.location.href = rp+'/admin/products/index/'+id;
	} else {
		$("#storeProductError").html("Please select store");
	}
	return false;
}

$('#sample_12').dataTable( {
	columnDefs: [
	   { 
	   	 "bSortable" : false,
	   	 "aTargets" : [ "no-sort" ]
	   }
	]
} );

function importValidate() {

	var ProductStoreId 	= $.trim($("#ProductStoreId").val());
	var excel 			= $.trim($("#excel").val());
	var error = 0;

	if(ProductStoreId == ''){
		error = 1;
		$("#storeError").html("Please select store");
	}

	if(excel == '') {
		error = 1;
		$("#excelError").html("Please select xls file");
	}

	if (error == 1) {
		return false;
	}
}