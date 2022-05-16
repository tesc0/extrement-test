<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repository\Eloquent\BaseRepository; 
use App\Repository\EloquentRepositoryInterface; 

use App\Repository\VaccineRepositoryInterface; 
use App\Repository\Eloquent\VaccineRepository; 
use App\Repository\ApplicationRepositoryInterface; 
use App\Repository\Eloquent\ApplicationRepository; 
use App\Repository\UserRepositoryInterface; 
use App\Repository\Eloquent\UserRepository; 
use App\Repository\VaccineTypeRepositoryInterface; 
use App\Repository\Eloquent\VaccineTypeRepository; 

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(ApplicationRepositoryInterface::class, ApplicationRepository::class);
        $this->app->bind(VaccineRepositoryInterface::class, VaccineRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(VaccineTypeRepositoryInterface::class, VaccineTypeRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
