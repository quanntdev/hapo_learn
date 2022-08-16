// const input = document.getElementById('file');
// const image = document.getElementById('img-preview');

// input.addEventListener('change', (e) => {
//     if (e.target.files.length) {
//         const src = URL.createObjectURL(e.target.files[0]);
//         image.src = src;
//     }
// });

//đổi về jquery
$(document).ready(function (){
	$('#avatar').change(function () {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });
})
