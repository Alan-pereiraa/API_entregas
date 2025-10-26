<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\ClientRepositoryInterface;
use App\Repositories\ClientRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Aqui você diz ao Laravel: quando pedirem o contrato, entregue o repositório
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
