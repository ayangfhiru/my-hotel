 <!-- Modal -->
 <div class="modal fade" id="modalReservationSetStatus" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Set Status</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form x-bind:action="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/payment/' + paymentId + '/set-status'" method="POST">
                     <div class="mb-3">
                         <label class="form-label">Invoice</label>
                         <input :value="invoice" class="form-control" disabled>
                     </div>
                     <div class="mb-3 row">
                         <div class="col">
                             <label class="form-label">Payment Method</label>
                             <input :value="payMethod" class="form-control text-capitalize" disabled>
                         </div>
                         <div class="col">
                             <label class="form-label">Payment Status</label>
                             <input :value="payStatus" class="form-control text-capitalize" disabled>
                         </div>
                     </div>
                     <div class="mb-3 row">
                         <div class="col">
                             <label class="form-label">Amount</label>
                             <input :value="amount" class="form-control text-capitalize" disabled>
                         </div>
                         <div class="col">
                             <label class="form-label">Set Status</label>
                             <select class="form-control" id="set_status" name="set_status">
                                 <option value="pending">Pending</option>
                                 <option value="completed">Completed</option>
                                 <option value="failed">Failed</option>
                             </select>
                         </div>
                     </div>
                     <!-- <div class="mb-3">
                         <a href="https://www.sentraalquran.com/wp-content/uploads/DP-pertama-pemesanan-400-pcs-Al-Quran-Souvenir-276x600.jpg" target="_blank">
                             <img src="https://www.sentraalquran.com/wp-content/uploads/DP-pertama-pemesanan-400-pcs-Al-Quran-Souvenir-276x600.jpg" alt="" class="img-thumbnail" style="height: 100px;">
                         </a>
                     </div> -->
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
