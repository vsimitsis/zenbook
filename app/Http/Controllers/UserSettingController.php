<?php

namespace App\Http\Controllers;

use App\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserSettingController extends Controller
{
    /**
     * Updates the user's app language
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateLanguage(Request $request)
    {
        $user     = Auth::user();
        $settings = $user->settings;

        $this->validate($request, [
            'language' => [
                'required',
                'integer',
                Rule::in(Language::all()->pluck('id')->toArray())
            ]
        ]);

        $settings->language_id = $request->language;
        $settings->save();

        return redirect()->back();
    }
}
