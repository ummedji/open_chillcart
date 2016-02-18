function citiesList() {
    var id = $('#StoreStoreState').val();
    $.post(rp + '/stores/locations', {'id': id, 'model': 'City'}, function (response) {
        $("#StoreStoreCity").html(response);
    });
}

function locationList() {
    var id = $('#StoreStoreCity').val();
    $.post(rp + '/stores/locations', {'id': id, 'model': 'Location'}, function (response) {
        $("#StoreStoreZip").html(response);
        $("#DeliveryLocationLocationId").html(response);
    });
}

function deliveryOptions() {
    if ($("#StoreDeliveryOptionYes").is(":checked")) {
        $("#deliveryOption").show();
    } else {
        $("#deliveryOption").hide();
    }
}


function emailOptions() {
    if ($("#StoreEmailOrderYes").is(":checked")) {
        $("#emailOption").show();
    } else {
        $("#emailOption").hide();
    }
}

function smsOptions() {
    if ($("#StoreSmsOptionYes").is(":checked")) {
        $("#smsOption").show();
    } else {
        $("#smsOption").hide();
    }
}

$(document).ready(function () {
    deliveryOptions();
    emailOptions();
    smsOptions();

    $("input[name='data[Store][delivery_option]']").click(function () {
        deliveryOptions();
    });
    $("input[name='data[Store][email_order]']").click(function () {
        emailOptions();
    });
    $("input[name='data[Store][sms_option]']").click(function () {
        smsOptions();
    });
});


function validateStoreAdd() {

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
    var StoreMinimumOrder = $.trim($("#StoreMinimumOrder").val());
    var StoreTax = $.trim($("#StoreTax").val());
    var DeliveryLocationLocationId = $.trim($("#DeliveryLocationLocationId").val());

    var StoreOrderEmail = $.trim($("#StoreOrderEmail").val());
    var StoreSmsPhone = $.trim($("#StoreSmsPhone").val());

    var StoreCommission = $.trim($("#StoreCommission").val());
    var invoice_period = $.trim($("#StoreInvoicePeriod").val());

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
    } else if (invoice_period == '') {
        $("[href=#invoice]").trigger('click');
        $("#invoiceError").html("Please select Invoice period");
        $("#StoreInvoicePeriod").focus();
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
    } else if (UserPassword == '') {
        $("[href=#shop]").trigger('click');
        $("#shopError").html("Please enter password");
        $("#UserPassword").focus();
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
});

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