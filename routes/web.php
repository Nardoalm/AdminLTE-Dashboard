<?php

use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : view('auth.login');
});

Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/google/callback', function () {

    $googleUser = Socialite::driver('google')->user();

    $user = User::updateOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'google_id' => $googleUser->getId(),
            'password' => bcrypt('123456'),
            'address' => 'Rua da zuada',
            'cep' => '44730000',
            'google_avatar' => $googleUser->getAvatar(),
        ]
    );

    Auth::login($user);

    return redirect('/dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::prefix('admin')->group(function () {
        Route::post('users/generate', [UserController::class, 'generateUsers'])->name('users.generate');
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('profile', function () {
            return view('admin.profile');
        })->name('admin.profile');

        Route::resource('users', UserController::class);
        Route::get('usersCRUD', [UserController::class, 'index'])->name('user.custom_index');

        Route::prefix('users/{user}/photos')->name('photos.')->group(function () {
            Route::get('/', [PhotoController::class, 'index'])->name('index');
            Route::get('/create', [PhotoController::class, 'create'])->name('create');
            Route::post('/', [PhotoController::class, 'store'])->name('store');
            Route::delete('/{photo}', [PhotoController::class, 'destroy'])->name('destroy');
            Route::post('/{photo}/default', [PhotoController::class, 'setDefault'])->name('set_default');
            Route::post('/{photo}/removedefault', [PhotoController::class, 'removeDefault'])->name('remove_default');
        });

        Route::name('admin.')->group(function () {
            Route::prefix('UI')->name('ui.')->group(function() {
                Route::get('buttons', \App\Http\Controllers\Adminlte\Pages\UIButtonsController::class)->name('buttons');
                Route::get('general', \App\Http\Controllers\Adminlte\Pages\UIGeneralController::class)->name('general');
                Route::get('icons', \App\Http\Controllers\Adminlte\Pages\UIIconsController::class)->name('icons');
                Route::get('modals', \App\Http\Controllers\Adminlte\Pages\UIModalsController::class)->name('modals');
                Route::get('navbar', \App\Http\Controllers\Adminlte\Pages\UINavbarController::class)->name('navbar');
                Route::get('ribbons', \App\Http\Controllers\Adminlte\Pages\UIRibbonsController::class)->name('ribbons');
                Route::get('sliders', \App\Http\Controllers\Adminlte\Pages\UISlidersController::class)->name('sliders');
                Route::get('timeline', \App\Http\Controllers\Adminlte\Pages\UITimelineController::class)->name('timeline');
            });

            Route::prefix('charts')->name('charts.')->group(function() {
                Route::get('chartjs', \App\Http\Controllers\Adminlte\Pages\ChartsChartjsController::class)->name('chartjs');
                Route::get('flot', \App\Http\Controllers\Adminlte\Pages\ChartsFlotController::class)->name('flot');
                Route::get('inline', \App\Http\Controllers\Adminlte\Pages\ChartsInlineController::class)->name('inline');
                Route::get('uplot', \App\Http\Controllers\Adminlte\Pages\ChartsUplotController::class)->name('uplot');
            });

            Route::prefix('forms')->name('forms.')->group(function() {
                Route::get('advanced', \App\Http\Controllers\Adminlte\Pages\FormsAdvancedController::class)->name('advanced');
                Route::get('editors', \App\Http\Controllers\Adminlte\Pages\FormsEditorsController::class)->name('editors');
                Route::get('general', \App\Http\Controllers\Adminlte\Pages\FormsGeneralController::class)->name('general');
                Route::get('validation', \App\Http\Controllers\Adminlte\Pages\FormsValidationController::class)->name('validation');
            });

            Route::prefix('layout')->name('layout.')->group(function() {
                Route::get('boxed', \App\Http\Controllers\Adminlte\Pages\LayoutBoxedController::class)->name('boxed');
                Route::get('collapsed-sidebar', \App\Http\Controllers\Adminlte\Pages\LayoutCollapsedSidebarController::class)->name('collapsed_sidebar');
                Route::get('fixed-footer', \App\Http\Controllers\Adminlte\Pages\LayoutFixedFooterController::class)->name('fixed_footer');
                Route::get('fixed-sidebar', \App\Http\Controllers\Adminlte\Pages\LayoutFixedSidebarController::class)->name('fixed_sidebar');
                Route::get('fixed-sidebar-custom', \App\Http\Controllers\Adminlte\Pages\LayoutFixedSidebarCustomController::class)->name('fixed_sidebar_custom');
                Route::get('fixed-topnav', \App\Http\Controllers\Adminlte\Pages\LayoutFixedTopnavController::class)->name('fixed_topnav');
                Route::get('top-nav', \App\Http\Controllers\Adminlte\Pages\LayoutTopNavController::class)->name('top_nav');
                Route::get('top-nav-sidebar', \App\Http\Controllers\Adminlte\Pages\LayoutTopNavSidebarController::class)->name('top_nav_sidebar');
            });

            Route::prefix('mailbox')->name('mailbox.')->group(function() {
                Route::get('compose', \App\Http\Controllers\Adminlte\Pages\MailboxComposeController::class)->name('compose');
                Route::get('mailbox', \App\Http\Controllers\Adminlte\Pages\MailboxMailboxController::class)->name('mailbox');
                Route::get('read-mail', \App\Http\Controllers\Adminlte\Pages\MailboxReadMailController::class)->name('read_mail');
            });

            Route::prefix('search')->name('search.')->group(function() {
                Route::get('enhanced-results', \App\Http\Controllers\Adminlte\Pages\SearchEnhancedResultsController::class)->name('enhanced_results');
                Route::get('enhanced', \App\Http\Controllers\Adminlte\Pages\SearchEnhancedController::class)->name('enhanced');
                Route::get('simple-results', \App\Http\Controllers\Adminlte\Pages\SearchSimpleResultsController::class)->name('simple_results');
                Route::get('simple', \App\Http\Controllers\Adminlte\Pages\SearchSimpleController::class)->name('simple');
            });

            Route::prefix('tables')->name('tables.')->group(function() {
                Route::get('data', \App\Http\Controllers\Adminlte\Pages\TablesDataController::class)->name('data');
                Route::get('jsgrid', \App\Http\Controllers\Adminlte\Pages\TablesJsgridController::class)->name('jsgrid');
                Route::get('simple', \App\Http\Controllers\Adminlte\Pages\TablesSimpleController::class)->name('simple');
            });

            Route::prefix('examples')->name('examples.')->group(function() {
                Route::get('404', \App\Http\Controllers\Adminlte\Pages\Examples404Controller::class)->name('404');
                Route::get('500', \App\Http\Controllers\Adminlte\Pages\Examples500Controller::class)->name('500');
                Route::get('blank', \App\Http\Controllers\Adminlte\Pages\ExamplesBlankController::class)->name('blank');
                Route::get('contact-us', \App\Http\Controllers\Adminlte\Pages\ExamplesContactUsController::class)->name('contact_us');
                Route::get('contacts', \App\Http\Controllers\Adminlte\Pages\ExamplesContactsController::class)->name('contacts');
                Route::get('e-commerce', \App\Http\Controllers\Adminlte\Pages\ExamplesECommerceController::class)->name('e_commerce');
                Route::get('faq', \App\Http\Controllers\Adminlte\Pages\ExamplesFaqController::class)->name('faq');
                Route::get('forgot-password-v2', \App\Http\Controllers\Adminlte\Pages\ExamplesForgotPasswordV2Controller::class)->name('forgot_password_v2');
                Route::get('forgot-password', \App\Http\Controllers\Adminlte\Pages\ExamplesForgotPasswordController::class)->name('forgot_password');
                Route::get('invoice-print', \App\Http\Controllers\Adminlte\Pages\ExamplesInvoicePrintController::class)->name('invoice_print');
                Route::get('invoice', \App\Http\Controllers\Adminlte\Pages\ExamplesInvoiceController::class)->name('invoice');
                Route::get('language-menu', \App\Http\Controllers\Adminlte\Pages\ExamplesLanguageMenuController::class)->name('language_menu');
                Route::get('legacy-user-menu', \App\Http\Controllers\Adminlte\Pages\ExamplesLegacyUserMenuController::class)->name('legacy_user_menu');
                Route::get('lockscreen', \App\Http\Controllers\Adminlte\Pages\ExamplesLockscreenController::class)->name('lockscreen');
                Route::get('login-v2', \App\Http\Controllers\Adminlte\Pages\ExamplesLoginV2Controller::class)->name('login_v2');
                Route::get('login', \App\Http\Controllers\Adminlte\Pages\ExamplesLoginController::class)->name('login');
                Route::get('pace', \App\Http\Controllers\Adminlte\Pages\ExamplesPaceController::class)->name('pace');
                Route::get('profile', \App\Http\Controllers\Adminlte\Pages\ExamplesProfileController::class)->name('profile');
                Route::get('project-add', \App\Http\Controllers\Adminlte\Pages\ExamplesProjectAddController::class)->name('project_add');
                Route::get('project-detail', \App\Http\Controllers\Adminlte\Pages\ExamplesProjectDetailController::class)->name('project_detail');
                Route::get('project-edit', \App\Http\Controllers\Adminlte\Pages\ExamplesProjectEditController::class)->name('project_edit');
                Route::get('projects', \App\Http\Controllers\Adminlte\Pages\ExamplesProjectsController::class)->name('projects');
                Route::get('recover-password-v2', \App\Http\Controllers\Adminlte\Pages\ExamplesRecoverPasswordV2Controller::class)->name('recover_password_v2');
                Route::get('recover-password', \App\Http\Controllers\Adminlte\Pages\ExamplesRecoverPasswordController::class)->name('recover_password');
                Route::get('register-v2', \App\Http\Controllers\Adminlte\Pages\ExamplesRegisterV2Controller::class)->name('register_v2');
                Route::get('register', \App\Http\Controllers\Adminlte\Pages\ExamplesRegisterController::class)->name('register');
            });

            Route::get('calendar', \App\Http\Controllers\Adminlte\Pages\CalendarController::class)->name('calendar');
            Route::get('gallery', \App\Http\Controllers\Adminlte\Pages\GalleryController::class)->name('gallery');
            Route::get('kanban', \App\Http\Controllers\Adminlte\Pages\KanbanController::class)->name('kanban');
            Route::get('widgets', \App\Http\Controllers\Adminlte\Pages\WidgetsController::class)->name('widgets');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
