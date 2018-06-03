<?php $__env->startSection('title', 'AdminPanel'); ?>
<?php $__env->startSection('link'); ?>
    @parent
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php
    // var_dump($class);
    ?>
    <div class="col-md-6 col-md-offset-1">
        <form class="form-horizontal" method="post" action="<?php echo e(route('save-class')); ?>">
            <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">    
            <?php if(isset($class)): ?>
                <input type="hidden" name="id" value="<?php echo e($class['id']); ?>">
                <div class="form-group">
                    <label for="sel1">Классный руководитель:</label>
                    <select class="form-control" id="sel1" name="teache">
                        <option value="<?php echo e($class['teacheCurrentID']); ?>" selected><?php echo e($class['teacheCurrent']); ?></option>
                        <?php $__currentLoopData = $class['teaches']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teache): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <option value="<?php echo e($teache->id_teache); ?>"><?php echo e($teache->fio_teache); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="numbe">Какой класс</label>
                    <input class="form-control" name="numbe" type="text" id="numbe" value="<?php echo e($class['numbe']); ?>">
                </div>
                <div class="form-group">
                    <label for="">Категории класса</label>
                    <input class="form-control" name="category" type="text" value="<?php echo e($class['category']); ?>">
                </div>
                <input type="submit" value="Сохранить" class="btn btn-primary btn-block">
            <?php elseif(isset($teaches)): ?>
                <div class="form-group">
                    <label for="sel1">Классный руководитель:</label>
                    <select class="form-control" id="sel1" name="teache">
                        <?php $__currentLoopData = $teaches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teache): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <option value="<?php echo e($teache->id_teache); ?>"><?php echo e($teache->fio_teache); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="numbe">Какой класс</label>
                    <select class="form-control" name="numbe" id="numbe">
                        <?php for($i = 1; $i < 12; $i++): ?>
                            <option value="<?php echo e($i); ?>"><?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="category">Категории класса</label>
                    <select class="form-control" name="category" id="category">
                        <option value="a">a</option>
                        <option value="b">b</option>
                        <option value="c">c</option>
                        <option value="d">d</option>
                    </select>
                </div>
                <input type="submit" value="Сохранить" class="btn btn-primary btn-block"> 
            <?php endif; ?>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('link_js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>