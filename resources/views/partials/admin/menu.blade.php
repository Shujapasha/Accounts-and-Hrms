@php
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
@endphp

{{--@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on' || env('SITE_RTL') =='on')--}}
{{--    <nav class="dash-sidebar light-sidebar transprent-bg">--}}
{{--@else--}}
{{--    <nav class="dash-sidebar light-sidebar">--}}
{{--@endif--}}
<nav class="dash-sidebar light-sidebar {{(isset($mode_setting['cust_theme_bg']) && $mode_setting['cust_theme_bg'] == 'on')?'transprent-bg':''}}">
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="#" class="b-brand">
                <img src="{{ $logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"
                alt="{{ config('app.name', 'AccountGo') }}" class="logo logo-lg">
            </a>
        </div>

        <div class="navbar-content">
            <ul class="dash-navbar">
                {{---------  Dashboard ------------}}
                <li class="dash-item ">
                    @if(\Auth::guard('customer')->check())
                        <a href="{{route('customer.dashboard')}}" class="dash-link {{ (Request::route()->getName() == 'customer.dashboard') ? ' active' : '' }}">
                            <span class="dash-micon"><i class="ti ti-home"></i></span>
                            <span class="dash-mtext">{{__('Dashboard')}}</span>
                        </a>
                    @elseif(\Auth::guard('vender')->check())
                        <a href="{{route('vender.dashboard')}}" class="dash-link {{ (Request::route()->getName() == 'vender.dashboard') ? ' active' : '' }}">
                            <span class="dash-micon"><i class="ti ti-home"></i></span>
                            <span class="dash-mtext">{{__('Dashboard')}}</span>
                        </a>
                    @else
                        <a href="{{route('dashboard')}}" class="dash-link {{ (Request::route()->getName() == 'dashboard') ? ' active' : '' }}">
                            <span class="dash-micon"><i class="ti ti-home"></i></span>
                            <span class="dash-mtext">{{__('Dashboard')}}</span>
                        </a>
                    @endif
                </li>

                {{---------  Customer Proposal ------------}}
                @can('manage customer proposal')
                    <li class="dash-item {{ (Request::route()->getName() == 'customer.proposal' || Request::route()->getName() == 'customer.proposal.show') ? ' active' : '' }} ">
                        <a href="{{ route('customer.proposal') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-receipt"></i></span>
                            <span class="dash-mtext">{{__('Proposal')}}</span>
                        </a>
                    </li>
                @endcan

                {{---------  Customer Invoice ------------}}
                @can('manage customer invoice')
                    <li class="dash-item {{ (Request::route()->getName() == 'customer.invoice' || Request::route()->getName() == 'customer.invoice.show') ? ' active' : '' }} ">
                        <a href="{{ route('customer.invoice') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-file-invoice"></i></span>
                            <span class="dash-mtext">{{__('Invoice')}}</span>
                        </a>
                    </li>
                @endcan

                {{---------  Customer Payment ------------}}
                @can('manage customer payment')
                    <li class="dash-item {{ (Request::route()->getName() == 'customer.payment') ? ' active' : '' }} ">
                        <a href="{{ route('customer.payment') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-report-money"></i></span>
                            <span class="dash-mtext">{{__('Payment')}}</span>
                        </a>
                    </li>
                @endcan

                {{---------  Customer Transaction ------------}}
                @can('manage customer transaction')
                    <li class="dash-item {{ (Request::route()->getName() == 'customer.transaction') ? ' active' : '' }}">
                        <a href="{{ route('customer.transaction') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-history"></i></span>
                            <span class="dash-mtext">{{__('Transaction')}}</span>
                        </a>
                    </li>
                @endcan

                {{---------  Vendor Bill ------------}}
                @can('manage vender bill')
                    <li class="dash-item {{ (Request::route()->getName() == 'vender.bill' || Request::route()->getName() == 'vender.bill.show') ? ' active' : '' }}">
                        <a href="{{ route('vender.bill') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-file-invoice"></i></span>
                            <span class="dash-mtext">{{__('Bill')}}</span>
                        </a>
                    </li>
                @endcan
                {{---------  Vendor Payment ------------}}
                @can('manage vender payment')
                    <li class="dash-item {{ (Request::route()->getName() == 'vender.payment') ? ' active' : '' }} ">
                        <a href="{{ route('vender.payment') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-report-money"></i></span>
                            <span class="dash-mtext">{{__('Payment')}}</span>
                        </a>
                    </li>
                @endcan

                {{---------  Vendor Transaction ------------}}
                @can('manage vender transaction')
                    <li class="dash-item {{ (Request::route()->getName() == 'vender.transaction') ? ' active' : '' }}">
                        <a href="{{ route('vender.transaction') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-history"></i></span>
                            <span class="dash-mtext">{{__('Transaction')}}</span>
                        </a>
                    </li>
                @endcan



                {{---------  Staff ------------}}
                @if(\Auth::user()->type=='super admin')
                    @can('manage user')
                        <li class="dash-item">
                            <a href="{{ route('users.index') }}" class="dash-link {{ (Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : '' }}">
                                <span class="dash-micon"><i class="ti ti-users"></i></span>
                                <span class="dash-mtext">{{__('User')}}</span>
                            </a>
                        </li>
                    @endcan
                @else
                    @if( Gate::check('manage user') || Gate::check('manage role'))
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'permissions' )?' active dash-trigger':''}}">
                            <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-users"></i></span><span class="dash-mtext">{{__('Staff')}}</span>
                                <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                            </a>
                            <ul class="dash-submenu {{ (Request::segment(1) == 'users' || Request::segment(1) == 'roles' || Request::segment(1) == 'permissions')?'show':''}}">
                                @can('manage user')
                                    <li class="dash-item {{ (Request::route()->getName() == 'users.index' || Request::route()->getName() == 'users.create' || Request::route()->getName() == 'users.edit') ? ' active' : '' }}">
                                        <a class="dash-link" href="{{ route('users.index') }}">{{__('User')}}</a>
                                    </li>
                                @endcan
                                @can('manage role')
                                    <li class="dash-item {{ (Request::route()->getName() == 'roles.index' || Request::route()->getName() == 'roles.create' || Request::route()->getName() == 'roles.edit') ? ' active' : '' }}">
                                        <a class="dash-link" href="{{route('roles.index')}}">{{ __('Role') }}</a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endif
                @endif

                {{---------  Product & Service ------------}}
                @if(Gate::check('manage product & service'))
                    <li class="dash-item {{ (Request::segment(1) == 'productservice')?'active':''}} ">
                        <a href="{{ route('productservice.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-shopping-cart"></i></span>
                            <span class="dash-mtext">{{__('Product & Services')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Product & Stock ------------}}
                @if(Gate::check('manage product & service'))
                    <li class="dash-item {{ (Request::segment(1) == 'productstock')?'active':''}}">
                        <a href="{{ route('productstock.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-box"></i></span>
                            <span class="dash-mtext">{{__('Product Stock')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Customer ------------}}
                @if(Gate::check('manage customer'))
                    <li class="dash-item {{ (Request::segment(1) == 'customer')?'active':''}}">
                        <a href="{{ route('customer.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-user-plus"></i></span>
                            <span class="dash-mtext">{{__('Customer')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Vendor ------------}}
                @if(Gate::check('manage vender'))
                    <li class="dash-item {{ (Request::segment(1) == 'vender')?'active':''}}">
                        <a href="{{ route('vender.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-note"></i></span>
                            <span class="dash-mtext">{{__('Vendor')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Proposal ------------}}
                @if(Gate::check('manage proposal'))
                    <li class="dash-item {{ (Request::segment(1) == 'proposal')?'active':''}}">
                        <a href="{{ route('proposal.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-receipt"></i></span>
                            <span class="dash-mtext">{{__('Proposal')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Banking ------------}}
                @if( Gate::check('manage bank account') ||  Gate::check('manage transfer'))
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'bank-account' || Request::segment(1) == 'transfer')?' active dash-trigger':''}}">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-building-bank"></i></span><span class="dash-mtext">{{__('Banking')}}</span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu {{ (Request::segment(1) == 'bank-account' || Request::segment(1) == 'transfer')?'show':''}}">
                            @can('manage bank account')
                                <li class="dash-item {{ (Request::route()->getName() == 'bank-account.index' || Request::route()->getName() == 'bank-account.create' || Request::route()->getName() == 'bank-account.edit') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('bank-account.index') }}">{{__('Account')}}</a>
                                </li>
                            @endcan
                            @can('manage transfer')
                                <li class="dash-item {{ (Request::route()->getName() == 'transfer.index' || Request::route()->getName() == 'transfer.create' || Request::route()->getName() == 'transfer.edit') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('transfer.index')}}">{{ __('Transfer') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                {{---------  Income ------------}}
                @if( Gate::check('manage invoice') ||  Gate::check('manage revenue') ||  Gate::check('manage credit note'))

                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note')?' active dash-trigger':''}}">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-file-invoice"></i></span><span class="dash-mtext">{{__('Income')}}</span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu {{ (Request::segment(1) == 'invoice' || Request::segment(1) == 'revenue' || Request::segment(1) == 'credit-note')?'show':''}}">
                            @can('manage invoice')
                                <li class="dash-item {{ (Request::route()->getName() == 'invoice.index' || Request::route()->getName() == 'invoice.create' || Request::route()->getName() == 'invoice.edit' || Request::route()->getName() == 'invoice.show') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('invoice.index') }}">{{__('Invoice')}}</a>
                                </li>
                            @endcan
                            @can('manage revenue')
                                <li class="dash-item {{ (Request::route()->getName() == 'revenue.index' || Request::route()->getName() == 'revenue.create' || Request::route()->getName() == 'revenue.edit') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('revenue.index')}}">{{ __('Revenue') }}</a>
                                </li>
                            @endcan
                            @can('manage credit note')
                                <li class="dash-item {{ (Request::route()->getName() == 'credit.note' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('credit.note')}}">{{ __('Credit Note') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>

                @endif

                {{---------  Expense ------------}}
                @if( Gate::check('manage bill')  ||  Gate::check('manage payment') ||  Gate::check('manage debit note'))
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note'  )?' active dash-trigger':''}}">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-report-money"></i></span><span class="dash-mtext">{{__('Expense')}}</span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu  {{ (Request::segment(1) == 'bill' || Request::segment(1) == 'payment' || Request::segment(1) == 'debit-note'  )?'show':''}}">
                            @can('manage bill')
                                <li class="dash-item  {{ (Request::route()->getName() == 'bill.index' || Request::route()->getName() == 'bill.create' || Request::route()->getName() == 'bill.edit' || Request::route()->getName() == 'bill.show') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('bill.index') }}">{{__('Bill')}}</a>
                                </li>
                            @endcan
                            @can('manage payment')
                                <li class="dash-item {{ (Request::route()->getName() == 'payment.index' || Request::route()->getName() == 'payment.create' || Request::route()->getName() == 'payment.edit') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('payment.index')}}">{{ __('Payment') }}</a>
                                </li>
                            @endcan
                            @can('manage debit note')
                                <li class="dash-item {{ (Request::route()->getName() == 'debit.note' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('debit.note')}}">{{ __('Debit Note') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                {{---------  Double Entry ------------}}
                @if( Gate::check('manage chart of account') ||  Gate::check('manage journal entry') ||   Gate::check('balance sheet report') ||  Gate::check('ledger report') ||  Gate::check('trial balance report'))
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'chart-of-account' || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance')?' active dash-trigger':''}}">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-scale"></i></span><span class="dash-mtext">{{__('Double Entry')}}</span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu {{ (Request::segment(1) == 'chart-of-account'  || Request::segment(1) == 'journal-entry' || Request::segment(2) == 'ledger' ||  Request::segment(2) == 'balance-sheet' ||  Request::segment(2) == 'trial-balance')?'show':''}}">
                            @can('manage chart of account')
                                <li class="dash-item {{ (Request::route()->getName() == 'chart-of-account.index') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('chart-of-account.index') }}">{{__('Chart of Accounts')}}</a>
                                </li>
                            @endcan
                            @can('manage journal entry')
                                <li class="dash-item {{ (Request::route()->getName() == 'journal-entry.index' || Request::route()->getName() == 'journal-entry.show') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('journal-entry.index') }}">{{ __('Journal Account') }}</a>
                                </li>
                            @endcan
                            @can('ledger report')
                                <li class="dash-item {{ (Request::route()->getName() == 'report.ledger' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('report.ledger')}}">{{ __('Ledger Summary') }}</a>
                                </li>
                            @endcan
                            @can('balance sheet report')
                                <li class="dash-item {{ (Request::route()->getName() == 'report.balance.sheet' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('report.balance.sheet')}}">{{ __('Balance Sheet') }}</a>
                                </li>
                            @endcan
                            @can('trial balance report')
                                <li class="dash-item {{ (Request::route()->getName() == 'trial.balance' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('trial.balance')}}">{{ __('Trial Balance') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                {{---------  Budget Planner ------------}}
                @if(\Auth::user()->type =='company')
                    <li class="dash-item {{ (Request::segment(1) == 'budget')?'active':''}}">
                        <a href="{{ route('budget.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-businessplan"></i></span>
                            <span class="dash-mtext">{{__('Budget Planner')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Contract ------------}}

                @if(Gate::check('manage contract')) 
                    <li class="dash-item {{ (Request::segment(1) == 'contract')?'active':''}}">
                        <a href="{{ route('contract.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-businessplan"></i></span>
                            <span class="dash-mtext">{{__('Contract')}}</span>
                        </a>
                    </li>
                @endif

                @can('manage customer contract')
                    <li class="dash-item {{ (Request::segment(2) == 'contract')?'active':''}}">
                        <a href="{{ route('customer.contract.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-businessplan"></i></span>
                            <span class="dash-mtext">{{__('Contract')}}</span>
                        </a>
                    </li>
                @endcan

                {{---------  Goal------------}}
                @if(Gate::check('manage goal'))
                    <li class="dash-item {{ (Request::segment(1) == 'goal')?'active':''}}">
                        <a href="{{ route('goal.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-target"></i></span>
                            <span class="dash-mtext">{{__('Goal')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Asset ------------}}
                @if(Gate::check('manage assets'))
                    <li class="dash-item {{ (Request::segment(1) == 'account-assets')?'active':''}}">
                        <a href="{{ route('account-assets.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-calculator"></i></span>
                            <span class="dash-mtext">{{__('Assets')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Plan------------}}
                @if(Gate::check('manage plan'))
                    <li class="dash-item {{ Request::segment(1) == 'plans' || Request::segment(1) == 'stripe'   ?'active':''}}">
                        <a href="{{ route('plans.index') }}" class="dash-link  ">
                            <span class="dash-micon"><i class="ti ti-trophy"></i></span>
                            <span class="dash-mtext">{{__('Plan')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Plan Request------------}}
                @if(\Auth::user()->type=='super admin')
                    <li class="dash-item  {{ request()->is('plan_request*') ? 'active' : '' }}">
                        <a href="{{ route('plan_request.index') }}" class="dash-link">
                            <span class="dash-micon"><i class="ti ti-arrow-up-right-circle"></i></span>
                            <span class="dash-mtext">{{__('Plan Request')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Coupon ------------}}
                @if(Gate::check('manage coupon'))
                    <li class="dash-item {{ (Request::segment(1) == 'coupons')?'active':''}}">
                        <a href="{{ route('coupons.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-gift"></i></span>
                            <span class="dash-mtext">{{__('Coupon')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Order ------------}}
                @if(Gate::check('manage order'))
                    <li class="dash-item {{ (Request::segment(1) == 'order')?'active':''}}">
                        <a href="{{ route('order.index') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-shopping-cart-plus"></i></span>
                            <span class="dash-mtext">{{__('Order')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Email Notification ------------}}
                    
                @if(\Auth::user()->type=='super admin')
                    <li class="dash-item">
                        <a href="{{ route('manage.email.language',[$emailTemplate->id,\Auth::user()->lang]) }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-template"></i></span><span
                                class="dash-mtext">{{ __('Email Template') }}</span></a>
                    </li>
                @endif

                <!-- @if (\Auth::user()->type == 'company')
                    <li class="dash-item">
                        <a href="{{ route('email_template.index') }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-notification"></i></span><span
                                class="dash-mtext">{{ __('Email Notification') }}</span></a>
                    </li>
                @endif -->


                {{---------  Report ------------}}
                @if( Gate::check('income report') || Gate::check('expense report') || Gate::check('income vs expense report') || Gate::check('tax report')  || Gate::check('loss & profit report') || Gate::check('invoice report') || Gate::check('bill report') || Gate::check('invoice report') ||  Gate::check('manage transaction')||  Gate::check('statement report'))
                    <li class="dash-item dash-hasmenu {{ ((Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance')?' active dash-trigger':''}}">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i class="ti ti-chart-line"></i></span><span class="dash-mtext">{{__('Report')}}</span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu {{ ((Request::segment(1) == 'report' || Request::segment(1) == 'transaction') &&  Request::segment(2) != 'ledger' &&  Request::segment(2) != 'balance-sheet' &&  Request::segment(2) != 'trial-balance')?'show':''}}">
                            @can('manage transaction')
                                <li class="dash-item {{ (Request::route()->getName() == 'transaction.index' || Request::route()->getName() == 'transfer.create' || Request::route()->getName() == 'transaction.edit') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('transaction.index') }}">{{__('Transaction')}}</a>
                                </li>
                            @endcan
                            @can('statement report')
                                <li class="dash-item {{ (Request::route()->getName() == 'report.account.statement') ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('report.account.statement')}}">{{ __('Account Statement') }}</a>
                                </li>
                            @endcan
                            @can('income report')
                                <li class="dash-item {{ (Request::route()->getName() == 'report.income.summary' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('report.income.summary')}}">{{ __('Income Summary') }}</a>
                                </li>
                            @endcan
                            @can('expense report')
                                <li class="dash-item {{ (Request::route()->getName() == 'report.expense.summary' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('report.expense.summary')}}">{{ __('Expense Summary') }}</a>
                                </li>
                            @endcan
                            @can('income vs expense report')
                                <li class="dash-item {{ (Request::route()->getName() == 'report.income.vs.expense.summary' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('report.income.vs.expense.summary')}}">{{ __('Income VS Expense') }}</a>
                                </li>
                            @endcan
                            @can('tax report')
                                <li class="dash-item {{ (Request::route()->getName() == 'report.tax.summary' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('report.tax.summary')}}">{{ __('Tax Summary') }}</a>
                                </li>
                            @endcan
                            @can('loss & profit report')
                                <li class="dash-item {{ (Request::route()->getName() == 'report.profit.loss.summary' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('report.profit.loss.summary')}}">{{ __('Profit & Loss') }}</a>
                                </li>
                            @endcan
                            @can('invoice report')
                                <li class="dash-item {{ (Request::route()->getName() == 'report.invoice.summary' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('report.invoice.summary')}}">{{ __('Invoice Summary') }}</a>
                                </li>
                            @endcan
                            @can('bill report')
                                <li class="dash-item {{ (Request::route()->getName() == 'report.bill.summary' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('report.bill.summary')}}">{{ __('Bill Summary') }}</a>
                                </li>
                            @endcan
                            @can('stock report')
                                <li class="dash-item {{ (Request::route()->getName() == 'report.product.stock.report' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('report.product.stock.report')}}">{{ __('Product Stock') }}</a>
                                </li>
                            @endcan


                        </ul>
                    </li>
                @endif

                {{---------  Constant ------------}}
                @if(Gate::check('manage constant tax') || Gate::check('manage constant category') ||Gate::check('manage constant unit') ||Gate::check('manage constant payment method') ||Gate::check('manage constant custom field') || Gate::check('manage constant chart of account'))
                    <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')?' active dash-trigger':''}} ">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-chart-arcs"></i></span><span class="dash-mtext">{{__('Constant')}}</span>
                            <span class="dash-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="dash-submenu {{ (Request::segment(1) == 'taxes' || Request::segment(1) == 'product-category' || Request::segment(1) == 'product-unit' || Request::segment(1) == 'payment-method' || Request::segment(1) == 'custom-field' || Request::segment(1) == 'chart-of-account-type')?'show':''}}">
                            @can('manage constant tax')
                                <li class="dash-item {{ (Request::route()->getName() == 'taxes.index' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{ route('taxes.index') }}">{{__('Taxes')}}</a>
                                </li>
                            @endcan
                            @can('manage constant category')
                                <li class="dash-item {{ (Request::route()->getName() == 'product-category.index' ) ? 'active' : '' }}">
                                    <a class="dash-link" href="{{route('product-category.index')}}">{{ __('Category') }}</a>
                                </li>
                            @endcan
                            @can('manage constant unit')
                                <li class="dash-item {{ (Request::route()->getName() == 'product-unit.index' ) ? ' active' : '' }}">
                                    <a class="dash-link" href="{{route('product-unit.index')}}">{{ __('Unit') }}</a>
                                </li>
                            @endcan
                            @can('manage constant custom field')
                                <li class="dash-item {{ (Request::route()->getName() == 'custom-field.index' ) ? 'active' : '' }}">
                                    <a class="dash-link" href="{{route('custom-field.index')}}">{{ __('Custom Field') }}</a>
                                </li>
                            @endcan
                                <li class="dash-item {{ (Request::route()->getName() == 'contractType.index' ) ? 'active' : '' }}">
                                    <a class="dash-link" href="{{route('contractType.index')}}">{{ __('Contract Type') }}</a>
                                </li>
                        </ul>
                    </li>
                @endif


                {{---------  System Setting ------------}}
                @if(Gate::check('manage system settings'))
                    <li class="dash-item {{ (Request::route()->getName() == 'systems.index') ? ' active' : '' }}">
                        <a href="{{ route('systems.index') }}" class="dash-link  ">
                            <span class="dash-micon"><i class="ti ti-settings"></i></span>
                            <span class="dash-mtext">{{__('System Setting')}}</span>
                        </a>
                    </li>
                @endif

                {{---------  Company Setting ------------}}
                @if(Gate::check('manage company settings'))
                    <li class="dash-item {{ (Request::route()->getName() == 'systems.index') ? ' active' : '' }}">
                        <a href="{{ route('company.setting') }}" class="dash-link ">
                            <span class="dash-micon"><i class="ti ti-settings"></i></span>
                            <span class="dash-mtext">{{__('Company Setting')}}</span>
                        </a>
                    </li>
                @endif


                            @if (Gate::check('manage report'))
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link"><span class=""><i
                                    class=""></i></span><span
                                class="dash-mtext">{{ __('Report') }}</span><span
                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            @can('manage report')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.income-expense') }}">{{ __('Income Vs Expense') }}</a>
                                </li>

                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.monthly.attendance') }}">{{ __('Monthly Attendance') }}</a>
                                </li>

                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.leave') }}">{{ __('Leave') }}</a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.account.statement') }}">{{ __('Account Statement') }}</a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.payroll') }}">{{ __('Payroll') }}</a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.timesheet') }}">{{ __('Timesheet') }}</a>
                                </li>
                            @endcan


                        </ul>
                    </li>
                @endif
                          

                        </ul>
                    </li>
                <!--dashboard-->
                <ul class="dash-navbar">
                <!-- user-->
                @if (\Auth::user()->type == 'super admin')
                    <li class="dash-item">
                        <a href="{{ route('user.index') }}" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-user"></i></span><span
                                class="dash-mtext">{{ __('Company') }}</span></a>
                    </li>
                @else
                    @if (Gate::check('manage user') || Gate::check('manage role') || Gate::check('manage employee profile') || Gate::check('manage employee last login'))
                        <li class="dash-item dash-hasmenu">
                            <a href="#!" class="dash-link"><span class="dash-micon"><i
                                        class="ti ti-users"></i></span><span
                                    class="dash-mtext">{{ __('Staff') }}</span><span class="dash-arrow"><i
                                        data-feather="chevron-right"></i></span></a>
                            <ul class="dash-submenu">
                                @can('manage user')
                                    <li class="dash-item">
                                        <a class="dash-link"
                                            href="{{ route('user.index') }}">{{ __('User') }}</a>
                                    </li>
                                @endcan
                                @can('manage role')
                                    <li class="dash-item">
                                        <a class="dash-link"
                                            href="{{ route('roles.index') }}">{{ __('Role') }}</a>
                                    </li>
                                @endcan
                                @can('manage employee profile')
                                    <li class="dash-item">
                                        <a class="dash-link"
                                            href="{{ route('employee.profile') }}">{{ __('Employee Profile') }}</a>
                                    </li>
                                @endcan
                                @can('manage employee last login')
                                    <li class="dash-item">
                                        <a class="dash-link"
                                            href="{{ route('lastlogin') }}">{{ __('Last Login') }}</a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endif
                @endif
                <!-- user-->

                <!-- employee-->
                @if (Gate::check('manage employee'))
                    @if (\Auth::user()->type == 'employee')
                        @php
                            $employee = App\Models\Employee::where('user_id', \Auth::user()->id)->first();
                        @endphp
                        <li class="dash-item {{ Request::segment(1) == 'employee' ? 'active' : '' }}">
                            <a href="{{ route('employee.show', \Illuminate\Support\Facades\Crypt::encrypt($employee->id)) }}"
                                class="dash-link"><span class="dash-micon"><i
                                        class="ti ti-user"></i></span><span
                                    class="dash-mtext">{{ __('Employee') }}</span></a>
                        </li>
                    @else
                        <li class="dash-item {{ Request::segment(1) == 'employee' ? 'active' : '' }}">
                            <a href="{{ route('employee.index') }}" class="dash-link"><span
                                    class="dash-micon"><i class="ti ti-user"></i></span><span
                                    class="dash-mtext">{{ __('Employee') }}</span></a>
                        </li>
                    @endif
                @endif
                <!-- employee-->

                <!-- payroll-->
                @if (Gate::check('manage set salary') || Gate::check('manage pay slip'))
                    <li
                        class="dash-item dash-hasmenu  {{ Request::segment(1) == 'setsalary' ? 'dash-trigger active' : '' }}">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-receipt"></i></span><span
                                class="dash-mtext">{{ __('Payroll') }}</span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu ">
                            <li class="dash-item {{ Request::segment(1) == 'setsalary' ? 'active' : '-' }}">
                                <a class="dash-link"
                                    href="{{ route('setsalary.index') }}">{{ __('Set Salary') }}</a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="{{ route('payslip.index') }}">{{ __('Payslip') }}</a>
                            </li>

                        </ul>
                    </li>
                @endif
                <!-- payroll-->

                @if (\Auth::user()->type == 'employee')
                    <li
                        class="dash-item dash-hasmenu {{ Request::segment(1) == 'setsalary' ? 'dash-trigger active' : '' }}">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-receipt"></i></span><span
                                class="dash-mtext">{{ __('Payroll') }}</span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <li class="dash-item {{ Request::segment(1) == 'setsalary' ? 'active' : '-' }}">
                                <a class="dash-link"
                                    href="{{ route('setsalary.show', \Auth::user()->id) }}">{{ __('Set Salary') }}</a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="{{ route('payslip.index') }}">{{ __('Payslip') }}</a>
                            </li>
                        </ul>
                    </li>
                @endif

                <!-- timesheet-->
                @if (Gate::check('manage attendance') || Gate::check('manage leave') || Gate::check('manage timesheet'))
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-clock"></i></span><span
                                class="dash-mtext">{{ __('Timesheet') }}</span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            @can('manage timesheet')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('timesheet.index') }}">{{ __('Timesheet') }}</a>
                                </li>
                            @endcan
                            @can('manage leave')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('leave.index') }}">{{ __('Manage Leave') }}</a>
                                </li>
                            @endcan
                            @can('manage attendance')
                                <li class="dash-item dash-hasmenu">
                                    <a href="#!" class="dash-link"><span
                                            class="dash-mtext">{{ __('Attendance') }}</span><span
                                            class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                    <ul class="dash-submenu">
                                        <li class="dash-item">
                                            <a class="dash-link"
                                                href="{{ route('attendanceemployee.index') }}">{{ __('Marked Attendance') }}</a>
                                        </li>
                                        @can('create attendance')
                                            <li class="dash-item">
                                                <a class="dash-link"
                                                    href="{{ route('attendanceemployee.bulkattendance') }}">{{ __('Bulk Attendance') }}</a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                <!--timesheet-->

                <!-- performance-->
                @if (Gate::check('manage indicator') || Gate::check('manage appraisal') || Gate::check('manage goal tracking'))
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-3d-cube-sphere"></i></span><span
                                class="dash-mtext">{{ __('Performance') }}</span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            @can('manage indicator')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('indicator.index') }}">{{ __('Indicator') }}</a>
                                </li>
                            @endcan

                            @can('manage appraisal')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('appraisal.index') }}">{{ __('Appraisal') }}</a>
                                </li>
                            @endcan

                            @can('manage goal tracking')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('goaltracking.index') }}">{{ __('Goal Tracking') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                <!--performance-->

                <!--fianance-->
                @if (Gate::check('manage account list') || Gate::check('manage payee') || Gate::check('manage payer') || Gate::check('manage deposit') || Gate::check('manage expense') || Gate::check('manage transfer balance'))
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-wallet"></i></span><span
                                class="dash-mtext">{{ __('Finance') }}</span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            @can('manage account list')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('accountlist.index') }}">{{ __('Account List') }}</a>
                                </li>
                            @endcan
                            @can('view balance account list')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('accountbalance') }}">{{ __('Account Balance') }}</a>
                                </li>
                            @endcan
                            @can('manage payee')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('payees.index') }}">{{ __('Payees') }}</a>
                                </li>
                            @endcan

                            @can('manage payer')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('payer.index') }}">{{ __('Payers') }}</a>
                                </li>
                            @endcan

                            @can('manage deposit')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('deposit.index') }}">{{ __('Deposit') }}</a>
                                </li>
                            @endcan

                            @can('manage expense')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('expense.index') }}">{{ __('Expense') }}</a>
                                </li>
                            @endcan

                            @can('manage transfer balance')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('transferbalance.index') }}">{{ __('Transfer Balance') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                <!-- fianance-->

                <!--trainning-->
                @if (Gate::check('manage trainer') || Gate::check('manage training'))
                    <li
                        class="dash-item dash-hasmenu {{ Request::segment(1) == 'training' ? 'dash-trigger active' : '' }}">
                        <a href="#!" class="dash-link "><span class="dash-micon"><i
                                    class="ti ti-school"></i></span><span
                                class="dash-mtext">{{ __('Training') }}</span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            @can('manage training')
                                <li class="dash-item {{ Request::segment(1) == 'training' ? ' active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('training.index') }}">{{ __('Training List') }}</a>
                                </li>
                            @endcan

                            @can('manage trainer')
                                <li class="dash-item ">
                                    <a class="dash-link"
                                        href="{{ route('trainer.index') }}">{{ __('Trainer') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif

                <!-- tranning-->


                <!-- HR-->
                @if (Gate::check('manage awards') || Gate::check('manage transfer') || Gate::check('manage resignation') || Gate::check('manage travels') || Gate::check('manage promotion') || Gate::check('manage complaint') || Gate::check('manage warning') || Gate::check('manage termination') || Gate::check('manage announcement') || Gate::check('manage holiday'))
                    <li
                        class="dash-item dash-hasmenu {{ Request::segment(1) == 'holiday' ? 'dash-trigger active' : '' }}">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-user-plus"></i></span><span
                                class="dash-mtext">{{ __('HR Admin Setup') }}</span><span class="dash-arrow"><i
                                    data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            <li class="dash-item {{ Request::segment(1) == 'award' ? 'active' : '' }}">
                                <a class="dash-link" href="{{ route('award.index') }}">{{ __('Award') }}</a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="{{ route('transfer.index') }}">{{ __('Transfer') }}</a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="{{ route('resignation.index') }}">{{ __('Resignation') }}</a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="{{ route('travel.index') }}">{{ __('Trip') }}</a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="{{ route('promotion.index') }}">{{ __('Promotion') }}</a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="{{ route('complaint.index') }}">{{ __('Complaints') }}</a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="{{ route('warning.index') }}">{{ __('Warning') }}</a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="{{ route('termination.index') }}">{{ __('Termination') }}</a>
                            </li>
                            <li class="dash-item">
                                <a class="dash-link"
                                    href="{{ route('announcement.index') }}">{{ __('Announcement') }}</a>
                            </li>
                            <li class="dash-item {{ Request::segment(1) == 'holiday' ? ' active' : '' }}">
                                <a class="dash-link"
                                    href="{{ route('holiday.index') }}">{{ __('Holidays') }}</a>
                            </li>
                        </ul>
                    </li>
                @endif
                <!-- HR-->

               <!-- recruitment-->
                @if (Gate::check('manage job') || Gate::check('manage job application') || Gate::check('manage job onboard') || Gate::check('manage custom question') || Gate::check('manage interview schedule') || Gate::check('manage career'))
                    <li
                        class="dash-item dash-hasmenu  {{ Request::segment(1) == 'job' || Request::segment(1) == 'job-application' ? 'dash-trigger active' : '' }} ">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-license"></i></span><span
                                class="dash-mtext">{{ __('Recruitment') }}</span><span
                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            @can('manage job')
                                <li class="dash-item {{ Request::segment(1) == 'job' ? 'active' : '-' }}">
                                    <a class="dash-link" href="{{ route('job.index') }}">{{ __('Jobs') }}</a>
                                </li>
                            @endcan
                             @can('manage job')
                                <li class="dash-item {{ Request::segment(1) == 'job' ? 'active' : '-' }}">
                                    <a class="dash-link" href="{{ route('job.create') }}">{{ __('Job Create') }}</a>
                                </li>
                            @endcan
                            @can('manage job application')
                                <li class="dash-item ">
                                    <a class="dash-link"
                                        href="{{ route('job-application.index') }}">{{ __('Job Application') }}</a>
                                </li>
                            @endcan
                            @can('manage job application')

                                <li class="dash-item  {{ Request::segment(2) == 'candidate' ? 'active' : '-' }}">
                                    <a class="dash-link"
                                        href="{{ route('job.application.candidate') }}">{{ __('Job Candidate') }}</a>
                                </li>
                            @endcan

                            @can('manage job onboard')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('job.on.board') }}">{{ __('Job On-Boarding') }}</a>
                                </li>
                            @endcan

                            @can('manage custom question')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('custom-question.index') }}">{{ __('Custom Question') }}</a>
                                </li>
                            @endcan

                            @can('manage interview schedule')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('interview-schedule.index') }}">{{ __('Interview Schedule') }}</a>
                                </li>
                            @endcan

                            @can('manage career')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('career', [\Auth::user()->creatorId(), 'en']) }}"
                                        target="_blank">{{ __('Career') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endif
                <!-- recruitment-->

                <!--chats-->
                @if (\Auth::user()->type != 'super admin')
                    <li class="dash-item">
                        <a href="{{ url('chats') }}" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-messages"></i></span><span
                                class="dash-mtext">{{ __('Chats') }}</span></a>
                    </li>
                @endif

                <!-- ticket-->
                @can('manage ticket')
                    <li class="dash-item {{ Request::segment(1) == 'ticket' ? 'active' : '' }}">
                        <a href="{{ route('ticket.index') }}" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-ticket"></i></span><span
                                class="dash-mtext">{{ __('Ticket') }}</span></a>
                    </li>
                @endcan

                <!-- Event-->
                @can('manage event')
                    <li class="dash-item">
                        <a href="{{ route('event.index') }}" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-calendar-event"></i></span><span
                                class="dash-mtext">{{ __('Event') }}</span></a>
                    </li>
                @endcan


                <!--meeting-->
                @can('manage meeting')
                    <li class="dash-item {{ Request::segment(1) == 'meeting' ? 'active' : '' }}">
                        <a href="{{ route('meeting.index') }}" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-calendar-time"></i></span><span
                                class="dash-mtext">{{ __('Meeting') }}</span></a>
                    </li>
                @endcan


                <!-- Zoom meeting-->
                @if (\Auth::user()->type != 'super admin')
                    <li class="dash-item {{ Request::segment(1) == 'zoommeeting' ? 'active' : '' }}">
                        <a href="{{ route('zoom-meeting.index') }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-video"></i></span><span
                                class="dash-mtext">{{ __('Zoom Meeting') }}</span></a>
                    </li>
                @endif

                <!-- assets-->
                @if (Gate::check('manage assets'))
                    <li class="dash-item">
                        <a href="{{ route('account-assets.index') }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-medical-cross"></i></span><span
                                class="dash-mtext">{{ __('Assets') }}</span></a>
                    </li>
                @endcan


                <!-- document-->
                @if (Gate::check('manage document'))
                    <li class="dash-item">
                        <a href="{{ route('document-upload.index') }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-file"></i></span><span
                                class="dash-mtext">{{ __('Document') }}</span></a>
                    </li>
                @endcan
                @if (\Auth::user()->type == 'company')
                <li class="dash-item">
                    <a href="{{ route('manage.email.language',[$emailTemplate ->id,\Auth::user()->lang]) }}" class="dash-link"><span
                            class="dash-micon"><i class="ti ti-template"></i></span><span
                            class="dash-mtext">{{ __('Email Template') }}</span></a>
                </li>
            @endif

                <!--company policy-->



                @if (Gate::check('manage company policy'))
                    <li class="dash-item">
                        <a href="{{ route('company-policy.index') }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-pray"></i></span><span
                                class="dash-mtext">{{ __('Company Policy') }}</span></a>
                    </li>
                @endcan

               
                @if (\Auth::user()->type == 'super admin')
                    <li class="dash-item ">
                        <a href="{{ route('plan_request.index') }}" class="dash-link"><span
                                class="dash-micon"><i
                                    class="ti ti-arrow-down-right-circle"></i></span><span
                                class="dash-mtext">{{ __('Plan Request') }}</span></a>

                    </li>
                @endif


                @if (Auth::user()->type == 'super admin')
                    @if (Gate::check('manage coupon'))
                        <li class="dash-item ">
                            <a href="{{ route('coupons.index') }}" class="dash-link"><span
                                    class="dash-micon"><i class="ti ti-gift"></i></span><span
                                    class="dash-mtext">{{ __('Coupon') }}</span></a>

                        </li>
                    @endif
                @endif
                @if (\Auth::user()->type == 'super admin')
                    @if (Gate::check('manage order'))
                        <li class="dash-item ">
                            <a href="{{ route('order.index') }}"
                                class="dash-link {{ request()->is('orders*') ? 'active' : '' }}"><span
                                    class="dash-micon"><i class="ti ti-shopping-cart"></i></span><span
                                    class="dash-mtext">{{ __('Order') }}</span></a>

                        </li>
                    @endif
                @endif

                <!--report-->
                <!-- @if (Gate::check('Manage Report'))
                    <li class="dash-item dash-hasmenu">
                        <a href="#!" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-list"></i></span><span
                                class="dash-mtext">{{ __('Report') }}</span><span
                                class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                        <ul class="dash-submenu">
                            @can('Manage Report')
                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.income-expense') }}">{{ __('Income Vs Expense') }}</a>
                                </li>

                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.monthly.attendance') }}">{{ __('Monthly Attendance') }}</a>
                                </li>

                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.leave') }}">{{ __('Leave') }}</a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.account.statement') }}">{{ __('Account Statement') }}</a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.payroll') }}">{{ __('Payroll') }}</a>
                                </li>


                                <li class="dash-item">
                                    <a class="dash-link"
                                        href="{{ route('report.timesheet') }}">{{ __('Timesheet') }}</a>
                                </li>
                            @endcan


                        </ul>
                    </li>
                @endif -->


                <!--constant-->
                @if (Gate::check('manage department') ||
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
                    Gate::check('manage job stage'))
                    <li class="dash-item dash-hasmenu">
                        <a href="{{route('branch.index')}}" class="dash-link"><span class="dash-micon"><i
                                    class="ti ti-table"></i></span><span
                                class="dash-mtext">{{ __('HRM System Setup') }}</span></a>
                        </li>
                        <!-- <ul class="dash-submenu">
                            @can('manage branch')
                                <li class="dash-item {{ request()->is('branch*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('branch.index') }}">{{ __('Branch') }}</a>
                                </li>
                            @endcan
                            @can('manage department')
                                <li class="dash-item {{ request()->is('department*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('department.index') }}">{{ __('Department') }}</a>
                                </li>
                            @endcan
                            @can('manage designation')
                                <li class="dash-item {{ request()->is('designation*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('designation.index') }}">{{ __('Designation') }}</a>
                                </li>
                            @endcan
                            @can('manage document type')
                                <li class="dash-item {{ request()->is('document*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('document.index') }}">{{ __('Document Type') }}</a>
                                </li>
                            @endcan

                            @can('manage award type')
                                <li class="dash-item {{ request()->is('awardtype*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('awardtype.index') }}">{{ __('Award Type') }}</a>
                                </li>
                            @endcan
                            @can('manage termination types')
                                <li
                                    class="dash-item {{ request()->is('terminationtype*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('terminationtype.index') }}">{{ __('Termination Type') }}</a>
                                </li>
                            @endcan
                            @can('manage payslip type')
                                <li class="dash-item {{ request()->is('paysliptype*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('paysliptype.index') }}">{{ __('Payslip Type') }}</a>
                                </li>
                            @endcan
                            @can('manage allowance option')
                                <li
                                    class="dash-item {{ request()->is('allowanceoption*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('allowanceoption.index') }}">{{ __('Allowance Option') }}</a>
                                </li>
                            @endcan
                            @can('Manage Loan Option')
                                <li class="dash-item {{ request()->is('loanoption*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('loanoption.index') }}">{{ __('Loan Option') }}</a>
                                </li>
                            @endcan
                            @can('Manage Deduction Option')
                                <li
                                    class="dash-item {{ request()->is('deductionoption*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('deductionoption.index') }}">{{ __('Deduction Option') }}</a>
                                </li>
                            @endcan
                            @can('manage expense type')
                                <li class="dash-item {{ request()->is('expensetype*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('expensetype.index') }}">{{ __('Expense Type') }}</a>
                                </li>
                            @endcan
                            @can('manage income type')
                                <li class="dash-item {{ request()->is('incometype*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('incometype.index') }}">{{ __('Income Type') }}</a>
                                </li>
                            @endcan
                            @can('Manage Payment Type')
                                <li class="dash-item {{ request()->is('paymenttype*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('paymenttype.index') }}">{{ __('Payment Type') }}</a>
                                </li>
                            @endcan
                            @can('manage leave type')
                                <li class="dash-item {{ request()->is('leavetype*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('leavetype.index') }}">{{ __('Leave Type') }}</a>
                                </li>
                            @endcan
                            @can('Manage Termination Type')
                                <li
                                    class="dash-item {{ request()->is('terminationtype*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('terminationtype.index') }}">{{ __('Termination Type') }}</a>
                                </li>
                            @endcan
                            @can('Manage Goal Type')
                                <li class="dash-item {{ request()->is('goaltype*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('goaltype.index') }}">{{ __('Goal Type') }}</a>
                                </li>
                            @endcan
                            @can('manage training type')
                                <li class="dash-item {{ request()->is('trainingtype*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('trainingtype.index') }}">{{ __('Training Type') }}</a>
                                </li>
                            @endcan
                            @can('manage job category')
                                <li class="dash-item {{ request()->is('job-category*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('job-category.index') }}">{{ __('Job Category') }}</a>
                                </li>
                            @endcan
                            @can('manage job stage')
                                <li class="dash-item {{ request()->is('job-stage*') ? 'active' : '' }}">
                                    <a class="dash-link"
                                        href="{{ route('job-stage.index') }}">{{ __('Job Stage') }}</a>
                                </li>
                            @endcan

                            <li
                                class="dash-item {{ request()->is('performanceType*') ? 'active' : '' }}">
                                <a class="dash-link"
                                    href="{{ route('performanceType.index') }}">{{ __('Performance Type') }}</a>
                            </li>

                            @can('Manage Competencies')
                                <li class="dash-item {{ request()->is('competencies*') ? 'active' : '' }}">

                                    <a class="dash-link"
                                        href="{{ route('competencies.index') }}">{{ __('Competencies') }}</a>
                                </li>
                            @endcan
                        </ul>
                    </li> -->
                @endif
                <!--constant-->


                @if (Gate::check('manage company settings') || Gate::check('manage system settings'))
                    <li class="dash-item ">
                        <a href="{{ route('settings.index') }}" class="dash-link"><span
                                class="dash-micon"><i class="ti ti-settings"></i></span><span
                                class="dash-mtext">{{ __('System Setting') }}</span></a>

                    </li>
                @endif
            </ul>

            </ul>
        </div>
    </div>
</nav>
