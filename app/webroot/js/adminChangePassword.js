jQuery(function() {

  var login = jQuery("#UserAdminLoginForm").validate({
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

  var forgetmail = jQuery("#forgetmail").validate({
    rules: {
      "data[Users][email]": {
        required: true,
        email : true
      }
    },
    messages: {
      "data[Users][email]": {
        required: "Please enter the email",
      },
    }
  });

  var UserAdminChangepassword = jQuery("#UserAdminChangepasswordForm").validate({
    rules: {     
        "data[User][oldpassword]": {
        required: true,
      },
      "data[User][newpassword]": {
        required: true,
      },
      "data[User][retypepassword]": {
        required: true,
        equalTo: '#UserPassword'
      }
    },
    messages: { 
      "data[User][oldpassword]": {
        required: "Please enter the old password",
      },
      "data[User][newpassword]": {
        required: "Please enter the new password",
      },
      "data[User][retypepassword]": {
        required: "Please enter the confirm password",
        //equalTo : "Please enter the same "
      },
    }
  });

  var paymentAddvalidator = jQuery("#SitesettingAdminPaymentSettingForm").validate({
    rules: {
      "data[Sitesetting][stripe_url]": {
        required: true,
      },
      "data[Sitesetting][stripe_ac]": {
        required: true,
      }
    },
    messages: { 
      "data[Sitesetting][stripe_url]": {
        required: "Please Enter Url detail",
      },
      "data[Sitesetting][stripe_ac]": {
        required: "Please Enter the account detail",
      }

    }
  });

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

  var SubCatAddvalidator = jQuery("#CategoryAdminSubCatAddForm").validate({
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

  var SubCatEditvalidator = jQuery("#CategoryAdminSubCatEditForm").validate({
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
      "data[CustomerAddressBook][address_title]": {
        required: true,
      },
      "data[CustomerAddressBook][address_phone]": {
        required: true,
        number :true,
      },
      "data[CustomerAddressBook][landmark]": {
        required: true,
      },
      "data[CustomerAddressBook][address]": {
        required: true,       
      },
      "data[CustomerAddressBook][city_id]": {
        required: true,
      },
      "data[CustomerAddressBook][location_id]": {
        required: true,
      }
    },
    messages: {
      "data[CustomerAddressBook][address_title]": {
        required: "Please Enter the titile",
      },
      "data[CustomerAddressBook][address_phone]": {
        required: "Please Enter the Phone nmber",
      },
      "data[CustomerAddressBook][landmark]": {
        required: "Please Enter the landmark",
      },
      "data[CustomerAddressBook][address]": {
        required: "Please Enter the address",
      },
      "data[CustomerAddressBook][city_id]": {
        required: "Please select the city",
      },
      "data[CustomerAddressBook][location_id]": {
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

  var DriverAdminAddForm = jQuery("#DriverAdminAddForm").validate({
    rules: {
      "data[Driver][driver_name]": {
        required: true,
      },
      "data[Driver][driver_email]": {
        required: true,
        email:true,
      },
      "data[User][username]": {
        required: true,
        number:true,
      },
      "data[User][password]": {
        required: true,
      },
      "data[User][conformpassword]": {
        required: true,
        equalTo:'#UserPassword',
      },
      "data[Driver][address]": {
        required: true,
      },
      "data[Driver][license_no]": {
        required: true,
      },
    },
    messages: { 
      "data[Driver][driver_name]": {
        required: "Please enter the driver name",
      },
      "data[Driver][driver_email]": {
        required: "Please enter the email",
      },
      "data[User][username]": {
        required: "Please enter the Phone number",
      },
      "data[User][password]": {
        required: "Please enter the password",
      },
      "data[User][conformpassword]": {
        required: "Please enter the confirm password",
      },
      "data[Driver][address]": {
        required: "Please enter the address",
      },
      "data[Driver][license_no]": {
        required: "Please enter the license no",
      },
    }
  });
  

  var DriverAdminEditForm = jQuery("#DriverAdminEditForm").validate({
    rules: {
      "data[Driver][driver_name]": {
        required: true,
      },
      "data[Driver][driver_email]": {
        required: true,
        email:true,
      },
      "data[Driver][driver_phone]": {
        required: true,
        number : true
      },
      "data[Driver][address]": {
        required: true,
      },
      "data[Driver][license_no]": {
        required: true,
      },
    },
    messages: { 
      "data[Driver][driver_name]": {
        required: "Please enter the driver name",
      },
      "data[Driver][driver_email]": {
        required: "Please enter the email",
      },
      "data[Driver][driver_phone]": {
        required: "Please enter the phone number",
      },
      "data[Driver][address]": {
        required: "Please enter the address",
      },
      "data[Driver][license_no]": {
        required: "Please enter the license no",
      },
    }
  });



  var VehicleAdminAddvehicleForm = jQuery("#VehicleAdminAddvehicleForm").validate({
    rules: {
      "data[Vehicle][vehicle_name]": {
        required: true,
      },
      "data[Vehicle][model_name]": {
        required: true,
      },
      "data[Vehicle][color]": {
        required: true,
      },
      "data[Vehicle][year]": {
        required: true,
        number : true
      },
      "data[Vehicle][vehicle_no]": {
        required: true,
      },
    },
    messages: { 
      "data[Vehicle][vehicle_name]": {
        required: "Please enter the vehicle name",
      },
      "data[Vehicle][model_name]": {
        required: "Please enter the vehicle model",
      },
      "data[Vehicle][color]": {
        required: "Please enter the vehicle color",
      },
      "data[Vehicle][year]": {
        required: "Please enter the year",
      },
      "data[Vehicle][vehicle_no]": {
        required: "Please enter the vehicle no",
      },
    }
  });



  var VehicleAdminEditvehicleForm = jQuery("#VehicleAdminEditvehicleForm").validate({
    rules: {
      "data[Vehicle][vehicle_name]": {
        required: true,
      },
      "data[Vehicle][model_name]": {
        required: true,
      },
      "data[Vehicle][color]": {
        required: true,
      },
      "data[Vehicle][year]": {
        required: true,
        number : true
      },
      "data[Vehicle][vehicle_no]": {
        required: true,
      },
    },
    messages: { 
      "data[Vehicle][vehicle_name]": {
        required: "Please enter the vehicle name",
      },
      "data[Vehicle][model_name]": {
        required: "Please enter the vehicle model",
      },
      "data[Vehicle][color]": {
        required: "Please enter the vehicle color",
      },
      "data[Vehicle][year]": {
        required: "Please enter the year",
      },
      "data[Vehicle][vehicle_no]": {
        required: "Please enter the vehicle no",
      },
    }
  });

  var StateAddvalidator = jQuery("#StateAdminAddForm").validate({
    rules: {
      "data[State][state_name]": {
        required: true,
      },
      "data[State][country_id]":{
        required: true,
      }
    },
    messages: { 
      "data[State][state_name]": {
        required: "Please enter the state name",
      },
      "data[State][country_id]": {
        required: "Please select the Country",
      }

    }
  });


  var StateEditvalidator = jQuery("#StateAdminEditForm").validate({
    rules: {
      "data[State][state_name]": {
        required: true,
      },
      "data[State][country_id]":{
        required: true,
      }
    },
    messages: { 
      "data[State][state_name]": {
        required: "Please select the state",
      },
      "data[State][country_id]": {
        required: "Please select the Country",
      }

    }
  });

  var CountryAddvalidator = jQuery("#CountryAdminAddForm").validate({
    rules: {
      "data[Country][country_name]": {
        required: true,
      },
      "data[Country][iso]":{
        required: true,
      },
      "data[Country][phone_code]":{
        required: true,
        number:true,
      },
      "data[Country][currency_name]":{
        required: true,
      },
      "data[Country][currency_code]":{
        required: true,
      },
      "data[Country][currency_symbol]":{
        required: true,
      }

    },
    messages: { 
      "data[Country][country_name]": {
        required: "Please Enter Country Name",
      },
      "data[Country][iso]": {
        required: "Please Enter ISO",
      },
      "data[Country][phone_code]":{
        required: "Please Enter Phone code",
      },
      "data[Country][currency_name]":{
        required: "Please Enter currencyname",
      },
      "data[Country][currency_code]":{
        required: "Please Enter Currency code",
      },
      "data[Country][currency_symbol]":{
        required: "Please Enter Currency Symbol",
      }

    }
  });

  var CountryEditvalidator = jQuery("#CountryAdminEditForm").validate({
    rules: {
      "data[Country][country_name]": {
        required: true,
      },
      "data[Country][iso]":{
        required: true,
      },
      "data[Country][phone_code]":{
        required: true,
        number:true,
      },
      "data[Country][currency_name]":{
        required: true,
      },
      "data[Country][currency_code]":{
        required: true,
      },
      "data[Country][currency_symbol]":{
        required: true,
      }

    },
    messages: { 
      "data[Country][country_name]": {
        required: "Please Enter Country Name",
      },
      "data[Country][iso]": {
        required: "Please Enter ISO",
      },
      "data[Country][phone_code]":{
        required: "Please Enter Phone code",
      },
      "data[Country][currency_name]":{
        required: "Please Enter currencyname",
      },
      "data[Country][currency_code]":{
        required: "Please Enter Currency code",
      },
      "data[Country][currency_symbol]":{
        required: "Please Enter Currency Symbol",
      }

    }
  });
  var CityAddvalidator = jQuery("#CityAdminAddForm").validate({
    rules: {
      "data[City][country_id]": {
        required: true,
      },
      "data[City][state_id]": {
        required: true,
      },
      "data[City][city_name]":{
        required: true,
      }
    },
    messages: { 
      "data[City][country_id]": {
        required: "Please select the country",
      },
      "data[City][state_id]": {
        required: "Please select the state",
      },
      "data[City][city_name]": {
        required: "Please enter the city name",
      }

    }
  });
  var CityEditvalidator = jQuery("#CityAdminEditForm").validate({
    rules: {
      "data[City][country_id]": {
        required: true,
      },
      "data[City][state_id]": {
        required: true,
      },
      "data[City][city_name]":{
        required: true,
      }
    },
    messages: { 
      "data[City][country_id]": {
        required: "Please select the country",
      },
      "data[City][state_id]": {
        required: "Please select the state",
      },
      "data[City][city_name]": {
        required: "Please select the city name",
      }

    }
  });

  var LocationAddvalidator = jQuery("#LocationAdminAddForm").validate({
    rules: {
        "data[Location][state_id]": {
          required: true,
          },
        "data[Location][city_id]":{
          required: true,
        },
        "data[Location][area_name]":{
          required: true,
        },
        "data[Location][zip_code]":{
          required: true,
          number:true,
        } 
      },
    messages: { 
      "data[Location][state_id]": {
        required: "Please select the state",
      },
      "data[Location][city_id]": {
        required: "Please select the City",
      },
      "data[Location][area_name]":{
          required: "Please Enter  the Area",
      },
      "data[Location][zip_code]":{
          required: "Please Enter the Zipcode",
      }
    }
  });

  var LocationEditvalidator = jQuery("#LocationAdminEditForm").validate({
    rules: {
        "data[Location][state_id]": {
          required: true,
          },
        "data[Location][city_id]":{
          required: true,
        },
        "data[Location][area_name]":{
          required: true,
        },
        "data[Location][zip_code]":{
          required: true,
          number:true,
        } 
      },
    messages: { 
      "data[Location][state_id]": {
        required: "Please select the state",
      },
      "data[Location][city_id]": {
        required: "Please select the City",
      },
      "data[Location][area_name]":{
          required: "Please Enter  the Area",
      },
      "data[Location][zip_code]":{
          required: "Please Enter the Zipcode",
      }
    }
  });
});