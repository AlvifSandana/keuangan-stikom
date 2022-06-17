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

<?php if (session()->getFlashdata('info')) { ?>
    <div class="row mb-2">
        <div class="col">
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <strong>Info: </strong> <?= session()->getFlashData('info') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (session()->getFlashdata('warning')) { ?>
    <div class="row mb-2">
        <div class="col">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Warning: </strong> <?= session()->getFlashData('warning') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
<?php } ?>
