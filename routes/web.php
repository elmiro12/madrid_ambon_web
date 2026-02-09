<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CMSController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Public\PagesController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Admin\SocialMediaController;
use App\Http\Controllers\Admin\PostCategoriesController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\MemberPRMIController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\SitemapController;

Route::get('/', [PagesController::class, 'home'])->name('home');
Route::get('/sitemap', [SitemapController::class, 'generate']);

Route::get('/pages/{slug}', [PagesController::class, 'getpages'])->name('pages');
Route::get('/berita', [BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/category/{slug}', [BeritaController::class, 'category'])->name('berita.category');
Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');
Route::get('gallery/{id}',[PagesController::class, 'getGallery'])->name('gallery.show');
Route::get('/member',[MemberPRMIController::class, 'showActiveMembers'])->name('members');

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/menus', [MenuController::class, 'index'])->name('admin.menus.index');
    Route::post('/save-menu', [MenuController::class, 'saveMenu'])->name('admin.menu.save');
    Route::delete('/menu/{id}', [MenuController::class, 'destroyMenu'])->name('admin.menu.destroy');

    Route::get('/categories', [PostCategoriesController::class, 'index'])->name('admin.categories.index');
    Route::post('/save-category', [PostCategoriesController::class, 'saveCategory'])->name('admin.category.save');
    Route::delete('/category/{id}', [PostCategoriesController::class, 'destroyCategory'])->name('admin.category.destroy');

    Route::get('/socials', [SocialMediaController::class, 'index'])->name('admin.socials.index');
    Route::post('/save-social', [SocialMediaController::class, 'saveSocialMedia'])->name('admin.social.save');
    Route::delete('/socials/{id}',[SocialMediaController::class, 'destroySocialMedia'])->name('admin.social.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('/save-user', [UserController::class, 'saveUser'])->name('admin.user.save');
    Route::delete('user/delete/{id}',[UserController::class,'deleteUser'])->name('admin.user.destroy');
});

Route::prefix('admin')->middleware(['auth', 'role:admin,editor'])->group(function () {

    Route::get('dashboard', [CMSController::class, 'dashboard'])->name('dashboard');
    Route::get('/pages', [CMSController::class, 'managePages'])->name('admin.pages.index');
    Route::get('/pages/create',[CMSController::class,'createPages'])->name('admin.pages.create');
    Route::get('/pages/{id}',[CMSController::class, 'editPages'])->name('admin.pages.edit');
    Route::get('/pages/show/{id}',[CMSController::class, 'showPages'])->name('admin.pages.show');
    Route::post('/save-page', [CMSController::class, 'savePage'])->name('admin.pages.save');
    Route::delete('pages/delete/{id}',[CMSController::class,'destroyPages'])->name('admin.pages.destroy');

    Route::get('/posts', [CMSController::class, 'managePosts'])->name('admin.posts.index');
    Route::get('/posts/create', [CMSController::class, 'createPost'])->name('admin.post.create');
    Route::get('/posts/{id}', [CMSController::class, 'editPost'])->name('admin.post.edit');
    Route::get('/posts/show/{id}', [CMSController::class, 'showPost'])->name('admin.post.show');
    Route::post('/save-post', [CMSController::class, 'savePost'])->name('admin.post.save');
    Route::delete('/posts/delete/{id}', [CMSController::class, 'destroyPost'])->name('admin.post.destroy');

    //tinymce
    Route::post('/upload-image', [CMSController::class, 'uploadImage'])->name('upload-image');

    Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/save-setting', [SettingController::class, 'updateSetting'])->name('admin.setting.save');

    Route::get('/gambar', [GalleryController::class, 'listGambar'])->name('admin.gallery.gambar');
    Route::get('/video', [GalleryController::class, 'listVideo'])->name('admin.gallery.video');
    Route::get('gallery/create/{slug}',[GalleryController::class, 'createGallery'])->name('admin.gallery.create');
    Route::get('gallery/{id}',[GalleryController::class, 'editGallery'])->name('admin.gallery.edit');
    Route::get('gallery/show/{id}',[GalleryController::class, 'showGallery'])->name('admin.gallery.show');
    Route::post('/save-gallery',[GalleryController::class, 'saveGallery'])->name('admin.gallery.save');
    Route::delete('/gallery/delete/{id}', [GalleryController::class, 'destroyGallery'])->name('admin.gallery.destroy');
    Route::delete('/gallery/item/{id}',[GalleryController::class, 'deleteGalleryItem'])->name('admin.gallery.item.destroy');
    
    Route::resource('event', EventController::class, ['as' => 'admin']);

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
