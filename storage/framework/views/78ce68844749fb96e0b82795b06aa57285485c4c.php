<?php $__env->startSection('title', 'AdminPanel'); ?>
<?php $__env->startSection('link'); ?>
    @parent
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-8">
        <admin-teache>
        </admin-teache>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('link_js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>