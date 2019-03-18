jQuery(document).ready(function ($) {

    setTimeout( function() {

        $.each( $("#font-selector optgroup"), function() {
            var src = $(this).data( "src" );
            $('head').append("<link href='" + src + "' rel='stylesheet' type='text/css'>");
        });

    }, 0);

    $("#font-selector").change(function() {
        var selected = $("#font-selector option:selected").text();
        $(this).css( 'font-family', selected );
    });

});
