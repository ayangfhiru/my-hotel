<!-- Modal -->
<div class="modal fade" id="modalReservationCancelled" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pembatalan Reservasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="section-body">
                    <?= form_open('', [
                        'method' => 'POST',
                        'x-bind:action' => "'" . site_url() . "hotel/' + hotelId + '/reservation/' + reservationId + '/cancelled'"
                    ]); ?>
                    <div class="form-label">
                        <?= form_label('Alasan Pembatalan', 'note'); ?>
                        <?= form_textarea([
                            'name' => 'note',
                            'id' => 'note',
                            'class' => 'form-control',
                            'rows' => '3',
                            'required' => 'required'
                        ]); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Batalkan Reservasi</button>
                    </div>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
