<?php

namespace App\Contracts;

interface ClientRepositoryInterface
{
    public function createClientPessoa(array $data);
    public function createClientEmpresa(array $data);
    public function update(string $id, array $data);
    public function find(string $id);
    public function destroy(string $id);
}