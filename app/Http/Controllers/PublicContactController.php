<?php

namespace App\Http\Controllers;

use App\Models\ContactPageSetting;
use Illuminate\View\View;

class PublicContactController extends Controller
{
    public function __invoke(): View
    {
        return view('pages.contact', [
            'contactSettings' => ContactPageSetting::current(),
        ]);
    }
}
