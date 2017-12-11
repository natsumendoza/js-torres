<!-- Modal -->
<div class="modal fade" id="paymentModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
       <form action="{{action('OrderController@updateByTransactionCode', $transactionCode)}}" method="POST">
           <input type="hidden" name="total_quantity" id="total_quantity" value="{{$totalQuantity}}">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">You'll be paying via BDO: </h4>
                </div>
                <table width="95%">
                    <tr>
                        <td colspan="3">&nbsp;<!-- spacer --></td>
                    </tr>
                    <tr>
                        <td style="text-align: center;" colspan="3">
                            <img src="{{URL::asset('/images/bdo_logo.png')}}" height="150" width="150">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;<!-- spacer --></td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;<!-- spacer --></td>
                    </tr>
                    <tr>
                        <td style="width: 170px;text-align: center; margin-right: 20px;"><span style="font-size: 15px;"><b>Choose Order Type: </b></span></td>
                        <td>
                            <label><input type="radio" name="order_type" value="{{config('constants.ORDER_TYPE_PICKUP')}}" checked><span style="font-size: 15px;"><b>Pickup</b></span></label>
                        </td>
                        <td>
                            <label><input type="radio" name="order_type" value="{{config('constants.ORDER_TYPE_DELIVER')}}"><span style="font-size: 15px;"><b>Deliver</b></span></label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: center;font-style: italic;" id="total_qty_note"></td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;<!-- spacer --></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="placeOrderBtn" class="btn btn-success" onclick="window.open('https://www.bdo.com.ph/', '_blank')" type="submit">Place Order</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('input[type=radio][name=order_type]').on('change', function() {
            if (this.value == 'Pickup') {
                $('#total_qty_note').text('');
            }
            else if (this.value == 'Deliver') {
                if($('#total_quantity').val() < 20)
                {
                    $('#total_qty_note').text("Note: Your order's quantity is below 20 items. You'll be paying extra ₱170.00 upon delivery.");
                }
            }
        });
    });
</script>