<?php $__env->startSection('title', 'AdminPanel'); ?>
<?php $__env->startSection('link'); ?>
    @parent
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <!-- <div class="col-md-7">
        <h2><?php echo e($arrayClass['className']); ?></h2>
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>ФИО</th>
                <th>Изменить</th>
                <th>Удалить</th>
            </tr>
            <tr>
                
            </tr>
        </table>
        <button class="btn btn-info" data-toggle="modal" data-target="#addNewPupil">Добавить нового ученика</button>
    </div> -->
    <!-- Modal -->
    <div id="addNewPupil" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Добавить нового ученика</h4>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(route('')); ?>" method="post">
                        <div class="form-group">
                            <label for="fio">ФИО</label>
                            <input class="form-control" name="fio" type="text" id="fio">
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-default" value="Добавить">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('link_js'); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>