<!-- Modal -->
<div class="modal fade" id="modalServiceUpdate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Update Serivce</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form
                    x-bind:action="'<?= site_url() ?>service/update/' + serId" method="POST">
                    <div class="mb-3">
                        <label for="service_name" class="form-label">Service</label>
                        <input
                            type="text"
                            id="service_name"
                            name="service_name"
                            :value="serName"
                            class="form-control">
                        <?= form_error('service_name', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="service_price" class="form-label">Harga</label>
                        <input
                            type="number"
                            id="service_price"
                            name="service_price"
                            :value="serPrice"
                            class="form-control">
                        <?= form_error('service_price', '<span class="text-danger ml-2">', '</span>') ?>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" x-model="serDesc"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
