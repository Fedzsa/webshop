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
