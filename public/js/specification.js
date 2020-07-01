$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function deleteSpecification(id) {
    Swal.fire({
        title: 'Are your sure you want to delete?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Delete'
    }).then((result) => {
        if(result.value) {
            $.ajax({
                type: 'DELETE',
                url: `/specifications/${id}`,
                success: (response) => {
                    if(response.success) {
                        Swal.fire('Deleted!', '', 'success');

                        let deletedSpecificationRow = $(`#specification-table tbody #${id}`);

                        deletedSpecificationRow.find('#is-deleted-column')
                                            .append('<i class="fas fa-check text-success"></i>');

                        deletedSpecificationRow.find('button')
                                            .attr('class', 'btn btn-warning fas fa-trash-restore')
                                            .attr('onclick', `restoreSpecification(${id})`);
                    }
                },
                error: (error) => {
                    console.error(error);
                }
            });
        }
    });
}

function restoreSpecification(id) {
    $.ajax({
        type: 'PUT',
        url: `/specifications/${id}/restore`,
        success: (response) => {
            if(response.success) {
                let elementRow = $(`#specification-table #${id}`);

                elementRow.find('i').remove();

                elementRow.find('button').remove();

                elementRow.find('td:last-child').append(createEditLinkTag(id));
            }
        },
        error: (error) => {
            console.error(error);
        }
    });
}

function createEditLinkTag(id) {
    let link = $('<a></a>');
    link.attr('href', `/specifications/${id}/delete`);
    link.attr('class', 'btn btn-danger fas fa-trash');
    return link;
}
