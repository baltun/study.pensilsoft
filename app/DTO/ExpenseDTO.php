<?php
declare(strict_types=1);

namespace App\DTO;

class ExpenseDTO
{
    public $sum;
    public $date;
    public $comment;

    public function fromRequest($request)
    {
        $this->sum = $request->sum ?? null;
        $this->date = $request->date ?? null;
        $this->comment = $request->comment ?? null;
    }

    public function toArray(): array
    {
        $arrayResult = [
            'sum' => $this->sum,
            'date' => $this->date,
            'comment' => $this->comment
        ];
        return $arrayResult;
    }
}
