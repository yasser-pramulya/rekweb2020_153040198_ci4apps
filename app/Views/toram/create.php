<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">form tambah data kelas</h2>

            <form action="/toram/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="row mb-3">
                    <label for="kelas" class="col-sm-2 col-form-label">kelas</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="kelas" autofocus value="<?= old('kelas'); ?>">
                        <div class=" invalid-feedback">
                            <?= $validation->getError('kelas'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="senjata" class="col-sm-2 col-form-label">senjata</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('senjata')) ? 'is-invalid' : ''; ?>" id="senjata" name="senjata" value="<?= old('senjata'); ?>">

                    </div>
                </div>
                <div class="form=group row">
                    <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview">
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


                <div class="form-group row">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Tambah Data</button>
                    </div>


                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>