<?php $__env->startSection('title', 'AdminPanel'); ?>
<?php $__env->startSection('link'); ?>
    @parent
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-7">
        <admin-items class-name="<?php echo e($className); ?>">
            
        </admin-items>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('link_js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>