<?php
use \App\Models\Project;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();

    $projects = Project::where('user_id', $user->id)
        ->orWhereHas('members', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
        ->latest()
        ->get();

    return view('dashboard', compact('projects'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}/update', [ProjectController::class, 'update'])->name('projects.update');
    Route::post('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
});

require __DIR__.'/auth.php';
