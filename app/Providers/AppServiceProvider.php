<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\RedirectResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // \App\User::observe(\App\Observers\UserObserver::class);
        // \App\Group::observe(\App\Observers\GroupObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Response macros for pnotify
        RedirectResponse::macro('pnotify', function($title = '', $text = '', $type = 'success'){
            session()->flash('pnotify.title', $title);
            session()->flash('pnotify.type', $type);
            session()->flash('pnotify.text', $text);
            return $this;
        });
    }
}
