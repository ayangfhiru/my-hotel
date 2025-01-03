 <!-- Modal -->
 <div class="modal fade" id="modalDateReservation" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Cek Hotel</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="<?= site_url("hotel/$hotelId/room/search") ?>" method="POST">
                     <div class="mb-3 form-row">
                         <div class="col">
                             <label for="check_in" class="form-label">Check In</label>
                             <input type="date" id="check_in" name="check_in" value="<?= set_value('check_in') ?>" class="form-control">
                             <?= form_error('check_in', '<span class="text-danger ml-2">', '</span>') ?>
                         </div>
                         <div class="col">
                             <label for="check_out" class="form-label">Check Out</label>
                             <input type="date" id="check_out" name="check_out" value="<?= set_value('check_out') ?>" class="form-control">
                             <?= form_error('check_out', '<span class="text-danger ml-2">', '</span>') ?>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-success">Search Room</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
