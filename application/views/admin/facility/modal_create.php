 <!-- Modal -->
 <div class="modal fade" id="modalFacilityCreate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Tambah Fasilitas</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="<?= site_url('facility/store') ?>" method="POST">
                     <div class="mb-3">
                         <label for="facility_name" class="form-label">Nama Fasilitas</label>
                         <input type="text" id="facility_name" name="facility_name" value="<?= set_value('facility_name') ?>" class="form-control">
                         <?= form_error('facility_name', '<span class="text-danger ml-2">', '</span>') ?>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                         <button type="submit" class="btn btn-primary">Tambah</button>
                     </div>
                 </form>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
