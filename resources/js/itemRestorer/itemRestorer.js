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
