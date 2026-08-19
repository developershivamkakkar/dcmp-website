<?php

namespace App\Services;

use App\Models\Blog;
use App\Models\SchoolEvent;
use App\Models\Album;
use App\Models\PageContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * SeoService — Centralized SEO resolver.
 *
 * THREE-LEVEL FALLBACK CHAIN (highest → lowest priority):
 *   1. Runtime overrides  — set via $seo->set() or fromModel() in controllers
 *   2. Per-page config    — config/site.php['pages'] (keyed by route name)
 *   3. Site-wide defaults — config/site.php (meta_description, meta_keywords)
 *
 * SINGLE CONFIG FILE: config/site.php
 * All SEO data is centralized in one place for clarity and maintainability.
 *
 * Quick-start in a controller:
 *   app(SeoService::class)->fromBlog($blog);
 *   app(SeoService::class)->fromEvent($event);
 *   app(SeoService::class)->fromAlbum($album);
 *   app(SeoService::class)->fromPage($page);
 *   app(SeoService::class)->set('title', 'Custom Title')->set('robots', 'noindex');
 *
 * The $seo variable is automatically shared with layouts/app.blade.php via
 * AppServiceProvider. Child views no longer need @section('meta-*') overrides.
 */
class SeoService
{
    /** Runtime overrides (highest priority). */
    protected array $overrides = [];

    /** Per-page config resolved from config/seo.php for the current route. */
    protected array $pageConfig = [];

    public function __construct()
    {
        $routeName = request()->route()?->getName() ?? '';
        $this->pageConfig = config("site.pages.{$routeName}", []);
    }

    // ── Fluent setter ────────────────────────────────────────────────────────

    /**
     * Set any SEO property at runtime.
     * Accepted keys: title, description, keywords, og_type, og_image,
     *                og_title, og_description, canonical, robots
     */
    public function set(string $key, mixed $value): static
    {
        $this->overrides[$key] = $value;
        return $this;
    }

    // ── Model helpers ────────────────────────────────────────────────────────

    /**
     * Populate SEO from a Blog model.
     * Call in FrontendBlogController::blog_detail().
     */
    public function fromBlog(Blog $blog): static
    {
        $siteName  = config('site.name');
        $plainText = strip_tags($blog->content ?? '');

        return $this
            ->set('title',       $blog->title . ' — ' . $siteName)
            ->set('description', Str::limit($plainText, 160) ?: config('site.meta_description'))
            ->set('keywords',    $this->extractKeywords($blog->title))
            ->set('og_type',     'article')
            ->set('og_image',    $blog->blog_image_path
                                    ? Storage::url($blog->blog_image_path)
                                    : null)
            ->set('canonical',   route('blog.detail.get', ['slug' => $blog->slug]));
    }

    /**
     * Populate SEO from a SchoolEvent model.
     * Call in FrontendEventController::event_detail().
     */
    public function fromEvent(SchoolEvent $event): static
    {
        $siteName  = config('site.name');
        $plainText = strip_tags($event->content ?? '');

        return $this
            ->set('title',       $event->title . ' — ' . $siteName)
            ->set('description', Str::limit($plainText, 160) ?: config('site.meta_description'))
            ->set('keywords',    $this->extractKeywords($event->title))
            ->set('og_type',     'article')
            ->set('og_image',    $event->event_image_path
                                    ? Storage::url($event->event_image_path)
                                    : null)
            ->set('canonical',   route('event.detail.get', ['slug' => $event->slug]));
    }

    /**
     * Populate SEO from a gallery Album model.
     * Call in FrontendGalleryController::events_images() / infra_images() / activities_images().
     */
    public function fromAlbum(Album $album): static
    {
        $siteName = config('site.name');

        return $this
            ->set('title',       $album->album_name . ' Gallery — ' . $siteName)
            ->set('description', 'Browse photos from the ' . $album->album_name . ' gallery at ' . $siteName . '.')
            ->set('keywords',    $album->album_name . ', ' . $siteName . ' Gallery, School Photos Panchkula')
            ->set('og_type',     'website')
            ->set('robots',      'index, follow');
    }

    /**
     * Populate SEO from a dynamic CMS page (PageContent).
     * Call in FrontendPageController::show().
     */
    public function fromPage(PageContent $page): static
    {
        $siteName  = config('site.name');
        $plainText = strip_tags($page->content ?? '');

        return $this
            ->set('title',       ($page->meta_title ?? $page->title) . ' — ' . $siteName)
            ->set('description', $page->meta_description ?: (Str::limit($plainText, 160) ?: config('site.meta_description')))
            ->set('keywords',    $page->meta_keywords ?: config('site.meta_keywords'))
            ->set('og_type',     'article')
            ->set('canonical',   url()->current());
    }

    // ── Getters ──────────────────────────────────────────────────────────────

    public function title(): string
    {
        return $this->resolve('title', config('site.full_name'));
    }

    public function description(): string
    {
        return $this->resolve('description', config('site.meta_description'));
    }

    public function keywords(): string
    {
        return $this->resolve('keywords', config('site.meta_keywords'));
    }

    public function robots(): string
    {
        return $this->resolve('robots', 'index, follow');
    }

    public function canonical(): string
    {
        return $this->resolve('canonical', url()->current());
    }

    public function ogType(): string
    {
        return $this->resolve('og_type', 'website');
    }

    public function ogTitle(): string
    {
        return $this->resolve('og_title', $this->title());
    }

    public function ogDescription(): string
    {
        return $this->resolve('og_description', $this->description());
    }

    public function ogImage(): string
    {
        $image = $this->resolve('og_image', null);
        if ($image) {
            return filter_var($image, FILTER_VALIDATE_URL)
                ? $image
                : asset($image);
        }
        return asset(config('site.og_image'));
    }

    // ── Internal ─────────────────────────────────────────────────────────────

    protected function resolve(string $key, mixed $siteDefault): mixed
    {
        return $this->overrides[$key]
            ?? $this->pageConfig[$key]
            ?? $siteDefault;
    }

    /**
     * Build a basic keywords string from a page/post title by appending
     * the site brand terms, so every dynamic page gets usable keywords
     * without manual entry.
     */
    protected function extractKeywords(string $title): string
    {
        return $title . ', ' . config('site.name') . ', Best School Panchkula, Dass Brown School';
    }
}
