 <!-- Modal -->
 <div class="modal fade" id="modalRoomCodeDelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Hapus Kode Kamar</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 Are you sure you want to delete
                 <span x-text="roomCode" class=""></span>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                 <button id="roomCodeId" data-url="<?= site_url() ?>" :data-id="roomCodeId" class="btn btn-danger">Delete</button>
                 <!-- <a
                     :href="'<?= site_url() ?>hotel/'+ hotelId +'/room/'+ roomId +'/room-code/'+ roomCodeId +'/delete'" type="button"
                     class="btn btn-danger">Remove</a> -->
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
