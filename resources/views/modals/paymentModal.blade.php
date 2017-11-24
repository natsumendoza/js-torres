<!-- Modal -->
<div class="modal fade" id="paymentModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
       <form action="{{action('OrderController@updateByTransactionCode', $transactionCode)}}" method="POST">
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
                        <td style="text-align: center;">
                            <img src="{{URL::asset('/images/bdo_logo.png')}}" height="150" width="150">
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
                            <button id="placeOrderBtn" class="btn btn-success" onclick="window.open('https://www.bdo.com.ph/', '_blank')" type="submit">Place Order</button>
                        </td>
                    </tr>
                </table>
            </div>
        </form>
    </div>
</div>