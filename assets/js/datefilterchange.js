/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


(function ( $ ) {
    
    function strPad (i,l,s) {
	var o = i.toString();
	if (!s) { s = '0'; }
	while (o.length < l) {
		o = s + o;
	}
	return o;
    }
 
    $.fn.datefilterchange = function( options ) {
 
        var altfield = jQuery('#'+jQuery(this).attr('id')+'-alt');
        var hrRemovebtn = jQuery('.ht-remove[ref="' + jQuery(this).attr('id') + '"]');
        //alert(jQuery(this).attr('id'));
        altfield.blur(function(){
           var n=jQuery(this).val().split('/');
           var dd = parseInt(n[0]);
           var mm = parseInt(n[1]);
           var yy = parseInt(n[2]);
           var k = jQuery('#'+jQuery(this).attr('rel'));
           if(n.length ==3 && dd !=0 && dd <= 31 && mm != 0 && mm <= 12){
            k.val((yy-543)+'-'+strPad(n[1],2)+'-'+strPad(n[0],2));
           }else{
            k.val('');
            jQuery(this).val('');
           }
        });
    
        hrRemovebtn.click(function(){
            var ref=jQuery(this).attr("ref");
            jQuery("#"+ref).val('');
            jQuery("#"+ref+"-alt").val('');
        });
 
    };
 
}( jQuery ));

/*
jQuery.fn.extend({
    strPad : function(i,l,s) {
	var o = i.toString();
	if (!s) { s = '0'; }
	while (o.length < l) {
		o = s + o;
	}
	return o;
},
    datefilterchange:function(){
        
        var altfield = jQuery('#'+jQuery(this).attr('id')+'-alt');
        var hrRemovebtn = jQuery('.ht-remove[ref="' + jQuery(this).attr('id') + '"]');
        //alert(jQuery(this).attr('id'));
        altfield.blur(function(){
           var n=jQuery(this).val().split('/');
           var dd = parseInt(n[0]);
           var mm = parseInt(n[1]);
           var yy = parseInt(n[2]);
           var k = jQuery('#'+jQuery(this).attr('rel'));
           if(n.length ==3 && dd !=0 && dd <= 31 && mm != 0 && mm <= 12){
            k.val((yy-543)+'-'+jQuery(this).strPad(n[1],2)+'-'+jQuery(this).strPad(n[0],2));
           }else{
            k.val('');
            jQuery(this).val('');
           }
    });
    
    hrRemovebtn.click(function(){
        var ref=jQuery(this).attr("ref");
        jQuery("#"+ref).val('');
        jQuery("#"+ref+"-alt").val('');
    });
    
    
    }
    });
    */
/*
 * 
 * 
 * 
$.strPad = function(i,l,s) {
	var o = i.toString();
	if (!s) { s = '0'; }
	while (o.length < l) {
		o = s + o;
	}
	return o;
};
function datefilterchange2(this2){
    alert(jQuery(this).attr('id'));
     var n=jQuery(this2).val().split('/');
   var dd = parseInt(n[0]);
   var mm = parseInt(n[1]);
   var yy = parseInt(n[2]);
   var k = jQuery('#'+jQuery(this2).attr('rel'));
   if(n.length ==3 && dd !=0 && dd <= 31 && mm != 0 && mm <= 12){
   
   k.val((yy-543)+'-'+$.strPad(n[1],2)+'-'+$.strPad(n[0],2));
   }else{
   k.val('');
   jQuery(this2).val('')
    }
    
}
jQuery(document).ready(function () {
    
    
    
    
    //alert('test')
   jQuery('input[class =\"dalternate\"]').blur(function(){
   //alert(jQuery(this).val().split('/'));
   alert(jQuery(this).attr('id'));
   var n=jQuery(this).val().split('/');
   var dd = parseInt(n[0]);
   var mm = parseInt(n[1]);
   var yy = parseInt(n[2]);
   var k = jQuery('input[rel=\"'+jQuery(this).attr('id')+'\"]');
   if(n.length ==3 && dd !=0 && dd <= 31 && mm != 0 && mm <= 12){
   
   k.val((yy-543)+'-'+$.strPad(n[1],2)+'-'+$.strPad(n[0],2));
   }else{
   k.val('');
   jQuery(this).val('')
}
   
   //split('/');
})
});

    */