<!-- Modal -->
<div class="modal fade" id="modalRoomStatus" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Set Status Room</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="section-body">
                    <?= form_open('', [
                        'method' => 'POST',
                        'x-bind:action' => "'" . site_url() . "hotel/' + hotelId + '/room-code/' + roomCodeId + '/update-status'"
                    ]); ?>
                    <div class="mb-3">
                        <?= form_label('Room Code'); ?>
                        <?= form_input([
                            'name' => 'room_code',
                            'value' => set_value('room_code', $roomCode),  // Assuming $roomCode is a variable you have in the controller
                            'class' => 'form-control',
                            'disabled' => 'disabled'
                        ]); ?>
                    </div>
                    <div class="mb-3">
                        <?= form_label('Room Status'); ?>
                        <?= form_dropdown('room_status', [
                            'VC' => 'VC (Vacant Clean)',
                            'VD' => 'VD (Vacant Dirty)',
                            'OO' => 'OO (Out of Order)',
                            'HU' => 'HU (Hold Unit)',
                            'O' => 'O (Occupied)',
                            'DND' => 'DND (Do Not Disturb)',
                            'SO' => 'SO (Sleep Out)',
                            'CI' => 'CI (Check In)',
                            'CO' => 'CO (Check Out)',
                            'ONL' => 'ONL (Online)',
                            'DL' => 'DL (Deposit)'
                        ], set_value('room_status', $roomStatus), ['class' => 'custom-select']); ?>
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
</div>
<!-- End Modal -->
