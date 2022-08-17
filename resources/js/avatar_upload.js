$(document).ready(function (){
	$('#avatar').change(function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
})
