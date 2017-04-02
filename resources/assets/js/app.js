require('./bootstrap');

$(function () {

    $( ".nav-toggle" ).click( function(){

        $( this ).toggleClass( "is-active" );
        $( this ).siblings( ".nav-menu" ).toggleClass( "is-active" );

    });

});