function deleteProduct(productId) {
    Swal.fire({
        title: "Are you sure you want to delete?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "DELETE",
                url: `/products/${productId}`,
                success: (response) => {
                    if (response.success) {
                        Swal.fire("Deleted!", "", "success");

                        let deletedProductRow = $(
                            `#product-table tbody tr[data-product-id=${productId}]`
                        );

                        deletedProductRow
                            .find("#is-deleted-column")
                            .append(
                                '<i class="fas fa-check text-success"></i>'
                            );

                        deletedProductRow
                            .find("button")
                            .attr(
                                "class",
                                "btn btn-warning fas fa-trash-restore"
                            )
                            .attr("onclick", `restoreProduct(${productId})`);
                    }
                },
                error: (error) => {
                    console.error(error);
                },
            });
        }
    });
}

function restoreProduct(productId) {
    $.ajax({
        type: "PUT",
        url: `/products/${productId}/restore`,
        success: (response) => {
            if (response.success) {
                let restoredProductRow = $(
                    `#product-table tbody tr[data-product-id=${productId}]`
                );
                restoredProductRow.find("i").remove();
                restoredProductRow
                    .find("button")
                    .attr("class", "btn btn-danger fas fa-trash")
                    .attr("onclick", `deleteProduct(${productId})`);
            }
        },
        error: (error) => {
            console.error(error);
        },
    });
}
