<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

/**
 * Class LanguageController
 *
 * @package App\Http\Controllers
 * @author Anitche Chisom
 */
class LanguageController extends Controller
{
    /**
     * Handle the incoming request to change language.
     *
     * @param Request $request
     * @return Application|ResponseFactory|RedirectResponse|Response
     */
    public function __invoke(Request $request)
    {
        // Validate form request...
        $data = $request->validate([
            'language' => ['required', 'string', Rule::in(['en', 'fr'])]
        ]);

        $request->session()->put('locale', $data['language']);

        app()->setLocale($request->session()->get('locale'));

        if ($request->wantsJson()) {
            return response([
                'message' => __('Language changed successfully')
            ]);
        }

        return redirect()->back();
    }
}
