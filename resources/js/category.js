function deleteCategory(id) {
    let categoryRemover = new CategoryRemover(id);
    categoryRemover.deleteItem();
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
