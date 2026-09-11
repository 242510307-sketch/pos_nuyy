

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Tambah Jenis</h1>

        <a href="<?php echo e(route('jenis.index')); ?>" class="btn btn-secondary">
            Kembali
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <ul class="mb-0">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">

            <form action="<?php echo e(route('jenis.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>

                <div class="mb-3">
                    <label for="nama_jenis" class="form-label">
                        Nama Jenis
                    </label>

                    <input
                        type="text"
                        name="nama_jenis"
                        id="nama_jenis"
                        class="form-control"
                        value="<?php echo e(old('nama_jenis')); ?>"
                        placeholder="Masukkan nama jenis"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

                <a href="<?php echo e(route('jenis.index')); ?>" class="btn btn-secondary">
                    Batal
                </a>
            </form>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_nuy\resources\views\jenis\create.blade.php ENDPATH**/ ?>