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
                 <form x-bind:action="'<?= site_url() ?>hotel/' + hotelId + '/room-code/' + roomCodeId + '/update-status'" method="POST">
                     <div class="mb-3">
                         <label class="form-label">Room Code</label>
                         <input :value="roomCode" class="form-control" disabled>
                     </div>
                     <div class="mb-3">
                         <label class="form-label">Room Status</label>
                         <select name="room_status" id="room_status" class="custom-select">
                             <option value="VC">VC (Vacant Clean)</option>
                             <option value="VD">VD (Vacant Dirty)</option>
                             <option value="OO">OO (Out of Order)</option>
                             <option value="HU">HU (Hold Unit)</option>
                             <option value="O">O (Occupied)</option>
                             <option value="DND">DND (Do Not Disturb)</option>
                             <option value="SO">SO (Sleep Out)</option>
                             <option value="CI">CI (Check In)</option>
                             <option value="CO">CO (Check Out)</option>
                             <option value="ONL">ONL (Online)</option>
                             <option value="DL">DL (Deposit)</option>
                         </select>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Update</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
