<?php

namespace CSoftech\Cms\Http\Controllers;

use Illuminate\Http\Request;
use CSoftech\Cms\Models\CMS;
use CSoftech\Cms\Models\Upload;
use App\Http\Controllers\Controller;

class CmsController extends Controller
{
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cmsHome()
    {
        $cms = CMS::whereSlug(array_search('home', \Config::get('contentSlug.CMS_CONTENT_SLUG')))->first();
        return view('view::cms.index', compact('cms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cmsHomeStore(Request $request)
    {
        try {
            \DB::BeginTransaction();

            if(is_null($request->cms_id)){
                $cms = CMS::create([
                    'content' => $request->content,
                    'slug' => array_search('home', \Config::get('contentSlug.CMS_CONTENT_SLUG')),
                ]);
            } else {
                $cms = CMS::whereId($request->cms_id)->first();
                $cms->update([
                    'content' => $request->content,
                ]);
            }

            if ($request->hasFile('banner_image')) {
                $hasBanner = $cms->uploads()->whereFileType(1)->first();
                if(!is_null($hasBanner)){
                    unlink(public_path('uploads/').$hasBanner->file_name);
                    $hasBanner->delete();
                }
                $file =  $request->file('banner_image');
                $fileFullName = $fileOriginalName = null;
                $fileName = preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime());
                $extension = $file->getClientOriginalExtension();
                $fileOriginalName = $file->getClientOriginalName();
                $fileFullName = $fileName . '.' . $extension;
                $file->move(public_path('uploads'), $fileFullName);

                Upload::create([
                    'file_name' => $fileFullName,
                    'thumbnail' => null,
                    'display_name' => $fileOriginalName,
                    'file_type' => 1,
                    'uploadable_id' => $cms->id,
                    'uploadable_type' => get_class($cms),
                ]);
            }
            \DB::commit();
            return redirect()->route('cms.home')->with('success', \Lang::get('messages.attribute_action_successfully', ['attribute' => 'About', 'action' => 'updated']));
        } catch (\Exception $error) {
            \DB::rollback();
            dd($error->getMessage());
            return redirect()->back()->withInput($request->input())->with('error', $error->getMessage());
        }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cmsAbout()
    {
        $cms = CMS::whereSlug(array_search('about', \Config::get('contentSlug.CMS_CONTENT_SLUG')))->first();
        return view('view::cms.about', compact('cms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cmsAboutStore(Request $request)
    {      
        try {
            \DB::BeginTransaction();

            if(is_null($request->cms_id)){
                CMS::create([
                    'content' => $request->content,
                    'slug' => array_search('about', \Config::get('contentSlug.CMS_CONTENT_SLUG')),
                ]);
            } else {
                $cms = CMS::whereId($request->cms_id)->first();
                $cms->update([
                    'content' => $request->content,
                ]);
            }

            \DB::commit();
            return redirect()->route('cms.about')->with('success', \Lang::get('messages.attribute_action_successfully', ['attribute' => 'About', 'action' => 'updated']));
        } catch (\Exception $error) {
            \DB::rollback();
            return redirect()->back()->withInput($request->input())->with('error', $error->getMessage());
        }
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cmsApproach()
    {
        $cms = CMS::whereSlug(array_search('approach', \Config::get('contentSlug.CMS_CONTENT_SLUG')))->first();
        return view('view::cms.approach', compact('cms'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cmsApproachStore(Request $request)
    {      
        try {
            \DB::BeginTransaction();

            if(is_null($request->cms_id)){
                CMS::create([
                    'content' => $request->content,
                    'slug' => array_search('approach', \Config::get('contentSlug.CMS_CONTENT_SLUG')),
                ]);
            } else {
                $cms = CMS::whereId($request->cms_id)->first();
                $cms->update([
                    'content' => $request->content,
                ]);
            }

            \DB::commit();
            return redirect()->route('cms.approach')->with('success', \Lang::get('messages.attribute_action_successfully', ['attribute' => 'Approach', 'action' => 'updated']));
        } catch (\Exception $error) {
            \DB::rollback();
            return redirect()->back()->withInput($request->input())->with('error', $error->getMessage());
        }
    }


     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cmsCareer()
    {
        $cms = CMS::whereSlug(array_search('career', \Config::get('contentSlug.CMS_CONTENT_SLUG')))->first();
        return view('view::cms.career', compact('cms'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cmsCareerStore(Request $request)
    {      
        try {
            \DB::BeginTransaction();

            if(is_null($request->cms_id)){
                CMS::create([
                    'content' => $request->content,
                    'slug' => array_search('career', \Config::get('contentSlug.CMS_CONTENT_SLUG')),
                ]);
            } else {
                $cms = CMS::whereId($request->cms_id)->first();
                $cms->update([
                    'content' => $request->content,
                ]);
            }

            \DB::commit();
            return redirect()->route('cms.career')->with('success', \Lang::get('messages.attribute_action_successfully', ['attribute' => 'Career', 'action' => 'updated']));
        } catch (\Exception $error) {
            \DB::rollback();
            return redirect()->back()->withInput($request->input())->with('error', $error->getMessage());
        }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cmsContact()
    {
        $cms = CMS::whereSlug(array_search('contact', \Config::get('contentSlug.CMS_CONTENT_SLUG')))->first();
        return view('view::cms.contact', compact('cms'));
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cmsContactStore(Request $request)
    {      
        try {
            \DB::BeginTransaction();

            if(is_null($request->cms_id)){
                CMS::create([
                    'content' => $request->content,
                    'slug' => array_search('contact', \Config::get('contentSlug.CMS_CONTENT_SLUG')),
                ]);
            } else {
                $cms = CMS::whereId($request->cms_id)->first();
                $cms->update([
                    'content' => $request->content,
                ]);
            }

            \DB::commit();
            return redirect()->route('cms.contact')->with('success', \Lang::get('messages.attribute_action_successfully', ['attribute' => 'Contact', 'action' => 'updated']));
        } catch (\Exception $error) {
            \DB::rollback();
            return redirect()->back()->withInput($request->input())->with('error', $error->getMessage());
        }
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cmsFaq()
    {
        $cms = CMS::whereSlug(array_search('faq', \Config::get('contentSlug.CMS_CONTENT_SLUG')))->get();
        return view('view::cms.faq', compact('cms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cmsFaqStore(Request $request)
    {
        try {
            \DB::BeginTransaction();

            foreach ($request->faq as $faq) {
                if(!isset($faq['cms_id'])){
                    CMS::create([
                        'question' => $faq['question'],
                        'content' => $faq['answer'],
                        'slug' => array_search('faq', \Config::get('contentSlug.CMS_CONTENT_SLUG')),
                    ]);
                } else {
                    $cms = CMS::whereId($faq['cms_id'])->first();
                    $cms->update([
                        'question' => $faq['question'],
                        'content' => $faq['answer'],
                    ]);
                }
            }

            \DB::commit();
            return redirect()->route('cms.faq')->with('success', \Lang::get('messages.attribute_action_successfully', ['attribute' => 'Contact', 'action' => 'updated']));
        } catch (\Exception $error) {
            \DB::rollback();
            return redirect()->back()->withInput($request->input())->with('error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteFaq($id)
    {
        $cms = CMS::whereId($id)->first();
        if (is_null($cms)) {
            return response()->json(['error' => \Lang::get('messages.attribute_does_not_exists', [
                'attribute' => \Lang::get('views.faq')
            ])], 404);
        }
        try {
            $cms->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => \Lang::get('messages.internal_server_error')], 500);
        }
    }    

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cmsGallery()
    {
        $cms = CMS::whereSlug(array_search('gallery', \Config::get('contentSlug.CMS_CONTENT_SLUG')))->first();
        return view('view::cms.gallery', compact('cms'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cmsGalleryStore(Request $request)
    {      
        try {
            \DB::BeginTransaction();

            if(is_null($request->cms_id)){
                $cms = CMS::create([
                    'slug' => array_search('gallery', \Config::get('contentSlug.CMS_CONTENT_SLUG')),
                ]);
            } else {
                $cms = CMS::whereId($request->cms_id)->first();
            }

            foreach ($request->gallery as $key => $productPhoto) {
                if ($request->hasFile('gallery.'.$key)) {
                    $file =  $request->file('gallery.'.$key);
                    $fileFullName = $fileOriginalName = null;
                    $fileName = preg_replace('/(0)\.(\d+) (\d+)/', '$3$1$2', microtime());
                    $extension = $file->getClientOriginalExtension();
                    $fileOriginalName = $file->getClientOriginalName();
                    $fileFullName = $fileName . '.' . $extension;
                    $file->move(public_path('uploads'), $fileFullName);
                    $destinationPath = public_path('uploads/'.$fileFullName);
                    // $img = Image::make($destinationPath)->resize(100, 100)->save(public_path('uploads/thumbnail/'.$fileFullName));
                    Upload::create([
                        'file_name' => $fileFullName,
                        'thumbnail' => null,
                        'display_name' => $fileOriginalName, 
                        'file_type' => array_search('IMAGE', \Config::get('contentSlug.FILE_TYPE')),
                        'uploadable_id' => $cms->id,
                        'uploadable_type' => get_class($cms),
                    ]);
                }
            }

            \DB::commit();
            return redirect()->route('cms.gallery')->with('success', \Lang::get('messages.attribute_action_successfully', ['attribute' => 'Contact', 'action' => 'updated']));
        } catch (\Exception $error) {
            \DB::rollback();
            return redirect()->back()->withInput($request->input())->with('error', $error->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteImage($id)
    {
        $img = Upload::whereId($id)->first();
        if (is_null($img)) {
            return response()->json(['error' => \Lang::get('messages.attribute_does_not_exists', [
                'attribute' => \Lang::get('views.image')
            ])], 404);
        }
        try {
            unlink(public_path('uploads') . '/' . $img->file_name);
            $img->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => \Lang::get('messages.internal_server_error')], 500);
        }
    }
}