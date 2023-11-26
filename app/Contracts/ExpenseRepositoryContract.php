<?php

namespace App\Contracts;

use App\DTO\ExpenseDTO;
use App\Models\ExpenseModel;
use Illuminate\Support\Collection;

interface ExpenseRepositoryContract
{
    public function getAll(): Collection;

    public function create(ExpenseDTO $expenseDTO);

    public function getById(int $id): ExpenseModel;

    public function editById(int $id, ExpenseDTO $expenseDTO);

    public function destroyById(int $id);
}
