<?php

namespace App\Providers;

use App\Models\criancas;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        $shareNewbornSummary = function ($view) {
            $summary = request()->attributes->get('newbornSummary');

            if ($summary === null) {
                $newbornsToday = criancas::with('parto.paciente')
                    ->whereDate('dataParto', now()->toDateString())
                    ->orderByDesc('hora')
                    ->limit(5)
                    ->get();

                $summary = [
                    'newbornsToday' => $newbornsToday,
                    'newbornsTodayCount' => criancas::whereDate('dataParto', now()->toDateString())->count(),
                ];

                request()->attributes->set('newbornSummary', $summary);
            }

            $view->with($summary);
        };

        View::composer(['dashboard', 'layouts.app'], $shareNewbornSummary);
    }
}
