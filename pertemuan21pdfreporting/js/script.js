$(document).ready(() => {

    //hilangkan tombol cari
    $('#tombol-cari').hide();

    //event ketika keyup ditulis
    $('#keyword').on('keyup',()=>{
        //munculkan icon loading
        $('.loader').show(200);

        //ajax menggunakan load
        // $('.container').load('ajax/pelajar.php?keyword=' + $('$keyword').val());

        //$.get()
        $.get('ajax/pelajar.php?keyword=' + $('#keyword').val(),(data) => {
            $('.container').html(data);
            $('.loader').hide();
        });
    })


});