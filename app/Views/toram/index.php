<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <a href="/toram/create" class="btn btn-primary mt-3">Tambah Data Kelas</a>
            <h1 class="mt-2">Daftar kelas Toram</h1>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">senjata</th>
                        <th scope="col">kelas</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($toram as $t) : ?>

                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><img src="/img/<?= $t['sampul']; ?>" alt="" class="sampul"></td>
                            <td><?= $t['kelas']; ?></td>
                            <td>
                                <a href="/toram/<?= $t['slug']; ?>" class="btn btn-success">Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>