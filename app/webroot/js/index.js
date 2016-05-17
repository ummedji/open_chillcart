$('#st_nave').affix({
    offset: {     
      top: $('#st_nave').offset().top,
      bottom: ($('footer').outerHeight(true) + $('.quicklinks').outerHeight(true)) + 40
    }
});