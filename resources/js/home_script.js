
$(document).ready(function (){
	$('.messenger-btn').on('click',function (){
		$('#mes-box').toggleClass('active');
	})

	$('#close').on('click',function (){
		$('#mes-box').toggleClass('active');
	})

	$('.btn-filter').on('click',function (){
		$('#filter-content').toggleClass('active');
	})
})

$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
