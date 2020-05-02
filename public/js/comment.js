$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function storeComment(productId) {
    let commentData = $('#comment-editor form').serializeArray();
    
    $.ajax({
        type: 'POST',
        url: `/products/${productId}/comments`,
        data: commentData,
        success: (response) => {
            if(response) {
                $('#comments').append(response);
            }
        },
        error: (error) => {
            console.error(error);
            let errors = error.responseJSON.errors.comment;
            let errorHtml = `<div class="alert alert-danger">${errors}</div>`;
            $('#comment-editor').prepend(errorHtml);
        }
    });
}

function updateComment(event, productId, commentId) {
    let commentCard = event.path[3];
    let comment = commentCard.querySelector('#comment-text form').elements.namedItem("comment").value;
    
    $.ajax({
        type: 'PUT',
        url: `/products/${productId}/comments/${commentId}`,
        data: {
            product_id: productId,
            comment_id: commentId,
            comment: comment
        },
        success: (response) => {
            if(response.updated) {
                commentCard.querySelector('#comment-text').innerHTML = `<p>${comment}</p>`;
            }
        },
        error: (error) => {
            console.error(error);

            if(error.status === 422) {
                let errors = error.responseJSON.errors.comment;
                let errorHtml = document.createElement('div');
                errorHtml.classList.add('alert');
                errorHtml.classList.add('alert-danger');
                errorHtml.innerHTML = errors;
                commentCard.querySelector('#comment-text form').prepend(errorHtml);
            }
        }
    });
}

function commentToChangeable(event, productId, commentId) {
    let commentCard = event.path[3];
    let comment = commentCard.querySelector('p').innerText;

    commentCard.querySelector('#comment-text').innerHTML = `
        <form>
            <input type="hidden" name="product_id" value="${ productId }" />
            <textarea name="comment" class="form-control" rows="5" placeholder="Leave comment here...">${ comment }</textarea>
            <button type="button" class="btn btn-success float-right mt-3" onclick="updateComment(event, ${ productId }, ${ commentId })">Update</button>
        </form>
    `;
}