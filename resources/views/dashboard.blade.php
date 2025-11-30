<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-black rounded-md">
                                Create Project
                            </a>
                        </div>
                    </div>

                    @if(empty($projects) || $projects->isEmpty())
                        <div class="text-gray-600">No projects found.</div>
                    @else
                        <div class="space-y-3">
                            @foreach($projects as $project)
                                <div class="border rounded p-4 flex justify-between items-start">
                                    <div>
                                        <div class="font-semibold text-lg">{{ $project->name }}</div>
                                        @if($project->description)
                                            <div class="text-sm text-gray-600 mt-1">{{ Str::limit($project->description, 140) }}</div>
                                        @endif
                                        <div class="text-xs text-gray-500 mt-2">Owner: {{ $project->owner->name ?? '—' }}</div>
                                    </div>

                                    <div class="flex flex-col items-end gap-2">
                                        <div class="text-sm text-gray-500">Members: {{ $project->members()->count() }}</div>


                                        <a href="{{ route('projects.update', ['project' => $project->id]) }}" class="inline-flex items-center px-3 py-1 bg-yellow-600 hover:bg-yellow-700 text-black rounded-md text-sm">Edit</a>
                                           
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
