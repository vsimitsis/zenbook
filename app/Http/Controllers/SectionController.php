<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionRequest;
use App\Section;
use App\Traits\ParentClass;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    use ParentClass;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(string $parent_type, int $parent_id)
    {
        $parentModel = $this->getParentClass($parent_type, $parent_id);

        return view('sections.create', [
            'section'      => new Section(),
            'parentModel'  => $parentModel,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SectionRequest $request
     * @param string $parent_type
     * @param int $parent_id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(SectionRequest $request, string $parent_type, int $parent_id)
    {
        $parent = $this->getParentClass($parent_type, $parent_id);

        Section::create([
            'parent_type' => get_class($parent),
            'parent_id'   => $parent->id,
            'name'        => $request->name,
            'description' => $request->description,
            'visibility'  => $request->visibility
        ]);

        return redirect(route($parent->getModelName() . '.show', $parent))
            ->with('success', __('messages.section_created'));
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param string $parent_type
     * @param int $parent_id
     * @param Section $section
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Request $request, string $parent_type, int $parent_id, Section $section)
    {
        return view('sections.show', [
            'section'     => $section,
            'modules'     => $this->fetchModules($request, $section),
            'parentModel' => $this->getParentClass($parent_type, $parent_id),
            'search'      => $request->search,
            'visibility'  => $request->visibility,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $parent_type
     * @param int $parent_id
     * @param Section $section
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $parent_type, int $parent_id, Section $section)
    {
        return view('sections.edit', [
            'section'     => $section,
            'parentModel' => $this->getParentClass($parent_type, $parent_id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SectionRequest $request
     * @param string $parent_type
     * @param int $parent_id
     * @param Section $section
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(SectionRequest $request, string $parent_type, int $parent_id, Section $section)
    {
        $parentModel = $this->getParentClass($parent_type, $parent_id);

        $section->name        = $request->name;
        $section->description = $request->description;
        $section->visibility  = $request->visibility;
        $section->save();

        return redirect(route($parentModel->getModelName() . '.show', [$parentModel]))
            ->with('success', __('messages.section_updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Section $section
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Section $section)
    {
        $parent = $section->parent;

        if ($section->delete()) {
            return redirect(route($parent->getModelName() . '.show', $section->parent))
                ->with('success', __('messages.section_deleted'));
        }

        return redirect(route($parent->getModelName() . '.show', $section->parent))
            ->with('error', __('messages.section_not_deleted'));
    }

    /**
     * Fetch the exam's sections
     *
     * @param Request $request
     * @param Section $section
     * @return mixed
     */
    protected function fetchModules(Request $request, Section $section)
    {
        $moduleQuery = $section->modules();

        if ($request->search) {
            $moduleQuery = $moduleQuery->where('name', 'LIKE', '%' . $request->search . '%');
        }

        switch ($request->visibility) {
            case 'visible':
                $moduleQuery = $moduleQuery->where('visibility', Section::VISIBLE);
                break;
            case 'hidden':
                $moduleQuery = $moduleQuery->where('visibility', Section::HIDDEN);
                break;
            default:
                break;
        }

        return $moduleQuery->paginate(10);
    }
}
