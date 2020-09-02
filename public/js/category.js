$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});

function deleteCategory(id) {
    Swal.fire({
        title: "Are your sure you want to delete?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "DELETE",
                url: `/categories/${id}`,
                success: (response) => {
                    if (response.success) {
                        Swal.fire("Deleted!", "", "success");
                        console.log("anyád");
                        let deletedCategoryRow = $(
                            `#category-table tbody tr[data-category-id=${id}]`
                        );
                        console.log(deletedCategoryRow);

                        deletedCategoryRow
                            .find("#is-deleted-column")
                            .append(
                                '<i class="fas fa-check text-success"></i>'
                            );

                        deletedCategoryRow
                            .find("button")
                            .attr(
                                "class",
                                "btn btn-warning fas fa-trash-restore"
                            )
                            .attr("onclick", `restoreCategory(${id})`);
                    }
                },
                error: (error) => {
                    console.error(error);
                },
            });
        }
    });
}

function restoreCategory(id) {
    $.ajax({
        type: "PUT",
        url: `/categories/${id}/restore`,
        success: (response) => {
            if (response.success) {
                let elementRow = $(
                    `#category-table tbody tr[data-category-id=${id}]`
                );

                elementRow.find("i").remove();

                elementRow
                    .find("button")
                    .attr("class", "btn btn-danger fas fa-trash")
                    .attr("onclick", `deleteCategory(${id})`);
            }
        },
        error: (error) => {
            console.error(error);
        },
    });
}
