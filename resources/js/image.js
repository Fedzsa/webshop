function deleteImage(productId, imageId) {
    Swal.fire({
        title: "Are you sure you want to delete?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
    }).then(() => {
        $.ajax({
            type: "DELETE",
            url: `/products/${productId}/images/${imageId}`,
            success: (response) => {
                Swal.fire("Deleted!", "", "success");

                $(`div[data-image-id=${imageId}]`).remove();
            },
            error: (error) => {
                console.error(error);
            },
        });
    });
}

function writeOutFileName() {
    let fileName = $("#image-input").val();
    fileName = fileName.substr(fileName.lastIndexOf("\\") + 1);
    $("#image-label").html(fileName);
}
