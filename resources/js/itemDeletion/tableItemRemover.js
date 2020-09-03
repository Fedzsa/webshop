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
