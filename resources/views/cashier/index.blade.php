@extends('layouts.app')

@section('content')
    @include('components.nav-link')

    <div class="container">
        <div class="row" id="table-detail"></div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <button class="styled-button" id="btn-show-tables">View All Tables</button>
                <div id="selected-table"></div>
                <div id="order-detail"></div>
            </div>
            <div class="col-md-7">
                <!-- Bootstrap tabs for each category -->
                <ul class="nav nav-tabs" id="nav-tab" role="tablist">
                    @foreach($categories as $key => $category)
                        <li class="nav-item" role="presentation">
                            <!-- Active class for the first tab -->
                            <a class="nav-link {{ $key === 0 ? 'active' : '' }}" data-id="{{$category->id}}" id="tab-{{ $key }}" data-toggle="tab" href="#{{ $category->name }}" role="tab" aria-controls="{{ $category->name }}" aria-selected="true">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!-- Tab content -->
                <div class="tab-content" id="nav-tabContent">
                    @foreach($categories as $key => $category)
                        <div class="tab-pane fade {{ $key === 0 ? 'show active' : '' }}" id="{{ $category->name }}" role="tabpanel" aria-labelledby="tab-{{ $key }}">
                            <!-- Content for each category goes here -->
                            <!-- For example, you can display items related to this category -->
                        </div>
                    @endforeach
                </div>
                <div id="list-menu" class="row mt-2"></div> 
            </div>
        </div>
    </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Payment</h1> 
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h3 class="totalAmount"></h3>
        <h3 class="changeAmount"></h3>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text">$</span>
            </div>
            <input type="number" id="received-amount" class="form-control">
        </div>
        <div class="form-group">
            <label for="payment">Payment Type</label>
            <select class="form-control" id="payment-type">
                <option value="cash">Cash</option>
                <option value="credit card">Credit Card</option>
            </select>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary btn-save-payment" disabled>Save Payment</button> 
      </div>
    </div>
  </div>
</div>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> <!-- Bootstrap JS -->
    <script>
        // Make table-detail hidden by default
        $("#table-detail").hide();

        // Show all tables when the client clicks on the button
        $(document).ready(function() {
            $("#btn-show-tables").click(function() {
                if ($("#table-detail").is(":hidden")) {
                    $.get("/cashier/getTable", function(data) {
                        $("#table-detail").html(data);
                        $("#table-detail").slideDown('fast');
                        $("#btn-show-tables").html('Hide Tables').removeClass('styled-button').addClass('btn-danger');
                    });
                } else {
                    $("#table-detail").slideUp('fast');
                    $("#btn-show-tables").html('View All Tables').removeClass('btn-danger').addClass('styled-button');
                }
            });

        //Load menus by category
        $(".nav-link").click(function(){
            $.get("/cashier/getMenuByCategory/"+$(this).data("id"),function(data){
                $("#list-menu").hide();
                $("#list-menu").html(data);
                $("#list-menu").fadeIn('fast');
            });
        })
        var SELECTED_TABLE_ID = "";
        var SELECTED_TABLE_NAME = "";
        var SALE_ID = "";

        //Detect button on click to show table data
        $("#table-detail").on("click", ".btn-table", function() {
            SELECTED_TABLE_ID = $(this).data("id");
            SELECTED_TABLE_NAME = $(this).data("name");
            $("#selected-table").html('<br><h3>Table: '+SELECTED_TABLE_NAME+'</h3><hr>');
            $.get("/cashier/getSaleDetailsByTable/"+ SELECTED_TABLE_ID, function(data){
                $("#order-detail").html(data);
            });
        }); 

        //Show menu to table(MIGHT HAVE TO ADD ON)
        $("#list-menu").on("click", ".btn-menu", function(){
            if(SELECTED_TABLE_ID == ""){
                alert("You need to select a table for the customer first");
            } else {
                var menu_id = $(this).data("id");
                $.ajax({
                    type: "POST",
                    data: {
                        "_token" : $('meta[name="csrf-token"]').attr('content'),
                        "menu_id": menu_id,
                        "table_id": SELECTED_TABLE_ID,
                        "table_name": SELECTED_TABLE_NAME,
                        "quantity" : 1
                    },
                    url: "/cashier/orderFood",
                    success: function(data){
                        $("#order-detail").html(data);
                    }
                })
            }
        })

    $("#order-detail").on('click', ".btn-confirm-order", function(){
        var SaleID = $(this).data("id");
        $.ajax({
            type: "POST",
            data: {
                "_token" : $('meta[name="csrf-token"]').attr('content'),
                "sale_id" : SaleID 
            },
            url: "/cashier/confirmOrderStatus",
            success: function(data){
                $("#order-detail").html(data)
            }        
        })
    })

    //Delete saleDetail

    $("#order-detail").on("click", ".btn-delete-saledetail", function(){
        var saleDetailID = $(this).data("id");
        $.ajax({
            type: "POST",
            data: {
                "_token" : $('meta[name="csrf-token"]').attr('content'),
                "saleDetail_id": saleDetailID
            },
            url: "/cashier/deleteSaleDetail",
            success: function(data){
                $("#order-detail").html(data);
            }
        })
    })

    //When user clicks on payment btn

    $("#order-detail").on("click", ".btn-payment", function() {
        var totalAmount = $(this).attr('data-totalAmount');
        $(".totalAmount").html("Total Amount " + totalAmount);
        $("#received-amount").val('');
        $(".changeAmount").html('');
        SALE_ID = $(this).data('id');
    });


    //Calculate change

    $("#received-amount").keyup(function() {
        var totalAmount = $(".btn-payment").attr('data-totalAmount');
        var receivedAmount = $(this).val();
        var changeAmount = receivedAmount - totalAmount;
        $(".changeAmount").html("Total Change: $" + changeAmount);

        //Check if cashier enters right amount, then enable or disable save payment btn

        if(changeAmount >= 0){
            $('.btn-save-payment').prop('disabled', false);
        } else {
            $('.btn-save-payment').prop('disabled', true);
        }
    });


    // Save Payment

    $(".btn-save-payment").click(function() {
        var receivedAmount = $("#received-amount").val();
        var paymentType = $("#payment-type").val();
        var saleId = SALE_ID;
        $.ajax({
            type: "POST",
            data: {
                "_token" : $('meta[name="csrf-token"]').attr('content'),
                "saleID" : saleId,
                "receivedAmount" : receivedAmount,
                "paymentType" : paymentType
            },
            url: "/cashier/savePayment",
            success: function(data){
                window.location.href= data;
            }
        }); 
    });

    });
    </script> 
@endsection
