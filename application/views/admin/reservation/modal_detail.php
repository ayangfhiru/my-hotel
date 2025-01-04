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
                 <div class="row">
                     <div class="col">
                         <label class="form-label">Payment Method</label>
                         <input :value="payMethod" class="form-control text-capitalize" disabled>
                     </div>
                     <div class="col">
                         <label class="form-label">Price</label>
                         <input :value="amount" class="form-control" disabled>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>

                 <button x-show="resStatus === 'pending'" type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalReservationCancelled">
                     Cancelled
                 </button>

                 <a x-show="resStatus === 'pending'"
                     :href="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/confirmed'"
                     class="btn btn-success">
                     Konfirmasi
                 </a>

                 <a x-show="resStatus === 'confirmed' || resStatus === 'in_house'"
                     :href="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/checked-in'"
                     class="btn btn-primary">
                     Check In <i class="fa-solid fa-arrow-right-to-bracket"></i>
                 </a>
                 <a x-show="resStatus === 'confirmed'"
                     :href="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/in-house'"
                     class="btn btn-primary">
                     In House <i class="fa-regular fa-clock"></i>
                 </a>

                 <a x-show="resStatus === 'checked_in'"
                     :href="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/checked-out'"
                     class="btn btn-primary">
                     Check Out <i class="fa-solid fa-arrow-right-from-bracket"></i>
                 </a>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
