function deleteImage(productId, imageId) {
    let imageRemover = new ImageRemover(productId, imageId);
    imageRemover.deleteItem();
}

function writeOutFileName() {
    let fileName = $("#image-input").val();
    fileName = fileName.substr(fileName.lastIndexOf("\\") + 1);
    $("#image-label").html(fileName);
}
