 <!-- Modal -->
 <div class="modal fade" id="modalFacilityUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="staticBackdropLabel">Update Fasilitas</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <?= form_open(site_url(), [
                        'method' => 'POST',
                        'x-bind:action' => "'/facility/update/' + facilityId"
                    ]); ?>
                 <div class="mb-3">
                     <?= form_label('Nama Fasilitas', 'facility_name', ['class' => 'form-label']); ?>
                     <?= form_input('facility_name', '', [
                            'id' => 'facility_name',
                            'class' => 'form-control',
                            ':value' => 'facilityName'
                        ]); ?>
                     <?= form_error('facility_name', '<span class="text-danger ml-2">', '</span>') ?>
                 </div>
                 <div class="mb-3">
                     <div class="d-flex">
                         <?= form_label('Icon', 'icon', ['class' => 'form-label mr-2']); ?>
                         <a href="https://fontawesome.com/search" target="_blank">
                             <i class="fa-solid fa-arrow-up-right-from-square"></i>
                         </a>
                     </div>
                     <?= form_input('icon', '', [
                            'id' => 'icon',
                            'class' => 'form-control'
                        ]); ?>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
                     <button type="submit" class="btn btn-primary">Update</button>
                 </div>
                 <?= form_close(); ?>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->
