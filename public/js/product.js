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
                        Swal.fire('Deleted!', '', 'success')

                        let deletedProductRow = $(`#product-table tbody #${productId}`);

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
                let restoredProductRow = $(`#product-table tbody #${productId}`);
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

function restoreSpecification(productId, specificationId) {
    $.ajax({
        type: 'PUT',
        url: `/products/${productId}/specifications/${specificationId}/restore`,
        success: (response) => {
            if(response.success) {
                let elementRow = $(`#product-specification-table #${specificationId}`);

                elementRow.find('i').remove();

                elementRow.find('button').remove();

                elementRow.find('td:last-child').append(createEditLinkTag(productId, specificationId));
            }
        },
        error: (error) => {
            console.error(error);
        }
    });
}

function createEditLinkTag(productId, specificationId) {
    let link = $('<a></a>');
    link.attr('href', `/products/${productId}/specifications/${specificationId}/delete`);
    link.attr('class', 'btn btn-danger fas fa-trash');
    return link;
}

function deleteImage(productId, imageId) {
    $.ajax({
        type: 'DELETE',
        url: `/products/${productId}/images/${imageId}`,
        success: (response) => {
            $(`#image-${imageId}`).remove();
        },
        error: (error) => {
            console.error(error);
        }
    });
}

function writeOutFileName() {
    let fileName = $('#image-input').val();
    fileName = fileName.substr(fileName.lastIndexOf("\\") + 1);
    $('#image-label').html(fileName);
}