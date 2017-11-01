<!-- Modal -->
<div class="modal fade" id="paymentModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <form action="{{action('OrderController@updateByTransactionCode', $transactionCode)}}" method="POST">
            <p>{{$transactionCode}}</p>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Choose mode of payment: </h4>
                </div>
                <table width="95%">
                    <tr>
                        <td colspan="3">&nbsp;<!-- spacer --></td>
                    </tr>
                    <tr>
                        <td width="20px;">&nbsp;</td>
                        <td>
                            <label><input type="radio" name="payment_mode" value="COD" checked><span style="font-size: 20px;"><b>Cash on delivery</b></span></label>
                        </td>
                        <td>
                            <label><input type="radio" name="payment_mode" value="BDO"><img src="{{URL::asset('/img/bdo_logo.png')}}" height="70" width="70"></label>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">&nbsp;<!-- spacer --></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="text-align: right">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button class="btn btn-success" type="submit">Checkout</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>