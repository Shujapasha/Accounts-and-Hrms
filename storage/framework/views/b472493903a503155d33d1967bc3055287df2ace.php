
<?php echo e(Form::open(['url' => 'zoom-meeting', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off'])); ?>

<div class="modal-body">

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('title', __('Title'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::text('title', null, ['class' => 'form-control', 'placeholder' => __('Enter Meeting Title')])); ?>

                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('user', __('User'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::select('user_id[]', $employee_option,null, array('class' => 'form-control select2','id'=>'choices-multiple','multiple'=>'','required'=>'required'))); ?>

                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::datetimeLocal('start_date', null, ['class' => 'form-control datetime-local', 'required' => 'required'])); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('duration', __('Duration'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo Form::number('duration', null, ['class' => 'form-control', 'required' => true, 'min' => 0]); ?>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('password', __('Password'), ['class' => 'form-label'])); ?>

                <div class="form-icon-user">
                    <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Password')])); ?>

                </div>
            </div>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\newaccounts\resources\views/zoom_meeting/create.blade.php ENDPATH**/ ?>