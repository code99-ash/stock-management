
<!-- Modal 
        With Card
 -->
<div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="modelTitleId2" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="paystack-color-bar"></div>
                <h5 class="modal-title">New Sale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="header">
                    <div class="page-info">
                        <h3 id="page-name" class="page-name">Ace supermarket</h3>
                    </div>
                    <div class="page-description">
                        <span id="page-description">Inventory system</span>
                    </div>
                </div>
            <form  id="paymentForm" class="payment-form">
                <div class="form-group">
                    <div class="row">
                        <div class="col-12">
                            <div class="element-label"><span>Card Number</span></div>
                            <input type="text" id="card_no" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="element-label"><span>CVV</span></div>
                            <input type="text" id="cvv" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <div class="element-label"><span>Expiry Date</span></div>
                            <input type="text" id="exp" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                        <div class="element-label"><span>Currency</span></div>
                        <select class="form-control" disabled="true">
                            <option value="NGN">NGN</option>
                        </select>
                        </div>
                        <div class="col-md-4">
                            <div class="element-label"><span>Product ID</span></div>
                            <select class="form-control">
                                <option value="1">ACE1</option>
                                <option value="2">ACE2</option>
                                <option value="3">ACE3</option>
                                <option value="4">ACE4</option>
                                <option value="5">ACE5</option>
                                <option value="6">ACE6</option>
                                <option value="7">ACE7</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="element-label"><span>Quantity</span></div>
                            <input type="text" id="quantity" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success text-white w-100" type="submit">Pay With Card</button>
                    <div class="float-right">
                        <h6>Total</h6>
                        <h3 id='total'></h3>
                    </div>
                </div>
            </form>
            <div id="paystack-footer" class="paystack-footer animated fadeIn">
                <!-- <a target="_blank" href="https://paystack.com/what-is-paystack">
                <img alt="Paystack secured badge" src="https://paystack.com/assets/payment/img/paystack-badge-cards.png">
                </a> -->
            </div>
            </div>
        </div>
    </div>
</div>

    <!-- With Cash -->

<!-- Modal -->
<div class="modal fade" id="payment-by-cash" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="paystack-color-bar"></div>
                <h5 class="modal-title">New Sale</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <div class="header">
                    <div class="page-info">
                        <h3 id="page-name" class="page-name">Ace supermarket</h3>
                    </div>
                    <div class="page-description">
                        <span id="page-description">Inventory system</span>
                    </div>
                </div>

                <button class="btn btn-primary btn-sm" onclick="showMoreSale(event)" data-more="true">Multiple Product</button>
                <button class="btn btn-primary btn-sm float-right ml-auto mr-1" onclick="addMoreToSale()" id="addMoreBtn" style="display: none" onclick="addMore()">Add more +</button>

            <form  id="paymentForm" class="payment-form">
                <div class="row">
                 
                    <div class="col-12" id="moreSale" style="display: none">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-danger" id="feedback--cash"></p>
                                    <div class="element-label"><span>Customer Name</span></div>
                                    <input type="text" id="name--cash" class="form-control">
                                </div>
                        </div>                                          
                        </div>

                        <div class="row">
                            <table class="table col-12 table-responsive-sm table-bordered"  id="multiSaleDiv">
                                <thead>
                                    <th></th>
                                    <th>Stock ID</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </thead>
                                <tbody id="more_tr">
                                    
                                </tbody>
                            </table>
                        </div>

                        <button class="btn btn-success text-white w-100" onclick="payMultiWithCash(event)" type="submit">Pay With Cash</button>

                    </div>
                    <div class="col-12" id="singleSale">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn bg-white text-success displayPrice float-right ml-auto mr-3"></button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12">
                                    <p class="text-danger" id="feedback--cash"></p>
                                    <div class="element-label"><span>Customer Name</span></div>
                                    <input type="text" id="name--cash" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                <div class="element-label"><span>Currency</span></div>
                                    <select class="form-control" disabled="true">
                                        <option value="NGN">NGN</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <div class="element-label">
                                        <span>Product ID</span>
                                        <span class="text-danger h5">*</span>
                                    </div>
                                    <select class="form-control stock_select" id="stock_id--cash">
                                    </select>
                                </div>
                                <div class="col-md-4">
        
                                    <div class="element-label">
                                        <span>Quantity</span>
                                        <span class="text-danger h5">*</span>
                                    </div>
                                    <input type="number" id="price--cash" value="100" class="d-none" onchange="setTotalPrice()" onkeyup="setTotalPrice()">
                                    <input type="number" id="quantity--cash" min="1" class="form-control" onchange="setTotalPrice()" onkeyup="setTotalPrice()">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-success text-white w-100" onclick="paySingleWithCash(event)" type="submit">Pay With Cash</button>
                            <div class="float-right pb-3 pt-1 d-flex">
                                <h4 id='total--cash' class="btn bg-white text-success ml-3 font-weight-bold"></h4>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </form>

            </div>
        </div>
    </div>
</div>

    
        
        