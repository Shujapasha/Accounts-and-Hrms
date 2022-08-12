<?php echo e(Form::model($customQuestion, ['route' => ['custom-question.update', $customQuestion->id],'method' => 'PUT'])); ?>

<div class="modal-body">
    <div class="row">
        <div class="form-group">
            <?php echo e(Form::label('question', __('Question'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('question', null, ['class' => 'form-control', 'placeholder' => __('Enter question')])); ?>

        </div>
        <div class="form-group">
            <?php echo e(Form::label('is_required', __('Is Required'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::select('is_required', $is_required, null, ['class' => 'form-control ','required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">

</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\newaccounts\resources\views/customQuestion/edit.blade.php ENDPATH**/ ?>