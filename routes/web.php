<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::prefix('users/{user}')->group(function () {
            Route::get('photos', [PhotoController::class, 'index'])->name('photos.index');
            Route::get('photos/create', [PhotoController::class, 'create'])->name('photos.create');
            Route::post('photos', [PhotoController::class, 'store'])->name('photos.store');
            Route::post('photos/{photo}/default', [PhotoController::class, 'setDefault'])->name('photos.set_default');
        });
        Route::get('usersCRUD', [UserController::class, 'index'])->name('user.index');
        Route::resource('users', UserController::class)->names('users');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::get('profile', function () {
            return view('admin.profile');
        })->name('profile');

        Route::get('UI/buttons', \App\Http\Controllers\Adminlte\Pages\UIButtonsController::class)->name('ui.buttons');
        Route::get('UI/general', \App\Http\Controllers\Adminlte\Pages\UIGeneralController::class)->name('ui.general');
        Route::get('UI/icons', \App\Http\Controllers\Adminlte\Pages\UIIconsController::class)->name('ui.icons');
        Route::get('UI/modals', \App\Http\Controllers\Adminlte\Pages\UIModalsController::class)->name('ui.modals');
        Route::get('UI/navbar', \App\Http\Controllers\Adminlte\Pages\UINavbarController::class)->name('ui.navbar');
        Route::get('UI/ribbons', \App\Http\Controllers\Adminlte\Pages\UIRibbonsController::class)->name('ui.ribbons');
        Route::get('UI/sliders', \App\Http\Controllers\Adminlte\Pages\UISlidersController::class)->name('ui.sliders');
        Route::get('UI/timeline', \App\Http\Controllers\Adminlte\Pages\UITimelineController::class)->name('ui.timeline');

        Route::get('calendar', \App\Http\Controllers\Adminlte\Pages\CalendarController::class)->name('calendar');
        Route::get('charts/chartjs', \App\Http\Controllers\Adminlte\Pages\ChartsChartjsController::class)->name('charts.chartjs');
        Route::get('charts/flot', \App\Http\Controllers\Adminlte\Pages\ChartsFlotController::class)->name('charts.flot');
        Route::get('charts/inline', \App\Http\Controllers\Adminlte\Pages\ChartsInlineController::class)->name('charts.inline');
        Route::get('charts/uplot', \App\Http\Controllers\Adminlte\Pages\ChartsUplotController::class)->name('charts.uplot');

        Route::get('examples/404', \App\Http\Controllers\Adminlte\Pages\Examples404Controller::class)->name('examples.404');
        Route::get('examples/500', \App\Http\Controllers\Adminlte\Pages\Examples500Controller::class)->name('examples.500');
        Route::get('examples/blank', \App\Http\Controllers\Adminlte\Pages\ExamplesBlankController::class)->name('examples.blank');
        Route::get('examples/contact-us', \App\Http\Controllers\Adminlte\Pages\ExamplesContactUsController::class)->name('examples.contact_us');
        Route::get('examples/contacts', \App\Http\Controllers\Adminlte\Pages\ExamplesContactsController::class)->name('examples.contacts');
        Route::get('examples/e-commerce', \App\Http\Controllers\Adminlte\Pages\ExamplesECommerceController::class)->name('examples.e_commerce');
        Route::get('examples/faq', \App\Http\Controllers\Adminlte\Pages\ExamplesFaqController::class)->name('examples.faq');
        Route::get('examples/forgot-password-v2', \App\Http\Controllers\Adminlte\Pages\ExamplesForgotPasswordV2Controller::class)->name('examples.forgot_password_v2');
        Route::get('examples/forgot-password', \App\Http\Controllers\Adminlte\Pages\ExamplesForgotPasswordController::class)->name('examples.forgot_password');
        Route::get('examples/invoice-print', \App\Http\Controllers\Adminlte\Pages\ExamplesInvoicePrintController::class)->name('examples.invoice_print');
        Route::get('examples/invoice', \App\Http\Controllers\Adminlte\Pages\ExamplesInvoiceController::class)->name('examples.invoice');
        Route::get('examples/language-menu', \App\Http\Controllers\Adminlte\Pages\ExamplesLanguageMenuController::class)->name('examples.language_menu');
        Route::get('examples/legacy-user-menu', \App\Http\Controllers\Adminlte\Pages\ExamplesLegacyUserMenuController::class)->name('examples.legacy_user_menu');
        Route::get('examples/lockscreen', \App\Http\Controllers\Adminlte\Pages\ExamplesLockscreenController::class)->name('examples.lockscreen');
        Route::get('examples/login-v2', \App\Http\Controllers\Adminlte\Pages\ExamplesLoginV2Controller::class)->name('examples.login_v2');
        Route::get('examples/login', \App\Http\Controllers\Adminlte\Pages\ExamplesLoginController::class)->name('examples.login');
        Route::get('examples/pace', \App\Http\Controllers\Adminlte\Pages\ExamplesPaceController::class)->name('examples.pace');
        Route::get('examples/profile', \App\Http\Controllers\Adminlte\Pages\ExamplesProfileController::class)->name('examples.profile');
        Route::get('examples/project-add', \App\Http\Controllers\Adminlte\Pages\ExamplesProjectAddController::class)->name('examples.project_add');
        Route::get('examples/project-detail', \App\Http\Controllers\Adminlte\Pages\ExamplesProjectDetailController::class)->name('examples.project_detail');
        Route::get('examples/project-edit', \App\Http\Controllers\Adminlte\Pages\ExamplesProjectEditController::class)->name('examples.project_edit');
        Route::get('examples/projects', \App\Http\Controllers\Adminlte\Pages\ExamplesProjectsController::class)->name('examples.projects');
        Route::get('examples/recover-password-v2', \App\Http\Controllers\Adminlte\Pages\ExamplesRecoverPasswordV2Controller::class)->name('examples.recover_password_v2');
        Route::get('examples/recover-password', \App\Http\Controllers\Adminlte\Pages\ExamplesRecoverPasswordController::class)->name('examples.recover_password');
        Route::get('examples/register-v2', \App\Http\Controllers\Adminlte\Pages\ExamplesRegisterV2Controller::class)->name('examples.register_v2');
        Route::get('examples/register', \App\Http\Controllers\Adminlte\Pages\ExamplesRegisterController::class)->name('examples.register');

        Route::get('forms/advanced', \App\Http\Controllers\Adminlte\Pages\FormsAdvancedController::class)->name('forms.advanced');
        Route::get('forms/editors', \App\Http\Controllers\Adminlte\Pages\FormsEditorsController::class)->name('forms.editors');
        Route::get('forms/general', \App\Http\Controllers\Adminlte\Pages\FormsGeneralController::class)->name('forms.general');
        Route::get('forms/validation', \App\Http\Controllers\Adminlte\Pages\FormsValidationController::class)->name('forms.validation');

        Route::get('gallery', \App\Http\Controllers\Adminlte\Pages\GalleryController::class)->name('gallery');
        Route::get('kanban', \App\Http\Controllers\Adminlte\Pages\KanbanController::class)->name('kanban');

        Route::get('layout/boxed', \App\Http\Controllers\Adminlte\Pages\LayoutBoxedController::class)->name('layout.boxed');
        Route::get('layout/collapsed-sidebar', \App\Http\Controllers\Adminlte\Pages\LayoutCollapsedSidebarController::class)->name('layout.collapsed_sidebar');
        Route::get('layout/fixed-footer', \App\Http\Controllers\Adminlte\Pages\LayoutFixedFooterController::class)->name('layout.fixed_footer');
        Route::get('layout/fixed-sidebar', \App\Http\Controllers\Adminlte\Pages\LayoutFixedSidebarController::class)->name('layout.fixed_sidebar');
        Route::get('layout/fixed-sidebar-custom', \App\Http\Controllers\Adminlte\Pages\LayoutFixedSidebarCustomController::class)->name('layout.fixed_sidebar_custom');
        Route::get('layout/fixed-topnav', \App\Http\Controllers\Adminlte\Pages\LayoutFixedTopnavController::class)->name('layout.fixed_topnav');
        Route::get('layout/top-nav', \App\Http\Controllers\Adminlte\Pages\LayoutTopNavController::class)->name('layout.top_nav');
        Route::get('layout/top-nav-sidebar', \App\Http\Controllers\Adminlte\Pages\LayoutTopNavSidebarController::class)->name('layout.top_nav_sidebar');

        Route::get('mailbox/compose', \App\Http\Controllers\Adminlte\Pages\MailboxComposeController::class)->name('mailbox.compose');
        Route::get('mailbox/mailbox', \App\Http\Controllers\Adminlte\Pages\MailboxMailboxController::class)->name('mailbox.mailbox');
        Route::get('mailbox/read-mail', \App\Http\Controllers\Adminlte\Pages\MailboxReadMailController::class)->name('mailbox.read_mail');

        Route::get('search/enhanced-results', \App\Http\Controllers\Adminlte\Pages\SearchEnhancedResultsController::class)->name('search.enhanced_results');
        Route::get('search/enhanced', \App\Http\Controllers\Adminlte\Pages\SearchEnhancedController::class)->name('search.enhanced');
        Route::get('search/simple-results', \App\Http\Controllers\Adminlte\Pages\SearchSimpleResultsController::class)->name('search.simple_results');
        Route::get('search/simple', \App\Http\Controllers\Adminlte\Pages\SearchSimpleController::class)->name('search.simple');

        Route::get('tables/data', \App\Http\Controllers\Adminlte\Pages\TablesDataController::class)->name('tables.data');
        Route::get('tables/jsgrid', \App\Http\Controllers\Adminlte\Pages\TablesJsgridController::class)->name('tables.jsgrid');
        Route::get('tables/simple', \App\Http\Controllers\Adminlte\Pages\TablesSimpleController::class)->name('tables.simple');

        Route::get('widgets', \App\Http\Controllers\Adminlte\Pages\WidgetsController::class)->name('widgets');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
