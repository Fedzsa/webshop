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

class ProductRemover extends TableItemRemover {
    #productId;

    constructor(productId) {
        super();
        this.#productId = productId;
    }

    getUrl() {
        return `/products/${this.#productId}`;
    }

    getTheHtmlItemToBeDeleted() {
        return $(`#product-table tbody tr[data-product-id=${this.#productId}]`);
    }

    getRestoreMethodDeclarationString() {
        return `restoreProduct(${this.#productId})`;
    }
}

class ProductSpecificationRemover extends TableItemRemover {
    #productId;
    #specificationId;

    constructor(productId, specificationId) {
        super();
        this.#productId = productId;
        this.#specificationId = specificationId;
    }

    getUrl() {
        return `/products/${this.#productId}/specifications/${
            this.#specificationId
        }`;
    }

    getTheHtmlItemToBeDeleted() {
        return $(
            `#product-specification-table tbody tr[data-specification-id=${
                this.#specificationId
            }]`
        );
    }

    getRestoreMethodDeclarationString() {
        return `restoreProductSpecification(${this.#productId}, ${
            this.#specificationId
        })`;
    }
}

class ImageRemover extends ItemRemover {
    #productId;
    #imageId;

    constructor(productId, imageId) {
        super();
        this.#productId = productId;
        this.#imageId = imageId;
    }

    getUrl() {
        return `/products/${this.#productId}/images/${this.#imageId}`;
    }

    getTheHtmlItemToBeDeleted() {
        return $(`div[data-image-id=${this.#imageId}]`);
    }

    afterItemDeletedCallback() {
        let imageElement = this.getTheHtmlItemToBeDeleted();
        imageElement.remove();
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

class ProductRestorer extends ItemRestorer {
    #productId;

    constructor(productId) {
        super();
        this.#productId = productId;
    }

    getUrl() {
        return `/products/${this.#productId}/restore`;
    }

    getTheHtmlItemToBeRestored() {
        return $(`#product-table tr[data-product-id=${this.#productId}]`);
    }

    getDeleteMethodDeclarationString() {
        return `deleteProduct(${this.#productId})`;
    }
}

class ProductSpecificationRestorer extends ItemRestorer {
    #productId;
    #specificationId;

    constructor(productId, specificationId) {
        super();
        this.#productId = productId;
        this.#specificationId = specificationId;
    }

    getUrl() {
        return `/products/${this.#productId}/specifications/${
            this.#specificationId
        }/restore`;
    }

    getTheHtmlItemToBeRestored() {
        return $(
            `#product-specification-table tr[data-specification-id=${
                this.#specificationId
            }]`
        );
    }

    getDeleteMethodDeclarationString() {
        return `deleteProductSpecification(${this.#specificationId})`;
    }
}

function deleteProduct(productId) {
    let productRemover = new ProductRemover(productId);
    productRemover.deleteItem();
}

function restoreProduct(productId) {
    let productRestorer = new ProductRestorer(productId);
    productRestorer.restoreItem();
}

function deleteProductSpecification(productId, specificationId) {
    let productSpecificationRemover = new ProductSpecificationRemover(
        productId,
        specificationId
    );
    productSpecificationRemover.deleteItem();
}

function restoreProductSpecification(productId, specificationId) {
    let productSpecificationRestorer = new ProductSpecificationRestorer(
        productId,
        specificationId
    );
    productSpecificationRestorer.restoreItem();
}

function deleteImage(productId, imageId) {
    let imageRemover = new ImageRemover(productId, imageId);
    imageRemover.deleteItem();
}

function writeOutFileName() {
    let fileName = $("#image-input").val();
    fileName = fileName.substr(fileName.lastIndexOf("\\") + 1);
    $("#image-label").html(fileName);
}
