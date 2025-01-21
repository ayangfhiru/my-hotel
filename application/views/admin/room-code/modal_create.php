 <!-- Modal -->
 <div class="modal fade" id="modalRoomCodeCreate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Tambah Room Code</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <?= form_open("hotel/$hotelId/room/$roomId/room-code/store") ?>
                 <div class="mb-3">
                     <label for="room_code" class="form-label">Room Code</label>
                     <?= form_input(['name' => 'room_code', 'id' => 'room_code', 'value' => set_value('room_code'), 'class' => 'form-control']) ?>
                     <?= form_error('room_code', '<span class="text-danger ml-2">', '</span>') ?>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Tambah</button>
                 </div>
                 <?= form_close() ?>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
