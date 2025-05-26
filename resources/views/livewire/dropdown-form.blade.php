<div class=""><!-- Bootstrap row container -->

    <div class="col-md-6">
        <label for="option">Select an option:</label>
        <select wire:model="selectedOption" name="selected_option" id="option" class="form-control">
            <option value="">-- Choose --</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
        </select>
    </div>

    @if ($selectedOption == 1)
        <div class="col-md-6">
            <label for="hiInput">Hi:</label>
            <input type="text" id="hiInput" wire:model="hiInput" class="form-control">
            <input type="hidden" name="hi_input" value="{{ $hiInput }}">
        </div>
    @elseif ($selectedOption == 2)
        <div class="col-md-6">
            <label for="helloInput">Hello:</label>
            <input type="text" id="helloInput" wire:model="helloInput" class="form-control">
            <input type="hidden" name="hello_input" value="{{ $helloInput }}">
        </div>
    @endif

</div>
