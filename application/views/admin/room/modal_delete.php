 <!-- Modal -->
 <div class="modal fade" id="modalRoomDelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Hapus Kamar</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 Are you sure you want to delete
                 <span x-text="roomType"></span>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <a
                     x-bind:href="'<?= site_url() ?>hotel/' + hotelId + '/room/' + roomId + '/delete'" type="button"
                     class="btn btn-danger">Remove</a>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
