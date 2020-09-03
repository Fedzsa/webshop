function deleteSpecification(id) {
    let specificationRemover = new SpecificationRemover(id);
    specificationRemover.deleteItem();
}

function restoreSpecification(id) {
    $.ajax({
        type: "PUT",
        url: `/specifications/${id}/restore`,
        success: (response) => {
            if (response.success) {
                let elementRow = $(
                    `#specification-table tr[data-specification-id=${id}]`
                );

                elementRow.find("i").remove();

                elementRow
                    .find("button")
                    .attr("class", "btn btn-danger fas fa-trash")
                    .attr("onclick", `deleteSpecification(${id})`);
            }
        },
        error: (error) => {
            console.error(error);
        },
    });
}
