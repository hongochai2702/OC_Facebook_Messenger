jQuery(document).ready(function($) {
    $("#facebook_messenger_custom").change(function(){
        $(".nj-facebook_messenger").toggleClass("hidden");
    })
    $(".facebook_messenger_backgroud_default").click(function(e){
        $(".wp-color-result").css("background-color","#0075ff");
        $("#facebook_messenger_backgroud").val("#0075ff");
        return false;
    })
    
    // Tabbed Content Facebook Messenger
    $('h2.nav-tab-wrapper a').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('h2.nav-tab-wrapper a').removeClass('nav-tab-active');
		$('.tab-content').removeClass('content-tab-active');

		$(this).addClass('nav-tab-active');
		$("#"+tab_id).addClass('nav-tab-active');
	})
	
});

$(document).ready(function(){
	
	$('ul.tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})

})