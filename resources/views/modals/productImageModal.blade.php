<!-- Modal -->
<div class="modal fade" id="orderImageModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Images</h4>
                <h6>(Click Image for larger view)</h6>
            </div>
            <div class="modal-body">

                <table width="100%">
                    <tr>
                        <td>Front Image:</td>
                        <td>Back Image:</td>
                    </tr>
                    <tr>
                        <td style="text-align: center"><a id="frontAnchorProduct" href="" target="_blank"><img id="frontImgSrcProduct" height="50" width="50" src=""></a></td>
                        <td style="text-align: center"><a id="backAnchorProduct" href="" target="_blank"><img id="backImgSrcProduct" height="50" width="50" src=""></a></td>
                    </tr>
                    <tr>
                        <td>Left Side Image:</td>
                        <td>Right Side Image:</td>
                    </tr>
                    <tr>
                        <td style="text-align: center"><a id="leftAnchorProduct" href="" target="_blank"><img id="leftImgSrcProduct" height="50" width="50" src=""></a></td>
                        <td style="text-align: center"><a id="rightAnchorProduct" href="" target="_blank"><img id="rightImgSrcProduct" height="50" width="50" src=""></a></td>
                    </tr>

                </table>
            </div>
            {{--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>--}}
        </div>
    </div>
</div>