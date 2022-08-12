<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');usersusers

require __DIR__.'/auth.php';

//Route::get('/register/{lang?}', 'Auth\RegisteredUserController@showRegistrationForm')->name('register');


Route::get('/register', function () {
    $settings = Utility::settings();
    $lang = $settings['default_language'];

    if($settings['enable_signup'] == 'on'){
        return view("auth.register", compact('lang'));
        // Route::get('/register', 'Auth\RegisteredUserController@showRegistrationForm')->name('register');
    }else{
        return Redirect::to('login');
    }

});

Route::post('register', 'Auth\RegisteredUserController@store')->name('register');
Route::get('/login/{lang?}', 'Auth\AuthenticatedSessionController@showLoginForm')->name('login');

Route::get('/password/resets/{lang?}', 'Auth\AuthenticatedSessionController@showLinkRequestForm')->name('change.langPass');


//================================= Contract Type  ====================================//
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
            'revalidate',
        ],
    ], function (){
    Route::resource('contractType', 'ContractTypeController');
}
);

//================================= Contract  ====================================//
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
            'revalidate',
        ],
    ], function (){
    // Route::get('contract/{id}/description', 'ContractController@description')->name('contract.description');
    // Route::get('contract/grid', 'ContractController@grid')->name('contract.grid');
    Route::resource('contract', 'ContractController');
    Route::get('contract/duplicate/{id}', 'ContractController@duplicate')->name('contract.duplicate')->middleware(['auth','XSS']);
    Route::put('contract/duplicatecontract/{id}', 'ContractController@duplicatecontract')->name('contract.duplicatecontract')->middleware(['auth','XSS']);
    Route::post('contract/{id}/description', 'ContractController@descriptionStore')->name('contract.description.store')->middleware(['auth','XSS']);
    Route::post('contract/{id}/file', 'ContractController@fileUpload')->name('contract.file.upload')->middleware(['auth','XSS']);
    Route::get('/contract/{id}/file/{fid}','ContractController@fileDownload')->name('contract.file.download')->middleware(['auth','XSS']);
    Route::delete('/contract/{id}/file/delete/{fid}','ContractController@fileDelete')->name('contract.file.delete')->middleware(['auth','XSS']);
    Route::post('/contract/{id}/comment','ContractController@commentStore')->name('comment.store')->middleware(['auth','XSS']);
    Route::get('/contract/{id}/comment','ContractController@commentDestroy')->name('comment.destroy')->middleware(['auth','XSS']);  
    Route::post('/contract/{id}/note', 'ContractController@noteStore')->name('contract.note.store')->middleware(['auth','XSS']);
    Route::get('/contract/{id}/note', 'ContractController@noteDestroy')->name('contract.note.destroy')->middleware(['auth','XSS']);
    Route::get('contract/pdf/{id}', 'ContractController@pdffromcontract')->name('contract.download.pdf')->middleware(['auth','XSS']);
    Route::get('contract/{id}/get_contract', 'ContractController@printContract')->name('get.contract')->middleware(['auth','XSS']);
    Route::get('/signature/{id}', 'ContractController@signature')->name('signature')->middleware(['auth','XSS']);
    Route::post('/signaturestore', 'ContractController@signatureStore')->name('signaturestore')->middleware(['auth','XSS']);
    Route::get('/contract/{id}/mail','ContractController@sendmailContract')->name('send.mail.contract')->middleware(['auth','XSS']);
    



    // Route::get('/contract/copy/{id}',['as' => 'contract.copy','uses' =>'ContractController@copycontract'])->middleware(['auth','XSS']);
    // Route::post('/contract/copy/store',['as' => 'contract.copy.store','uses' =>'ContractController@copycontractstore'])->middleware(['auth','XSS']);

    
}
);


//================================= Email Templates  ====================================//
       
        Route::get('email_template_lang/{id}/{lang?}', 'EmailTemplateController@manageEmailLang')->name('manage.email.language')->middleware(['auth','XSS']);
        Route::post('email_template_store/{pid}', 'EmailTemplateController@storeEmailLang')->name('store.email.language')->middleware(['auth']);
        Route::post('email_template_status/{id}', 'EmailTemplateController@updateStatus')->name('status.email.language')->middleware(['auth']);

        Route::resource('email_template', 'EmailTemplateController')->middleware(
            [
                'auth',
                'XSS',
                'revalidate',
            ]
        );
        Route::get('invoice/{id}/show', 'InvoiceController@customerInvoiceShow')->name('customer.invoice.show')->middleware(
            [
                'auth',
                'XSS','revalidate',
            ]
        );

Route::prefix('customer')->as('customer.')->group(
    function (){
        Route::get('login/{lang}', 'Auth\AuthenticatedSessionController@showCustomerLoginLang')->name('login.lang')->middleware(['XSS']);
        Route::get('login', 'Auth\AuthenticatedSessionController@showCustomerLoginForm')->name('login')->middleware(['XSS']);
        Route::post('login', 'Auth\AuthenticatedSessionController@customerLogin')->name('login')->middleware(['XSS']);

        Route::get('/password/resets/{lang?}', 'Auth\AuthenticatedSessionController@showCustomerLinkRequestForm')->name('change.langPass');
        Route::post('/password/email', 'Auth\AuthenticatedSessionController@postCustomerEmail')->name('password.email');

        Route::get('reset-password/{token}', 'Auth\AuthenticatedSessionController@getCustomerPassword')->name('
        ');
        Route::post('reset-password', 'Auth\AuthenticatedSessionController@updateCustomerPassword')->name('password.reset');



        Route::get('dashboard', 'CustomerController@dashboard')->name('dashboard')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::get('invoice', 'InvoiceController@customerInvoice')->name('invoice')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::get(
            '/invoice/pay/{invoice}', [
                   'as' => 'pay.invoice',
                   'uses' => 'InvoiceController@payinvoice',
               ]
        );
        Route::get('proposal', 'ProposalController@customerProposal')->name('proposal')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::get('proposal/{id}/show', 'ProposalController@customerProposalShow')->name('proposal.show')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::get('invoice/{id}/send', 'InvoiceController@customerInvoiceSend')->name('invoice.send')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        
        Route::post('invoice/{id}/send/mail', 'InvoiceController@customerInvoiceSendMail')->name('invoice.send.mail')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::get('invoice/{id}/show', 'InvoiceController@customerInvoiceShow')->name('invoice.show')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::get('invoice/{id}/show', 'InvoiceController@customerInvoiceShow')->name('invoice.view')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::post('invoice/{id}/payment', 'StripePaymentController@addpayment')->name('invoice.payment')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::get('payment', 'CustomerController@payment')->name('payment')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::get('transaction', 'CustomerController@transaction')->name('transaction')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::post('logout', 'CustomerController@customerLogout')->name('logout')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::get('profile', 'CustomerController@profile')->name('profile')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::post('update-profile', 'CustomerController@editprofile')->name('update.profile')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::post('billing-info', 'CustomerController@editBilling')->name('update.billing.info')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::post('shipping-info', 'CustomerController@editShipping')->name('update.shipping.info')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::post('change.password', 'CustomerController@updatePassword')->name('update.password')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        
        Route::get('change-language/{lang}', 'CustomerController@changeLanquage')->name('change.language')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        //================================= contract ====================================//

        Route::resource('contract', 'ContractController')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );

        Route::post('contract/{id}/description', 'ContractController@descriptionStore')->name('contract.description.store')->middleware(
            [
                'auth:customer',
                'XSS','revalidate',
            ]
        );
        Route::post('contract/{id}/file', 'ContractController@fileUpload')->name('contract.file.upload')->middleware(['auth:customer','XSS']);
        Route::post('/contract/{id}/comment','ContractController@commentStore')->name('comment.store')->middleware(['auth:customer','XSS']);
        Route::post('/contract/{id}/note', 'ContractController@noteStore')->name('contract.note.store')->middleware(['auth:customer','XSS']);
        Route::get('contract/pdf/{id}', 'ContractController@pdffromcontract')->name('contract.download.pdf')->middleware(['auth:customer','XSS']);
        Route::get('contract/{id}/get_contract', 'ContractController@printContract')->name('get.contract')->middleware(['auth:customer','XSS']);
        Route::get('/signature/{id}', 'ContractController@signature')->name('signature')->middleware(['auth:customer','XSS']);
        Route::post('/signaturestore', 'ContractController@signatureStore')->name('signaturestore')->middleware(['auth:customer','XSS']);
        Route::get('contract/pdf/{id}', 'ContractController@pdffromcontract')->name('contract.download.pdf')->middleware(['auth:customer','XSS']);
        Route::delete('/contract/{id}/file/delete/{fid}','ContractController@fileDelete')->name('contract.file.delete')->middleware(['auth:customer','XSS']);
        Route::get('/contract/{id}/comment','ContractController@commentDestroy')->name('comment.destroy')->middleware(['auth:customer','XSS']);  
        Route::get('/contract/{id}/note', 'ContractController@noteDestroy')->name('contract.note.destroy')->middleware(['auth:customer','XSS']);




        
        
        


        //================================= Invoice Payment Gateways  ====================================//



        Route::post('{id}/pay-with-paypal', 'PaypalController@customerPayWithPaypal')->name('pay.with.paypal')->middleware(
            [
                'XSS',
                'revalidate',
            ]
        );
        Route::get('{id}/get-payment-status', 'PaypalController@customerGetPaymentStatus')->name('get.payment.status')->middleware(
            [
                'XSS',
                'revalidate',
            ]
        );

        Route::post('invoice/{id}/payment', 'StripePaymentController@addpayment')->name('invoice.payment')->middleware(
            [
                'XSS',
                'revalidate',
            ]
        );

        Route::post('/invoice-pay-with-paystack',['as' => 'invoice.pay.with.paystack','uses' =>'PaystackPaymentController@invoicePayWithPaystack'])->middleware(['XSS']);
        Route::any('/invoice/paystack/{pay_id}/{invoice_id}', ['as' => 'invoice.paystack','uses' => 'PaystackPaymentController@getInvoicePaymentStatus']);

        Route::post('/invoice-pay-with-flaterwave',['as' => 'invoice.pay.with.flaterwave','uses' =>'FlutterwavePaymentController@invoicePayWithFlutterwave'])->middleware(['XSS']);
        Route::get('/invoice/flaterwave/{txref}/{invoice_id}', ['as' => 'invoice.flaterwave','uses' => 'FlutterwavePaymentController@getInvoicePaymentStatus']);

        Route::post('/invoice-pay-with-razorpay',['as' => 'invoice.pay.with.razorpay','uses' =>'RazorpayPaymentController@invoicePayWithRazorpay'])->middleware(['XSS']);
        Route::get('/invoice/razorpay/{txref}/{invoice_id}', ['as' => 'invoice.razorpay','uses' => 'RazorpayPaymentController@getInvoicePaymentStatus']);

        Route::post('/invoice-pay-with-paytm',['as' => 'invoice.pay.with.paytm','uses' =>'PaytmPaymentController@invoicePayWithPaytm'])->middleware(['XSS']);
        Route::post('/invoice/paytm/{invoice}/{amount}', ['as' => 'invoice.paytm','uses' => 'PaytmPaymentController@getInvoicePaymentStatus']);

        Route::post('/invoice-pay-with-mercado',['as' => 'invoice.pay.with.mercado','uses' =>'MercadoPaymentController@invoicePayWithMercado'])->middleware(['XSS']);
        Route::any('/invoice/mercado/{invoice}', ['as' => 'invoice.mercado','uses' => 'MercadoPaymentController@getInvoicePaymentStatus']);

        Route::post('/invoice-pay-with-mollie',['as' => 'invoice.pay.with.mollie','uses' =>'MolliePaymentController@invoicePayWithMollie'])->middleware(['XSS']);
        Route::get('/invoice/mollie/{invoice}/{amount}', ['as' => 'invoice.mollie','uses' => 'MolliePaymentController@getInvoicePaymentStatus']);

        Route::post('/invoice-pay-with-skrill',['as' => 'invoice.pay.with.skrill','uses' =>'SkrillPaymentController@invoicePayWithSkrill'])->middleware(['XSS']);
        Route::get('/invoice/skrill/{invoice}/{amount}', ['as' => 'invoice.skrill','uses' => 'SkrillPaymentController@getInvoicePaymentStatus']);

        Route::post('/invoice-pay-with-coingate',['as' => 'invoice.pay.with.coingate','uses' =>'CoingatePaymentController@invoicePayWithCoingate'])->middleware(['XSS']);
        Route::get('/invoice/coingate/{invoice}/{amount}', ['as' => 'invoice.coingate','uses' => 'CoingatePaymentController@getInvoicePaymentStatus'])->middleware(['XSS']);

         

       
       
        

    }
);

Route::prefix('vender')->as('vender.')->group(
    function (){
        Route::get('login/{lang}', 'Auth\AuthenticatedSessionController@showVenderLoginLang')->name('login.lang')->middleware(['XSS']);
        Route::get('login', 'Auth\AuthenticatedSessionController@showVenderLoginForm')->name('login')->middleware(['XSS']);
        Route::post('login', 'Auth\AuthenticatedSessionController@VenderLogin')->name('login')->middleware(['XSS']);


        Route::get('/password/resets/{lang?}', 'Auth\AuthenticatedSessionController@showVendorLinkRequestForm')->name('change.langPass');
        Route::post('/password/email', 'Auth\AuthenticatedSessionController@postVendorEmail')->name('password.email');

        Route::get('reset-password/{token}', 'Auth\AuthenticatedSessionController@getVendorPassword')->name('reset.password');
        Route::post('reset-password', 'Auth\AuthenticatedSessionController@updateVendorPassword')->name('password.reset');




        Route::get('dashboard', 'VenderController@dashboard')->name('dashboard')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::get('bill', 'BillController@VenderBill')->name('bill')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::get('bill/{id}/show', 'BillController@venderBillShow')->name('bill.show')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );


        Route::get('bill/{id}/send', 'BillController@venderBillSend')->name('bill.send')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::post('bill/{id}/send/mail', 'BillController@venderBillSendMail')->name('bill.send.mail')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );


        Route::get('payment', 'VenderController@payment')->name('payment')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::get('transaction', 'VenderController@transaction')->name('transaction')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::post('logout', 'VenderController@venderLogout')->name('logout')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );

        Route::get('profile', 'VenderController@profile')->name('profile')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );

        Route::post('update-profile', 'VenderController@editprofile')->name('update.profile')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::post('billing-info', 'VenderController@editBilling')->name('update.billing.info')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::post('shipping-info', 'VenderController@editShipping')->name('update.shipping.info')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::post('change.password', 'VenderController@updatePassword')->name('update.password')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );
        Route::get('change-language/{lang}', 'VenderController@changeLanquage')->name('change.language')->middleware(
            [
                'auth:vender',
                'XSS','revalidate',
            ]
        );

    }
);


Route::get('/', 'DashboardController@index')->name('dashboard')->middleware(['XSS','revalidate',]);

Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::get('user/{id}/plan', 'UserController@upgradePlan')->name('plan.upgrade')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::get('user/{id}/plan/{pid}', 'UserController@activePlan')->name('plan.active')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::get('profile', 'UserController@profile')->name('profile')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::post('edit-profile', 'UserController@editprofile')->name('update.account')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::resource('users', 'UserController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::post('change-password', 'UserController@updatePassword')->name('update.password');
Route::any('user-reset-password/{id}', 'UserController@userPassword')->name('users.reset');
Route::post('user-reset-password/{id}', 'UserController@userPasswordReset')->name('user.password.update');


Route::get('/change/mode',['as' => 'change.mode','uses' =>'UserController@changeMode']);



Route::resource('roles', 'RoleController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::resource('permissions', 'PermissionController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){
    Route::get('change-language/{lang}', 'LanguageController@changeLanquage')->name('change.language');
    Route::get('manage-language/{lang}', 'LanguageController@manageLanguage')->name('manage.language');
    Route::post('store-language-data/{lang}', 'LanguageController@storeLanguageData')->name('store.language.data');
    Route::get('create-language', 'LanguageController@createLanguage')->name('create.language');
    Route::post('store-language', 'LanguageController@storeLanguage')->name('store.language');

    Route::delete('/lang/{lang}', 'LanguageController@destroyLang')->name('lang.destroy');
}
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::resource('systems', 'SystemController');
    Route::post('email-settings', 'SystemController@saveEmailSettings')->name('email.settings');
    Route::post('company-settings', 'SystemController@saveCompanySettings')->name('company.settings');
    Route::post('stripe-settings', 'SystemController@savePaymentSettings')->name('payment.settings');
    Route::post('system-settings', 'SystemController@saveSystemSettings')->name('system.settings');
    Route::post('recaptcha-settings',['as' => 'recaptcha.settings.store','uses' =>'SystemController@recaptchaSettingStore'])->middleware(['auth','XSS']);
    Route::get('company-setting', 'SystemController@companyIndex')->name('company.setting');
    Route::post('business-setting', 'SystemController@saveBusinessSettings')->name('business.setting');
    Route::post('twilio-settings', 'SystemController@saveTwilioSettings')->name('twilio.settings');
    Route::post('company-payment-setting', 'SystemController@saveCompanyPaymentSettings')->name('company.payment.settings');
    Route::get('test-mail', 'SystemController@testMail')->name('test.mail');
    Route::post('test-mail', 'SystemController@testSendMail')->name('test.send.mail');

}
);


Route::get('productservice/index', 'ProductServiceController@index')->name('productservice.index');
Route::resource('productservice', 'ProductServiceController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);


//Product Stock
Route::resource('productstock', 'ProductStockController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);



Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('customer/{id}/show', 'CustomerController@show')->name('customer.show');
    Route::ANY('customer/{id}/statement', 'CustomerController@statement')->name('customer.statement');
    Route::any('customer-reset-password/{id}', 'CustomerController@customerPassword')->name('customer.reset');
    Route::post('customer-reset-password/{id}', 'CustomerController@customerPasswordReset')->name('customer.password.update');
    Route::resource('customer', 'CustomerController');

}
);
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('vender/{id}/show', 'VenderController@show')->name('vender.show');
    Route::ANY('vender/{id}/statement', 'VenderController@statement')->name('vender.statement');

    Route::resource('vender', 'VenderController');

}
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::resource('bank-account', 'BankAccountController');

}
);
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('transfer/index', 'TransferController@index')->name('transfer.index');
    Route::resource('transfer', 'TransferController');

}
);


Route::resource('taxes', 'TaxController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::resource('product-category', 'ProductServiceCategoryController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::resource('product-unit', 'ProductServiceUnitController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);


Route::get('invoice/pdf/{id}', 'InvoiceController@invoice')->name('invoice.pdf')->middleware(['XSS','revalidate',]);
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){


    Route::get('invoice/{id}/duplicate', 'InvoiceController@duplicate')->name('invoice.duplicate');
    Route::get('invoice/{id}/shipping/print', 'InvoiceController@shippingDisplay')->name('invoice.shipping.print');
    Route::get('invoice/{id}/payment/reminder', 'InvoiceController@paymentReminder')->name('invoice.payment.reminder');
    Route::get('invoice/index', 'InvoiceController@index')->name('invoice.index');
    Route::post('invoice/product/destroy', 'InvoiceController@productDestroy')->name('invoice.product.destroy');
    Route::post('invoice/product', 'InvoiceController@product')->name('invoice.product');
    Route::post('invoice/customer', 'InvoiceController@customer')->name('invoice.customer');
    Route::get('invoice/{id}/sent', 'InvoiceController@sent')->name('invoice.sent');
    Route::get('invoice/{id}/resent', 'InvoiceController@resent')->name('invoice.resent');
    Route::get('invoice/{id}/payment', 'InvoiceController@payment')->name('invoice.payment');
    Route::post('invoice/{id}/payment', 'InvoiceController@createPayment')->name('invoice.payment');
    Route::post('invoice/{id}/payment/{pid}/destroy', 'InvoiceController@paymentDestroy')->name('invoice.payment.destroy');
    Route::get('invoice/items', 'InvoiceController@items')->name('invoice.items');

    Route::resource('invoice', 'InvoiceController');
    Route::get('invoice/create/{cid}', 'InvoiceController@create')->name('invoice.create');
}
);

Route::get(
    '/invoices/preview/{template}/{color}', [
                                              'as' => 'invoice.preview',
                                              'uses' => 'InvoiceController@previewInvoice',
                                          ]
);
Route::post(
    '/invoices/template/setting', [
                                    'as' => 'invoice.template.setting',
                                    'uses' => 'InvoiceController@saveTemplateSettings',
                                ]
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){


    Route::get('credit-note', 'CreditNoteController@index')->name('credit.note');
    Route::get('custom-credit-note', 'CreditNoteController@customCreate')->name('invoice.custom.credit.note');
    Route::post('custom-credit-note', 'CreditNoteController@customStore')->name('invoice.custom.credit.note');
    Route::get('credit-note/invoice', 'CreditNoteController@getinvoice')->name('invoice.get');
    Route::get('invoice/{id}/credit-note', 'CreditNoteController@create')->name('invoice.credit.note');
    Route::post('invoice/{id}/credit-note', 'CreditNoteController@store')->name('invoice.credit.note');
    Route::get('invoice/{id}/credit-note/edit/{cn_id}', 'CreditNoteController@edit')->name('invoice.edit.credit.note');
    Route::post('invoice/{id}/credit-note/edit/{cn_id}', 'CreditNoteController@update')->name('invoice.edit.credit.note');
    Route::delete('invoice/{id}/credit-note/delete/{cn_id}', 'CreditNoteController@destroy')->name('invoice.delete.credit.note');

}
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){


    Route::get('debit-note', 'DebitNoteController@index')->name('debit.note');
    Route::get('custom-debit-note', 'DebitNoteController@customCreate')->name('bill.custom.debit.note');
    Route::post('custom-debit-note', 'DebitNoteController@customStore')->name('bill.custom.debit.note');
    Route::get('debit-note/bill', 'DebitNoteController@getbill')->name('bill.get');
    Route::get('bill/{id}/debit-note', 'DebitNoteController@create')->name('bill.debit.note');
    Route::post('bill/{id}/debit-note', 'DebitNoteController@store')->name('bill.debit.note');
    Route::get('bill/{id}/debit-note/edit/{cn_id}', 'DebitNoteController@edit')->name('bill.edit.debit.note');
    Route::post('bill/{id}/debit-note/edit/{cn_id}', 'DebitNoteController@update')->name('bill.edit.debit.note');
    Route::delete('bill/{id}/debit-note/delete/{cn_id}', 'DebitNoteController@destroy')->name('bill.delete.debit.note');

}
);


Route::get(
    '/bill/preview/{template}/{color}', [
                                          'as' => 'bill.preview',
                                          'uses' => 'BillController@previewBill',
                                      ]
);
Route::post(
    '/bill/template/setting', [
                                'as' => 'bill.template.setting',
                                'uses' => 'BillController@saveBillTemplateSettings',
                            ]
);

Route::resource('taxes', 'TaxController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::get('revenue/index', 'RevenueController@index')->name('revenue.index')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::resource('revenue', 'RevenueController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::get('bill/pdf/{id}', 'BillController@bill')->name('bill.pdf')->middleware(['XSS','revalidate',]);
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('bill/{id}/duplicate', 'BillController@duplicate')->name('bill.duplicate');
    Route::get('bill/{id}/shipping/print', 'BillController@shippingDisplay')->name('bill.shipping.print');
    Route::get('bill/index', 'BillController@index')->name('bill.index');
    Route::post('bill/product/destroy', 'BillController@productDestroy')->name('bill.product.destroy');
    Route::post('bill/product', 'BillController@product')->name('bill.product');
    Route::post('bill/vender', 'BillController@vender')->name('bill.vender');
    Route::get('bill/{id}/sent', 'BillController@sent')->name('bill.sent');
    Route::get('bill/{id}/resent', 'BillController@resent')->name('bill.resent');
    Route::get('bill/{id}/payment', 'BillController@payment')->name('bill.payment');
    Route::post('bill/{id}/payment', 'BillController@createPayment')->name('bill.payment');
    Route::post('bill/{id}/payment/{pid}/destroy', 'BillController@paymentDestroy')->name('bill.payment.destroy');
    Route::get('bill/items', 'BillController@items')->name('bill.items');

    Route::resource('bill', 'BillController');
    Route::get('bill/create/{cid}', 'BillController@create')->name('bill.create');
}
);


Route::get('payment/index', 'PaymentController@index')->name('payment.index')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::resource('payment', 'PaymentController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);


Route::resource('plans', 'PlanController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);







Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('report/transaction', 'TransactionController@index')->name('transaction.index');


}
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('report/income-summary', 'ReportController@incomeSummary')->name('report.income.summary');
    Route::get('report/expense-summary', 'ReportController@expenseSummary')->name('report.expense.summary');
    Route::get('report/income-vs-expense-summary', 'ReportController@incomeVsExpenseSummary')->name('report.income.vs.expense.summary');
    Route::get('report/tax-summary', 'ReportController@taxSummary')->name('report.tax.summary');
    Route::get('report/profit-loss-summary', 'ReportController@profitLossSummary')->name('report.profit.loss.summary');

    Route::get('report/invoice-summary', 'ReportController@invoiceSummary')->name('report.invoice.summary');
    Route::get('report/bill-summary', 'ReportController@billSummary')->name('report.bill.summary');
    Route::get('report/product-stock-report', 'ReportController@productStock')->name('report.product.stock.report');


    Route::get('report/invoice-report', 'ReportController@invoiceReport')->name('report.invoice');
    Route::get('report/account-statement-report', 'ReportController@accountStatement')->name('report.account.statement');

    Route::get('report/balance-sheet', 'ReportController@balanceSheet')->name('report.balance.sheet');
    Route::get('report/ledger', 'ReportController@ledgerSummary')->name('report.ledger');
    Route::get('report/trial-balance', 'ReportController@trialBalanceSummary')->name('trial.balance');
}
);

Route::get(
    '/apply-coupon', [
                       'as' => 'apply.coupon',
                       'uses' => 'CouponController@applyCoupon',
                   ]
)->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::resource('coupons', 'CouponController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::get('proposal/pdf/{id}', 'ProposalController@proposal')->name('proposal.pdf')->middleware(['XSS','revalidate',]);
Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::get('proposal/{id}/status/change', 'ProposalController@statusChange')->name('proposal.status.change');
    Route::get('proposal/{id}/convert', 'ProposalController@convert')->name('proposal.convert');
    Route::get('proposal/{id}/duplicate', 'ProposalController@duplicate')->name('proposal.duplicate');
    Route::post('proposal/product/destroy', 'ProposalController@productDestroy')->name('proposal.product.destroy');
    Route::post('proposal/customer', 'ProposalController@customer')->name('proposal.customer');
    Route::post('proposal/product', 'ProposalController@product')->name('proposal.product');
    Route::get('proposal/items', 'ProposalController@items')->name('proposal.items');
    Route::get('proposal/{id}/sent', 'ProposalController@sent')->name('proposal.sent');
    Route::get('proposal/{id}/resent', 'ProposalController@resent')->name('proposal.resent');

    Route::resource('proposal', 'ProposalController');
    Route::get('proposal/create/{cid}', 'ProposalController@create')->name('proposal.create');
}
);

Route::get(
    '/proposal/preview/{template}/{color}', [
                                              'as' => 'proposal.preview',
                                              'uses' => 'ProposalController@previewProposal',
                                          ]
);
Route::post(
    '/proposal/template/setting', [
                                    'as' => 'proposal.template.setting',
                                    'uses' => 'ProposalController@saveProposalTemplateSettings',
                                ]
);



//Budget Planner //

Route::resource('budget', 'BudgetController')->middleware(
    [
        'auth',
        'XSS',
        'revalidate',
    ]
);


Route::resource('goal', 'GoalController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::resource('account-assets', 'AssetController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
Route::resource('custom-field', 'CustomFieldController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::post('plan-pay-with-paypal', 'PaypalController@planPayWithPaypal')->name('plan.pay.with.paypal')->middleware(
    [
        'XSS','revalidate',
    ]
);

Route::get('{id}/plan-get-payment-status', 'PaypalController@planGetPaymentStatus')->name('plan.get.payment.status')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::post('chart-of-account/subtype', 'ChartOfAccountController@getSubType')->name('charofAccount.subType')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);

Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::resource('chart-of-account', 'ChartOfAccountController');

}
);


Route::group(
    [
        'middleware' => [
            'auth',
            'XSS','revalidate',
        ],
    ], function (){

    Route::post('journal-entry/account/destroy', 'JournalEntryController@accountDestroy')->name('journal.account.destroy');
    Route::resource('journal-entry', 'JournalEntryController');

}
);

//================================= Plan Payment Gateways  ====================================//

Route::post('/plan-pay-with-paystack',['as' => 'plan.pay.with.paystack','uses' =>'PaystackPaymentController@planPayWithPaystack'])->middleware(['auth','XSS']);
Route::get('/plan/paystack/{pay_id}/{plan_id}', ['as' => 'plan.paystack','uses' => 'PaystackPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-flaterwave',['as' => 'plan.pay.with.flaterwave','uses' =>'FlutterwavePaymentController@planPayWithFlutterwave'])->middleware(['auth','XSS']);
Route::get('/plan/flaterwave/{txref}/{plan_id}', ['as' => 'plan.flaterwave','uses' => 'FlutterwavePaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-razorpay',['as' => 'plan.pay.with.razorpay','uses' =>'RazorpayPaymentController@planPayWithRazorpay'])->middleware(['auth','XSS']);
Route::get('/plan/razorpay/{txref}/{plan_id}', ['as' => 'plan.razorpay','uses' => 'RazorpayPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-paytm',['as' => 'plan.pay.with.paytm','uses' =>'PaytmPaymentController@planPayWithPaytm'])->middleware(['auth','XSS']);
Route::post('/plan/paytm/{plan}', ['as' => 'plan.paytm','uses' => 'PaytmPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-mercado',['as' => 'plan.pay.with.mercado','uses' =>'MercadoPaymentController@planPayWithMercado'])->middleware(['auth','XSS']);
Route::get('/plan/mercado/{plan}', ['as' => 'plan.mercado','uses' => 'MercadoPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-mollie',['as' => 'plan.pay.with.mollie','uses' =>'MolliePaymentController@planPayWithMollie'])->middleware(['auth','XSS']);
Route::get('/plan/mollie/{plan}', ['as' => 'plan.mollie','uses' => 'MolliePaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-skrill',['as' => 'plan.pay.with.skrill','uses' =>'SkrillPaymentController@planPayWithSkrill'])->middleware(['auth','XSS']);
Route::get('/plan/skrill/{plan}', ['as' => 'plan.skrill','uses' => 'SkrillPaymentController@getPaymentStatus']);

Route::post('/plan-pay-with-coingate',['as' => 'plan.pay.with.coingate','uses' =>'CoingatePaymentController@planPayWithCoingate'])->middleware(['auth','XSS']);
Route::get('/plan/coingate/{plan}', ['as' => 'plan.coingate','uses' => 'CoingatePaymentController@getPaymentStatus']);



Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
            'revalidate',
        ],
    ], function (){
    Route::get('order', 'StripePaymentController@index')->name('order.index');
    Route::get('/stripe/{code}', 'StripePaymentController@stripe')->name('stripe');
    Route::post('/stripe', 'StripePaymentController@stripePost')->name('stripe.post');
}
);


Route::post('plan-pay-with-paypal', 'PaypalController@planPayWithPaypal')->name('plan.pay.with.paypal')->middleware(
    [
        'auth',
        'XSS',
        'revalidate',
    ]
);

Route::get('{id}/plan-get-payment-status', 'PaypalController@planGetPaymentStatus')->name('plan.get.payment.status')->middleware(
    [
        'auth',
        'XSS',
        'revalidate',
    ]
);


// Plan Request Module
Route::get('plan_request', 'PlanRequestController@index')->name('plan_request.index')->middleware(['auth','XSS',]);
Route::get('request_frequency/{id}', 'PlanRequestController@requestView')->name('request.view')->middleware(['auth','XSS',]);
Route::get('request_send/{id}', 'PlanRequestController@userRequest')->name('send.request')->middleware(['auth','XSS',]);
Route::get('request_response/{id}/{response}', 'PlanRequestController@acceptRequest')->name('response.request')->middleware(['auth','XSS',]);
Route::get('request_cancel/{id}', 'PlanRequestController@cancelRequest')->name('request.cancel')->middleware(['auth','XSS',]);

// --------------------------- invoice payments  ---------------------

Route::get(
    '/invoice/pay/{invoice}', [
           'as' => 'pay.invoice',
           'uses' => 'InvoiceController@payinvoice',
       ]
);

Route::get(
    '/bill/pay/{bill}', [
           'as' => 'pay.billpay',
           'uses' => 'BillController@paybill',
       ]
);

Route::get(
    '/proposal/pay/{proposal}', [
           'as' => 'pay.proposalpay',
           'uses' => 'ProposalController@payproposal',
       ]
);


Route::post('/invoice-pay-with-stripe',['as' => 'invoice.pay.with.stripe','uses' =>'StripePaymentController@invoicePayWithStripe']);

Route::post('{id}/pay-with-paypal', 'PaypalController@clientPayWithPaypal')->name('client.pay.with.paypal')->middleware(
    [

        'XSS',
        'revalidate',
    ]
);

Route::get('invoice/pay/pdf/{id}', 'InvoiceController@pdffrominvoice')->name('invoice.download.pdf');


// -------------------------------------import export------------------------------

Route::get('export/productservice', 'ProductServiceController@export')->name('productservice.export');
Route::get('import/productservice/file', 'ProductServiceController@importFile')->name('productservice.file.import');
Route::post('import/productservice', 'ProductServiceController@import')->name('productservice.import');

Route::get('export/customer', 'CustomerController@export')->name('customer.export');
Route::get('import/customer/file', 'CustomerController@importFile')->name('customer.file.import');
Route::post('import/customer', 'CustomerController@import')->name('customer.import');

Route::get('export/vender', 'VenderController@export')->name('vender.export');
Route::get('import/vender/file', 'VenderController@importFile')->name('vender.file.import');
Route::post('import/vender', 'VenderController@import')->name('vender.import');


Route::get('export/Proposal', 'ProposalController@export')->name('proposal.export');
Route::get('export/invoice', 'InvoiceController@export')->name('invoice.export');
Route::get('export/Bill', 'BillController@export')->name('Bill.export');


//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});
Route::get('/config-clear', function() {
    $exitCode = Artisan::call('config:clear');
    return '<h1>Clear Config cleared</h1>';
});

// ------------------------------------- PaymentWall ------------------------------

Route::post('/paymentwalls' , ['as' => 'plan.paymentwallpayment','uses' =>'PaymentWallPaymentController@paymentwall'])->middleware(['XSS']);
Route::post('/plan-pay-with-paymentwall/{plan}',['as' => 'plan.pay.with.paymentwall','uses' =>'PaymentWallPaymentController@planPayWithPaymentWall'])->middleware(['XSS']);
Route::get('/plan/{flag}', ['as' => 'error.plan.show','uses' => 'PaymentWallPaymentController@planeerror']);


Route::post('/paymentwall' , ['as' => 'invoice.paymentwallpayment','uses' =>'PaymentWallPaymentController@invoicepaymentwall'])->middleware(['XSS']);
Route::post('/invoice-pay-with-paymentwall/{plan}',['as' => 'invoice.pay.with.paymentwall','uses' =>'PaymentWallPaymentController@invoicePayWithPaymentwall'])->middleware(['XSS']);
Route::get('/invoices/{flag}/{invoice}', ['as' => 'error.invoice.show','uses' => 'PaymentWallPaymentController@invoiceerror']);




 



Route::get('/check', 'HomeController@check')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('/password/resets/{lang?}', 'Auth\LoginController@showLinkRequestForm')->name('change.langPass');

Route::get('/', 'HomeController@index')->name('home')->middleware(['XSS']);
Route::get('/home', 'HomeController@index')->name('home')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('/home/getlanguvage', 'HomeController@getlanguvage')->name('home.getlanguvage');


Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function (){

    Route::resource('settings', 'SettingsController');
    Route::post('email-settings', 'SettingsController@saveEmailSettings')->name('email.settings');
    Route::post('company-settings', 'SettingsController@saveCompanySettings')->name('company.settings');
    Route::post('payment-settings', 'SettingsController@savePaymentSettings')->name('payment.settings');
    Route::post('system-settings', 'SettingsController@saveSystemSettings')->name('system.settings');
    Route::get('company-setting', 'SettingsController@companyIndex')->name('company.setting');
    // Route::get('company-email-setting/{name}', 'SettingsController@updateEmailStatus')->name('company.email.setting');
    Route::get('company-email-setting/{name}', 'EmailTemplateController@updateStatus')->name('company.email.setting');

    Route::post('pusher-settings', 'SettingsController@savePusherSettings')->name('pusher.settings');
    Route::post('business-setting', 'SettingsController@saveBusinessSettings')->name('business.setting');

    Route::post('zoom-settings', 'SettingsController@zoomSetting')->name('zoom.settings');

    Route::get('test-mail', 'SettingsController@testMail')->name('test.mail');
    Route::post('test-mail', 'SettingsController@testSendMail')->name('test.send.mail');

    Route::get('create/ip', 'SettingsController@createIp')->name('create.ip');
    Route::post('create/ip', 'SettingsController@storeIp')->name('store.ip');
    Route::get('edit/ip/{id}', 'SettingsController@editIp')->name('edit.ip');
    Route::post('edit/ip/{id}', 'SettingsController@updateIp')->name('update.ip');
    Route::delete('destroy/ip/{id}', 'SettingsController@destroyIp')->name('destroy.ip');
}
);

// Email Templates
Route::get('email_template_lang/{id}/{lang?}', 'EmailTemplateController@manageEmailLang')->name('manage.email.language')->middleware(['auth','XSS']);
Route::post('email_template_store/{pid}', 'EmailTemplateController@storeEmailLang')->name('store.email.language')->middleware(['auth']);
Route::post('email_template_status/{id}', 'EmailTemplateController@updateStatus')->name('status.email.language')->middleware(['auth']);

Route::resource('email_template', 'EmailTemplateController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('email_template_lang', 'EmailTemplateLangController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get(
    '/test', [
               'as' => 'test.email',
               'uses' => 'SettingsController@testEmail',
           ]
)->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post(
    '/test/send', [
                    'as' => 'test.email.send',
                    'uses' => 'SettingsController@testEmailSend',
                ]
)->middleware(
    [
        'auth',
        'XSS',
    ]
);
// End

Route::resource('user', 'UserController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('employee/json', 'EmployeeController@json')->name('employee.json')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('branch/employee/json', 'EmployeeController@employeeJson')->name('branch.employee.json')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('employee-profile', 'EmployeeController@profile')->name('employee.profile')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('show-employee-profile/{id}', 'EmployeeController@profileShow')->name('show.employee.profile')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('lastlogin', 'EmployeeController@lastLogin')->name('lastlogin')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('employee', 'EmployeeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('department', 'DepartmentController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('designation', 'DesignationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('document', 'DocumentController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('branch', 'BranchController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('awardtype', 'AwardTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('award', 'AwardController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('termination/{id}/description', 'TerminationController@description')->name('termination.description');

Route::resource('termination', 'TerminationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('terminationtype', 'TerminationTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('announcement/getdepartment', 'AnnouncementController@getdepartment')->name('announcement.getdepartment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('announcement/getemployee', 'AnnouncementController@getemployee')->name('announcement.getemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('announcement', 'AnnouncementController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('holiday/calender', 'HolidayController@calender')->name('holiday.calender')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('holiday', 'HolidayController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('employee/salary/{eid}', 'SetSalaryController@employeeBasicSalary')->name('employee.basic.salary')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('allowances/create/{eid}', 'AllowanceController@allowanceCreate')->name('allowances.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('commissions/create/{eid}', 'CommissionController@commissionCreate')->name('commissions.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('loans/create/{eid}', 'LoanController@loanCreate')->name('loans.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('saturationdeductions/create/{eid}', 'SaturationDeductionController@saturationdeductionCreate')->name('saturationdeductions.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('otherpayments/create/{eid}', 'OtherPaymentController@otherpaymentCreate')->name('otherpayments.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('overtimes/create/{eid}', 'OvertimeController@overtimeCreate')->name('overtimes.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);

//payslip

Route::resource('paysliptype', 'PayslipTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('allowance', 'AllowanceController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('commission', 'CommissionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('allowanceoption', 'AllowanceOptionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('loanoption', 'LoanOptionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('deductionoption', 'DeductionOptionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('loan', 'LoanController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('saturationdeduction', 'SaturationDeductionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('otherpayment', 'OtherPaymentController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('overtime', 'OvertimeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('event/getdepartment', 'EventController@getdepartment')->name('event.getdepartment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('event/getemployee', 'EventController@getemployee')->name('event.getemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('event/data/{id}', 'EventController@showData')->name('eventsshow');
Route::resource('event', 'EventController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('meeting/getdepartment', 'MeetingController@getdepartment')->name('meeting.getdepartment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('meeting/getemployee', 'MeetingController@getemployee')->name('meeting.getemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('meeting', 'MeetingController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('employee/update/sallary/{id}', 'SetSalaryController@employeeUpdateSalary')->name('employee.salary.update')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('salary/employeeSalary', 'SetSalaryController@employeeSalary')->name('employeesalary')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('setsalary', 'SetSalaryController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('payslip/paysalary/{id}/{date}', 'PaySlipController@paysalary')->name('payslip.paysalary')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/bulk_pay_create/{date}', 'PaySlipController@bulk_pay_create')->name('payslip.bulk_pay_create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('payslip/bulkpayment/{date}', 'PaySlipController@bulkpayment')->name('payslip.bulkpayment')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('payslip/search_json', 'PaySlipController@search_json')->name('payslip.search_json')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/employeepayslip', 'PaySlipController@employeepayslip')->name('payslip.employeepayslip')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/showemployee/{id}', 'PaySlipController@showemployee')->name('payslip.showemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/editemployee/{id}', 'PaySlipController@editemployee')->name('payslip.editemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('payslip/editemployee/{id}', 'PaySlipController@updateEmployee')->name('payslip.updateemployee')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/pdf/{id}/{m}', 'PaySlipController@pdf')->name('payslip.pdf')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/payslipPdf/{id}', 'PaySlipController@payslipPdf')->name('payslip.payslipPdf')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('payslip/send/{id}/{m}', 'PaySlipController@send')->name('payslip.send')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('payslip/delete/{id}', 'PaySlipController@destroy')->name('payslip.delete')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('payslip', 'PaySlipController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('resignation', 'ResignationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('travel', 'TravelController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('promotion', 'PromotionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('transfer', 'TransferController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('complaint', 'ComplaintController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('warning', 'WarningController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('profile', 'UserController@profile')->name('profile')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('edit-profile', 'UserController@editprofile')->name('update.account')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('accountlist', 'AccountListController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('accountbalance', 'AccountListController@account_balance')->name('accountbalance')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('leave/{id}/action', 'LeaveController@action')->name('leave.action')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('leave/changeaction', 'LeaveController@changeaction')->name('leave.changeaction')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('leave/jsoncount', 'LeaveController@jsoncount')->name('leave.jsoncount')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('leave', 'LeaveController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('ticket/{id}/reply', 'TicketController@reply')->name('ticket.reply')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('ticket/changereply', 'TicketController@changereply')->name('ticket.changereply')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('ticket', 'TicketController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('attendanceemployee/bulkattendance', 'AttendanceEmployeeController@bulkAttendance')->name('attendanceemployee.bulkattendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('attendanceemployee/bulkattendance', 'AttendanceEmployeeController@bulkAttendanceData')->name('attendanceemployee.bulkattendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('attendanceemployee/attendance', 'AttendanceEmployeeController@attendance')->name('attendanceemployee.attendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('attendanceemployee', 'AttendanceEmployeeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('timesheet', 'TimeSheetController')->middleware(
    [
        'auth',
        'XSS',
    ]
);



Route::resource('expensetype', 'ExpenseTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('incometype', 'IncomeTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('paymenttype', 'PaymentTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('leavetype', 'LeaveTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('payees', 'PayeesController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('payer', 'PayerController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('deposit', 'DepositController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('expense', 'ExpenseController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('transferbalance', 'TransferBalanceController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::group(
    [
        'middleware' => [
            'auth',
            'XSS',
        ],
    ], function (){
    Route::get('change-language/{lang}', 'LanguageController@changeLanquage')->name('change.language');
    Route::get('manage-language/{lang}', 'LanguageController@manageLanguage')->name('manage.language');
    Route::post('store-language-data/{lang}', 'LanguageController@storeLanguageData')->name('store.language.data');
    Route::get('create-language', 'LanguageController@createLanguage')->name('create.language');
    Route::post('store-language', 'LanguageController@storeLanguage')->name('store.language');
    Route::delete('/lang/{lang}', 'LanguageController@destroyLang')->name('lang.destroy');
}
);

Route::resource('roles', 'RoleController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('permissions', 'PermissionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);



Route::post('change-password', 'UserController@updatePassword')->name('update.password');

Route::resource('account-assets', 'AssetController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('document-upload', 'DucumentUploadController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('indicator', 'IndicatorController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('appraisal', 'AppraisalController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('goaltype', 'GoalTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('goaltracking', 'GoalTrackingController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('company-policy', 'CompanyPolicyController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('trainingtype', 'TrainingTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('trainer', 'TrainerController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('training/status', 'TrainingController@updateStatus')->name('training.status')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('training', 'TrainingController')->middleware(
    [
        'auth',
        'XSS',
    ]
);




Route::get('report/income-expense', 'ReportController@incomeVsExpense')->name('report.income-expense')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/leave', 'ReportController@leave')->name('report.leave')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('employee/{id}/leave/{status}/{type}/{month}/{year}', 'ReportController@employeeLeave')->name('report.employee.leave')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/account-statement', 'ReportController@accountStatement')->name('report.account.statement')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/payroll', 'ReportController@payroll')->name('report.payroll')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/monthly/attendance', 'ReportController@monthlyAttendance')->name('report.monthly.attendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/attendance/{month}/{branch}/{department}', 'ReportController@exportCsv')->name('report.attendance')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('report/timesheet', 'ReportController@timesheet')->name('report.timesheet')->middleware(
    [
        'auth',
        'XSS',
    ]
);

//------------------------------------  Recurtment --------------------------------

Route::resource('job-category', 'JobCategoryController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('job-stage', 'JobStageController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-stage/order', 'JobStageController@order')->name('job.stage.order')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('job', 'JobController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('career/{id}/{lang}', 'JobController@career')->name('career');
Route::get('job/requirement/{code}/{lang}', 'JobController@jobRequirement')->name('job.requirement');
Route::get('job/apply/{code}/{lang}', 'JobController@jobApply')->name('job.apply');
Route::post('job/apply/data/{code}', 'JobController@jobApplyData')->name('job.apply.data');


Route::get('job-application/candidate', 'JobApplicationController@candidate')->name('job.application.candidate')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('job-application', 'JobApplicationController')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('job-application/order', 'JobApplicationController@order')->name('job.application.order')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/{id}/rating', 'JobApplicationController@rating')->name('job.application.rating')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::delete('job-application/{id}/archive', 'JobApplicationController@archive')->name('job.application.archive')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::post('job-application/{id}/skill/store', 'JobApplicationController@addSkill')->name('job.application.skill.store')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/{id}/note/store', 'JobApplicationController@addNote')->name('job.application.note.store')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::delete('job-application/{id}/note/destroy', 'JobApplicationController@destroyNote')->name('job.application.note.destroy')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-application/getByJob', 'JobApplicationController@getByJob')->name('get.job.application')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::get('job-onboard', 'JobApplicationController@jobOnBoard')->name('job.on.board')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('job-onboard/create/{id}', 'JobApplicationController@jobBoardCreate')->name('job.on.board.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-onboard/store/{id}', 'JobApplicationController@jobBoardStore')->name('job.on.board.store')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::get('job-onboard/edit/{id}', 'JobApplicationController@jobBoardEdit')->name('job.on.board.edit')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-onboard/update/{id}', 'JobApplicationController@jobBoardUpdate')->name('job.on.board.update')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::delete('job-onboard/delete/{id}', 'JobApplicationController@jobBoardDelete')->name('job.on.board.delete')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('job-onboard/convert/{id}', 'JobApplicationController@jobBoardConvert')->name('job.on.board.convert')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::post('job-onboard/convert/{id}', 'JobApplicationController@jobBoardConvertData')->name('job.on.board.convert')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::post('job-application/stage/change', 'JobApplicationController@stageChange')->name('job.application.stage.change')->middleware(
    [
        'auth',
        'XSS',
    ]
);

Route::resource('custom-question', 'CustomQuestionController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


Route::resource('interview-schedule', 'InterviewScheduleController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::get('interview-schedule/create/{id?}', 'InterviewScheduleController@create')->name('interview-schedule.create')->middleware(
    [
        'auth',
        'XSS',
    ]
);


//================================= Custom Landing Page ====================================//

Route::get('/landingpage', 'LandingPageSectionController@index')->name('custom_landing_page.index')->middleware(['auth','XSS']);
Route::get('/LandingPage/show/{id}', 'LandingPageSectionController@show');
Route::post('/LandingPage/setConetent', 'LandingPageSectionController@setConetent')->middleware(['auth','XSS']);
Route::get('/get_landing_page_section/{name}', function($name) {

    return view('custom_landing_page.'.$name);
});
Route::post('/LandingPage/removeSection/{id}', 'LandingPageSectionController@removeSection')->middleware(['auth','XSS']);
Route::post('/LandingPage/setOrder', 'LandingPageSectionController@setOrder')->middleware(['auth','XSS']);
Route::post('/LandingPage/copySection', 'LandingPageSectionController@copySection')->middleware(['auth','XSS']);
Route::resource('competencies', 'CompetenciesController')->middleware(
    [
        'auth',
        'XSS',
    ]
);
Route::resource('performanceType', 'PerformanceTypeController')->middleware(
    [
        'auth',
        'XSS',
    ]
);


//Employee Import & Export

Route::get('import/employee/file', 'EmployeeController@importFile')->name('employee.file.import');
Route::post('import/employee', 'EmployeeController@import')->name('employee.import');
Route::get('export/employee', 'EmployeeController@export')->name('employee.export');

// Timesheet Import & Export

Route::get('import/timesheet/file', 'TimeSheetController@importFile')->name('timesheet.file.import');
Route::post('import/timesheet', 'TimeSheetController@import')->name('timesheet.import');
Route::get('export/timesheet', 'TimeSheetController@export')->name('timesheet.export');

//Leave Export
Route::get('export/leave','LeaveController@export')->name('leave.export');

//deposite Export
Route::get('export/deposite','DepositController@export')->name('deposite.export');


//expense Export
Route::get('export/expense','ExpenseController@export')->name('expense.export');

//Transfer Balance Export
Route::get('export/transfer-balance','TransferBalanceController@export')->name('transfer_balance.export');

//Training Import & Export
Route::get('export/training', 'TrainingController@export')->name('training.export');

//Trainer Export
Route::get('export/trainer','TrainerController@export')->name('trainer.export');
Route::get('import/training/file', 'TrainerController@importFile')->name('trainer.file.import');
Route::post('import/training', 'TrainerController@import')->name('trainer.import');

//Holidays Import & Export
Route::get('export/holidays','HolidayController@export')->name('holidays.export');
Route::get('import/holidays/file', 'HolidayController@importFile')->name('holidays.file.import');
Route::post('import/holidays', 'HolidayController@import')->name('holidays.import');

//Asset Import & Export
Route::get('export/assets','AssetController@export')->name('assets.export');
Route::get('import/assets/file', 'AssetController@importFile')->name('assets.file.import');
Route::post('import/assets', 'AssetController@import')->name('assets.import');

//zoom meeting
Route::any('zoommeeting/calendar', 'ZoomMeetingController@calender')->name('zoom_meeting.calender')->middleware(['auth','XSS']);
Route::resource('zoom-meeting', 'ZoomMeetingController')->middleware(['auth','XSS']);


// slack
Route::post('setting/slack','SettingsController@slack')->name('slack.setting');

//telegram
Route::post('setting/telegram','SettingsController@telegram')->name('telegram.setting');

//twilio
Route::post('setting/twilio','SettingsController@twilio')->name('twilio.setting');

// recaptcha
Route::post('/recaptcha-settings',['as' => 'recaptcha.settings.store','uses' =>'SettingsController@recaptchaSettingStore'])->middleware(['auth','XSS']);

// user reset password
Route::any('user-reset-password/{id}', 'UserController@userPassword')->name('user.reset');
Route::post('user-reset-password/{id}', 'UserController@userPasswordReset')->name('user.password.update');


Route::resource('expenses', 'ExpenseController')->middleware(
    [
        'auth',
        'XSS','revalidate',
    ]
);
