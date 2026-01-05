<?php

namespace App\Livewire;

use Livewire\Component;

class ShipmentsAssignedList extends Component
{
    public int $count = 0;
    public int $amount = 1;
    public string $errorMessage = "";
    public function render()
    {
        return view('livewire.shimpents-assigned-list');
    }

    public function increment(): void
    {
        $this->count+= $this->amount;
        $this->errorMessage = "";
    }
    public function decrement()
    {
        $result = $this->count - $this->amount;
        if($result > 0)
        {
            $this->count-= $this->amount;
        } else
        {
            $this->errorMessage = 'Invalid math operation, you cannot do this!';
        }
    }

    public function validateAmount()
    {
       $this->amount < 1 ? $this->errorMessage = "Amount cannot be smaller then 1" : "";
    }
}
