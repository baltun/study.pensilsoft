<?php
declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class AbstractRepository
{
    protected function fallIfRecordExists(Model $model, $dto)
    {
        $existingExpenseModelQuery = $model->query();

        $expenseDTOProperties = get_object_vars($dto);
        foreach ($expenseDTOProperties as $expenseDTOPropertyKey => $expenseDTOPropertyValue) {
            $existingExpenseModelQuery = $existingExpenseModelQuery->where($expenseDTOPropertyKey, $expenseDTOPropertyValue);
        }
        $existingExpenseModel = $existingExpenseModelQuery->first();
//        dd($existingExpenseModel);
        if ($existingExpenseModel) {
            throw new \LogicException('Запись уже существует');
        }
    }
}
