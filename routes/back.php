<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\LearningUnit;
use App\Models\Clearnote;
use App\Models\latexbook;

Route::middleware(['firewall'])->group(function() {
    Route::get('/', 'DashboardController')->name('dashboard');

    Route::post('/sortUpdate', function() {

        try {
            $json = file_get_contents('php://input');
            $data = json_decode($json, true);

            foreach ($data as $position => $item) {
                if (preg_match('/subject([0-9]+)/', $item, $matches)) {
                    $id = (int)$matches[1];
                    $subject = Subject::where('id', $id)->first();
                    $subject->position = $position;
                    $subject->save();
                } elseif (preg_match('/unit([0-9]+)/', $item, $matches)) {
                    $id = (int)$matches[1];
                    $unit = LearningUnit::where('id', $id)->first();
                    $unit->position = $position;
                    $unit->save();
                } elseif (preg_match('/note([0-9]+)/', $item, $matches)) {
                    $id = (int)$matches[1];
                    $note = Clearnote::where('id', $id)->first();
                    $note->position = $position;
                    $note->save();
                } elseif (preg_match('/latexbook([0-9]+)/', $item, $matches)) {
                    $id = (int)$matches[1];
                    $book = latexbook::where('id', $id)->first();
                    $book->position = $position;
                    $book->save();
                }
            }

            return back()->with('message', '並び順を保存しました！');

        } catch(Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    });

    Route::resource('profile', 'ProfileController')->only(['index', 'edit', 'update']);
    Route::resource('top', 'TopController')->only(['index', 'edit', 'update']);
    Route::resource('archive', 'ArchiveController')->only(['index', 'edit', 'update']);
    Route::resource('blog', 'BlogController')->except('show');
    Route::resource('readingNote', 'ReadingNoteController');
    Route::resource('tags', 'TagController')->except('show');
    Route::resource('latexbooks', 'LaTeXBookController');
    Route::resource('subjects', 'SubjectController');
    Route::resource('subjects.learningUnits', 'LearningUnitController')->except(['index', 'create', 'edit']);
    Route::resource('subjects.learningUnits.clearnotes', 'ClearnoteController')->except(['index', 'show']);
});
