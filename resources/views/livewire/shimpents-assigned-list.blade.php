<div>
    <p>Counter: <span class={{$count >= 5000 ? "red" : ""}}>{{$count}} </span></p>
    <button wire:click="increment">Up</button>
    <button wire:click="decrement">Down</button>
    <input name="amount" wire:blur="validateAmount" wire:model.live.debounce="amount" type="number" min="1">
    <p>Amount is: {{$amount}}</p>
    <p class="red">{{$errorMessage}}</p>
    <style>
        .red  {color: red}
    </style>
</div>
