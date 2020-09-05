$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});


class ItemRemover {
    constructor() {}

    deleteItem() {
        let modal = this.#fireDeleteModal();
        modal.then((result) => {
            if (result.value) {
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

    afterItemDeletedCallback() {}
    getUrl() {}
    getTheHtmlItemToBeDeleted() {}
}

class TableItemRemover extends ItemRemover {
    constructor() {
        super();
    }

    afterItemDeletedCallback() {
        let deletedItemRow = this.getTheHtmlItemToBeDeleted();

        deletedItemRow
            .find("#is-deleted-column")
            .append('<i class="fas fa-check text-success"></i>');

        deletedItemRow
            .find("button")
            .attr("class", "btn btn-warning fas fa-trash-restore")
            .attr("onclick", this.getRestoreMethodDeclarationString());
    }

    getRestoreMethodDeclarationString() {}
}

class CategoryRemover extends TableItemRemover {
    #categoryId;

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

class ItemRestorer {
    constructor() {}

    restoreItem() {
        this.#restore();
    }

    #restore() {
        $.ajax({
            type: "PUT",
            url: this.getUrl(),
            success: (response) => {
                if (response.success) {
                    this.#changeRowToRestoredRow();
                }
            },
            error: (error) => {
                console.error(error);
            },
        });
    }

    #changeRowToRestoredRow() {
        let elementRow = this.getTheHtmlItemToBeRestored();

        elementRow.find("i").remove();

        elementRow
            .find("button")
            .attr("class", "btn btn-danger fas fa-trash")
            .attr("onclick", this.getDeleteMethodDeclarationString());
    }

    getUrl() {}
    getTheHtmlItemToBeRestored() {}
    getDeleteMethodDeclarationString() {}
}

class CategoryRestorer extends ItemRestorer {
    #categoryId;

    constructor(categoryId) {
        super();
        this.#categoryId = categoryId;
    }

    getUrl() {
        return `/categorys/${this.#categoryId}/restore`;
    }

    getTheHtmlItemToBeRestored() {
        return $(`#category-table tr[data-category-id=${this.#categoryId}]`);
    }

    getDeleteMethodDeclarationString() {
        return `deleteCategory(${this.#categoryId})`;
    }
}

function deleteCategory(id) {
    let categoryRemover = new CategoryRemover(id);
    categoryRemover.deleteItem();
}

function restoreCategory(id) {
    let categoryRestorer = new CategoryRestorer(id);
    categoryRestorer.restoreItem();
}
