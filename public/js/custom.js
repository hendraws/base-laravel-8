$(document).on("click", ".modal-button", function () {
    let modalID = $(this).data("url");
    let modalSize = $(this).data("mode");
    let modalBG = $(this).data("color");
    let modalTarget = $(this).data("target");
    if (modalBG === undefined) {
        $(".modal")
            .children()
            .children("#content")
            .removeClass()
            .addClass("modal-content");
    } else {
        $(".modal")
            .children()
            .children("#content")
            .removeClass()
            .addClass("modal-content " + modalBG);
    }
    if (modalSize === undefined || modalSize === false || modalSize === "md") {
        $(".modal")
            .children()
            .removeClass()
            .addClass("modal-dialog modal-dialog-centered");
    } else {
        $(".modal")
            .children()
            .removeClass()
            .addClass("modal-dialog modal-dialog-centered modal-" + modalSize);
    }
    if (modalTarget === "alt") {
        $("#ModalFormAlt")
            .modal("show")
            .find(".modal-content-form")
            .load(modalID);
    } else {
        $("#ModalForm").modal("show").find(".modal-content-form").load(modalID);
    }
});

function getDataTable(url, target) {
    $.ajax({
        url: url,
        type: "get",
        datatype: "html",
    })
        .done(function (data) {
            Swal.fire({
                title: "Selesai",
                icon: "success",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
            });
            $(target).empty().html(data);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            Swal.fire({
                html: "No response from server",
                icon: "error",
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 10000,
                timerProgressBar: true,
            });
        });
}

$(document).on("click", ".hapus", function (e) {
    e.preventDefault();
    var url = $(this).data("url");
    Swal.fire({
        title: "Apakah Anda Yakin ?",
        text: "Data akan terhapus tidak dapat dikembalikan lagi !",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.value == true) {
            $.ajax({
                type: "DELETE",
                url: url,

                success: function (data) {
                    if (data.code == "200") {
                        Swal.fire(
                            "Deleted!",
                            "Your file has been deleted.",
                            "success"
                        );
                        setTimeout(function () {
                            location.reload();
                        }, 1500);
                    }
                },
            });
        }
    });
}); //tutup
