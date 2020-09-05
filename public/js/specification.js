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

class SpecificationRemover extends TableItemRemover {
    #specificationId;

    constructor(specificationId) {
        super();
        this.#specificationId = specificationId;
    }

    getUrl() {
        return `/specifications/${this.#specificationId}`;
    }

    getTheHtmlItemToBeDeleted() {
        return $(
            `#specification-table tbody tr[data-specification-id=${
                this.#specificationId
            }]`
        );
    }

    getRestoreMethodDeclarationString() {
        return `restoreSpecification(${this.#specificationId})`;
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

class SpecificationRestorer extends ItemRestorer {
    #specificationId;

    constructor(specificationId) {
        super();
        this.#specificationId = specificationId;
    }

    getUrl() {
        return `/specifications/${this.#specificationId}/restore`;
    }

    getTheHtmlItemToBeRestored() {
        return $(
            `#specification-table tr[data-specification-id=${
                this.#specificationId
            }]`
        );
    }

    getDeleteMethodDeclarationString() {
        return `deleteSpecification(${this.#specificationId})`;
    }
}

function deleteSpecification(id) {
    let specificationRemover = new SpecificationRemover(id);
    specificationRemover.deleteItem();
}

function restoreSpecification(id) {
    let specificationRestorer = new SpecificationRestorer(id);
    specificationRestorer.restoreItem();
}
