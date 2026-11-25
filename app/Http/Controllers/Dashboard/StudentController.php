<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\AnimationClass;
use App\Models\ClassChapter;
use App\Models\UraanUrduClass;
use App\Models\UrduClassChapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class StudentController extends Controller
{
    public function studentPortal()
    {
        try {
            return view('dashboard.students.index');
        } catch (\Throwable $th) {
            // throw $th;
            Log::error("Student Portal View Failed:" . $th->getMessage());
            return redirect()->route('choose-portal')->with('error', "Something went wrong! Please try again later");
        }
    }

    public function studentVideos()
    {
        try {
            return view('dashboard.students.videos');
        } catch (\Throwable $th) {
            // throw $th;
            Log::error("Student Videos View Failed:" . $th->getMessage());
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }

    public function studentAudios(?int $grade = null)
    {
        try {
            if ($grade === null) {
                $grades = collect(range(1, 8))->map(function ($grade) {
                    return (object) [
                        'name' => "Grade {$grade}",
                        'slug' => (string) $grade,
                    ];
                });

                return view('dashboard.students.resource-classes', [
                    'classes' => $grades,
                    'heading' => 'URDU AUDIOS',
                    'routeName' => 'student.audios.grade',
                    'routeParameter' => 'grade',
                    'resourceLabel' => 'audio books',
                ]);
            }

            abort_unless($grade >= 1 && $grade <= 8, 404);

            return view('dashboard.students.audios', compact('grade'));
        } catch (\Throwable $th) {
            // throw $th;
            Log::error("Student Audios View Failed:" . $th->getMessage());
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }

    public function studentAnimations(?string $classSlug = null)
    {
        try {
            if ($classSlug === null) {
                return view('dashboard.students.resource-classes', [
                    'classes' => AnimationClass::all(),
                    'heading' => 'Digital Discovery Animations',
                    'routeName' => 'student.animations.class',
                    'routeParameter' => 'class',
                    'resourceLabel' => 'resources',
                ]);
            }

            $animationClass = AnimationClass::with('classChapters')->where('slug', $classSlug)->firstOrFail();
            $animationClasses = collect([$animationClass]);

            return view('dashboard.students.animation', compact('animationClasses'));
        } catch (\Throwable $th) {
            // throw $th;
            Log::error("Student Animations View Failed:" . $th->getMessage());
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }
    public function chapterDetails($classSlug, $chapterSlug)
    {
        try {
            $animationClass = AnimationClass::where('slug', $classSlug)->first();
            $classChapter = ClassChapter::with('chapterContents')->where('slug', $chapterSlug)->where('class_id', $animationClass->id)->first();
            return view('dashboard.students.chapter-details', compact('classChapter'));
        } catch (\Throwable $th) {
            // throw $th;
            Log::error("Student Animations View Failed:" . $th->getMessage());
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }

    public function preview(Request $request)
    {
        $file = $request->file; // swf path

        return view('dashboard.students.animation-preview', compact('file'));
    }

    public function uraanUrduSeries(?string $classSlug = null)
    {
        try {
            if ($classSlug === null) {
                return view('dashboard.students.resource-classes', [
                    'classes' => UraanUrduClass::all(),
                    'heading' => 'Uraan Urdu Series Worksheets',
                    'routeName' => 'student.uraan-urdu-series.class',
                    'routeParameter' => 'class',
                    'resourceLabel' => 'resources',
                ]);
            }

            $urduClass = UraanUrduClass::with('classChapters')->where('slug', $classSlug)->firstOrFail();
            $urduClasses = collect([$urduClass]);

            return view('dashboard.students.uraan-urdu-series', compact('urduClasses'));
        } catch (\Throwable $th) {
            // throw $th;
            Log::error("Student Uraan Urdu Series View Failed:" . $th->getMessage());
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }

    public function urduChapterDetails($classSlug, $chapterSlug)
    {
        try {
            $urduClass = UraanUrduClass::where('slug', $classSlug)->first();
            $classChapter = UrduClassChapter::with('chapterContents')->where('slug', $chapterSlug)->where('urdu_class_id', $urduClass->id)->first();
            return view('dashboard.students.urdu-chapter-details', compact('classChapter'));
        } catch (\Throwable $th) {
            // throw $th;
            Log::error("Student Uraan Urdu Series View Failed:" . $th->getMessage());
            return redirect()->back()->with('error', "Something went wrong! Please try again later");
        }
    }

    public function urduPreview(Request $request)
    {
        $file = $request->file; // swf path

        return view('dashboard.students.urdu-preview', compact('file'));
    }

    public function library(){
        $books = Auth::guard('student')->user()->books()->with('author')->get();
        return view('dashboard.students.student-library', ['books' => $books]);
    }
}
