<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['firewall'])->group(function() {
    Route::get('/', 'DashboardController')->name('dashboard');
    Route::post('/sort', 'SortController@save')->name('sort.save');
    Route::resource('profile', 'ProfileController')->only(['index', 'edit', 'update']);
    Route::resource('top', 'TopController')->only(['index', 'edit', 'update']);
    Route::resource('archive', 'ArchiveController')->only(['index', 'edit', 'update']);
    Route::resource('blog', 'BlogController')->except('show');
    Route::resource('readingNote', 'ReadingNoteController');
    Route::resource('tags', 'TagController')->except('show');
    Route::resource('series', 'SeriesController');
    Route::resource('references', 'ReferenceController')->except('show');
    Route::resource('latexbooks', 'LaTeXbookController');
    Route::resource('subjects', 'SubjectController');
    Route::resource('subjects.learningUnits', 'LearningUnitController')->except(['index', 'create', 'edit']);
    Route::resource('subjects.learningUnits.clearnotes', 'ClearnoteController')->except(['index', 'show']);
});
