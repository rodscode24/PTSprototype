<?php

namespace App\Http\Controllers;

use App\Models\CmsPage;
use Illuminate\View\View;

class PublicCmsPageController extends Controller
{
    public function show(string $slug): View
    {
        return view('pages.cms', [
            'page' => CmsPage::findBySlug($slug),
        ]);
    }
}
