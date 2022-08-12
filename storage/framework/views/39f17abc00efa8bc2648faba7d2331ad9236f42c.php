        <?php echo e(Form::open(['url' => 'deposit', 'method' => 'post'])); ?>

        <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo e(Form::label('account_id', __('Account'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::select('account_id', $accounts, null, ['class' => 'form-control select2', 'placeholder' => __('Choose Account')])); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('amount', __('Amount'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::number('amount', null, ['class' => 'form-control', 'placeholder' => __('Amount'), 'step' => '0.01'])); ?>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('date', __('Date'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::text('date', null, ['class' => 'form-control d_week', 'autocomplete' => 'off'])); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('income_category_id', __('Category'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::select('income_category_id', $incomeCategory, null, ['class' => 'form-control select2', 'placeholder' => __('Choose A Category')])); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('payer_id', __('Payer'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::select('payer_id', $payers, null, ['class' => 'form-control select2'])); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('payment_type_id', __('Payment Method'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::select('payment_type_id', $paymentTypes, null, ['class' => 'form-control select2', 'placeholder' => __('Choose Payment Method')])); ?>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <?php echo e(Form::label('referal_id', __('Ref#'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::text('referal_id', null, ['class' => 'form-control'])); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo e(Form::label('description', __('Description'), ['class' => 'col-form-label'])); ?>

                        <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => __('Description'), 'rows' => '5'])); ?>

                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="button" value="Cancel" class="btn btn-light" data-bs-dismiss="modal">
            <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
        </div>
        <?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\newaccounts\resources\views/deposit/create.blade.php ENDPATH**/ ?>