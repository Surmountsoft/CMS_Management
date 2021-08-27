<?php
use CSoftech\Cms\Http\Controllers\CmsController;
	
Route::get('cms/home', [CmsController::class, 'cmsHome'])->name('cms.home');
Route::post('cms/create/home', [CmsController::class, 'cmsHomeStore'])->name('cms.create.home');


Route::get('cms/about', [CmsController::class, 'cmsAbout'])->name('cms.about');
Route::post('cms/create/about', [CmsController::class, 'cmsAboutStore'])->name('cms.create.about');

Route::get('cms/approach', [CmsController::class, 'cmsApproach'])->name('cms.approach');
Route::post('cms/create/approach', [CmsController::class, 'cmsApproachStore'])->name('cms.create.approach');


Route::get('cms/career', [CmsController::class, 'cmsCareer'])->name('cms.career');
Route::post('cms/create/career', [CmsController::class, 'cmsCareerStore'])->name('cms.create.career');


Route::get('cms/contact', [CmsController::class, 'cmsContact'])->name('cms.contact');
Route::post('cms/create/contact', [CmsController::class, 'cmsContactStore'])->name('cms.create.contact');


Route::get('cms/faq', [CmsController::class, 'cmsFaq'])->name('cms.faq');
Route::post('cms/create/faq', [CmsController::class, 'cmsFaqStore'])->name('cms.create.faq');
Route::delete('cms/delete/faq/{id}',[CmsController::class, 'deleteFaq'])->name('cms.delete.faq');

Route::get('cms/gallery', [CmsController::class, 'cmsGallery'])->name('cms.gallery');
Route::post('cms/create/gallery', [CmsController::class, 'cmsGalleryStore'])->name('cms.create.gallery');
Route::delete('cms/gallery/img-remove/{id}',[CmsController::class, 'deleteImage'])->name('cms.img-remove');