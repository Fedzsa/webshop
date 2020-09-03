$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});


class ItemRemover {

    constructor() {}

    deleteItem() {
        let modal = this.#fireDeleteModal();
        modal.then(result => {
            if(result.value) {
                this.#delete(() => this.afterItemDeletedCallback());
            }
        });
    }

    #fireDeleteModal() {
        return Swal.fire({
            title: "Are your sure you want to delete?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Delete",
        });
    }

    #delete(callback) {
        $.ajax({
            type: "DELETE",
            url: this.getUrl(),
            success: (response) => {
                if (response.success) {
                    this.#openSuccessfulDeletionModal();

                    callback();
                }
            },
            error: (error) => {
                console.error(error);
            },
        });
    }

    #openSuccessfulDeletionModal() {
        Swal.fire("Deleted!", "", "success");
    }

    afterItemDeletedCallback() {};
    getUrl() {};
    getTheHtmlItemToBeDeleted() {};
}

class TableItemRemover extends ItemRemover {

    constructor() {
        super();
    }

    afterItemDeletedCallback() {
        let deletedItemRow = this.getTheHtmlItemToBeDeleted();

        deletedItemRow
            .find("#is-deleted-column")
            .append(
                '<i class="fas fa-check text-success"></i>'
            );

        deletedItemRow
            .find("button")
            .attr(
                "class",
                "btn btn-warning fas fa-trash-restore"
            )
            .attr("onclick", this.getRestoreMethodDeclarationString());
    }

    getRestoreMethodDeclarationString() {};
}

class CategoryRemover extends TableItemRemover {
    #categoryId

    constructor(categoryId) {
        super();
        this.#categoryId = categoryId;
    }

    getUrl() {
        return `/categories/${this.#categoryId}`;
    }

    getTheHtmlItemToBeDeleted() {
        return $(
            `#category-table tbody tr[data-category-id=${this.#categoryId}]`
        );
    }

    getRestoreMethodDeclarationString() {
        return `restoreCategory(${this.#categoryId})`;
    }
}

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
