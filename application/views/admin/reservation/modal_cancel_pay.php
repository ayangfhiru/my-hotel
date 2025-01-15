 <!-- Modal -->
 <div class="modal fade" id="modalPaymentCancelled" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Pembatalan Pembayaran</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form x-bind:action="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/cancelled'" method="POST">
                     <div class="form-label">
                         <label for="note">Alasan Pembatalan</label>
                         <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Batalkan Reservasi</button>
                     </div>

                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
