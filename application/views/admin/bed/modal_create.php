<!-- Modal -->
<div class="modal fade" id="modalBedCreate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Perlengkapan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= site_url('bed/store') ?>" method="POST">
                    <div class="mb-3">
                        <label for="bed_name" class="form-label">Nama Tempat Tidur</label>
                        <input type="text" id="bed_name" name="bed_name" value="<?= set_value('bed_name') ?>" class="form-control">
                        <?= form_error('bed_name', '<span class="text-danger ml-2">', '</span>') ?>
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
