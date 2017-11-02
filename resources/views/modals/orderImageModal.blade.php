<!-- Modal -->
<div class="modal fade" id="orderImageModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Order Images</h4>
            </div>
            <div class="modal-body">

                <table width="100%">
                    <tr>
                        <td>Front Image:</td>
                        <td>Back Image:</td>
                    </tr>
                    <tr>
                        <td style="text-align: center"><a id="frontAchor" href="#" target="_blank"><img id="frontImgSrc" height="50" width="50" src="{{URL::asset('/orderimages/'.@$frontImage)}}"></a></td>
                        <td style="text-align: center"><a id="backAchor"href="{{URL::asset('/orderimages/'.@$backImage)}}" target="_blank"><img id="backImgSrc" height="50" width="50" src="{{URL::asset('/orderimages/'.@$backImage)}}"></a></td>
                    </tr>
                    <tr>
                        <td>Left Side Image:</td>
                        <td>Right Side Image:</td>
                    </tr>
                    <tr>
                        <td style="text-align: center"><a id="leftAchor" href="{{URL::asset('/orderimages/'.@$leftImage)}}" target="_blank"><img id="leftImgSrc" height="50" width="50" src="{{URL::asset('/orderimages/'.@$leftImage)}}"></a></td>
                        <td style="text-align: center"><a id="rightAchor" href="{{URL::asset('/orderimages/'.@$rightImage)}}" target="_blank"><img id="rightImgSrc" height="50" width="50" src="{{URL::asset('/orderimages/'.@$rightImage)}}"></a></td>
                    </tr>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>