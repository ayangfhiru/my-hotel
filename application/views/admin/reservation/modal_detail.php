 <!-- Modal -->
 <div class="modal fade" id="modalReservationDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <div class="w-100 d-flex justify-content-between align-items-center mr-3">
                     <h5 class="modal-title" id="staticBackdropLabel">Detail</h5>
                     <a x-bind:href="'<?= site_url() ?>reservation/' + reservationId + '/invoice'" target="_blank">
                         <i class="fa-solid fa-print fa-2xl"></i>
                     </a>
                 </div>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form>
                     <div class="mb-3">
                         <label class="form-label">Invoice</label>
                         <input :value="invoice" class="form-control" disabled>
                     </div>
                     <div class="mb-3">
                         <label class="form-label">Full Name</label>
                         <input :value="fullName" class="form-control" disabled>
                     </div>
                     <div class="mb-3">
                         <label class="form-label">Status</label>
                         <input :value="resStatus.replace('_', ' ')" class="form-control text-capitalize" disabled>
                     </div>
                     <div class="mb-3 row">
                         <div class="col">
                             <label class="form-label">Identity</label>
                             <input :value="identity" class="form-control text-uppercase" disabled>
                         </div>
                         <div class="col">
                             <label class="form-label">Identity Number</label>
                             <input :value="identityNum" class="form-control" disabled>
                         </div>
                     </div>
                     <div class="mb-3 row">
                         <div class="col">
                             <label class="form-label">Email</label>
                             <input :value="email" class="form-control" disabled>
                         </div>
                         <div class="col">
                             <label class="form-label">Phone Number</label>
                             <input :value="phoneNum" class="form-control" disabled>
                         </div>
                     </div>
                     <div class="mb-3 row">
                         <div class="col">
                             <label class="form-label">Payment Method</label>
                             <input :value="payMethod" class="form-control text-capitalize" disabled>
                         </div>
                         <div class="col">
                             <label class="form-label">Price</label>
                             <input :value="amount" class="form-control" disabled>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                         <a x-show="resStatus === 'pending'" x-bind:href="'<?= site_url() ?>hotel/' + hotelId + '/room-code/' + roomCodeId + '/reservation/' + reservationId + '/guest-cancel'" type="submit"
                             class="btn btn-danger">
                             Cancel
                         </a>
                         <a x-show="resStatus === 'confirmed'" x-bind:href="'<?= site_url() ?>hotel/' + hotelId + '/room-code/' + roomCodeId + '/reservation/' + reservationId + '/guest-in'" type="submit"
                             class="btn btn-primary">
                             Check In
                             <i class="fa-solid fa-arrow-right-to-bracket"></i>
                         </a>
                         <a x-show="resStatus === 'in_house'" x-bind:href="'<?= site_url() ?>hotel/' + hotelId + '/room-code/' + roomCodeId + '/reservation/' + reservationId + '/guest-out'" type="submit"
                             class="btn btn-primary">
                             Check Out
                             <i class="fa-solid fa-arrow-right-from-bracket"></i>
                         </a>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
