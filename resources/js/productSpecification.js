function deleteSpecification(productId, specificationId) {
    Swal.fire({
        title: "Are you sure you want to delete?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "DELETE",
                url: `/products/${productId}/specifications/${specificationId}`,
                success: (response) => {
                    if (response.success) {
                        Swal.fire("Deleted!", "", "success");

                        let deletedProductRow = $(
                            `#product-specification-table tbody tr[data-specification-id=${specificationId}]`
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
                            .attr(
                                "onclick",
                                `restoreSpecification(${productId}, ${specificationId})`
                            );
                    }
                },
                error: (error) => {
                    console.error(error);
                },
            });
        }
    });
}

function restoreSpecification(productId, specificationId) {
    $.ajax({
        type: "PUT",
        url: `/products/${productId}/specifications/${specificationId}/restore`,
        success: (response) => {
            if (response.success) {
                let elementRow = $(
                    `#product-specification-table tr[data-specification-id=${specificationId}]`
                );

                elementRow.find("i").remove();

                elementRow
                    .find("button")
                    .attr("class", "btn btn-danger fas fa-trash")
                    .attr(
                        "onclick",
                        `deleteSpecification(${productId}, ${specificationId})`
                    );
            }
        },
        error: (error) => {
            console.error(error);
        },
    });
}
