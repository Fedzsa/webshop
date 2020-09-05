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
