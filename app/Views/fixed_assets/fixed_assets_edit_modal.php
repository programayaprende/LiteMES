<!--fixed_assets_edit_modal-->
<!--begin:Modal-->
<div class="modal fade" id="editFixedAssetModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Fixed Asset</h5> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body" style="height: 500px;">
                <!--begin::Form-->
                <form id="form-edit-modal">
                    <input type="hidden" name="id_fixed_asset" value="">
                    <div class="form-group">    
                        <label for="exampleTextarea">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" rows="3" name="description"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Part Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  placeholder="Part Number" name="part_number"/>
                    </div>

                    <div class="form-group">
                        <label>Brand <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  placeholder="Brand" name="brand"/>
                    </div>

                    <div class="form-group">
                        <label>Model <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  placeholder="Model" name="model"/>
                    </div>

                    <div class="form-group">
                        <label>Serial No. <span class="text-danger">*</span></label>
                        <input type="text" class="form-control"  placeholder="Serial No." name="serial_no"/>
                    </div>

                    <div class="form-group">
                        <label>Import Petition</label>
                        <input type="text" class="form-control"  placeholder="Import Petition" name="import_petition"/>
                    </div>

                    <div class="form-group">
                        <label>Tariff Heading</label>
                        <input type="text" class="form-control"  placeholder="Tariff Heading" name="tariff_heading" maxlength="3"/>
                    </div>

                    <div class="form-group">
                        <label>Key</label>
                        <input type="text" class="form-control"  placeholder="Key" name="key"/>
                    </div>
                    
                    
                </form>
                <!--end::Form-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold save-edit-modal" >Save</button>                
            </div>
        </div>
    </div>
</div>
<!--end:Modal-->