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

class ProductRemover extends TableItemRemover {
    #productId

    constructor(productId) {
        super();
        this.#url = url;
        this.#productId = productId;
    }

    getUrl() {
        return `/products/${this.#productId}`;
    }

    getTheHtmlItemToBeDeleted() {
        return $(
            `#product-table tbody tr[data-product-id=${this.#productId}]`
        );
    }

    getRestoreMethodDeclarationString() {
        return `restoreProduct(${this.#productId})`;
    }
}

class ProductSpecificationRemover extends TableItemRemover {
    #productId
    #specificationId

    constructor(productId, specificationId) {
        super();
        this.#productId = productId;
        this.#specificationId = specificationId;
    }

    getUrl() {
        return `/products/${this.#productId}/specifications/${this.#specificationId}`;
    }

    getTheHtmlItemToBeDeleted() {
        return $(
            `#product-specification-table tbody tr[data-specification-id=${this.#specificationId}]`
        );
    }

    getRestoreMethodDeclarationString() {
        return `restoreProductSpecification(${this.#productId}, ${this.#specificationId})`;
    }
}

class ImageRemover extends ItemRemover {
    #productId
    #imageId

    constructor(productId, imageId) {
        super();
        this.#productId = productId;
        this.#imageId = imageId;
    }

    getUrl() {
        return `/products/${this.#productId}/images/${this.#imageId}`;
    }

    getTheHtmlItemToBeDeleted(){
        return $(`div[data-image-id=${this.#imageId}]`);
    }

    afterItemDeletedCallback() {
        let imageElement = this.getTheHtmlItemToBeDeleted();
        imageElement.remove();
    }
}

function deleteProduct(productId) {
    let productRemover = new ProductRemover(productId);
    productRemover.deleteItem();
}

function restoreProduct(productId) {
    $.ajax({
        type: "PUT",
        url: `/products/${productId}/restore`,
        success: (response) => {
            if (response.success) {
                let restoredProductRow = $(
                    `#product-table tbody tr[data-product-id=${productId}]`
                );
                restoredProductRow.find("i").remove();
                restoredProductRow
                    .find("button")
                    .attr("class", "btn btn-danger fas fa-trash")
                    .attr("onclick", `deleteProduct(${productId})`);
            }
        },
        error: (error) => {
            console.error(error);
        },
    });
}

function deleteSpecification(productId, specificationId) {
    let productSpecificationRemover = new ProductSpecificationRemover(productId, specificationId);
    productSpecificationRemover.deleteItem();
}

function restoreProductSpecification(productId, specificationId) {
    $.ajax({
        type: "PUT",
        url: `/products/${productId}/specifications/${specificationId}/restore`,
        success: (response) => {
            if (response.success) {
                let elementRow = $(
                    `#product-specification-table tr[data-specification-id=${specificationId}]`
                );

                elementRow.find("i").remove();

                elementRow
                    .find("button")
                    .attr("class", "btn btn-danger fas fa-trash")
                    .attr(
                        "onclick",
                        `deleteSpecification(${productId}, ${specificationId})`
                    );
            }
        },
        error: (error) => {
            console.error(error);
        },
    });
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
