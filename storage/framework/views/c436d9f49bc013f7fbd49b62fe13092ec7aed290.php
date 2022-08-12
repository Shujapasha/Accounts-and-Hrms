<?php echo e(Form::open(['url' => 'complaint', 'method' => 'post'])); ?>

<div class="modal-body">
    <div class="row">
        <?php if(\Auth::user()->type != 'employee'): ?>
            <div class="form-group col-md-6 col-lg-6 ">
                <?php echo e(Form::label('complaint_from', __('Complaint From'), ['class' => 'col-form-label'])); ?>

                <?php echo e(Form::select('complaint_from', $employees, null, ['class' => 'form-control  select2', 'required' => 'required'])); ?>

            </div>
        <?php endif; ?>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('complaint_against', __('Complaint Against'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::select('complaint_against', $employees, null, ['class' => 'form-control select2' ,'required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('title', __('Title'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('title', null, ['class' => 'form-control','placeholder' =>'Enter Complaint Title' ,'required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-6 col-lg-6">
            <?php echo e(Form::label('complaint_date', __('Complaint Date'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::text('complaint_date', null, ['class' => 'form-control d_week','autocomplete'=>'off' ,'required' => 'required'])); ?>

        </div>
        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'), ['class' => 'col-form-label'])); ?>

            <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Enter Description') ,'rows' => '3' ,'required' => 'required'])); ?>

        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
</div>


<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\newaccounts\resources\views/complaint/create.blade.php ENDPATH**/ ?>