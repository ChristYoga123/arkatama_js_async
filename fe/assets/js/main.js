function pilihKategori()
{
    $.ajax({
        method: "GET",
        url: "http://localhost/js-async/be/api/categories",
        dataType: "json",
        success: function (response) {
            response.data.forEach(function (item) {
                $('select[name=category_id]').append(`<option value="${item.category_id}">${item.category_name}</option>`);
            });
        }
    });
}

function buatProduk()
{
    $.ajax({
        method: "POST",
        url: "http://localhost/js-async/be/api/products",
        data: $("form#buat-produk").serialize(),
        success: function (response) {
            $("form#buat-produk")[0].reset();
            // jika status code 401
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: response.message
            });
            $("#modalProduk").modal("hide");
        },
        statusCode: {
            400: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal',
                    text: xhr.responseJSON.message
                });
            }
        }
    })
}