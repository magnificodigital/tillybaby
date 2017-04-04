$( document ).ready(function() {
    
    verificaScroll();
    
});


jQuery( window ).scroll(function() {
    verificaScroll();
});

function verificaScroll(){
    nScrollPosition = jQuery( window ).scrollTop();
    if(nScrollPosition>=100){
         jQuery( "#header" ).addClass( "header-fixed-top" );
    }else{
         jQuery( "#header" ).removeClass( "header-fixed-top" );
    }
}