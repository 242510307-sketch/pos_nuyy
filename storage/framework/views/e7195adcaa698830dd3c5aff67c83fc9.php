

<?php $__env->startSection('title', 'Edit Jenis Produk'); ?>

<?php $__env->startSection('content'); ?>

<style>
    .jenis-edit-page {
        max-width: 900px;
        margin: 0 auto;
    }

    .edit-header {
        position: relative;
        overflow: hidden;
        border-radius: 20px;
        color: #fff;
        background: linear-gradient(
            135deg,
            #0d6efd 0%,
            #0dcaf0 100%
        );
    }

    .edit-header::before {
        content: "";
        position: absolute;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
        top: -140px;
        right: -60px;
    }

    .edit-header::after {
        content: "";
        position: absolute;
        width: 180px;
        height: 180px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
        bottom: -100px;
        left: -60px;
    }

    .edit-header-content {
        position: relative;
        z-index: 2;
    }

    .edit-icon {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 17px;
        background: rgba(255,255,255,.18);
        font-size: 27px;
    }

    .form-card {
        border: none;
        border-radius: 20px;
        background: #fff;
    }

    .form-label {
        color: #343a40;
        font-weight: 600;
    }

    .form-control {
        padding: 12px 15px;
        border-radius: 12px;
        border: 1px solid #dee2e6;
    }

    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 .2rem rgba(13,110,253,.12);
    }

    .current-type {
        padding: 18px;
        border: 1px solid #e8f1ff;
        border-radius: 15px;
        background: #f8fbff;
    }

    .current-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 16px;
        border-radius: 50px;
        color: #0d6efd;
        background: rgba(13,110,253,.10);
        font-weight: 600;
    }

    .btn-simpan,
    .btn-kembali,
    .btn-hapus {
        padding: 10px 20px;
        border-radius: 50px;
        font-weight: 600;
    }

    .danger-box {
        margin-top: 30px;
        padding: 20px;
        border: 1px solid #f5c2c7;
        border-radius: 16px;
        background: #fff5f5;
    }

    .danger-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        border-radius: 14px;
        color: #dc3545;
        background: rgba(220,53,69,.10);
        font-size: 21px;
    }

    @media (max-width: 576px) {

        .jenis-edit-page {
            padding-left: 8px;
            padding-right: 8px;
        }

        .edit-header {
            border-radius: 16px;
        }

        .danger-box .d-flex {
            align-items: flex-start !important;
        }

        .btn-hapus {
            width: 100%;
        }
    }
</style>


<div class="container-fluid py-4 jenis-edit-page">

    
    <div class="edit-header shadow-sm p-4 p-md-5 mb-4">

        <div class="edit-header-content">

            <div class="d-flex align-items-center">

                <div class="edit-icon me-3">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <div>

                    <h3 class="fw-bold mb-1">
                        Edit Jenis Produk
                    </h3>

                    <p class="mb-0 opacity-75">
                        Perbarui informasi jenis produk.
                    </p>

                </div>

            </div>

        </div>

    </div>


    
    <?php if($errors->any()): ?>

        <div class="alert alert-danger border-0 rounded-4 shadow-sm">

            <div class="fw-bold mb-2">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                Terjadi kesalahan
            </div>

            <ul class="mb-0">

                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </ul>

        </div>

    <?php endif; ?>


    
    <div class="card form-card shadow-sm">

        <div class="card-body p-4 p-md-5">

            
            <div class="current-type mb-4">

                <small class="text-muted d-block mb-2">
                    Jenis saat ini
                </small>

                <span class="current-badge">

                    <i class="bi bi-tag-fill"></i>

                    <?php echo e($jenis->nama_jenis); ?>


                </span>

            </div>


            
            <form
                action="<?php echo e(route('jenis.update', $jenis->id)); ?>"
                method="POST"
            >

                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <div class="mb-4">

                    <label
                        for="nama_jenis"
                        class="form-label"
                    >
                        Nama Jenis
                    </label>

                    <input
                        type="text"
                        name="nama_jenis"
                        id="nama_jenis"
                        class="form-control <?php $__errorArgs = ['nama_jenis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        value="<?php echo e(old('nama_jenis', $jenis->nama_jenis)); ?>"
                        placeholder="Masukkan nama jenis"
                        required
                    >

                    <?php $__errorArgs = ['nama_jenis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>

                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                </div>


                
                <div class="d-flex flex-wrap gap-2">

                    <button
                        type="submit"
                        class="btn btn-primary btn-simpan"
                    >
                        <i class="bi bi-check-lg me-1"></i>
                        Simpan Perubahan
                    </button>

                    <a
                        href="<?php echo e(route('jenis.index')); ?>"
                        class="btn btn-secondary btn-kembali"
                    >
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>

                </div>

            </form>


            
            <div class="danger-box">

                <div class="d-flex justify-content-between align-items-center gap-3">

                    <div class="d-flex align-items-center">

                        <div class="danger-icon me-3">
                            <i class="bi bi-trash3-fill"></i>
                        </div>

                        <div>

                            <h6 class="fw-bold text-danger mb-1">
                                Hapus Jenis
                            </h6>

                            <small class="text-muted">
                                Jenis ini akan dihapus secara permanen.
                            </small>

                        </div>

                    </div>


                    <form
                        action="<?php echo e(route('jenis.destroy', $jenis->id)); ?>"
                        method="POST"
                    >

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>

                        <button
                            type="submit"
                            class="btn btn-danger btn-hapus"
                            onclick="return confirm('Yakin ingin menghapus jenis ini?')"
                        >
                            <i class="bi bi-trash3 me-1"></i>
                            Hapus
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_nuy\resources\views\jenis\edit.blade.php ENDPATH**/ ?>