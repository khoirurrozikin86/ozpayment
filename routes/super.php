<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Super\{RoleController, PermissionController, UserManageController};
use App\Http\Controllers\Super\UserController;
use App\Http\Controllers\Admin\{
    PortfolioController,
    SettingController,
    ServiceController,
    TechStackController,
    PageController,
    LeadController,
    PaketController,
    serverController,
    PelangganController,
    BulanController,
    TagihanController,
    PaymentController
};

Route::middleware(['auth', 'role:super_admin'])
    ->prefix('super')->name('super.')->group(function () {

        Route::view('/', 'super.dashboard')->name('dashboard');

        // Roles
        Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/roles/dt', [RoleController::class, 'datatable'])->name('roles.dt');
        Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/roles/{role}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
        Route::get('/roles/{role}/permissions', [RoleController::class, 'editPermissions'])->name('roles.permissions.edit');
        Route::put('/roles/{role}/permissions', [RoleController::class, 'updatePermissions'])->name('roles.permissions.update');

        // Permissions
        Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
        Route::get('/permissions/dt', [PermissionController::class, 'datatable'])->name('permissions.dt');
        Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');
        Route::post('/permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::get('/permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit');
        Route::put('/permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('/permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

        // Users
        // Route::get('/users', [UserManageController::class, 'index'])->name('users.index');
        // Route::get('/users/dt', [UserManageController::class, 'datatable'])->name('users.dt');
        // Route::get('/users/{user}/edit', [UserManageController::class, 'edit'])->name('users.edit');
        // Route::put('/users/{user}/roles', [UserManageController::class, 'syncRoles'])->name('users.roles.sync');
        // Route::put('/users/{user}/perms', [UserManageController::class, 'syncPermissions'])->name('users.perms.sync');


        // USERS
        Route::prefix('users')->name('user.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/dt', [UserController::class, 'datatable'])->name('dt'); // ← ini yang dipakai DataTables
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
            Route::put('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');

            // tetap pakai controller lama untuk sinkron role/permission
            Route::put('/{user}/roles', [UserManageController::class, 'syncRoles'])->name('roles.sync');
            Route::put('/{user}/perms', [UserManageController::class, 'syncPermissions'])->name('perms.sync');
        });



        Route::get('portfolios',                 [PortfolioController::class, 'index'])->name('portfolios.index');
        Route::get('portfolios/dt',       [PortfolioController::class, 'datatable'])->name('portfolios.dt');

        Route::get('portfolios/create',          [PortfolioController::class, 'create'])->name('portfolios.create');
        Route::post('portfolios',                [PortfolioController::class, 'store'])->name('portfolios.store');

        Route::get('portfolios/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolios.edit');
        Route::put('portfolios/{portfolio}',     [PortfolioController::class, 'update'])->name('portfolios.update');

        Route::delete('portfolios/{portfolio}',  [PortfolioController::class, 'destroy'])->name('portfolios.destroy');



        Route::get('settings',        [SettingController::class, 'index'])->name('settings.index');
        Route::get('settings/dt',     [SettingController::class, 'datatable'])->name('settings.dt');
        Route::post('settings',       [SettingController::class, 'store'])->name('settings.store');
        Route::put('settings/{setting}', [SettingController::class, 'update'])->name('settings.update');
        Route::delete('settings/{setting}', [SettingController::class, 'destroy'])->name('settings.destroy');


        Route::get('services',            [ServiceController::class, 'index'])->name('services.index');
        Route::get('services/dt',         [ServiceController::class, 'datatable'])->name('services.dt');
        Route::post('services',           [ServiceController::class, 'store'])->name('services.store');
        Route::put('services/{service}',  [ServiceController::class, 'update'])->name('services.update');
        Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

        Route::get('tech-stacks',                 [TechStackController::class, 'index'])->name('tech-stacks.index');
        Route::get('tech-stacks/dt',              [TechStackController::class, 'datatable'])->name('tech-stacks.dt');
        Route::post('tech-stacks',                [TechStackController::class, 'store'])->name('tech-stacks.store');
        Route::put('tech-stacks/{techstack}',     [TechStackController::class, 'update'])->name('tech-stacks.update');
        Route::delete('tech-stacks/{techstack}',  [TechStackController::class, 'destroy'])->name('tech-stacks.destroy');


        Route::get('pages',             [PageController::class, 'index'])->name('pages.index');
        Route::get('pages/dt',          [PageController::class, 'datatable'])->name('pages.dt');
        Route::post('pages',            [PageController::class, 'store'])->name('pages.store');
        Route::put('pages/{page}',      [PageController::class, 'update'])->name('pages.update');
        Route::delete('pages/{page}',   [PageController::class, 'destroy'])->name('pages.destroy');

        Route::get('leads',              [LeadController::class, 'index'])->name('leads.index');
        Route::get('leads/dt',           [LeadController::class, 'datatable'])->name('leads.dt');
        Route::post('leads',             [LeadController::class, 'store'])->name('leads.store');
        Route::put('leads/{lead}',       [LeadController::class, 'update'])->name('leads.update');
        Route::delete('leads/{lead}',    [LeadController::class, 'destroy'])->name('leads.destroy');


        Route::get('pakets',           [PaketController::class, 'index'])->name('pakets.index');
        Route::get('pakets/dt',        [PaketController::class, 'datatable'])->name('pakets.dt'); // ← pakai method 'datatable'
        Route::post('pakets',          [PaketController::class, 'store'])->name('pakets.store');
        Route::put('pakets/{paket}',   [PaketController::class, 'update'])->name('pakets.update');
        Route::delete('pakets/{paket}', [PaketController::class, 'destroy'])->name('pakets.destroy');
        Route::get('pakets/export/xlsx', [PaketController::class, 'export'])->name('pakets.export'); // ← export


        Route::get('servers',            [ServerController::class, 'index'])->name('servers.index');
        Route::get('servers/dt',         [ServerController::class, 'dt'])->name('servers.dt');
        Route::get('servers/export/xlsx', [ServerController::class, 'export'])->name('servers.export');
        Route::post('servers',           [ServerController::class, 'store'])->name('servers.store');
        Route::put('servers/{server}',   [ServerController::class, 'update'])->name('servers.update');
        Route::delete('servers/{server}', [ServerController::class, 'destroy'])->name('servers.destroy');


        Route::get('pelanggans',              [PelangganController::class, 'index'])->name('pelanggans.index');
        Route::get('pelanggans/dt',           [PelangganController::class, 'dt'])->name('pelanggans.dt');
        Route::get('pelanggans/export/xlsx',  [PelangganController::class, 'export'])->name('pelanggans.export');
        Route::post('pelanggans',             [PelangganController::class, 'store'])->name('pelanggans.store');
        Route::put('pelanggans/{pelanggan}',  [PelangganController::class, 'update'])->name('pelanggans.update');
        Route::delete('pelanggans/{pelanggan}', [PelangganController::class, 'destroy'])->name('pelanggans.destroy');

        Route::get('bulans',             [BulanController::class, 'index'])->name('bulans.index');
        Route::get('bulans/dt',          [BulanController::class, 'dt'])->name('bulans.dt');
        Route::get('bulans/export/xlsx', [BulanController::class, 'export'])->name('bulans.export');

        // gunakan route model binding by PK string
        Route::post('bulans',            [BulanController::class, 'store'])->name('bulans.store');
        Route::put('bulans/{bulan}',     [BulanController::class, 'update'])->name('bulans.update');      // {bulan} → id_bulan
        Route::delete('bulans/{bulan}',  [BulanController::class, 'destroy'])->name('bulans.destroy');


        Route::get('tagihans',              [TagihanController::class, 'index'])->name('tagihans.index');
        Route::get('tagihans/dt',           [TagihanController::class, 'dt'])->name('tagihans.dt');
        Route::get('tagihans/export/xlsx',  [TagihanController::class, 'export'])->name('tagihans.export');

        Route::post('tagihans',             [TagihanController::class, 'store'])->name('tagihans.store');
        Route::put('tagihans/{tagihan}',    [TagihanController::class, 'update'])->name('tagihans.update');
        Route::delete('tagihans/{tagihan}', [TagihanController::class, 'destroy'])->name('tagihans.destroy');

        // generate batch/per user
        Route::post('tagihans/generate',    [TagihanController::class, 'generate'])->name('tagihans.generate');

        // Halaman khusus "Belum Lunas" di TagihanController
        Route::get('tagihans/unpaid',            [TagihanController::class, 'unpaid'])->name('tagihans.unpaid');
        Route::get('tagihans/unpaid/dt',         [TagihanController::class, 'unpaidDt'])->name('tagihans.unpaid.dt');
        Route::get('tagihans/unpaid/export/xlsx', [TagihanController::class, 'unpaidExport'])->name('tagihans.unpaid.export');






        // Halaman list + filter + export
        Route::get('payments',              [PaymentController::class, 'index'])->name('payments.index');
        Route::get('payments/dt',           [PaymentController::class, 'dt'])->name('payments.dt');
        Route::get('payments/summary',      [PaymentController::class, 'summary'])->name('payments.summary');
        Route::get('payments/export/xlsx',  [PaymentController::class, 'export'])->name('payments.export');

        // CRUD pembayaran
        Route::post('payments',             [PaymentController::class, 'store'])->name('payments.store');
        Route::delete('payments/{payment}', [PaymentController::class, 'destroy'])->name('payments.destroy');

        // Lookup (kartu) — tetap di controller yang sama
        Route::get('payments/lookup',       [PaymentController::class, 'lookup'])->name('payments.lookup');
        Route::get('payments/find',         [PaymentController::class, 'find'])->name('payments.find');
    });
