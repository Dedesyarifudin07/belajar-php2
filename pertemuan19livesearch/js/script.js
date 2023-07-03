//ambil element element yang dibutuhkan
const keyword = document.querySelector('#keyword');
const tombolCari = document.querySelector('#tombol-cari');
const container = document.querySelector('.container');


keyword.addEventListener('keyup',(e) => {
    
    
    //buat objeck ajax
    const xhr = new XMLHttpRequest();

    //cek kesiapan ajax
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200){
            container.innerHTML = xhr.responseText;
        }
    }

    //eksekusi ajax 
    xhr.open('GET','ajax/pelajar.php?keyword=' + e.target.value,true);
    //menjalankan ajax
    xhr.send();
    
})