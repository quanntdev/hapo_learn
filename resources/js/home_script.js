$(document).ready(function (){
	$('.messenger-btn').on('click',function (){
		$('#mes-box').toggleClass('active');
	})

	$('#close').on('click',function (){
		$('#mes-box').toggleClass('active');
	})
})