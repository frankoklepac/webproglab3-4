<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-4xl">
                    <h3 class="text-lg font-medium">Projects you created</h3>
                    @if(isset($ownedProjects) && $ownedProjects->isNotEmpty())
                        <ul class="mt-3 space-y-3">
                            @foreach($ownedProjects as $project)
                                <li class="rounded p-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="font-semibold">{{ $project->name }}</div>
                                        </div>
                                        <div class="text-sm text-gray-500">Members: {{ $project->members()->count() }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="mt-2 text-gray-600">You haven't created any projects yet.</div>
                    @endif
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-4xl">
                    <h3 class="text-lg font-medium">Projects you're a member of</h3>
                    @if(isset($memberProjects) && $memberProjects->isNotEmpty())
                        <ul class="mt-3 space-y-3">
                            @foreach($memberProjects as $project)
                                <li class="rounded p-3">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <div class="font-semibold">{{ $project->name }}</div>
                                        </div>
                                        <div class="text-sm text-gray-500">Members: {{ $project->members()->count() }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="mt-2 text-gray-600">You're not a member of any projects.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
