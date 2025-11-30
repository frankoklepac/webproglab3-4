<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Project</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(session('success'))
                        <div class="mb-4 text-green-600">{{ session('success') }}</div>
                    @endif

                    @if($project->isOwner(auth()->user()))
                        <form method="POST" action="{{ route('projects.edit', ['project' => $project->id]) }}">
                            @csrf

                            <div class="mb-4">
                                <label class="block mb-1">Name</label>
                                <input name="name" value="{{ old('name', $project->name) }}" class="w-full border rounded px-3 py-2" required>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1">Description</label>
                                <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description', $project->description) }}</textarea>
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1">Price</label>
                                <input name="price" value="{{ old('price', $project->price) }}" class="w-full border rounded px-3 py-2" />
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1">Start Date</label>
                                <input type="date" name="start_date" value="{{ old('start_date', $project->start_date) }}" class="border rounded px-3 py-2" />
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1">End Date</label>
                                <input type="date" name="end_date" value="{{ old('end_date', $project->end_date) }}" class="border rounded px-3 py-2" />
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1">Completed Projects</label>
                                <input name="completed_projects" value="{{ old('completed_projects', $project->completed_projects) }}" class="w-full border rounded px-3 py-2" />
                            </div>

                            <div class="mb-4">
                                <label class="block mb-1">Team Members (select multiple)</label>
                                <select name="members[]" multiple class="w-full border rounded px-3 py-2">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $project->members->contains($user->id) ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex items-center gap-3">
                                <button class="bg-blue-600 text-black px-4 py-2 rounded">Save</button>
                                <a href="{{ route('dashboard') }}" class="text-gray-600">Cancel</a>
                            </div>
                        </form>
                    @elseif($project->isMember(auth()->user()))
                        <form method="POST" action="{{ route('projects.edit', ['project' => $project->id]) }}">
                            @csrf

                            <div class="mb-4">
                                <label class="block mb-1">Completed Projects</label>
                                <input name="completed_projects" value="{{ old('completed_projects', $project->completed_projects) }}" class="w-full border rounded px-3 py-2" />
                            </div>

                            <div class="flex items-center gap-3">
                                <button class="bg-blue-600 text-black px-4 py-2 rounded">Save</button>
                                <a href="{{ route('dashboard') }}" class="text-gray-600">Cancel</a>
                            </div>
                        </form>
                    @else
                        <div class="text-red-600">You are not authorized to edit this project.</div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
