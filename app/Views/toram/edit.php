<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">form ubah data kelas</h2>
            <form action="/toram/update/<?= $toram['id']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="slug" value="<?= $toram['slug']; ?>">
                <input type="hidden" name="sampulLama" value="<?= $toram['sampul']; ?>">
                <div class="row mb-3">
                    <label for="kelas" class="col-sm-2 col-form-label">kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="kelas" autofocus value="<?= (old('kelas')) ? old('kelas') : $toram['kelas'] ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('kelas'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="senjata" class="col-sm-2 col-form-label">senjata</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('senjata')) ? 'is-invalid' : ''; ?>" id="senjata" name="senjata" value="<?= (old('senjata')) ? old('senjata') : $toram['senjata'] ?>">

                    </div>
                </div>
                <div class="row mb-3">
                    <label for="sampul" class="col-sm-2 col-form-label">sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $toram['sampul']; ?>" class="img-thumbnail img-preview">
                    </div>
                    <div class="col-sm-8">
                        <div class="costum=file">
                            <input class="form-control " type="file" <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?> id="sampul" name="sampul" onchange="previewImg()">
                            <div class=" invalid-feedback">
                                <?= $validation->getError('sampul'); ?>
                            </div>
                        </div>
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Ubah Data</button>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>