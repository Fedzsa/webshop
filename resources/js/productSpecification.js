function deleteSpecification(productId, specificationId) {
    let productSpecificationRemover = new ProductSpecificationRemover(productId, specificationId);
    productSpecificationRemover.deleteItem();
}

function restoreProductSpecification(productId, specificationId) {
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
