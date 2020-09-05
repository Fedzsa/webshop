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
