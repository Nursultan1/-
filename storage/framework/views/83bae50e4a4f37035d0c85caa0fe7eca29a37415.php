<?php $__env->startSection('title', 'Журнал'); ?>
<?php $__env->startSection('link'); ?>
    @parent
    <!-- Здесь можно подключить css -->
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/modal.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php for($i=1; $i<=11; $i++): ?>
    <classes number=<?php echo e($i); ?>>

    </classes>
    <?php endfor; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('link_js'); ?>
    @parent
    <!-- Здесь можно подключить js -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>