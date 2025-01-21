<!-- Modal -->
<div class="modal fade" id="modalDateReservation" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Cek Hotel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open(site_url("hotel/$hotelId/room/search")); ?>
                <div class="mb-3 form-row">
                    <div class="col">
                        <?= form_label('Check In', 'check_in', ['class' => 'form-label']); ?>
                        <?= form_input([
                            'name' => 'check_in',
                            'id' => 'check_in',
                            'type' => 'date',
                            'value' => set_value('check_in'),
                            'class' => 'form-control'
                        ]); ?>
                        <?= form_error('check_in', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                    <div class="col">
                        <?= form_label('Check Out', 'check_out', ['class' => 'form-label']); ?>
                        <?= form_input([
                            'name' => 'check_out',
                            'id' => 'check_out',
                            'type' => 'date',
                            'value' => set_value('check_out'),
                            'class' => 'form-control'
                        ]); ?>
                        <?= form_error('check_out', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Search Room</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
