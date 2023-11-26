<?php
declare(strict_types=1);

namespace App\Repositories;

use App\Contracts\ExpenseRepositoryContract;
use App\DTO\ExpenseDTO;
use App\Models\ExpenseModel;
use Illuminate\Support\Collection;

class ExpenseRepository extends AbstractRepository implements ExpenseRepositoryContract
{
    public function getAll(): Collection
    {
        $expensesCollection = ExpenseModel::all();

        return $expensesCollection;
    }

    public function create(ExpenseDTO $expenseDTO)
    {
        // проверяем, нет ли уже такого объекта, и если есть - выбрасываем исключение
        $this->fallIfRecordExists(new ExpenseModel(), $expenseDTO);

        $expenseModel = ExpenseModel::create($expenseDTO->toArray());
        $result = $expenseModel->save();

        return $result;
    }


    public function getById(int $id): ExpenseModel
    {
        $expenseModel = ExpenseModel::find($id);
        return $expenseModel;
    }

    public function editById(int $id, ExpenseDTO $expenseDTO)
    {
        $expenseModel = ExpenseModel::find($id);
        if (!$expenseModel) {
            return false;
        }
        $expenseModel->update($expenseDTO->toArray());
        $result = $expenseModel->save();

        return $result;
    }

    public function destroyById(int $id)
    {
        $result = ExpenseModel::destroy([$id]);

        return (bool)$result;
    }

}
