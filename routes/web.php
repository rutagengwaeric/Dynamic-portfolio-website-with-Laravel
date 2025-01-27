<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Demo\DemoController;
use App\Http\Controllers\Home\AboutController;
use App\Http\Controllers\Home\BlogCategoryController;
use App\Http\Controllers\Home\BlogController;
use App\Http\Controllers\Home\ContactController;
use App\Http\Controllers\Home\FooterController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\Home\PortfolioController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Frontend Routes
// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::get('/admin', function () {
    return view('auth.login');
});



// Dashboard Route with Middleware
Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/', [DemoController::class, 'HomePage'])->name('home');
// Admin Controller Routes
Route::controller(AdminController::class)->group(function(){
    Route::get('/admin/logout', 'destroy')->name('admin.logout');
    Route::get('/admin/profile', 'Profile')->name('admin.profile');
    Route::get('/edit/profile', 'EditProfile')->name('edit.profile');
    Route::post('/store/profile', 'StoreProfile')->name('store.profile');
    Route::get('/change/password', 'ChangePassword')->name('change.password');
    Route::post('/update/password', 'UpdatePassword')->name('update.password');
});

// Home Slides Routes
Route::controller(HomeSliderController::class)->group(function(){
    Route::get('/home/slide', 'HomeSlider')->name('home.slider');
    Route::post('/update/slide', 'UpdateSlider')->name('update.slider');
});
// Contact Routes
Route::controller(ContactController::class)->group(function(){
    Route::get('/contact', 'Contact')->name('contact.me');
    Route::post('/store/contact', 'StoreContact')->name('contact.store');
    Route::get('/contact/messages', 'ContactMessages')->name('contact.message');
    Route::get('/delete/contact/{id}', 'DeleteContact')->name('delete.message');
});
// Footer Routes
Route::controller(FooterController::class)->group(function(){
    Route::get('/footer/setup', 'FooterSetup')->name('footer.setup');
    Route::post('/update/footer', 'UpdateFooter')->name('update.footer');
});

// Blog Routes
Route::controller(BlogController::class)->group(function(){
    Route::get('/all/blog', 'AllBlog')->name('all.blog');
    Route::get('/add/blog', 'AddBlog')->name('add.blog');
    Route::post('/store/blog', 'StoreBlog')->name('store.blog');
    Route::get('/edit/blog/{id}', 'EditBlog')->name('edit.blog');
    Route::post('/update/blog/{id}', 'UpdateBlog')->name('update.blog');
    Route::get('/delete/blog/{id}', 'DeleteBlog')->name('delete.blog');
    Route::get('/category/blog/{id}', 'CategoryBlog')->name('category.blog');
    Route::get('/blog','HomeBlog')->name('home.blog');
});

// Blog Category Routes
Route::controller(BlogCategoryController::class)->group(function(){
    Route::get('/all/blog/category', 'BlogCategory')->name('all.blog.category');
    Route::get('/add/blog/category', 'AddBlogCategory')->name('add.blog.category');
    Route::post('/store/blog/category', 'StoreBlogCategory')->name('store.blog.category');
    Route::get('/edit/blog/category/{id}', 'EditBlogCategory')->name('edit.blog.category');
    Route::post('/update/blog/category/{id}', 'UpdateBlogCategory')->name('update.blog.category');
    Route::get('/delete/blog/category/{id}', 'DeleteBlogCategory')->name('delete.blog.category');

});

// About Page Routes
Route::controller(AboutController::class)->middleware('auth')->group(function(){

    Route::get('/about/page', 'AboutPage')->name('about.page');
    Route::post('/update/about', 'UpdateAbout')->name('update.about');
    Route::get('/about', 'HomeAbout')->name('home.about');
    Route::get('/about/multi/image', 'AboutMultiImage')->name('about.multi.image');
    Route::post('/store/multi/image', 'StoreMultiImage')->name('store.multi.image');
    Route::get('/all/multi/image', 'AllMultiImage')->name('all.multi.image');
    Route::get('/edit/multi/image/{id}', 'EditMultiImage')->name('edit.multi.image');
    Route::post('/update/multi/image', 'UpdateMultiImage')->name('update.multi.image');
    Route::get('/delete/multi/image/{id}', 'DeleteMultiImage')->name('delete.multi.image');

});

// Authenticated User Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Portifolio Routes
Route::controller(PortfolioController::class)->middleware('auth')->group(function(){
    Route::get('/all/portifolio', 'AllPortfolio')->name('all.portifolio');
    Route::get('/add/portifolio', 'AddPortfolio')->name('add.portifolio');
    Route::post('/store/portifolio', 'StorePortfolio')->name('store.portfolio');
    Route::get('/edit/portifolio/{id}', 'EditPortfolio')->name('edit.portfolio');
    Route::post('/update/portifolio', 'UpdatePortfolio')->name('update.portfolio');
    Route::get('/delete/portifolio/{id}', 'DeletePortfolio')->name('delete.portfolio');
    Route::get('/portifolio', 'HomePortfolio')->name('home.portfolio');
});

Route::get('/portfolio/details/{id}', [PortfolioController::class, 'PortfolioDetails'])->name('portfolio.details');
Route::get('/blog/details/{id}', [BlogController::class, 'BlogDetails'])->name('blog.details');

// Include authentication routes
require __DIR__.'/auth.php';
