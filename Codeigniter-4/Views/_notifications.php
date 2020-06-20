<?php if (session()->has('success')) : ?>
    <div class="notification success">
        <?= session('success') ?>
    </div>
<?php endif ?>

<?php if (session()->has('error')) : ?>
    <div class="notification error text-danger">
        <?= session('error') ?>
    </div>
<?php endif ?>

<?php if (session()->has('errors')) : ?>
    <ul class="notification error text-danger">
    <?php foreach (session('errors') as $error) : ?>
        <li><?= $error ?></li>
    <?php endforeach ?>
    </ul>
<?php endif ?>
