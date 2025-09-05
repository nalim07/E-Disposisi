<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your employee information.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        @if($employee)
        <div>
            <x-input-label for="employee_fullname" :value="__('Employee Name')" />
            <x-text-input id="employee_fullname" name="employee_fullname" type="text" class="mt-1 block w-full" :value="old('employee_fullname', $employee->fullname)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('employee_fullname')" />
        </div>

        <div>
            <x-input-label for="employee_email" :value="__('Employee Email')" />
            <x-text-input id="employee_email" name="employee_email" type="email" class="mt-1 block w-full" :value="old('employee_email', $employee->email)" required autocomplete="email" />
            <x-input-error class="mt-2" :messages="$errors->get('employee_email')" />
        </div>
        @else
        <div class="text-center text-gray-500">
            <p>No employee record found for this user.</p>
        </div>
        @endif

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
