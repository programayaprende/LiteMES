<!--fixed_assets_view_modal-->
<!--begin:Modal-->
<div class="modal fade" id="deleteFixedAssetModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Fixed Asset</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>After record delete, can not be recovered, continue?</p>
                <form id="form-delete-modal">                
                    <input type="hiddenx" name="id_fixed_asset" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">No</button>
                <button type="button" class="btn btn-primary save-delete-modal">Yes, delete</button>                                
            </div>
        </div>
    </div>
</div>
<!--end:Modal-->