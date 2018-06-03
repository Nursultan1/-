<?php $__env->startSection('title', 'AdminPanel'); ?>
<?php $__env->startSection('link'); ?>
    @parent
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-7">
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Класс</th>
                <th>Классный руководитель</th>
                <th>Список учеников</th>
                <th>Список предметов</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            <?php $__currentLoopData = $classList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $classes): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                <tr>
                    <td><?php echo e($classes['id']); ?></td>
                    <td><?php echo e($classes['name']); ?></td>
                    <td><?php echo e($classes['teache']); ?></td>
                    <td><a href="<?php echo e(route('pupils',['id'=>$classes['id']])); ?>">Посмотреть</a></td>
                    <td><a href="<?php echo e(route('items',['id'=>$classes['id']])); ?>">Посмотреть</a></td>
                    <td><a href="<?php echo e(route('update-class',['id'=>$classes['id']])); ?>">Изменить</a></td>
                    <td><a href="<?php echo e(route('delete-class',['id'=>$classes['id']])); ?>">Удалить</a></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
        </table>
        <button class="btn"><a href="<?php echo e(route('add-class')); ?>">Добавить новый класс</a></button>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('link_js'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>