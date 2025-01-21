 <!-- Modal -->
 <div class="modal fade" id="modalRoomCodeUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Update Room Code</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <?= form_open(site_url(), [
                        'method' => 'POST',
                        'x-bind:action' => "'/hotel/' + hotelId + '/room/' + roomId + '/room-code/' + roomCodeId + '/update'",
                    ]); ?>
                 <div class="mb-3">
                     <?= form_label('Room Code', 'foom_code', ['class' => 'form-label']); ?>
                     <?= form_input('room_code', '', [
                            'id' => 'room_code',
                            'x-bind:value' => 'roomCode',
                            'class' => 'form-control'
                        ]); ?>
                     <?= form_error('room_code', '<span class="text-danger ml-2">', '</span>') ?>
                 </div>
                 <div class="mb-3">
                     <?= form_label('Room Status', 'room_status', ['class' => 'form-label']); ?>
                     <select id="room_status" name="room_status" class="form-control">
                         <?php foreach ($room_status as $sta): ?>
                             <option value="<?= $sta ?>"><?= $sta; ?></option>
                         <?php endforeach ?>
                     </select>
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

 <script>
     function timestampConverter(clientExists) {
         return {
             timestamp: clientExists,
             humanReadble: '',
             init() {
                 const date = new Date(this.timestamp * 1000);

                 const year = date.getFullYear();
                 const month = String(date.getMonth() + 1).padStart(2, '0');
                 const day = String(date.getDate()).padStart(2, '0');
                 this.humanReadble = `${year}-${month}-${day}`;
             }
         }
     }
 </script>

 <!-- End Modal -->
