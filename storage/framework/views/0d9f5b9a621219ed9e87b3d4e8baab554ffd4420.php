<?php
$logo = asset(Storage::url('uploads/logo/'));
// $company_logo = \App\Models\Utility::GetLogo();
// $company_logo=App\Models\Utility::getValByName('company_logo');
 // $company_small_logo=App\Models\Utility::getValByName('company_small_logo');
 // $mode_setting = \App\Models\Utility::mode_layout();
// $logo= $mode_setting['company_logo_dark'];
// if($mode_setting['cust_darklayout'] =='on'){
//     $logo= $mode_setting['company_logo_light'];
// }
// $logo= $mode_setting['company_logo_dark'];
// if($mode_setting['cust_darklayout'] =='on'){
//     $logo= $mode_setting['company_logo_light'];
// }
if(\Auth::user()->type=="Super Admin")
    {
        $company_logo=Utility::get_superadmin_logo();
    }
    else
    {
        $company_logo=Utility::get_company_logo();
    }
    
    $mode_setting = \App\Models\Utility::getLayoutsSetting();

    $emailTemplate     = App\Models\EmailTemplate::first();
?>






<nav class="dash-sidebar light-sidebar <?php echo e((isset($mode_setting['cust_theme_bg']) && $mode_setting['cust_theme_bg'] == 'on')?'transprent-bg':''); ?>">
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="#" class="b-brand">
                <img src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                alt="<?php echo e(config('app.name', 'AccountGo')); ?>" class="logo logo-lg">
            </a>
        </div>

        <div class="navbar-content">
            <ul class="dash-navbar">
                
                <li class="dash-item ">
                    <?php if(\Auth::guard('customer')->check()): ?>
                        <a href="<?php echo e(route('customer.dashboard')); ?>" class="dash-link <?php echo e((Request::route()->getName() == 'customer.dashboard') ? ' active' : ''); ?>">
                            <span class="dash-micon"><i class="ti ti-home"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        </a>
                    <?php elseif(\Auth::guard('vender')->check()): ?>
                        <a href="<?php echo e(route('vender.dashboard')); ?>" class="dash-link <?php echo e((Request::route()->getName() == 'vender.dashboard') ? ' active' : ''); ?>">
                            <span class="dash-micon"><i class="ti ti-home"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="dash-link <?php echo e((Request::route()->getName() == 'dashboard') ? ' active' : ''); ?>">
                            <span class="dash-micon"><i class="ti ti-home"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        </a>
                    <?php endif; ?>
                </li>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer proposal')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'customer.proposal' || Request::route()->getName() == 'customer.proposal.show') ? ' active' : ''); ?> ">
                        <a href="<?php echo e(route('customer.proposal')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-receipt"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Proposal')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer invoice')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'customer.invoice' || Request::route()->getName() == 'customer.invoice.show') ? ' active' : ''); ?> ">
                        <a href="<?php echo e(route('customer.invoice')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-file-invoice"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Invoice')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer payment')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'customer.payment') ? ' active' : ''); ?> ">
                        <a href="<?php echo e(route('customer.payment')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-report-money"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Payment')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer transaction')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'customer.transaction') ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('customer.transaction')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-history"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Transaction')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage vender bill')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'vender.bill' || Request::route()->getName() == 'vender.bill.show') ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('vender.bill')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-file-invoice"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Bill')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage vender payment')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'vender.payment') ? ' active' : ''); ?> ">
                        <a href="<?php echo e(route('vender.payment')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-report-money"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Payment')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage vender transaction')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'vender.transaction') ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('vender.transaction')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-history"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Transaction')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>



                
                <?php if(\Auth::user()->type=='super admin'): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                        <li class="dash-item">
                            <a href="<?php echo e(route('users.index')); ?>" class="dash-link <?php echo e((Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : ''); ?>">
                                <span class="dash-micon"><i class="ti ti-users"></i></span>
                                <span class="dash-mtext"><?php echo e(__('User')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php else: ?>
                    <?php if( Gate::check('manage user') || Gate::check('manage role')): ?>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'permissions' )?' active dash-trigger':''); ?>">
                            <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-users"></i></span><span class="dash-mtext"><?php echo e(__('Staff')); ?></span>
                                <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="dash-submenu <?php echo e((Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'permissions')?'show':''); ?>">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                                    <li class="dash-item <?php echo e((Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : ''); ?>">
                                        <a class="dash-link" href="<?php echo e(route('users.index')); ?>"><?php echo e(__('User')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage role')): ?>
                                    <li class="dash-item <?php echo e((Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : ''); ?>">
                                        <a class="dash-link" href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Role')); ?></a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                
                <?php if(Gate::check('manage product & service')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'productservice')?'active':''); ?> ">
                        <a href="<?php echo e(route('productservice.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Product & Services')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage product & service')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'productstock')?'active':''); ?>">
                        <a href="<?php echo e(route('productstock.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-box"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Product Stock')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage customer')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'customer')?'active':''); ?>">
                        <a href="<?php echo e(route('customer.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-user-plus"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Customer')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage vender')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'vender')?'active':''); ?>">
                        <a href="<?php echo e(route('vender.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-note"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Vendor')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage proposal')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'proposal')?'active':''); ?>">
                        <a href="<?php echo e(route('proposal.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-receipt"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Proposal')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if( Gate::check('manage bank account') ||  Gate::check('manage transfer')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'bank-account' || Request::segment(1) == 'transfer')?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-building-bank"></i></span><span class="dash-mtext"><?php echo e(__('Banking')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e((Request::segment(1) == 'bank-account' || Request::segment(1) == 'transfer')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bank account')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'bank-account.index' || Request::route()->getName() == 'bank-account.create' || Request::route()->getName() == 'bank-account.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('bank-account.index')); ?>"><?php echo e(__('Account')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage transfer')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'transfer.index' || Request::route()->getName() == 'transfer.create' || Request::route()->getName() == 'transfer.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('transfer.index')); ?>"><?php echo e(__('Transfer')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if( Gate::check('manage invoice') ||  Gate::check('manage revenue') ||  Gate::check('manage credit note')): ?>

                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note')?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-file-invoice"></i></span><span class="dash-mtext"><?php echo e(__('Income')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e((Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage invoice')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'invoice.index' || Request::route()->getName() == 'invoice.create' || Request::route()->getName() == 'invoice.edit' || Request::route()->getName() == 'invoice.show') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('invoice.index')); ?>"><?php echo e(__('Invoice')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage revenue')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'revenue.index' || Request::route()->getName() == 'revenue.create' || Request::route()->getName() == 'revenue.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('revenue.index')); ?>"><?php echo e(__('Revenue')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage credit note')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'credit.note' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('credit.note')); ?>"><?php echo e(__('Credit Note')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>

                <?php endif; ?>

                
                <?php if( Gate::check('manage bill')  ||  Gate::check('manage payment') ||  Gate::check('manage debit note')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note'  )?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-report-money"></i></span><span class="dash-mtext"><?php echo e(__('Expense')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu  <?php echo e((Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note'  )?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bill')): ?>
                                <li class="dash-item  <?php echo e((Request::route()->getName() == 'bill.index' || Request::route()->getName() == 'bill.create' || Request::route()->getName() == 'bill.edit' || Request::route()->getName() == 'bill.show') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('bill.index')); ?>"><?php echo e(__('Bill')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage payment')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'payment.index' || Request::route()->getName() == 'payment.create' || Request::route()->getName() == 'payment.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('payment.index')); ?>"><?php echo e(__('Payment')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage debit note')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'debit.note' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('debit.note')); ?>"><?php echo e(__('Debit Note')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if( Gate::check('manage chart of account') ||  Gate::check('manage journal entry') ||   Gate::check('balance sheet report') ||  Gate::check('ledger report') ||  Gate::check('trial balance report')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance')?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-scale"></i></span><span class="dash-mtext"><?php echo e(__('Double Entry')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e((Request::segment(1) == 'chart-of-account'  || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage chart of account')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'chart-of-account.index') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('chart-of-account.index')); ?>"><?php echo e(__('Chart of Accounts')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage journal entry')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'journal-entry.index' || Request::route()->getName() == 'journal-entry.show') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('journal-entry.index')); ?>"><?php echo e(__('Journal Account')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('ledger report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.ledger' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.ledger')); ?>"><?php echo e(__('Ledger Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('balance sheet report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.balance.sheet' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.balance.sheet')); ?>"><?php echo e(__('Balance Sheet')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('trial balance report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'trial.balance' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('trial.balance')); ?>"><?php echo e(__('Trial Balance')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if(\Auth::user()->type =='company'): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'budget')?'active':''); ?>">
                        <a href="<?php echo e(route('budget.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-businessplan"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Budget Planner')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                

                <?php if(Gate::check('manage contract')): ?> 
                    <li class="dash-item <?php echo e((Request::segment(1) == 'contract')?'active':''); ?>">
                        <a href="<?php echo e(route('contract.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-businessplan"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Contract')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage customer contract')): ?>
                    <li class="dash-item <?php echo e((Request::segment(2) == 'contract')?'active':''); ?>">
                        <a href="<?php echo e(route('customer.contract.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-businessplan"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Contract')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage goal')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'goal')?'active':''); ?>">
                        <a href="<?php echo e(route('goal.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-target"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Goal')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage assets')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'account-assets')?'active':''); ?>">
                        <a href="<?php echo e(route('account-assets.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-calculator"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Assets')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage plan')): ?>
                    <li class="dash-item <?php echo e(Request::segment(1) == 'plans' || Request::segment(1) == 'stripe'   ?'active':''); ?>">
                        <a href="<?php echo e(route('plans.index')); ?>" class="dash-link  ">
                            <span class="dash-micon"><i class="ti ti-trophy"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Plan')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(\Auth::user()->type=='super admin'): ?>
                    <li class="dash-item  <?php echo e(request()->is('plan_request*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('plan_request.index')); ?>" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-arrow-up-right-circle"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Plan Request')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage coupon')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'coupons')?'active':''); ?>">
                        <a href="<?php echo e(route('coupons.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-gift"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Coupon')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage order')): ?>
                    <li class="dash-item <?php echo e((Request::segment(1) == 'order')?'active':''); ?>">
                        <a href="<?php echo e(route('order.index')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-shopping-cart-plus"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Order')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                    
                <?php if(\Auth::user()->type=='super admin'): ?>
                    <li class="dash-item">
                        <a href="<?php echo e(route('manage.email.language',[$emailTemplate->id,\Auth::user()->lang])); ?>" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-template"></i></span><span
                                class="dash-mtext"><?php echo e(__('Email Template')); ?></span></a>
                    </li>
                <?php endif; ?>

                <!-- <?php if(\Auth::user()->type == 'company'): ?>
                    <li class="dash-item">
                        <a href="<?php echo e(route('email_template.index')); ?>" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-notification"></i></span><span
                                class="dash-mtext"><?php echo e(__('Email Notification')); ?></span></a>
                    </li>
                <?php endif; ?> -->


                
                <?php if( Gate::check('income report') || Gate::check('expense report') || Gate::check('income vs expense report') || Gate::check('tax report')  || Gate::check('loss & profit report') || Gate::check('invoice report') || Gate::check('bill report') || Gate::check('invoice report') ||  Gate::check('manage transaction')||  Gate::check('statement report')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e(((Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance')?' active dash-trigger':''); ?>">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-chart-line"></i></span><span class="dash-mtext"><?php echo e(__('Report')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e(((Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage transaction')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'transaction.index' || Request::route()->getName() == 'transfer.create' || Request::route()->getName() == 'transaction.edit') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('transaction.index')); ?>"><?php echo e(__('Transaction')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('statement report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.account.statement') ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.account.statement')); ?>"><?php echo e(__('Account Statement')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('income report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.income.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.income.summary')); ?>"><?php echo e(__('Income Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('expense report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.expense.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.expense.summary')); ?>"><?php echo e(__('Expense Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('income vs expense report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.income.vs.expense.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.income.vs.expense.summary')); ?>"><?php echo e(__('Income VS Expense')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('tax report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.tax.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.tax.summary')); ?>"><?php echo e(__('Tax Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('loss & profit report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.profit.loss.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.profit.loss.summary')); ?>"><?php echo e(__('Profit & Loss')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('invoice report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.invoice.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.invoice.summary')); ?>"><?php echo e(__('Invoice Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('bill report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.bill.summary' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.bill.summary')); ?>"><?php echo e(__('Bill Summary')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('stock report')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'report.product.stock.report' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('report.product.stock.report')); ?>"><?php echo e(__('Product Stock')); ?></a>
                                </li>
                            <?php endif; ?>


                        </ul>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage constant tax') || Gate::check('manage constant category') ||Gate::check('manage constant unit') ||Gate::check('manage constant payment method') ||Gate::check('manage constant custom field') || Gate::check('manage constant chart of account')): ?>
                    <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')?' active dash-trigger':''); ?> ">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-chart-arcs"></i></span><span class="dash-mtext"><?php echo e(__('Constant')); ?></span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu <?php echo e((Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')?'show':''); ?>">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant tax')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'taxes.index' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('taxes.index')); ?>"><?php echo e(__('Taxes')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant category')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'product-category.index' ) ? 'active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('product-category.index')); ?>"><?php echo e(__('Category')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant unit')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'product-unit.index' ) ? ' active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('product-unit.index')); ?>"><?php echo e(__('Unit')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage constant custom field')): ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'custom-field.index' ) ? 'active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('custom-field.index')); ?>"><?php echo e(__('Custom Field')); ?></a>
                                </li>
                            <?php endif; ?>
                                <li class="dash-item <?php echo e((Request::route()->getName() == 'contractType.index' ) ? 'active' : ''); ?>">
                                    <a class="dash-link" href="<?php echo e(route('contractType.index')); ?>"><?php echo e(__('Contract Type')); ?></a>
                                </li>
                        </ul>
                    </li>
                <?php endif; ?>


                
                <?php if(Gate::check('manage system settings')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'systems.index') ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('systems.index')); ?>" class="dash-link  ">
                            <span class="dash-micon"><i class="ti ti-settings"></i></span>
                            <span class="dash-mtext"><?php echo e(__('System Setting')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>

                
                <?php if(Gate::check('manage company settings')): ?>
                    <li class="dash-item <?php echo e((Request::route()->getName() == 'systems.index') ? ' active' : ''); ?>">
                        <a href="<?php echo e(route('company.setting')); ?>" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-settings"></i></span>
                            <span class="dash-mtext"><?php echo e(__('Company Setting')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>


                            <?php if(Gate::check('manage report')): ?>
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link"><span class=""><i
                                    class=""></i></span><span
                                class="dash-mtext"><?php echo e(__('Report')); ?></span><span
                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage report')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.income-expense')); ?>"><?php echo e(__('Income Vs Expense')); ?></a>
                                </li>

                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.monthly.attendance')); ?>"><?php echo e(__('Monthly Attendance')); ?></a>
                                </li>

                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.leave')); ?>"><?php echo e(__('Leave')); ?></a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.account.statement')); ?>"><?php echo e(__('Account Statement')); ?></a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.payroll')); ?>"><?php echo e(__('Payroll')); ?></a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.timesheet')); ?>"><?php echo e(__('Timesheet')); ?></a>
                                </li>
                            <?php endif; ?>


                        </ul>
                    </li>
                <?php endif; ?>
                          

                        </ul>
                    </li>
                <!--dashboard-->
                <ul class="dash-navbar">
                <!-- user-->
                <?php if(\Auth::user()->type == 'super admin'): ?>
                    <li class="dash-item">
                        <a href="<?php echo e(route('user.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-user"></i></span><span
                                class="dash-mtext"><?php echo e(__('Company')); ?></span></a>
                    </li>
                <?php else: ?>
                    <?php if(Gate::check('manage user') || Gate::check('manage role') || Gate::check('manage employee profile') || Gate::check('manage employee last login')): ?>
                        <li class="dash-item dash-hasmenu">
                            <a href="#!" class="dash-link"><span class="dash-micon"><i
                                        class="ti ti-users"></i></span><span
                                    class="dash-mtext"><?php echo e(__('Staff')); ?></span><span class="dash-arrow"><i
                                        data-feather="chevron-right"></i></span></a>
                            <ul class="dash-submenu">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                                    <li class="dash-item">
                                        <a class="dash-link"
                                            href="<?php echo e(route('user.index')); ?>"><?php echo e(__('User')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage role')): ?>
                                    <li class="dash-item">
                                        <a class="dash-link"
                                            href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Role')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage employee profile')): ?>
                                    <li class="dash-item">
                                        <a class="dash-link"
                                            href="<?php echo e(route('employee.profile')); ?>"><?php echo e(__('Employee Profile')); ?></a>
                                    </li>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage employee last login')): ?>
                                    <li class="dash-item">
                                        <a class="dash-link"
                                            href="<?php echo e(route('lastlogin')); ?>"><?php echo e(__('Last Login')); ?></a>
                                    </li>
                                <?php endif; ?>

                            </ul>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- user-->

                <!-- employee-->
                <?php if(Gate::check('manage employee')): ?>
                    <?php if(\Auth::user()->type == 'employee'): ?>
                        <?php
                            $employee = App\Models\Employee::where('user_id', \Auth::user()->id)->first();
                        ?>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'employee' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id))); ?>"
                                class="dash-link"><span class="dash-micon"><i
                                        class="ti ti-user"></i></span><span
                                    class="dash-mtext"><?php echo e(__('Employee')); ?></span></a>
                        </li>
                    <?php else: ?>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'employee' ? 'active' : ''); ?>">
                            <a href="<?php echo e(route('employee.index')); ?>" class="dash-link"><span
                                    class="dash-micon"><i class="ti ti-user"></i></span><span
                                    class="dash-mtext"><?php echo e(__('Employee')); ?></span></a>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <!-- employee-->

                <!-- payroll-->
                <?php if(Gate::check('manage set salary') || Gate::check('manage pay slip')): ?>
                    <li
                        class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'setsalary' ? 'dash-trigger active' : ''); ?>">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-receipt"></i></span><span
                                class="dash-mtext"><?php echo e(__('Payroll')); ?></span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu ">
                            <li class="dash-item <?php echo e(Request::segment(1) == 'setsalary' ? 'active' : '-'); ?>">
                                <a class="dash-link"
                                    href="<?php echo e(route('setsalary.index')); ?>"><?php echo e(__('Set Salary')); ?></a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('payslip.index')); ?>"><?php echo e(__('Payslip')); ?></a>
                            </li>

                        </ul>
                    </li>
                <?php endif; ?>
                <!-- payroll-->

                <?php if(\Auth::user()->type == 'employee'): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'setsalary' ? 'dash-trigger active' : ''); ?>">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-receipt"></i></span><span
                                class="dash-mtext"><?php echo e(__('Payroll')); ?></span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <li class="dash-item <?php echo e(Request::segment(1) == 'setsalary' ? 'active' : '-'); ?>">
                                <a class="dash-link"
                                    href="<?php echo e(route('setsalary.show', \Auth::user()->id)); ?>"><?php echo e(__('Set Salary')); ?></a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('payslip.index')); ?>"><?php echo e(__('Payslip')); ?></a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- timesheet-->
                <?php if(Gate::check('manage attendance') || Gate::check('manage leave') || Gate::check('manage timesheet')): ?>
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-clock"></i></span><span
                                class="dash-mtext"><?php echo e(__('Timesheet')); ?></span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage timesheet')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('timesheet.index')); ?>"><?php echo e(__('Timesheet')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage leave')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('leave.index')); ?>"><?php echo e(__('Manage Leave')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage attendance')): ?>
                                <li class="dash-item dash-hasmenu">
                                    <a href="#!" class="dash-link"><span
                                            class="dash-mtext"><?php echo e(__('Attendance')); ?></span><span
                                            class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        <li class="dash-item">
                                            <a class="dash-link"
                                                href="<?php echo e(route('attendanceemployee.index')); ?>"><?php echo e(__('Marked Attendance')); ?></a>
                                        </li>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create attendance')): ?>
                                            <li class="dash-item">
                                                <a class="dash-link"
                                                    href="<?php echo e(route('attendanceemployee.bulkattendance')); ?>"><?php echo e(__('Bulk Attendance')); ?></a>
                                            </li>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <!--timesheet-->

                <!-- performance-->
                <?php if(Gate::check('manage indicator') || Gate::check('manage appraisal') || Gate::check('manage goal tracking')): ?>
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-3d-cube-sphere"></i></span><span
                                class="dash-mtext"><?php echo e(__('Performance')); ?></span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage indicator')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('indicator.index')); ?>"><?php echo e(__('Indicator')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage appraisal')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('appraisal.index')); ?>"><?php echo e(__('Appraisal')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage goal tracking')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('goaltracking.index')); ?>"><?php echo e(__('Goal Tracking')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <!--performance-->

                <!--fianance-->
                <?php if(Gate::check('manage account list') || Gate::check('manage payee') || Gate::check('manage payer') || Gate::check('manage deposit') || Gate::check('manage expense') || Gate::check('manage transfer balance')): ?>
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-wallet"></i></span><span
                                class="dash-mtext"><?php echo e(__('Finance')); ?></span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage account list')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('accountlist.index')); ?>"><?php echo e(__('Account List')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view balance account list')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('accountbalance')); ?>"><?php echo e(__('Account Balance')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage payee')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('payees.index')); ?>"><?php echo e(__('Payees')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage payer')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('payer.index')); ?>"><?php echo e(__('Payers')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage deposit')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('deposit.index')); ?>"><?php echo e(__('Deposit')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage expense')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('expense.index')); ?>"><?php echo e(__('Expense')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage transfer balance')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('transferbalance.index')); ?>"><?php echo e(__('Transfer Balance')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <!-- fianance-->

                <!--trainning-->
                <?php if(Gate::check('manage trainer') || Gate::check('manage training')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'training' ? 'dash-trigger active' : ''); ?>">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i
                                    class="ti ti-school"></i></span><span
                                class="dash-mtext"><?php echo e(__('Training')); ?></span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage training')): ?>
                                <li class="dash-item <?php echo e(Request::segment(1) == 'training' ? ' active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('training.index')); ?>"><?php echo e(__('Training List')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage trainer')): ?>
                                <li class="dash-item ">
                                    <a class="dash-link"
                                        href="<?php echo e(route('trainer.index')); ?>"><?php echo e(__('Trainer')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>

                <!-- tranning-->


                <!-- HR-->
                <?php if(Gate::check('manage awards') || Gate::check('manage transfer') || Gate::check('manage resignation') || Gate::check('manage travels') || Gate::check('manage promotion') || Gate::check('manage complaint') || Gate::check('manage warning') || Gate::check('manage termination') || Gate::check('manage announcement') || Gate::check('manage holiday')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'holiday' ? 'dash-trigger active' : ''); ?>">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-user-plus"></i></span><span
                                class="dash-mtext"><?php echo e(__('HR Admin Setup')); ?></span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <li class="dash-item <?php echo e(Request::segment(1) == 'award' ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('award.index')); ?>"><?php echo e(__('Award')); ?></a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('transfer.index')); ?>"><?php echo e(__('Transfer')); ?></a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('resignation.index')); ?>"><?php echo e(__('Resignation')); ?></a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('travel.index')); ?>"><?php echo e(__('Trip')); ?></a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('promotion.index')); ?>"><?php echo e(__('Promotion')); ?></a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('complaint.index')); ?>"><?php echo e(__('Complaints')); ?></a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('warning.index')); ?>"><?php echo e(__('Warning')); ?></a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('termination.index')); ?>"><?php echo e(__('Termination')); ?></a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="<?php echo e(route('announcement.index')); ?>"><?php echo e(__('Announcement')); ?></a>
                            </li>
                            <li class="dash-item <?php echo e(Request::segment(1) == 'holiday' ? ' active' : ''); ?>">
                                <a class="dash-link"
                                    href="<?php echo e(route('holiday.index')); ?>"><?php echo e(__('Holidays')); ?></a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <!-- HR-->

               <!-- recruitment-->
                <?php if(Gate::check('manage job') || Gate::check('manage job application') || Gate::check('manage job onboard') || Gate::check('manage custom question') || Gate::check('manage interview schedule') || Gate::check('manage career')): ?>
                    <li
                        class="dash-item dash-hasmenu  <?php echo e(Request::segment(1) == 'job' || Request::segment(1) == 'job-application' ? 'dash-trigger active' : ''); ?> ">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-license"></i></span><span
                                class="dash-mtext"><?php echo e(__('Recruitment')); ?></span><span
                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job')): ?>
                                <li class="dash-item <?php echo e(Request::segment(1) == 'job' ? 'active' : '-'); ?>">
                                    <a class="dash-link" href="<?php echo e(route('job.index')); ?>"><?php echo e(__('Jobs')); ?></a>
                                </li>
                            <?php endif; ?>
                             <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job')): ?>
                                <li class="dash-item <?php echo e(Request::segment(1) == 'job' ? 'active' : '-'); ?>">
                                    <a class="dash-link" href="<?php echo e(route('job.create')); ?>"><?php echo e(__('Job Create')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job application')): ?>
                                <li class="dash-item ">
                                    <a class="dash-link"
                                        href="<?php echo e(route('job-application.index')); ?>"><?php echo e(__('Job Application')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job application')): ?>

                                <li class="dash-item  <?php echo e(Request::segment(2) == 'candidate' ? 'active' : '-'); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('job.application.candidate')); ?>"><?php echo e(__('Job Candidate')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job onboard')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('job.on.board')); ?>"><?php echo e(__('Job On-Boarding')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage custom question')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('custom-question.index')); ?>"><?php echo e(__('Custom Question')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage interview schedule')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('interview-schedule.index')); ?>"><?php echo e(__('Interview Schedule')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage career')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('career', [\Auth::user()->creatorId(), 'en'])); ?>"
                                        target="_blank"><?php echo e(__('Career')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                <?php endif; ?>
                <!-- recruitment-->

                <!--chats-->
                <?php if(\Auth::user()->type != 'super admin'): ?>
                    <li class="dash-item">
                        <a href="<?php echo e(url('chats')); ?>" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-messages"></i></span><span
                                class="dash-mtext"><?php echo e(__('Chats')); ?></span></a>
                    </li>
                <?php endif; ?>

                <!-- ticket-->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage ticket')): ?>
                    <li class="dash-item <?php echo e(Request::segment(1) == 'ticket' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('ticket.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-ticket"></i></span><span
                                class="dash-mtext"><?php echo e(__('Ticket')); ?></span></a>
                    </li>
                <?php endif; ?>

                <!-- Event-->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage event')): ?>
                    <li class="dash-item">
                        <a href="<?php echo e(route('event.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-calendar-event"></i></span><span
                                class="dash-mtext"><?php echo e(__('Event')); ?></span></a>
                    </li>
                <?php endif; ?>


                <!--meeting-->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage meeting')): ?>
                    <li class="dash-item <?php echo e(Request::segment(1) == 'meeting' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('meeting.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-calendar-time"></i></span><span
                                class="dash-mtext"><?php echo e(__('Meeting')); ?></span></a>
                    </li>
                <?php endif; ?>


                <!-- Zoom meeting-->
                <?php if(\Auth::user()->type != 'super admin'): ?>
                    <li class="dash-item <?php echo e(Request::segment(1) == 'zoommeeting' ? 'active' : ''); ?>">
                        <a href="<?php echo e(route('zoom-meeting.index')); ?>" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-video"></i></span><span
                                class="dash-mtext"><?php echo e(__('Zoom Meeting')); ?></span></a>
                    </li>
                <?php endif; ?>

                <!-- assets-->
                <?php if(Gate::check('manage assets')): ?>
                    <li class="dash-item">
                        <a href="<?php echo e(route('account-assets.index')); ?>" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-medical-cross"></i></span><span
                                class="dash-mtext"><?php echo e(__('Assets')); ?></span></a>
                    </li>
                <?php endif; ?>


                <!-- document-->
                <?php if(Gate::check('manage document')): ?>
                    <li class="dash-item">
                        <a href="<?php echo e(route('document-upload.index')); ?>" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-file"></i></span><span
                                class="dash-mtext"><?php echo e(__('Document')); ?></span></a>
                    </li>
                <?php endif; ?>
                <?php if(\Auth::user()->type == 'company'): ?>
                <li class="dash-item">
                    <a href="<?php echo e(route('manage.email.language',[$emailTemplate ->id,\Auth::user()->lang])); ?>" class="dash-link"><span
                            class="dash-micon"><i class="ti ti-template"></i></span><span
                            class="dash-mtext"><?php echo e(__('Email Template')); ?></span></a>
                </li>
            <?php endif; ?>

                <!--company policy-->



                <?php if(Gate::check('manage company policy')): ?>
                    <li class="dash-item">
                        <a href="<?php echo e(route('company-policy.index')); ?>" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-pray"></i></span><span
                                class="dash-mtext"><?php echo e(__('Company Policy')); ?></span></a>
                    </li>
                <?php endif; ?>

               
                <?php if(\Auth::user()->type == 'super admin'): ?>
                    <li class="dash-item ">
                        <a href="<?php echo e(route('plan_request.index')); ?>" class="dash-link"><span
                                class="dash-micon"><i
                                    class="ti ti-arrow-down-right-circle"></i></span><span
                                class="dash-mtext"><?php echo e(__('Plan Request')); ?></span></a>

                    </li>
                <?php endif; ?>


                <?php if(Auth::user()->type == 'super admin'): ?>
                    <?php if(Gate::check('manage coupon')): ?>
                        <li class="dash-item ">
                            <a href="<?php echo e(route('coupons.index')); ?>" class="dash-link"><span
                                    class="dash-micon"><i class="ti ti-gift"></i></span><span
                                    class="dash-mtext"><?php echo e(__('Coupon')); ?></span></a>

                        </li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if(\Auth::user()->type == 'super admin'): ?>
                    <?php if(Gate::check('manage order')): ?>
                        <li class="dash-item ">
                            <a href="<?php echo e(route('order.index')); ?>"
                                class="dash-link <?php echo e(request()->is('orders*') ? 'active' : ''); ?>"><span
                                    class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span
                                    class="dash-mtext"><?php echo e(__('Order')); ?></span></a>

                        </li>
                    <?php endif; ?>
                <?php endif; ?>

                <!--report-->
                <!-- <?php if(Gate::check('Manage Report')): ?>
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-list"></i></span><span
                                class="dash-mtext"><?php echo e(__('Report')); ?></span><span
                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Report')): ?>
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.income-expense')); ?>"><?php echo e(__('Income Vs Expense')); ?></a>
                                </li>

                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.monthly.attendance')); ?>"><?php echo e(__('Monthly Attendance')); ?></a>
                                </li>

                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.leave')); ?>"><?php echo e(__('Leave')); ?></a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.account.statement')); ?>"><?php echo e(__('Account Statement')); ?></a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.payroll')); ?>"><?php echo e(__('Payroll')); ?></a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="<?php echo e(route('report.timesheet')); ?>"><?php echo e(__('Timesheet')); ?></a>
                                </li>
                            <?php endif; ?>


                        </ul>
                    </li>
                <?php endif; ?> -->


                <!--constant-->
                <?php if(Gate::check('manage department') ||
                    Gate::check('manage designation') ||
                    Gate::check('manage document type') ||
                    Gate::check('manage branch') ||
                    Gate::check('manage award type') ||
                    Gate::check('manage termination types') ||
                    Gate::check('manage payslip type') ||
                    Gate::check('manage allowance option') ||
                    Gate::check('manage loan options') ||
                    Gate::check('manage deduction options') ||
                    Gate::check('manage expense type') ||
                    Gate::check('manage income type') ||
                    Gate::check('manage
                                             payment type') ||
                    Gate::check('manage leave type') ||
                    Gate::check('manage training type') ||
                    Gate::check('manage job category') ||
                    Gate::check('manage job stage')): ?>
                    <li class="dash-item dash-hasmenu">
                        <a href="<?php echo e(route('branch.index')); ?>" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-table"></i></span><span
                                class="dash-mtext"><?php echo e(__('HRM System Setup')); ?></span></a>
                        </li>
                        <!-- <ul class="dash-submenu">
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage branch')): ?>
                                <li class="dash-item <?php echo e(request()->is('branch*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('branch.index')); ?>"><?php echo e(__('Branch')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage department')): ?>
                                <li class="dash-item <?php echo e(request()->is('department*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('department.index')); ?>"><?php echo e(__('Department')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage designation')): ?>
                                <li class="dash-item <?php echo e(request()->is('designation*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('designation.index')); ?>"><?php echo e(__('Designation')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage document type')): ?>
                                <li class="dash-item <?php echo e(request()->is('document*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('document.index')); ?>"><?php echo e(__('Document Type')); ?></a>
                                </li>
                            <?php endif; ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage award type')): ?>
                                <li class="dash-item <?php echo e(request()->is('awardtype*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('awardtype.index')); ?>"><?php echo e(__('Award Type')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage termination types')): ?>
                                <li
                                    class="dash-item <?php echo e(request()->is('terminationtype*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('terminationtype.index')); ?>"><?php echo e(__('Termination Type')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage payslip type')): ?>
                                <li class="dash-item <?php echo e(request()->is('paysliptype*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('paysliptype.index')); ?>"><?php echo e(__('Payslip Type')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage allowance option')): ?>
                                <li
                                    class="dash-item <?php echo e(request()->is('allowanceoption*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('allowanceoption.index')); ?>"><?php echo e(__('Allowance Option')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Loan Option')): ?>
                                <li class="dash-item <?php echo e(request()->is('loanoption*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('loanoption.index')); ?>"><?php echo e(__('Loan Option')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Deduction Option')): ?>
                                <li
                                    class="dash-item <?php echo e(request()->is('deductionoption*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('deductionoption.index')); ?>"><?php echo e(__('Deduction Option')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage expense type')): ?>
                                <li class="dash-item <?php echo e(request()->is('expensetype*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('expensetype.index')); ?>"><?php echo e(__('Expense Type')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage income type')): ?>
                                <li class="dash-item <?php echo e(request()->is('incometype*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('incometype.index')); ?>"><?php echo e(__('Income Type')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Payment Type')): ?>
                                <li class="dash-item <?php echo e(request()->is('paymenttype*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('paymenttype.index')); ?>"><?php echo e(__('Payment Type')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage leave type')): ?>
                                <li class="dash-item <?php echo e(request()->is('leavetype*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('leavetype.index')); ?>"><?php echo e(__('Leave Type')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Termination Type')): ?>
                                <li
                                    class="dash-item <?php echo e(request()->is('terminationtype*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('terminationtype.index')); ?>"><?php echo e(__('Termination Type')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Goal Type')): ?>
                                <li class="dash-item <?php echo e(request()->is('goaltype*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('goaltype.index')); ?>"><?php echo e(__('Goal Type')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage training type')): ?>
                                <li class="dash-item <?php echo e(request()->is('trainingtype*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('trainingtype.index')); ?>"><?php echo e(__('Training Type')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job category')): ?>
                                <li class="dash-item <?php echo e(request()->is('job-category*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('job-category.index')); ?>"><?php echo e(__('Job Category')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage job stage')): ?>
                                <li class="dash-item <?php echo e(request()->is('job-stage*') ? 'active' : ''); ?>">
                                    <a class="dash-link"
                                        href="<?php echo e(route('job-stage.index')); ?>"><?php echo e(__('Job Stage')); ?></a>
                                </li>
                            <?php endif; ?>

                            <li
                                class="dash-item <?php echo e(request()->is('performanceType*') ? 'active' : ''); ?>">
                                <a class="dash-link"
                                    href="<?php echo e(route('performanceType.index')); ?>"><?php echo e(__('Performance Type')); ?></a>
                            </li>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Competencies')): ?>
                                <li class="dash-item <?php echo e(request()->is('competencies*') ? 'active' : ''); ?>">

                                    <a class="dash-link"
                                        href="<?php echo e(route('competencies.index')); ?>"><?php echo e(__('Competencies')); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li> -->
                <?php endif; ?>
                <!--constant-->


                <?php if(Gate::check('manage company settings') || Gate::check('manage system settings')): ?>
                    <li class="dash-item ">
                        <a href="<?php echo e(route('settings.index')); ?>" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-settings"></i></span><span
                                class="dash-mtext"><?php echo e(__('System Setting')); ?></span></a>

                    </li>
                <?php endif; ?>
            </ul>

            </ul>
        </div>
    </div>
</nav>
<?php /**PATH C:\xampp\htdocs\newaccounts\resources\views/partials/admin/menu.blade.php ENDPATH**/ ?>