$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function deleteProduct(productId) {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete'
    }).then((result) => {
        if(result.value) {
            $.ajax({
                type: 'DELETE',
                url: `/products/${productId}`,
                success: (response) => {
                    if(response.success) {
                        Swal.fire('Deleted!', '', 'success');

                        let deletedProductRow = $(`#product-table tbody tr[data-product-id=${productId}]`);

                        deletedProductRow.find('#is-deleted-column')
                                            .append('<i class="fas fa-check text-success"></i>');

                        deletedProductRow.find('button')
                                            .attr('class', 'btn btn-warning fas fa-trash-restore')
                                            .attr('onclick', `restoreProduct(${productId})`);
                    }
                },
                error: (error) => {
                    console.error(error);
                }
            })
        }
    });
}

function restoreProduct(productId) {
    $.ajax({
        type: 'PUT',
        url: `/products/${productId}/restore`,
        success: (response) => {
            if(response.success) {
                let restoredProductRow = $(`#product-table tbody tr[data-product-id=${productId}]`);
                restoredProductRow.find('i').remove();
                restoredProductRow.find('button')
                                    .attr('class', 'btn btn-danger fas fa-trash')
                                    .attr('onclick', `deleteProduct(${productId})`);
            }
        },
        error: (error) => {
            console.error(error);
        }
    });
}

function deleteSpecification(productId, specificationId) {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete'
    }).then((result) => {
        if(result.value) {
            $.ajax({
                type: 'DELETE',
                url: `/products/${productId}/specifications/${specificationId}`,
                success: (response) => {
                    if(response.success) {
                        Swal.fire('Deleted!', '', 'success');

                        let deletedProductRow = $(`#product-specification-table tbody tr[data-specification-id=${specificationId}]`);

                        deletedProductRow.find('#is-deleted-column')
                                            .append('<i class="fas fa-check text-success"></i>');

                        deletedProductRow.find('button')
                                            .attr('class', 'btn btn-warning fas fa-trash-restore')
                                            .attr('onclick', `restoreSpecification(${productId}, ${specificationId})`);
                    }
                },
                error: (error) => {
                    console.error(error);
                }
            });
        }
    });
}

function restoreSpecification(productId, specificationId) {
    $.ajax({
        type: 'PUT',
        url: `/products/${productId}/specifications/${specificationId}/restore`,
        success: (response) => {
            if(response.success) {
                let elementRow = $(`#product-specification-table tr[data-specification-id=${specificationId}]`);

                elementRow.find('i').remove();

                elementRow.find('button')
                            .attr('class', 'btn btn-danger fas fa-trash')
                            .attr('onclick', `deleteSpecification(${productId}, ${specificationId})`);
            }
        },
        error: (error) => {
            console.error(error);
        }
    });
}

function deleteImage(productId, imageId) {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete'
    }).then(() => {
        $.ajax({
            type: 'DELETE',
            url: `/products/${productId}/images/${imageId}`,
            success: (response) => {
                Swal.fire('Deleted!', '', 'success');

                $(`div[data-image-id=${imageId}]`).remove();
            },
            error: (error) => {
                console.error(error);
            }
        });
    });
}

function writeOutFileName() {
    let fileName = $('#image-input').val();
    fileName = fileName.substr(fileName.lastIndexOf("\\") + 1);
    $('#image-label').html(fileName);
}
