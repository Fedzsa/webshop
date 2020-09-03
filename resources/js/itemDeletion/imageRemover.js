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
