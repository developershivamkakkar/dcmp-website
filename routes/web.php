<?php

use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\BannerController;
use App\Http\Controllers\admin\ContactController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\GalleryController;
use App\Http\Controllers\admin\HeroBannerController;
use App\Http\Controllers\admin\MandatoryDisclosureController;
use App\Http\Controllers\admin\ResourceController;
use App\Http\Controllers\admin\LearningPartnerController;
use App\Http\Controllers\FrontendContactContoller;
use App\Http\Controllers\FrontendGalleryController;
use App\Http\Controllers\FrontendHomePageController;
use App\Http\Controllers\FrontendJobController;
use App\Http\Controllers\FrontendResourceController;
use App\Http\Controllers\FrontendLearningPartnerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AnnouncementsController;
use App\Http\Controllers\admin\BlogController;
use App\Http\Controllers\admin\DownloadController;
use App\Http\Controllers\admin\EnquiryController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\MenuItemController;
use App\Http\Controllers\admin\PageEditorController;
use App\Http\Controllers\FrontendPageController;
use App\Http\Controllers\admin\PopupController;
use App\Http\Controllers\admin\SchoolEventController;
use App\Http\Controllers\FrontendBlogController;
use App\Http\Controllers\FrontendBrochureController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\FrontendDownloadController;
use App\Http\Controllers\FrontendEventController;
use App\Http\Controllers\FrontendMandatoryDisclosure;
use App\Http\Controllers\FrontendTransferCertificateController;
use App\Http\Controllers\admin\TransferCertificateController;
use App\Http\Controllers\FrontendAchievementController;
use App\Http\Controllers\admin\AchievementController;
use App\Http\Controllers\FrontendFaqController;
use App\Http\Controllers\admin\FaqController;
use App\Http\Controllers\admin\SiteSettingController;
use App\Http\Controllers\admin\LandingPageController;
use App\Http\Controllers\FrontendTestimonialController;
use App\Http\Controllers\admin\TestimonialController;

// Frontend Web Routes
Route::middleware(['loadAnnouncements'])->group(function () {

    // Frontend Contact Routes
    Route::get('contact', [FrontendContactContoller::class, 'index'])->name('contact');
    Route::post('contact', [FrontendContactContoller::class, 'store'])->name('contact.store');
    // Mandatory Disclosure Frontend Routes
    Route::get('mandatory-disclosure', [FrontendMandatoryDisclosure::class, 'index'])->name('mandatory-disclosure.get');
    // Gallery Frontend Routes
    Route::get('gallery/school-events', [FrontendGalleryController::class, 'school_events'])->name('gallery-school-events.get');
    Route::get('gallery/school-events/images/{id}', [FrontendGalleryController::class, 'events_images'])->name('images.show');
    Route::get('gallery/infrastructure', [FrontendGalleryController::class, 'infrastructure'])->name('gallery-infrastructure.get');
    Route::get('gallery/infrastructure/images/{id}', [FrontendGalleryController::class, 'infra_images'])->name('infra.images.show');
    Route::get('gallery/activities', [FrontendGalleryController::class, 'activities'])->name('gallery-activities.get');
    Route::get('gallery/activities/images/{id}', [FrontendGalleryController::class, 'activities_images'])->name('activities.images.show');
    Route::get('gallery/annual-functions', [FrontendGalleryController::class, 'annual_functions'])->name('gallery-annual-functions.get');
    Route::get('gallery/annual-functions/images/{id}', [FrontendGalleryController::class, 'annual_functions_images'])->name('annual-functions.images.show');
    Route::get('gallery/news-clippings', [FrontendGalleryController::class, 'news_clippings'])->name('gallery-news-clippings.get');

    // Home Page Routes
    Route::get('/', [FrontendHomePageController::class, 'index'])->name('home.get');

    // Resources Routes
    Route::get('resource-list', [FrontendResourceController::class, 'index'])->name('resource-list');

    // Achievements Routes
    Route::get('achievements', [FrontendAchievementController::class, 'index'])->name('achievements.get');

    // FAQ Routes
    Route::get('faq', [FrontendFaqController::class, 'index'])->name('faq.get');

    // Testimonials (Opinions That Matter) Routes
    Route::get('opinions-that-matter', [FrontendTestimonialController::class, 'index'])->name('testimonials.get');

    // Learning Partners Routes
    Route::get('learning-partners', [FrontendLearningPartnerController::class, 'index'])->name('learning-partners.get');

    // Transfer Certificate Routes
    Route::get('transfer-certificate', [FrontendTransferCertificateController::class, 'index'])->name('tc.index');
    Route::post('transfer-certificate/search', [FrontendTransferCertificateController::class, 'search'])->name('tc.search');

    // Downloads Routes
    Route::get('downloads', [FrontendDownloadController::class, 'index'])->name('downloads-list.get');

    // Blogs Routes
    Route::get('blogs', [FrontendBlogController::class, 'index'])->name('blogs.get');
    Route::get('blog/{slug}', [FrontendBlogController::class, 'blog_detail'])->name('blog.detail.get');

    // Event Routes
    Route::get('events', [FrontendEventController::class, 'index'])->name('events.get');
    Route::get('event/{slug}', [FrontendEventController::class, 'event_detail'])->name('event.detail.get');


    Route::post('/brochure-submit', [FrontendBrochureController::class, 'submit'])
        ->name('brochure.submit');

        // Job Enquiry Form
        Route::get('job-enquiry', [FrontendJobController::class, 'index'])->name('job-form.get');
        Route::post('job-enquiry', [FrontendJobController::class, 'store'])->name('job.store');

    // Admissions Landing WebPage
    Route::get('admissions', [FrontendPageController::class, 'admissions_landing_page'])->name('admissions.landing.get');


});



Route::get('sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Backend Routes
Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        // Here we will define Guest Routes
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('login', [AdminLoginController::class, 'authenticate'])->name('admin.auth');
    });
    Route::group(['middleware' => ['admin.auth', 'dynamic.role']], function () {
        // Here we will define Password Protected  Routes
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('logout', [DashboardController::class, 'logout'])->name('admin.logout');

        //Admin Resource List CRUD
        Route::get('resources', [ResourceController::class, 'resource_list'])->name('resources.get');
        Route::get('resource-create', [ResourceController::class, 'create'])->name('resource.create');
        Route::post('resource-create', [ResourceController::class, 'store'])->name('resource.store');
        Route::get('resource-update/{id}', [ResourceController::class, 'update_view'])->name('update.resource');
        Route::put('resource-update/{id}', [ResourceController::class, 'update'])->name('resource.update');
        Route::delete('resource-delete/{id}', [ResourceController::class, 'delete'])->name('resource.delete');

        //Admin Hero Banner Routes
        Route::get('hero-banners', [HeroBannerController::class, 'index'])->name('banners.get');
        Route::get('hero-banner-upload', [HeroBannerController::class, 'upload_view'])->name('upload.banner');
        Route::post('hero-banner-upload', [HeroBannerController::class, 'upload'])->name('banner.upload');
        Route::delete('hero-banner-delete/{id}', [HeroBannerController::class, 'delete'])->name('banner.delete');

        //Explore  Banner Routes
        Route::get('banners', [BannerController::class, 'index'])->name('explore-banners.get');
        Route::get('banner-upload', [BannerController::class, 'upload_view'])->name('explore-upload.banner');
        Route::post('banner-upload', [BannerController::class, 'upload'])->name('explore-banner.upload');
        Route::delete('banner-delete/{id}', [BannerController::class, 'delete'])->name('explore-banner.delete');

        // Mandatory Disclosure Routes
        Route::get('mandatory-disclousre', [MandatoryDisclosureController::class, 'index'])->name('md.get');
        Route::put('mandatory-disclousre', [MandatoryDisclosureController::class, 'update'])->name('md.update');
        Route::get('mandatory-disclousre/edit', [MandatoryDisclosureController::class, 'update_view'])->name('md.edit');

        // Gallery Routes
        Route::get('gallery-list', [GalleryController::class, 'list_view'])->name('gallery.get');
        Route::post('gallery-list', [GalleryController::class, 'create'])->name('gallery.create');
        Route::put('gallery-list/{id}', [GalleryController::class, 'update'])->name('gallery.update');
        Route::delete('gallery-list/{id}', [GalleryController::class, 'delete'])->name('gallery.delete');
        Route::get('gallery-images-upload/{album_id}', [GalleryController::class, 'images_view'])->name('gallery.images');
        Route::post('gallery-images-upload', [GalleryController::class, 'upload'])->name('gallery.upload');
        Route::delete('gallery-image-delete/{image_id}', [GalleryController::class, 'image_delete'])->name('gallery.image.delete');

        // Announcements Routes
        Route::get('announcements', [AnnouncementsController::class, 'index'])->name('announcements.get');
        Route::post('announcements', [AnnouncementsController::class, 'store'])->name('announcements.store');
        Route::delete('announcements/{id}', [AnnouncementsController::class, 'delete'])->name('announcements.delete');
        Route::put('announcements/{id}', [AnnouncementsController::class, 'edit'])->name('announcements.edit');

        // Popup Routes
        Route::get('popups', [PopupController::class, 'index'])->name('popups.get');
        Route::post('popup-upload', [PopupController::class, "upload"])->name('popup.upload');
        Route::delete('popup-delete/{id}', [PopupController::class, 'delete'])->name('popup.delete');
        Route::put('popup-update/{id}', [PopupController::class, 'update'])->name('popup.update');


        // Contact List Routes
        Route::get('contact', [ContactController::class, 'index'])->name('contacts.get');

        // Job Enquires
        Route::get('job-enquires', [EnquiryController::class, 'get_job_enquires'])->name('admin.job-enquires.get');


        // Permissions Routes
        Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.get');
        Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
        Route::put('permissions/{id}', [PermissionController::class, 'update'])->name('permissions.update');
        Route::delete('permissions/{id}', [PermissionController::class, 'delete'])->name('permissions.delete');

        // Role Routes
        Route::get('roles', [RoleController::class, 'index'])->name('roles.get');
        Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
        Route::put('roles/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::delete('roles/{id}', [RoleController::class, 'delete'])->name('roles.delete');
        Route::get('roles/give-permissions/{role_id}', [RoleController::class, 'add_permission_to_role'])->name('add_permission_to_role');
        Route::put('roles/give-permissions/{role_id}', [RoleController::class, 'give_permission_to_role'])->name('give_permission_to_role');

        //User Routes
        Route::get('users', [UserController::class, 'index'])->name('users.get');
        Route::post('users', [UserController::class, 'store'])->name('user.store');
        // Update User
        Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
        // Delete User
        Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
        //Menu-Items
        Route::get('menu-items', [MenuItemController::class, 'index'])->name('menu-items.index');
        Route::post('menu-item/create', [MenuItemController::class, 'store'])->name('menu-items.store');
        Route::put('menu-item/{menuItem}', [MenuItemController::class, 'update'])->name('menu-items.update');
        Route::delete('menu-item/{menuItem}', [MenuItemController::class, 'destroy'])->name('menu-items.destroy');
        Route::post('menu-items/reorder', [MenuItemController::class, 'reorder'])->name('menu-items.reorder');

        // Site Settings
        Route::get('site-settings', [SiteSettingController::class, 'index'])->name('admin.site-settings.index');
        Route::post('site-settings', [SiteSettingController::class, 'save'])->name('admin.site-settings.save');

        // Landing Page Editor
        Route::get('landing-page', [LandingPageController::class, 'index'])->name('admin.landing-page.index');
        Route::post('landing-page', [LandingPageController::class, 'save'])->name('admin.landing-page.save');

        // Page Editor Routes
        Route::get('page-editor', [PageEditorController::class, 'dependent_dropdown'])->name('dependent-dropdown');
        Route::get('sub-menus/{parent_id}', [PageEditorController::class, 'getSubMenus']);
        Route::get('page/data/{menuItemId}', [PageEditorController::class, 'getPageData'])->name('page.data');
        Route::get('page/show', [PageEditorController::class, 'show'])->name('page.show');
        Route::post('page/save', [PageEditorController::class, 'save'])->name('page.save');
        Route::post('/page-editor/upload-image', [PageEditorController::class, 'upload'])->name('ckeditor.upload');

        // Achievements Admin Routes
        Route::get('achievements', [AchievementController::class, 'index'])->name('admin.achievements.index');
        Route::post('achievements', [AchievementController::class, 'store'])->name('admin.achievements.store');
        Route::delete('achievements/{id}', [AchievementController::class, 'delete'])->name('admin.achievements.delete');

        // Testimonials Admin Routes
        Route::get('testimonials', [TestimonialController::class, 'index'])->name('admin.testimonials.index');
        Route::post('testimonials', [TestimonialController::class, 'store'])->name('admin.testimonials.store');
        Route::put('testimonials/{id}', [TestimonialController::class, 'update'])->name('admin.testimonials.update');
        Route::delete('testimonials/{id}', [TestimonialController::class, 'delete'])->name('admin.testimonials.delete');

        // Learning Partners Admin Routes
        Route::get('learning-partners', [LearningPartnerController::class, 'index'])->name('admin.learning-partners.index');
        Route::post('learning-partners', [LearningPartnerController::class, 'store'])->name('admin.learning-partners.store');
        Route::put('learning-partners/{partner}', [LearningPartnerController::class, 'update'])->name('admin.learning-partners.update');
        Route::delete('learning-partners/{partner}', [LearningPartnerController::class, 'destroy'])->name('admin.learning-partners.destroy');
        Route::post('learning-partners/reorder', [LearningPartnerController::class, 'reorder'])->name('admin.learning-partners.reorder');

        // FAQ Admin Routes
        Route::get('faqs', [FaqController::class, 'index'])->name('admin.faqs.index');
        Route::post('faqs', [FaqController::class, 'store'])->name('admin.faqs.store');
        Route::put('faqs/{id}', [FaqController::class, 'update'])->name('admin.faqs.update');
        Route::delete('faqs/{id}', [FaqController::class, 'delete'])->name('admin.faqs.delete');

        // Transfer Certificate Admin Routes
        Route::get('transfer-certificates', [TransferCertificateController::class, 'index'])->name('admin.tc.index');
        Route::post('transfer-certificates', [TransferCertificateController::class, 'store'])->name('admin.tc.store');
        Route::delete('transfer-certificates/{id}', [TransferCertificateController::class, 'delete'])->name('admin.tc.delete');

        // Download Routes
        Route::get('downloads', [DownloadController::class, 'index'])->name('downloads.get');
        Route::post('download', [DownloadController::class, 'store'])->name('download.store');
        Route::delete('download/{id}', [DownloadController::class, 'delete'])->name('download.delete');

        // Blogs Routes
        Route::get('blogs', [BlogController::class, 'index'])->name('admin.blogs.get');
        Route::get('edit-blog/{blog_id}', [BlogController::class, 'edit'])->name('admin.blogs.edit');
        Route::post('blogs', [BlogController::class, 'store'])->name('admin.blogs.store');
        Route::put('edit-blog/{blog_id}', [BlogController::class, 'update'])->name('admin.blog.update');
        Route::delete('delete-blog/{blog_id}', [BlogController::class, 'delete'])->name('admin.blog.delete');

        // Event Routes
        Route::get('events', [SchoolEventController::class, 'index'])->name('admin.events.get');
        Route::get('edit-event/{event_id}', [SchoolEventController::class, 'edit'])->name('admin.events.edit');
        Route::post('events', [SchoolEventController::class, 'store'])->name('admin.events.store');
        Route::put('edit-event/{event_id}', [SchoolEventController::class, 'update'])->name('admin.event.update');
        Route::delete('delete-event/{event_id}', [SchoolEventController::class, 'delete'])->name('admin.event.delete');

    });

});

// For Dynamic Web Routes
Route::get('{slug}', [FrontendPageController::class, 'show'])
    ->where('slug', '.*')
    ->name('show.page')->middleware('loadAnnouncements'); // to render announcements on every webpage (use middleware)
