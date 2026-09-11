

<?php $__env->startSection('title', 'POS'); ?>

<?php $__env->startSection('content'); ?>

<div class="container-fluid">

    
    <?php if(session('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">

            <i class="bi bi-exclamation-triangle-fill me-1"></i>

            <?php echo e(session('errors')); ?>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>
    <?php endif; ?>


    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <i class="bi bi-check-circle-fill me-1"></i>

            <?php echo e(session('success')); ?>


            <button
                type="button"
                class="btn-close"
                data-bs-dismiss="alert"
            ></button>

        </div>
    <?php endif; ?>


    
    <h4 class="mb-3">

        <?php if($mode === 'edit'): ?>
            Edit Penjualan
        <?php else: ?>
            Tambah Penjualan
        <?php endif; ?>

    </h4>


    <div class="row">

        
        <div class="col-md-6">

            <div class="card">

                <div
                    class="card-body"
                    style="max-height:70vh; overflow:auto"
                >

                    
                    <div class="mb-3">

                        <form
                            method="GET"
                            action="<?php echo e(route('penjualan.create')); ?>"
                        >

                            <input
                                type="text"
                                name="search"
                                value="<?php echo e(request('search')); ?>"
                                class="form-control"
                                placeholder="Cari produk..."
                                onkeyup="this.form.submit()"
                            >

                        </form>

                    </div>


                    
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <form
                            method="POST"
                            action="<?php echo e(route('itempenjualan.store')); ?>"
                            class="row mb-2"
                        >

                            <?php echo csrf_field(); ?>

                            <input
                                type="hidden"
                                name="product_id"
                                value="<?php echo e($product->id); ?>"
                            >


                            
                            <div class="col-7">

                                <button
                                    type="button"
                                    class="btn btn-outline-primary w-100 text-start p-2
                                    <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>"
                                >

                                    <div class="d-flex align-items-center gap-2">

                                        <?php if($product->foto): ?>

                                            <img
                                                src="<?php echo e(asset('storage/' . $product->foto)); ?>"
                                                alt="<?php echo e($product->nama); ?>"
                                                class="rounded-circle"
                                                style="width:45px; height:45px; object-fit:cover"
                                            >

                                        <?php else: ?>

                                            <div
                                                class="rounded-circle bg-light d-flex align-items-center justify-content-center"
                                                style="width:45px; height:45px;"
                                            >
                                                <i class="bi bi-image text-muted"></i>
                                            </div>

                                        <?php endif; ?>


                                        <div>

                                            <div class="fw-semibold">
                                                <?php echo e($product->nama); ?>

                                            </div>

                                            <small class="text-muted">
                                                Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?>

                                            </small>

                                        </div>

                                    </div>

                                </button>

                            </div>


                            
                            <div class="col-3">

                                <input
                                    type="number"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    max="<?php echo e($product->stok); ?>"
                                    class="form-control"
                                    <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>

                                >

                            </div>


                            
                            <div class="col-2">

                                <button
                                    type="submit"
                                    class="btn btn-primary w-100"
                                    <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>

                                >
                                    +
                                </button>

                            </div>

                        </form>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <div class="text-center text-muted py-4">

                            <i class="bi bi-box-seam fs-1 d-block mb-2"></i>

                            Produk tidak ditemukan.

                        </div>

                    <?php endif; ?>

                </div>

            </div>

        </div>


        
        <div class="col-md-6">

            <div class="card">

                <div class="table-responsive">

                    <table class="table table-bordered mb-0">

                        <thead>

                            <tr>

                                <th>Produk</th>

                                <th style="width:100px;">
                                    Qty
                                </th>

                                <th>
                                    Subtotal
                                </th>

                                <th style="width:100px;">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php $__empty_1 = true; $__currentLoopData = $sale->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr>

                                    
                                    <td>

                                        <?php if($item->produk): ?>

                                            <?php echo e($item->produk->nama); ?>


                                        <?php else: ?>

                                            <span class="text-danger">

                                                <i class="bi bi-exclamation-triangle-fill me-1"></i>

                                                Produk tidak ditemukan

                                            </span>

                                            <small class="d-block text-muted">
                                                ID Produk: <?php echo e($item->produk_id); ?>

                                            </small>

                                        <?php endif; ?>

                                    </td>


                                    
                                    <td>

                                        <?php if($item->produk && $sale->status === 'OPEN'): ?>

                                            <form
                                                method="POST"
                                                action="<?php echo e(route('itempenjualan.update', $item->id)); ?>"
                                            >

                                                <?php echo csrf_field(); ?>

                                                <?php echo method_field('PUT'); ?>

                                                <input
                                                    type="number"
                                                    name="quantity"
                                                    value="<?php echo e($item->kuantitas); ?>"
                                                    min="1"
                                                    max="<?php echo e($item->produk->stok + $item->kuantitas); ?>"
                                                    class="form-control form-control-sm"
                                                    onchange="this.form.submit()"
                                                >

                                            </form>

                                        <?php else: ?>

                                            <span>
                                                <?php echo e($item->kuantitas); ?>

                                            </span>

                                        <?php endif; ?>

                                    </td>


                                    
                                    <td>

                                        Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?>


                                    </td>


                                    
                                    <td>

                                        <?php if($sale->status === 'OPEN' && $item->produk): ?>

                                            <form
                                                method="POST"
                                                action="<?php echo e(route('itempenjualan.destroy', $item->id)); ?>"
                                                onsubmit="return confirm('Hapus produk ini dari keranjang?')"
                                            >

                                                <?php echo csrf_field(); ?>

                                                <?php echo method_field('DELETE'); ?>

                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm"
                                                >
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </form>

                                        <?php endif; ?>

                                    </td>

                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>

                                    <td
                                        colspan="4"
                                        class="text-center text-muted py-4"
                                    >

                                        <i class="bi bi-cart-x fs-1 d-block mb-2"></i>

                                        Keranjang masih kosong.

                                    </td>

                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>


                
                <div class="card-footer">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <span class="fw-semibold">
                            Total Pembayaran
                        </span>

                        <strong class="fs-5 text-primary">

                            Rp <?php echo e(number_format($sale->total_pembayaran, 0, ',', '.')); ?>


                        </strong>

                    </div>


                    
                    <?php if($sale->status === 'OPEN'): ?>

                        <form
                            method="POST"
                            action="<?php echo e(route('penjualan.update', $sale->id)); ?>"
                            onsubmit="return confirm('Yakin ingin checkout transaksi ini?')"
                        >

                            <?php echo csrf_field(); ?>

                            <?php echo method_field('PUT'); ?>


                            <select
                                name="payment_method"
                                class="form-select mb-2"
                                required
                            >

                                <option value="">
                                    Pilih Pembayaran
                                </option>

                                <option value="CASH">
                                    Cash
                                </option>

                                <option value="QRIS">
                                    QRIS
                                </option>

                            </select>

                            <div id="qris-payment-fields" class="border rounded p-3 mb-2 text-center d-none">
                                <div class="fw-semibold mb-2">QRIS Pembayaran</div>
                                <div id="payment-qr" class="d-flex justify-content-center"></div>
                                <div class="small text-muted mt-2">Scan QR untuk transaksi #<?php echo e($sale->id); ?></div>
                            </div>

                            <div id="cash-payment-fields">
                                <label for="jumlah_bayar" class="form-label mb-1">
                                    Jumlah Bayar
                                </label>

                                <input
                                    id="jumlah_bayar"
                                    name="jumlah_bayar"
                                    type="number"
                                    min="<?php echo e($sale->total_pembayaran); ?>"
                                    step="1"
                                    class="form-control mb-2"
                                    placeholder="Masukkan jumlah uang"
                                    required
                                >

                                <div class="d-flex justify-content-between mb-2">
                                    <span class="fw-semibold">Kembalian</span>
                                    <strong id="change-amount" class="text-success">Rp 0</strong>
                                </div>
                            </div>

                            <div id="cash-payment-error" class="text-danger small mb-2 d-none">
                                Jumlah bayar kurang dari total pembayaran.
                            </div>


                            <button
                                type="submit"
                                class="btn btn-success w-100"
                                <?php echo e($sale->itemPenjualan->count() === 0 ? 'disabled' : ''); ?>

                            >

                                <i class="bi bi-check-circle me-1"></i>

                                Checkout

                            </button>

                        </form>

                    <?php else: ?>

                        <button
                            type="button"
                            class="btn btn-secondary w-100"
                            disabled
                        >

                            <i class="bi bi-check-circle me-1"></i>

                            Transaksi Sudah Selesai

                        </button>

                    <?php endif; ?>


                    
                    <?php if($sale->status === 'OPEN'): ?>

                        <form
                            action="<?php echo e(route('penjualan.destroy', $sale->id)); ?>"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin membatalkan transaksi? Stok produk akan dikembalikan.')"
                        >

                            <?php echo csrf_field(); ?>

                            <?php echo method_field('DELETE'); ?>


                            <button
                                type="submit"
                                class="btn btn-outline-danger w-100 mt-2"
                            >

                                <i class="bi bi-x-circle me-1"></i>

                                Batalkan Transaksi

                            </button>

                        </form>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?php if($sale->status === 'OPEN'): ?>
    <script>
        const paymentMethod = document.querySelector('[name="payment_method"]');
        const paymentAmount = document.querySelector('#jumlah_bayar');
        const cashFields = document.querySelector('#cash-payment-fields');
        const qrisFields = document.querySelector('#qris-payment-fields');
        const changeAmount = document.querySelector('#change-amount');
        const paymentError = document.querySelector('#cash-payment-error');
        const totalAmount = <?php echo e((int) $sale->total_pembayaran); ?>;

        function updatePaymentFields() {
            const isCash = paymentMethod.value === 'CASH';
            cashFields.classList.toggle('d-none', !isCash);
            qrisFields.classList.toggle('d-none', paymentMethod.value !== 'QRIS');
            paymentAmount.required = isCash;

            if (!isCash) {
                paymentAmount.value = totalAmount;
                changeAmount.textContent = 'Rp 0';
                paymentError.classList.add('d-none');
                return;
            }

            const paid = Number(paymentAmount.value || 0);
            const change = Math.max(0, paid - totalAmount);
            changeAmount.textContent = 'Rp ' + change.toLocaleString('id-ID');
            paymentError.classList.toggle('d-none', paid >= totalAmount);
        }

        paymentMethod.addEventListener('change', updatePaymentFields);
        paymentAmount.addEventListener('input', updatePaymentFields);
        updatePaymentFields();
    </script>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
    if (typeof QRCode !== 'undefined') {
        new QRCode(document.querySelector('#payment-qr'), {
            text: 'NUYMART-<?php echo e($sale->id); ?>',
            width: 160,
            height: 160,
            correctLevel: QRCode.CorrectLevel.M
        });
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_nuy\resources\views/penjualan/pos.blade.php ENDPATH**/ ?>