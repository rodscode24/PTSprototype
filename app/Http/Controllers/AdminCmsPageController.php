<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use App\Models\CmsPage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminCmsPageController extends Controller
{
    public function edit(string $slug): View|RedirectResponse
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            return redirect()->route('devlogin');
        }

        return view('admin.cms-page', [
            'adminEmail' => Auth::user()->email,
            'page' => CmsPage::findBySlug($slug),
        ]);
    }

    public function update(Request $request, string $slug): RedirectResponse|JsonResponse
    {
        if (! Auth::check() || ! Auth::user()->is_admin) {
            return redirect()->route('devlogin');
        }

        $page = CmsPage::findBySlug($slug);
        $isHomePage = $page->slug === 'home';

        $validated = $request->validate([
            'hero_eyebrow' => [$isHomePage ? 'nullable' : 'required', 'string', 'max:120'],
            'hero_title' => ['required', 'string', 'max:180'],
            'hero_subtitle' => [$isHomePage ? 'nullable' : 'required', 'string', 'max:1200'],
            'hero_image' => ['nullable', 'image', 'max:4096'],
            'body_html' => ['required', 'string', 'max:40000'],
            'section_images' => ['nullable', 'array'],
            'section_images.*' => ['nullable', 'image', 'max:4096'],
        ]);

        if ($request->hasFile('hero_image')) {
            $validated['hero_image_path'] = $request->file('hero_image')->store('cms-pages', 'public');
        }

        if ($isHomePage) {
            $validated['hero_eyebrow'] = $validated['hero_eyebrow'] ?? $page->hero_eyebrow;
            $validated['hero_subtitle'] = $validated['hero_subtitle'] ?? '';
        }

        $validated['body_html'] = $this->applySectionImages(
            html_entity_decode($validated['body_html']),
            $request->file('section_images', [])
        );

        unset($validated['hero_image']);
        unset($validated['section_images']);

        $before = $page->only(array_keys($validated));
        $page->update($validated);
        AuditLog::record($page->name, 'Updated '.$page->name.' page content', $page, $before, $page->fresh()->only(array_keys($validated)));

        if ($request->expectsJson()) {
            $page->refresh();

            return response()->json([
                'message' => $page->name.' page updated successfully.',
                'hero_image_url' => $page->heroImageUrl(),
                'body_html' => html_entity_decode($page->body_html),
            ]);
        }

        return redirect()
            ->route('admin.cms.edit', $page->slug)
            ->with('status', $page->name.' page updated successfully.');
    }

    private function applySectionImages(string $bodyHtml, array $sectionImages): string
    {
        foreach ($sectionImages as $token => $image) {
            if (! $image || ! $image->isValid()) {
                continue;
            }

            if (! preg_match('/^[A-Za-z0-9_-]+$/', (string) $token)) {
                continue;
            }

            $path = $image->store('cms-pages', 'public');
            $url = Storage::url($path);
            $style = "background-image: linear-gradient(135deg, rgba(7,33,51,.38), rgba(15,95,143,.28)), url('{$url}'); background-size: cover; background-position: center; background-repeat: no-repeat;";

            $pattern = '/<([a-z0-9]+)([^>]*\sdata-upload-token=(["\'])'.preg_quote((string) $token, '/').'\\3[^>]*)>/i';

            $bodyHtml = preg_replace_callback($pattern, function (array $matches) use ($style) {
                $attributes = preg_replace('/\sstyle=(["\']).*?\\1/i', '', $matches[2]);

                return '<'.$matches[1].$attributes.' style="'.htmlspecialchars($style, ENT_QUOTES, 'UTF-8').'">';
            }, $bodyHtml, 1);
        }

        return preg_replace('/\sdata-upload-token=(["\']).*?\\1/i', '', $bodyHtml) ?? $bodyHtml;
    }
}
