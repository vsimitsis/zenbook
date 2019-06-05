<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRequest;
use App\Module;
use App\ModuleType;
use App\Section;
use App\Traits\ExaminableModules;
use App\Traits\ParentClass;

class ModuleController extends Controller
{
    use ParentClass, ExaminableModules;

    /**
     * Show the form for creating a new module.
     *
     * @param string $parent_type
     * @param int $parent_id
     * @param Section $section
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(string $parent_type, int $parent_id, Section $section)
    {
        $parentModel = $this->getParentClass($parent_type, $parent_id);

        return view('modules.create', [
            'module'      => new Module(),
            'section'     => $section,
            'parentModel' => $parentModel,
            'moduleTypes' => ModuleType::all(),
            'choices'     => collect(),
        ]);
    }

    /**
     * Store a newly created module in storage.
     *
     * @param ModuleRequest $request
     * @param Section $section
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(ModuleRequest $request, Section $section)
    {
        $examinable  = $this->createExaminableModel($request);
        $parentModel = $section->parent;
        $moduleType  = ModuleType::where('type', $request->module_type)->first();

        Module::create([
            'name'            => $request->name,
            'section_id'      => $section->id,
            'module_type_id'  => $moduleType->id,
            'examinable_type' => $moduleType->type,
            'examinable_id'   => $examinable->id,
            'visibility'      => $request->visibility,
        ]);

        return redirect(route('section.show', [
            'parent_type' => $parentModel->getModelUrlName(),
            'parent_id' => $parentModel->id,
            'section' => $section
        ]))->with('success', __('messages.module_created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $parent_type
     * @param int $parent_id
     * @param Section $section
     * @param Module $module
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $parent_type, int $parent_id, Section $section, Module $module)
    {
        $parentModel = $this->getParentClass($parent_type, $parent_id);

        return view('modules.edit', [
            'module'      => $module,
            'section'     => $section,
            'parentModel' => $parentModel,
            'moduleTypes' => ModuleType::all(),
            'choices'     => $this->fetchChoices($module),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ModuleRequest $request
     * @param Module $module
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(ModuleRequest $request, Module $module)
    {
        if ($this->updateExaminableModel($request, $module)) {
            return redirect(route('section.show', [
                'parent_type' => $module->section->parent->getModelUrlName(),
                'parent_id' => $module->section->parent->id,
                'section' => $module->section
            ]))->with('success', __('messages.changes_saved'));
        }

        return redirect(route('section.show', [
            'parent_type' => $module->section->parent->getModelUrlName(),
            'parent_id' => $module->section->parent->id,
            'section' => $module->section
        ]))->with('success', __('messages.changes_not_saved'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Module $module
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
    public function destroy(Module $module)
    {
        $section         = $module->section;
        $parentModel     = $section->parent;

        if ($module->examinable->delete() && $module->delete()) {
            return redirect(route('section.show', [
                'parent_type' => $parentModel->getModelUrlName(),
                'parent_id' => $parentModel->id,
                'section' => $section
            ]))->with('success', __('messages.module_deleted'));
        }

        return redirect(route('section.show', [
            'parent_type' => $parentModel->getModelUrlName(),
            'parent_id' => $parentModel->id,
            'section' => $section
        ]))->with('success', __('messages.module_not_deleted'));
    }

    /**
     * Fetch all the multiple choice module choices
     *
     * @param Module $module
     * @return \Illuminate\Support\Collection
     */
    protected function fetchChoices(Module $module)
    {
        if ($module->examinable_type === 'App\\MultipleChoice') {
            return $module->examinable->choices;
        }

        return collect();
    }
}
