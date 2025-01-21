<!-- Modal -->
<div class="modal fade" id="modalServiceCreate" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Serivce</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?= form_open('service/store'); ?>
                <div class="mb-3">
                    <?= form_label('Service', 'service_name', ['class' => 'form-label']); ?>
                    <?= form_input('service_name', '', [
                        'id' => 'service_name',
                        'class' => 'form-control'
                    ]) ?>
                </div>
                <div class="mb-3">
                    <?= form_label('Harga', 'service_price', ['class' => 'form-label']); ?>
                    <?= form_input([
                        'name' => 'service_price',
                        'id' => 'service_price',
                        'type' => 'number',
                        'class' => 'form-control'
                    ]) ?>
                </div>
                <div class="mb-3">
                    <?= form_label('Deskripsi', 'description', ['class' => 'form-label']); ?>
                    <?= form_textarea('description', '', [
                        'id' => 'description',
                        'class' => 'form-control'
                    ]) ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
