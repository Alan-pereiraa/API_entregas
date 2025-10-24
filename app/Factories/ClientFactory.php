<?php

namespace App\Factories;
use App\Contracts\ClientRepositoryInterface;
use App\Models\Cliente;

class ClientFactory
{
    protected $repository;

    public function __construct(ClientRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function create(array $data): Cliente
    {
        $clienteType = $data["tipo"];

        switch ($clienteType) {
            case 'pessoa':
                return $this->repository->createClientPessoa($data);
                break;
            case 'empresa':
                return $this->repository->createClientEmpresa($data);
                break;
            default:
                throw new \Exception('Esse tipo de cliente não existe.');
                break;
        }
    }
}