$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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