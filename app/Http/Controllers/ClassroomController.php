<?php

namespace App\Http\Controllers;

use App\Classroom;
use App\Http\Requests\ClassroomRequest;
use App\Traits\UniqueNames;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassroomController extends Controller
{
    use UniqueNames;

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        return view('classrooms.index', [
            'classrooms' => $this->fetchClassrooms($request),
            'search'     => $request->search
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('classrooms.create', [
            'classroom' => new Classroom(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ClassroomRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(ClassroomRequest $request)
    {
        $this->authorize('create', Classroom::class);

        Classroom::create([
            'company_id' => Auth::user()->company->id,
            'name'       => $this->renameIfExists($request, new Classroom()),
        ]);

        return redirect(route('classroom.index'))
            ->with('success', __('messages.classroom_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Classroom $classroom
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Classroom $classroom)
    {
        return view('classrooms.edit', [
            'classroom' => $classroom
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ClassroomRequest $request
     * @param Classroom $classroom
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ClassroomRequest $request, Classroom $classroom)
    {
        $classroom->name = $this->renameIfExists($request, $classroom);
        $classroom->save();

        return redirect(route('classroom.index', $classroom))
            ->with('success', __('messages.changes_saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Classroom $classroom
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Classroom $classroom)
    {
        if ($classroom->delete()) {
            return redirect(route('classroom.index', $classroom))
                ->with('success', __('messages.classroom_deleted'));
        }

        return redirect(route('classroom.index', $classroom))
            ->with('success', __('messages.classroom_not_deleted'));
    }

    /**
     * Fetch the classrooms
     *
     * @param Request $request
     * @return mixed
     */
    protected function fetchClassrooms(Request $request)
    {
        $classroomQuery = Auth::user()->company->classrooms();

        if ($request->search) {
            $classroomQuery = $classroomQuery->where('name', 'LIKE', '%' . $request->search . '%');
        }

        return $classroomQuery->paginate(10);
    }
}
