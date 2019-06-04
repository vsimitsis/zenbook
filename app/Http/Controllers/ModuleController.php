<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModuleRequest;
use App\Module;
use App\ModuleType;
use App\Section;
use App\Traits\ParentClass;
use Illuminate\Http\Request;

class ModuleController extends Controller
{
    use ParentClass;

    /**
     * Show the form for creating a new module.
     *
     * @param string $parent_type
     * @param int $parent_id
     * @param Section $section
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModuleRequest $request)
    {
        dd($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function show(Module $module)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function edit(Module $module)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Module $module)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Module  $module
     * @return \Illuminate\Http\Response
     */
    public function destroy(Module $module)
    {
        //
    }
}
