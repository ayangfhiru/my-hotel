<!-- Modal -->
<div class="modal fade" id="modalBedUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Tempat Tidur</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open(site_url(), [
                    'method' => 'POST',
                    'x-bind:action' => "'bed/update/' + bedId"
                ]); ?>
                <div class="mb-3">
                    <?= form_label('Tipe Bed', 'bed_type', ['class' => 'form-label']); ?>
                    <?= form_input('bed_type', '', [
                        'id' => 'bed_type',
                        'class' => 'form-control',
                        ':value' => 'bedType'
                    ]); ?>
                    <?= form_error('bed_name', '<span class="text-danger ml-2">', '</span>') ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
