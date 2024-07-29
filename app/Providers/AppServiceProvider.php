<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like auth()->user->can() and @can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('admin_sys') ? true : null;
        });
        //Paginator::useBootstrapFour();
        Paginator::useBootstrapFive();
        Blade::directive('formatMoney', function ($money) {
            return "<?php echo '$' . number_format($money, 0, ',', '.'); ?>";
        });
        Blade::directive('formatDate', function ($date) {
            return "<?php echo isset($date) ? ($date)->format('d/m/Y') : ''; ?>";
        });
        Blade::directive('formatWooDate', function ($date) {
            return "<?php echo isset($date) ? Carbon\Carbon::parse($date)->format('d/m/y H:i') : ''; ?>";
        });
        Blade::directive('statusBadge', function ($status) {
            return "<?php
                \$color = [
                    'publish' => 'success',
                    'private' => 'primary',
                    'draft' => 'warning',
                    'Devolución' => 'danger',
                    'pending' => 'secondary',
                ];
                echo isset($status) && isset(\$color[trim($status, \"'\\\"\")]) ? '<span class=\"badge badge-' . \$color[trim($status, \"'\\\"\")] . '\">' . $status . '</span>' : '';
            ?>";
        });
    }
}
