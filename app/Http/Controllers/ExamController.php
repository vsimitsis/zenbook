<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Http\Requests\ExamRequest;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('exams.index', [
            'exams'      => $this->fetchExams($request),
            'search'     => $request->search,
            'status'     => $request->status,
            'visibility' => $request->visibility,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('exams.create', [
            'exam' => new Exam(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        Exam::create([
            'company_id' => Auth::user()->company_id,
            'user_id'    => Auth::user()->id,
            'name'       => $this->renameIfExists($request),
            'status'     => $request->status,
            'visibility' => $request->visibility,
        ]);

        return redirect(route('exam.index'))
            ->with('success', __('messages.exam_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Exam $exam
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, Exam $exam)
    {
        return view('exams.show', [
            'exam'       => $exam,
            'sections'   => $this->fetchSections($request, $exam),
            'search'     => $request->search,
            'visibility' => $request->visibility,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        return view('exams.edit', [
            'exam' => $exam
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, Exam $exam)
    {
        $exam->name       = $this->renameIfExists($request, $exam);
        $exam->status     = $request->status;
        $exam->visibility = $request->visibility;
        $exam->save();

        return redirect(route('exam.index'))
            ->with('success', __('messages.changes_saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Exam $exam
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Exam $exam)
    {
        $this->authorize('destroy', $exam);

        if ($exam->delete()) {
            return redirect(route('exam.index'))
                ->with('success', __('messages.exam_deleted'));
        }

        return redirect(route('exam.index'))
            ->with('error', __('messages.exam_not_deleted'));
    }

    /**
     * Fetch company's exams and filter them
     *
     * @param Request $request
     * @return mixed
     */
    protected function fetchExams(Request $request)
    {
        $examQuery = Exam::where('company_id', Auth::user()->company_id);

        if ($request->search) {
            $examQuery = $examQuery->where('name', 'LIKE', '%' . $request->search . '%');
        }

        switch ($request->status) {
            case 'open':
                $examQuery = $examQuery->where('status', Exam::STATUS_OPEN);
                break;
            case 'closed':
                $examQuery = $examQuery->where('status', Exam::STATUS_CLOSED);
                break;
            default:
                break;
        }

        switch ($request->visibility) {
            case 'visible':
                $examQuery = $examQuery->where('visibility', Exam::VISIBLE);
                break;
            case 'hidden':
                $examQuery = $examQuery->where('visibility', Exam::HIDDEN);
                break;
            default:
                break;
        }

        return $examQuery->orderBy('name')->paginate(10);
    }

    /**
     * Fetch the exam's sections
     *
     * @param Request $request
     * @param Exam $exam
     * @return mixed
     */
    protected function fetchSections(Request $request, Exam $exam)
    {
        $sectionQuery = $exam->sections();

        if ($request->search) {
            $sectionQuery = $sectionQuery->where('name', 'LIKE', '%' . $request->search . '%');
        }

        switch ($request->visibility) {
            case 'visible':
                $sectionQuery = $sectionQuery->where('visibility', Section::VISIBLE);
                break;
            case 'hidden':
                $sectionQuery = $sectionQuery->where('visibility', Section::HIDDEN);
                break;
            default:
                break;
        }

        return $sectionQuery->paginate(10);
    }

    /**
     * Check if an exam with this name exists and rename it
     *
     * @param ExamRequest $request
     * @param Exam|null $exam
     * @return string
     */
    protected function renameIfExists(ExamRequest $request, Exam $exam = null) :string
    {
        $name       = $request->name;
        $countQuery = Auth::user()->company->exams()->where('name', $name);

        if ($exam) {
            $countQuery = $countQuery->where('id', '!=', $exam->id);
        }

        $count = $countQuery->count();

        if ($count) {
            $name .= "-$count";
        }

        return $name;
    }
}
