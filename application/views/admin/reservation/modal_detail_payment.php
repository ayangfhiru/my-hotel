 <!-- Modal -->
 <div class="modal fade" id="modalPaymentDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Detail Pembayaran</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body row">
                 <div class="col">
                     <a href="<?= base_url("assets/transfer/transfer.jpg") ?>" target="_blank">
                         <img src="<?= base_url("assets/transfer/transfer.jpg") ?>" class="img-fluid" alt="Transfer">
                     </a>
                 </div>
                 <div class="col">
                     <div class="mb-3">
                         <label class="form-label">Invoice</label>
                         <input :value="invoice" class="form-control" disabled>
                     </div>
                     <div class="mb-3">
                         <label class="form-label">Payment Method</label>
                         <input :value="payMethod" class="form-control text-capitalize" disabled>
                     </div>
                     <div class="mb-3">
                         <label class="form-label">Price</label>
                         <input :value="amount" class="form-control" disabled>
                     </div>
                     <form x-bind:action="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/payment/' + paymentId + '/cancelled'" method="POST">
                         <div class="form-label">
                             <label for="note">Alasan Pembatalan</label>
                             <textarea class="form-control" id="note" name="note" rows="3" required></textarea>
                         </div>
                         <div class="flex flex-col gap-y-2 mt-3">
                             <a :href="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/payment/' + paymentId + '/completed'"
                                 class="btn btn-success w-full">
                                 Konfirmasi
                             </a>
                             <button type="submit" class="btn btn-danger w-full">Batalkan Pembayaran</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
