<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create Project</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('projects.store') }}">
                        @csrf

                        <div class="mb-4">
                            <label class="block mb-1">Name</label>
                            <input name="name" value="{{ old('name') }}" class="w-full border rounded px-3 py-2" required>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1">Description</label>
                            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1">Price</label>
                            <input name="price" value="{{ old('price') }}" class="w-full border rounded px-3 py-2" />
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1">Start Date</label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}" class="border rounded px-3 py-2" />
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1">End Date</label>
                            <input type="date" name="end_date" value="{{ old('end_date') }}" class="border rounded px-3 py-2" />
                        </div>

                        <div class="mb-4">
                            <label class="block mb-1">Team Members (select multiple)</label>
                            <select name="members[]" multiple class="w-full border rounded px-3 py-2">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            <p class="text-sm text-gray-600 mt-1">The project owner (you) will be set automatically.</p>
                        </div>

                        <div class="flex items-center gap-3">
                            <button class="bg-blue-600 text-black px-4 py-2 rounded">Create</button>
                            <a href="{{ route('dashboard') }}" class="text-black-600">Cancel</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
