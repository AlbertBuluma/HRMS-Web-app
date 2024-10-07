<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('List of Company Staff') }}
        </h2>
    </x-slot>

    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{--                        <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">--}}
            <div class="max-w-xl">
                <div class="py-2">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('staff.create') }}">
                            <x-primary-button>{{ __('Create Staff') }}</x-primary-button>
                        </a>
                    </div>
                </div>
            </div>
            {{--                        </div>--}}
            <!-- Table responsive wrapper -->
            {{--            <div class="overflow-hidden min-w-full">--}}
            <div class="overflow-hidden w-auto">
                <table class="table-fixed text-left text-sm font-light text-surface ">
                    <thead
                        class="border-b border-neutral-200 font-medium">
                    <tr>
                        <th scope="col" class="px-6 py-4">Staff ID</th>
                        <th scope="col" class="px-6 py-4">Surname</th>
                        <th scope="col" class="px-6 py-4">Other Names</th>
                        <th scope="col" class="px-6 py-4">Date of Birth</th>
                        <th scope="col" class="px-6 py-4">ID Photo (Base 64 Encoded)</th>
                        <th scope="col" class="px-6 py-4">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($staff_list['data'] as $staff)
                        <tr class="border-b border-neutral-200 transition duration-300 ease-in-out">
                            <td class="whitespace-nowrap px-6 py-4 font-medium">{{ $staff['staff_id'] }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $staff['attributes']['surname'] }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $staff['attributes']['other_name'] }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $staff['attributes']['date_of_birth'] }}</td>
                            <td class="whitespace-nowrap px-6 py-4">{{ substr($staff['attributes']['id_photo'], 45) }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="max-w-xl">
                                    <div class="py-2">
                                        <div class="flex items-center gap-4">
                                            <a href="{{ route('staff.edit', $staff['staff_id']) }}">
                                                <x-primary-button>{{ __('EDIT') }}</x-primary-button>
                                            </a>
                                            <a href="{{ route('staff.destroy', $staff['staff_id']) }}">
                                                <x-primary-button>{{ __('DELETE') }}</x-primary-button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr class="border-b border-neutral-200 transition duration-300 ease-in-out">
                            <td class="whitespace-nowrap px-6 py-4">No data available</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

