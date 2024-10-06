<x-app-layout>
    <section>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __("Update Staff's profile information") }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Edit '. $staff['attributes']['surname'].'\'s' .' details') }}
                            </p>
                        </header>
                        <form method="post" action="{{ route('staff.update', $staff['staff_id']) }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div>
                                <x-input-label for="name" :value="__('Surname')"/>
                                <x-text-input id="surname" name="surname" type="text" class="mt-1 block w-full"
                                              :value="old('surname', $staff['attributes']['surname'])" required autofocus
                                              autocomplete="surname"/>
                                <x-input-error class="mt-2" :messages="$errors->get('surname')"/>
                            </div>

                            <div>
                                <x-input-label for="other_name" :value="__('Other Names')"/>
                                <x-text-input id="other_name" name="other_name" type="text" class="mt-1 block w-full"
                                              :value="old('other_name', $staff['attributes']['other_name'])" required
                                              autofocus autocomplete="other_name"/>
                                <x-input-error class="mt-2" :messages="$errors->get('other_name')"/>
                            </div>

                            <div>
                                <x-input-label for="date_of_birth" :value="__('Date of Birth')"/>
                                <x-text-input id="date_of_birth" name="date_of_birth" type="date"
                                              class="mt-1 block w-full"
                                              :value="old('date_of_birth', $staff['attributes']['date_of_birth'])"
                                              required autofocus autocomplete="date_of_birth"/>
                                <x-input-error class="mt-2" :messages="$errors->get('date_of_birth')"/>
                            </div>
                            <div>
                                <x-input-label for="id_photo" :value="__('Staff Photo')"/>
                                <x-text-input id="id_photo" name="id_photo" type="file"
                                              class="mt-1 block w-full" :value="old('id_photo', $staff['attributes']['id_photo'])" autofocus autocomplete="id_photo"/>
                                <x-input-error class="mt-2" :messages="$errors->get('id_photo')"/>
                            </div>


                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                                {{--            @if (session('status') === 'profile-updated')--}}
                                {{--                <p--}}
                                {{--                    x-data="{ show: true }"--}}
                                {{--                    x-show="show"--}}
                                {{--                    x-transition--}}
                                {{--                    x-init="setTimeout(() => show = false, 2000)"--}}
                                {{--                    class="text-sm text-gray-600"--}}
                                {{--                >{{ __('Saved.') }}</p>--}}
                                {{--            @endif--}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>


