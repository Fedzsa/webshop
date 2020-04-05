$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function restore(id) {

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
