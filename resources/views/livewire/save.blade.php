@if ($currentStep == 3)

    <div class="container">
        <label for="Product Name">Product photos (can attach more than one):</label>
        <br />
        <input type="file" class="form-control" accept="image/*" wire:model.blur="attachments" multiple />
        @error('file')
            <span class="error">{{ $message }}</span>
        @enderror
        <br /><br />
    </div>
    <div class="row setup-content {{ $currentStep != 3 ? 'displayNone' : '' }}" id="step-3">
        @if ($currentStep != 3)
            <div style="display: none" class="row setup-content" id="step-3">
        @endif
        <div class="col-xs-12">
            <div class="col-md-12">
                <h3 style="font-family: 'Cairo', sans-serif;">{{ trans('Parent_trans.sure') }}</h3><br>
                <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
                    wire:click="back(2)">{{ trans('Parent_trans.Back') }}</button>
                @if ($x == true)
                    <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitForm"
                        type="button">{{ trans('Parent_trans.Finish') }}</button>
                @else
                    <input type="hidden" wire:model.blur="id">
                    <button class="btn btn-success btn-sm btn-lg pull-right" wire:click="submitEditForm"
                        type="button">{{ trans('Parent_trans.Finish') }}</button>
                @endif
            </div>
        </div>
    </div>
    </div>
@endif
