<?php if (session()->getFlashdata('success')) { ?>
    <div class="row mb-2">
        <div class="col">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Complete!</strong> <?= session()->getFlashData('success') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (session()->getFlashdata('error')) { ?>
    <div class="row mb-2">
        <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> <?= session()->getFlashData('error') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php } ?>