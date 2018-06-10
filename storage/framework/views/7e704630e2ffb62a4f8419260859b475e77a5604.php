<?php $__env->startSection('content'); ?>
<div class="container">
    <Home id="<?php echo e(Auth::user()->id_teache); ?>" fio="<?php echo e(Auth::user()->fio_teache); ?>" email="<?php echo e(Auth::user()->email); ?>"></Home>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>