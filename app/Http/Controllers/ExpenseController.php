<?php

namespace App\Http\Controllers;

use App\DTO\ExpenseDTO;
use App\Http\Requests\ExpenseRequest;
use App\Http\Resources\ExpenseCollectionResource;
use App\Http\Resources\ExpenseResource;
use App\Services\ExpenseService;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Collection;

class ExpenseController extends Controller
{
    public function __construct(
        protected ExpenseService $expenseService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = $this->expenseService->getAll();

        return ExpenseCollectionResource::make($positions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExpenseRequest $request, ExpenseDTO $expenseDTO)
    {
        $expenseDTO->fromRequest($request);
        $result = $this->expenseService->create($expenseDTO);
        if ($result) {
            $responseData = [
                'success' => 'true',
                'notification' => [
                    'title' => 'Позиция добавлена',
                    'type' => 'success',
                ]
            ];
        } else {
            $responseData = [
                'success' => 'false',
                'notification' => [
                    'error' => 'Ошибка добавления позиции',
                ]
            ];
        }
        return $responseData;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): ExpenseResource
    {
        $position = $this->expenseService->getById($id);

        return ExpenseResource::make($position);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ExpenseRequest $request, string $id, ExpenseDTO $expenseDTO)
    {
        $expenseDTO->fromRequest($request);
        $result = $this->expenseService->editById($id, $expenseDTO);

        if ($result) {
            $responseData = [
                'success' => 'true',
                'notification' => [
                    'title' => 'Изменения сохранены',
                    'type' => 'success',
                ]
            ];
        } else {
            $responseData = [
                'success' => 'false',
                'notification' => [
                    'error' => 'Ошибка редактирования позиции - запись не найдена',
                ]
            ];
        }

        return $responseData;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $result = $this->expenseService->destroyById($id);

        if ($result) {
            $responseData = [
                'success' => 'true',
                'notification' => [
                    'title' => 'Позиция удалена',
                    'type' => 'success',
                ]
            ];
        } else {
            $responseData = [
                'success' => 'false',
                'notification' => [
                    'error' => 'Запись с таким ID не найдена',
                ]
            ];
        }

        return $responseData;
    }
}
