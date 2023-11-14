<div>
    @if (!empty($successMessage))
        <div class="alert alert-success" id="success-alert">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $successMessage }}
        </div>
    @endif

    @if ($catchError)
        <div class="alert alert-danger" id="success-danger">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ $catchError }}
        </div>
    @endif

    @if (session()->has('add'))
        <div class="alert alert-success">
            {{ session('add') }}
        </div>
    @endif
    @if ($show_table == true)
        @include('livewire.Parent_Table')
    @else
        <button class="btn btn-danger btn-sm nextBtn btn-lg pull-right" type="button"
            wire:click="backtoTable">{{ trans('Parent_trans.Back') }}</button>
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step">
                    <a href="#step-1" type="button"
                        class="btn btn-circle {{ $currentStep != 1 ? 'btn-default' : 'btn-success' }}">1</a>
                    <p>{{ trans('Parent_trans.Step1') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-2" type="button"
                        class="btn btn-circle {{ $currentStep != 2 ? 'btn-default' : 'btn-success' }}">2</a>
                    <p>{{ trans('Parent_trans.Step2') }}</p>
                </div>
                <div class="stepwizard-step">
                    <a href="#step-3" type="button"
                        class="btn btn-circle {{ $currentStep != 3 ? 'btn-default' : 'btn-success' }}"
                        disabled="disabled">3</a>
                    <p>{{ trans('Parent_trans.Step3') }}</p>
                </div>
            </div>
        </div>
        <div>

            <div>
                @include('livewire.Father_Form')
            </div>
            <div>
                @include('livewire.Mother_Form')

            </div>
            <div>
                @include('livewire.save')
            </div>
        </div>
    @endif
