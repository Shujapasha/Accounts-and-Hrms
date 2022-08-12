<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Expense')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="section">
        <div class="section-header">
            <h1><?php echo e(__('Expense')); ?></h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></div>
                <div class="breadcrumb-item"><?php echo e(__('Expense')); ?></div>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between w-100">
                                <h4><?php echo e(__('Manage Expense')); ?></h4>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
                                    <div class="col-auto">
                                        <a href="#" data-url="<?php echo e(route('expenses.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Expense')); ?>" class="btn btn-xs btn-warning">
                                            <span class="btn-inner--icon"><i class="ti ti-plus"></i></span>
                                            <span class="btn-inner--text"> <?php echo e(__('Create')); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="card-body p-0">
                                <div id="table-1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                    <div class="table-responsive">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-flush" id="dataTable">
                                                    <thead>
                                                    <tr>

                                                        <th> <?php echo e(__('Category')); ?></th>
                                                        <th width="40%"> <?php echo e(__('Description')); ?></th>
                                                        <th> <?php echo e(__('Amount')); ?></th>
                                                        <th> <?php echo e(__('Date')); ?></th>
                                                        <th> <?php echo e(__('Project')); ?></th>
                                                        <th> <?php echo e(__('User')); ?></th>
                                                        <th> <?php echo e(__('Attachment')); ?></th>
                                                        <?php if(Gate::check('edit expense') || Gate::check('delete expense')): ?>
                                                            <th class="text-end"> <?php echo e(__('Action')); ?></th>
                                                        <?php endif; ?>
                                                    </tr>
                                                    </thead>

                                                    <tbody>
                                                    <?php $__currentLoopData = $expenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e((!empty($expense->category)?$expense->category->name:'')); ?></td>
                                                            <td><?php echo e($expense->description); ?></td>
                                                            <td><?php echo e(Auth::user()->priceFormat($expense->amount)); ?> </td>
                                                            <td><?php echo e(Auth::user()->dateFormat($expense->date)); ?></td>
                                                            <td><?php echo e($expense->projects->name); ?></td>
                                                            <td><?php echo e((!empty($expense->user)?$expense->user->name:'')); ?></td>
                                                            <td class="text-center">

                                                                <?php if($expense->attachment): ?>
                                                                    <a href="<?php echo e(asset(Storage::url('uploads/attachment/'. $expense->attachment))); ?>" download="" class="table-action" data-toggle="tooltip" data-original-title="<?php echo e(__('Download')); ?>">
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <?php if(Gate::check('edit expense') || Gate::check('delete expense')): ?>
                                                                <td class="action text-end">
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit expense')): ?>
                                                                        <a href="#" class="table-action" data-url="<?php echo e(route('expenses.edit',$expense->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Expense')); ?>" data-toggle="tooltip" data-original-title="<?php echo e(__('Edit')); ?>">
                                                                            <i class="far fa-edit"></i>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete expense')): ?>
                                                                        <a href="#" class="table-action table-action-delete" data-toggle="tooltip" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($expense->id); ?>').submit();">
                                                                            <i class="far fa-trash-alt"></i>
                                                                        </a>
                                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['expenses.destroy', $expense->id],'id'=>'delete-form-'.$expense->id]); ?>

                                                                        <?php echo Form::close(); ?>

                                                                    <?php endif; ?>
                                                                </td>

                                                            <?php endif; ?>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\newaccounts\resources\views/expenses/index.blade.php ENDPATH**/ ?>