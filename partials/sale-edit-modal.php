<!-- Modal -->
<div class="modal fade mt-5" id="saleEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Sales</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="row p-0">
                    <input min="1" type="number" id="sale_id" class="d-none form-control">
                    <div class="form-group col-6">
                        <label>item</label>
                        <input type="text" id="edit_sold" class="form-control" disabled>
                    </div>
                    <div class="form-group col-6">
                        <label for="">Quantity</label>
                        <input min="1" type="number" id="edit_qty" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="updateSale()">Update</button>
            </div>
        </div>
    </div>
</div>