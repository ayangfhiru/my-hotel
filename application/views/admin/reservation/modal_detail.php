<!-- Modal -->
<div class="modal fade" id="modalReservationDetail" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <div class="w-100 d-flex justify-content-between align-items-center mr-3">
                    <div class="flex gap-x-3 items-center">
                        <h5 class="modal-title" id="staticBackdropLabel">
                            Detail
                        </h5>
                        <a :href="'<?= base_url() ?>reservation/'+ reservationId +'/detail'" target="_blank">
                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                        </a>
                    </div>

                    <a x-bind:href="'<?= site_url() ?>reservation/' + reservationId + '/invoice'" target="_blank">
                        <i class="fa-solid fa-print fa-2xl"></i>
                    </a>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <!-- <div class="col">
                    <form action="">
                        <div class="form-label mb-3">
                            <label for="request">Request</label>
                            <textarea class="form-control" rows="5" id="request" x-model="resRequest" disabled></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="cost" class="form-label">Biaya Tambahan</label>
                            <input id="cost" name="cost" class="form-control">
                        </div>
                    </form>
                </div> -->
                <div class="col">
                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input :value="fullName" class="form-control" disabled>
                    </div>
                    <div class="mb-3 row">
                        <div class="col">
                            <label class="form-label">Reservation</label>
                            <input :value="resStatus" class="form-control text-capitalize" disabled>
                        </div>
                        <div class="col">
                            <label class="form-label">Payment</label>
                            <input :value="payStatus" class="form-control text-capitalize" disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label class="form-label">Check In</label>
                            <input :value="checkIn" class="form-control text-capitalize" disabled>
                        </div>
                        <div class="col">
                            <label class="form-label">Check Out</label>
                            <input :value="checkOut" class="form-control" disabled>
                        </div>
                    </div>
                    <div x-show="cancelNote">
                        <label class="form-label">Note</label>
                        <textarea class="form-control" id="note" rows="3" x-model="cancelNote" disabled></textarea>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <!-- <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalReservationCancelled">
                        Konfirmasi
                    </button>
                </div> -->
                <div class="col d-flex justify-content-end" style="gap: 5px;">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>

                    <button x-show="resStatus === 'pending'" type="button" class="btn btn-danger" data-dismiss="modal" data-toggle="modal" data-target="#modalReservationCancelled">
                        Pembalatalan
                    </button>

                    <button
                        x-show="payStatus === 'completed'"
                        value="confirm"
                        class="btn btn-success">Konfirmasi</button>
                    <!-- <a x-show="payStatus === 'completed'"
                        :href="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/confirmed'"
                        class="btn btn-success">
                        Konfirmasi
                    </a> -->

                    <button
                        x-show="resStatus === 'confirmed' || resStatus === 'in_house'"
                        value="check_in"
                        class="btn btn-primary">
                        Check In <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </button>
                    <!-- <a x-show="resStatus === 'confirmed' || resStatus === 'in_house'"
                        :href="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/checked-in'"
                        class="btn btn-primary">
                        Check In <i class="fa-solid fa-arrow-right-to-bracket"></i>
                    </a> -->

                    <button
                        x-show="resStatus === 'confirmed'"
                        value="in_house"
                        class="btn btn-primary">
                        In House <i class="fa-regular fa-clock"></i>
                    </button>
                    <!-- <a x-show="resStatus === 'confirmed'"
                        :href="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/in-house'"
                        class="btn btn-primary">
                        In House <i class="fa-regular fa-clock"></i>
                    </a> -->

                    <button
                        x-show="resStatus === 'check_in'"
                        value="check_out"
                        class="btn btn-primary">
                        Check Out <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </button>
                    <!-- <a x-show="resStatus === 'checked_in'"
                        :href="'<?= site_url() ?>hotel/' + hotelId + '/reservation/' + reservationId + '/checked-out'"
                        class="btn btn-primary">
                        Check Out <i class="fa-solid fa-arrow-right-from-bracket"></i>
                    </a> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->
