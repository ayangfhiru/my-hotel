 <!-- Modal -->
 <div class="modal fade" id="modalPaymentDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Detail Pembayaran</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body row">
                 <div class="col">
                     <a :href="'<?= base_url() ?>assets/transfer/' + payImg" target="_blank">
                         <img :src="'<?= base_url() ?>assets/transfer/' + payImg" class="img-fluid">
                     </a>
                 </div>
                 <div class="col">
                     <div class="mb-3">
                         <label class="form-label">Invoice</label>
                         <input :value="payInvoice" class="form-control" disabled>
                     </div>
                     <div class="mb-3">
                         <label class="form-label">Total</label>
                         <input :value="payAmount" class="form-control" disabled>
                     </div>
                     <form x-bind:action="'<?= site_url() ?>payment/' + payId + '/reservation/' + resId + '/cancel'" method="POST">
                         <div class="form-label" x-show="payStatus !== 'completed'">
                             <label for="note">Alasan Pembatalan</label>
                             <textarea class="form-control" id="note" name="note" rows="3" x-text="hotelId" :disabled="payStatus === 'failed'"></textarea>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                             <button x-show="payStatus === 'pending'" type="button" class="btn btn-success">Confirm</button>
                             <button x-show="payStatus === 'pending'" type="submit" class="btn btn-danger">Batalkan</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
