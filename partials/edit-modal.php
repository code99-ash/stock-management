<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header pt-2 pb-2">
                <h5 class="modal-title text-success"></h5>
                <button type="button" class="close closeBtn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-1 pb-1">
                <div class="row p-0">
                    <input min="1" type="number" id="id" class="d-none form-control">
                    <div class="form-group col-sm-6 mr-sm-auto">
                        <label for="">Quantity</label>
                        <input min="1" type="number" id="qty" class="form-control">
                    </div>
                    <div class="form-group col-sm-6 ml-sm-auto">
                        <label for="">Price</label>
                        <input min="1" type="number" id="price" class="form-control">
                    </div>
                </div>
            </div>
            <div class="modal-footer p-2">
                <button type="button" onclick="update(qty.value, price.value)" class="saveBtn btn btn-outline-success">Update</button>
            </div>
        </div>
    </div>
  </div>