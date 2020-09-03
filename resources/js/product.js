function deleteProduct(productId) {
    let productRemover = new ProductRemover(productId);
    productRemover.deleteItem();
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
