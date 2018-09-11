<?php

if (request()->flash('success')) {
    ?>
    <div class="alert alert-success"><?= trans('success.' . request()->flash('success')) ?></div>
    <?php
}

if (request()->flash('error')) {
    ?>
    <div class="alert alert-danger"><?= trans('errors.' . request()->flash('error')) ?></div>
    <?php
}
