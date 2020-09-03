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
