<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header pt-2 pb-2">
                <h5 class="modal-title delete-modal-title text-success"></h5>
                <button type="button" class="close deleteCloseBtn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-1 pb-1">
                <input min="1" type="number" id="itemId" class="d-none form-control">
                Are you sure you want to delete this item from Stock
            </div>
            <div class="modal-footer p-2">
                <button type="button" onclick="deleteItem()" class="saveBtn btn btn-outline-danger">Delete</button>
            </div>
        </div>
    </div>
  </div>