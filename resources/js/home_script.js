
$(document).ready(function (){
	$('.messenger-btn').on('click',function (){
		$('#mesBox').toggleClass('active');
	})

	$('#close').on('click',function (){
		$('#mesBox').toggleClass('active');
	})

	$('.btn-filter').on('click',function (){
		$('#filterContent').toggleClass('active');
	})

	$('.js-example-basic-single').select2({
		theme: 'bootstrap4',
		width: 'resolve'
	});
})