<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('admin', function (User $user) {
            return $user->roles->pluck('nama')->contains('Admin');
        });
        Gate::define('komite', function (User $user) {
            return $user->roles->pluck('nama')->contains('Komite');
        });
        Gate::define('ketua_penguji', function (User $user) {
            return $user->roles->pluck('nama')->contains('Ketua Penguji');
        });
        Gate::define('dosen_penguji', function (User $user) {
            return $user->roles->pluck('nama')->contains('Dosen Penguji');
        });
        Gate::define('dosen_pembimbing', function (User $user) {
            return $user->roles->pluck('nama')->contains('Dosen Pembimbing');
        });
        Gate::define('mahasiswa', function (User $user) {
            return $user->roles->pluck('nama')->contains('Mahasiswa');
        });
        Gate::define('ketua_komite', function (User $user) {
            return $user->roles->pluck('nama')->contains('Ketua Komite');
        });
    }
}
