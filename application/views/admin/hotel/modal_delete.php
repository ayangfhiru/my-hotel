 <!-- Modal -->
 <div class="modal fade" id="modalHotelDelete" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Hapus Hotel</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 Are you sure you want to delete
                 <span x-text="hotelName"></span>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                 <button id="hotelDelete" :data-id="hotelId" data-url="<?= site_url() ?>" class="btn btn-danger">Remove</button>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
