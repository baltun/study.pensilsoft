<?php
declare(strict_types=1);

namespace App\Services;

use App\Contracts\ExpenseRepositoryContract;
use App\DTO\ExpenseDTO;
use App\Models\ExpenseModel;
use Illuminate\Support\Collection;

/**
 * сервис позволяет писать бизнес-логику не привязываясь к другим слоям
 */
class ExpenseService
{
    public function __construct(
        protected ExpenseRepositoryContract $expenseRepository,
        protected ExpenseDTO $expenseDTO
    )
    {
    }

    public function getAll(): Collection
    {
        $expensesCollection = $this->expenseRepository->getAll();

        // преобразуем сумму во всей коллекции к реальному числу
        foreach ($expensesCollection as $expense) {
            $expense->sum /= 100;
        }



        return $expensesCollection;
    }

    public function create(ExpenseDTO $expenseDTO): bool
    {
        $expenseDTO->sum *= 100; // преобразуем в int для сохранения

        $result = $this->expenseRepository->create($expenseDTO);

        return $result;
    }

    public function getById($id): ExpenseModel
    {
        $expense = $this->expenseRepository->getById($id);
        $expense->sum /= 100; // преобразуем сохраненную в int сумму к реальной

        return $expense;
    }

    public function editById(int $id, ExpenseDTO $expenseDTO)
    {
        $expenseDTO->sum *= 100; // преобразуем в int для сохранения
        $result = $this->expenseRepository->editById($id, $expenseDTO);

        return $result;
    }

    public function destroyById(int $id)
    {
        $result = $this->expenseRepository->destroyById($id);

        return $result;
    }
}
