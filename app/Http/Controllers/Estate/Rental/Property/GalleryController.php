<?php

namespace App\Http\Controllers\Estate\Rental\Property;

use App\Http\Requests\Estate\Rental\Property\StoreGalleryRequest;
use App\Models\Image\Gallery;
use App\Models\v1\Estate\EstateProperty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ExtCountries;
use Image;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $id)
    {
        //Property
        $property = EstateProperty::find($id);

        //sort
        $sort = $request->sort;

        //check app
        if ($property == null)
            abort(404);

        //Property App
        $app = $property->app;

        //company
        $company = $app->company;

        //country code
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        //gallery
        $galleries = $property->galleries()->orderBy('created_at')->paginate();

        //authorize
//        $this->authorize('view', $app);

        //TODO: use for debug only
        //dd($property->prices()->where('status',1)->first());

        return view('v1.estates.properties.galleries.index')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('sort', $sort)
            ->with('galleries', $galleries)
            ->with('property', $property);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        //Property
        $property = EstateProperty::find($id);

        //check app
        if ($property == null)
            abort(404);

        //Property App
        $app = $property->app;

        //company
        $company = $app->company;

        //country code
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        //authorize
        $this->authorize('view', $app);

        //TODO: use for debug only
        //dd($property->prices()->where('status',1)->first());

        return view('v1.estates.properties.galleries.create')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('property', $property);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreGalleryRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGalleryRequest $request)
    {
        //on success-proceed

        //catch input
        $title = $request->input('name');
        $property = $request->input('property');
        $audience = $request->input('audience');
        $desc = $request->input('description');
        $cover = $request->file('cover');
        $status = $request->input('status');

        //get gallery property
        $property = EstateProperty::find($property);

        //check if image not null
        if (!empty($cover)) {

            //ext
            $fileExt = $cover->getClientOriginalExtension();

            //org name
            #TODO: Uncomment line below if you need to use original file name
//            $orgName = $cover->getClientOriginalName();

            //org path
            $orgPath = $cover->getRealPath();

            //mime
            #TODO: Uncomment line below if you need to use file mime
//            $mime = $cover->getMimeType();

            //new name
            $newName = md5(str_random(16)) . '.' . $fileExt;

            //directory
            $directory = config('settings.property_storage_gallery') . '/' . $property->id . '/' . 'covers';

            //thumb
            $thumbDir = $directory . '/thumbs';

            //create directories
            Storage::disk('common')->makeDirectory($directory);
            Storage::disk('common')->makeDirectory($thumbDir);

            //storage paths
            $path = public_path($directory);
            $thumbPath = public_path($thumbDir . '/' . $newName);

            //url paths
            $url = ($directory . '/' . $newName);
            $thumbUrl = ($thumbDir . '/' . $newName);

//            dd(array($cover->path(), $cover->getRealPath(), $orgPath));

            //resize and save thumbnail
            Image::make($orgPath)->resize(96, 96)->save($thumbPath);

            //save cover
            $cover->move($path, $newName);

        }

        //new gallery instance
        $gallery = new Gallery();
        $gallery->audience_id = $audience;
        $gallery->title = $title;
        $gallery->summary = $desc;
        $gallery->cover = $url;
        $gallery->thumbnail = $thumbUrl;
        $gallery->status = $status;

        //check if saved
        if ($property->galleries()->save($gallery)) {
            //redirect with success message
            //pass link name
            //pass success link route
            return redirect()->route('estate.rental.property.gallery.index', ['id' => $property->id])
                ->with('success', $title . ' gallery created.')
                ->with('link_name', 'Start adding photos')
                ->with('success_link', route('estate.rental.property.image.create', ['id' => $gallery->id]));
        }

        //error
        return redirect()->back()
            ->with('error', 'Failed creating gallery. Please try again!')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //gallery
        $gallery = Gallery::find($id);

        //check app
        if ($gallery == null)
            abort(404);

        //Property
        $property = $gallery->galleryable;

        //Property App
        $app = $property->app;

        //company
        $company = $app->company;

        if (auth()->check() && $this->authorize('view', $app)) {
            //photos
            $photos = $gallery->photos()->orderBy('created_at', 'DESC')->simplePaginate();
        } else {
            //photos
            $photos = $gallery->photos()->where('status', '1')->where('audience_id', '17')
                ->orderBy('created_at', 'DESC')->simplePaginate();
        }

        $_photos = $gallery->photos()->where('status', '1')->where('audience_id', '17')
            ->orderBy('created_at', 'DESC')->get();


        //country code
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        //authorize
//        $this->authorize('view', $app);

        //TODO: use for debug only
        //dd($property->prices()->where('status',1)->first());

        return view('v1.estates.properties.galleries.show')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('property', $property)
            ->with('photos', $photos)
            ->with('gallery_photos', $_photos)
            ->with('gallery', $gallery);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //gallery
        $gallery = Gallery::find($id);

        //check app
        if ($gallery == null)
            abort(404);

        //Property
        $property = $gallery->galleryable;

        //Property App
        $app = $property->app;

        //company
        $company = $app->company;

        //country code
        $code = ExtCountries::where('name.common', $company->country)->first()->callingCode[0];

        //currency sign or iso code
        $currency = ExtCountries::where('name.common', $company->country)->first()->currency;
        $currency = $currency[0]['sign'] != null ? $currency[0]['sign'] : $currency[0]['ISO4217Code'];

        //authorize
//        $this->authorize('view', $app);

        //TODO: use for debug only
        //dd($property->prices()->where('status',1)->first());

        return view('v1.estates.properties.galleries.edit')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('property', $property)
            ->with('gallery', $gallery);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreGalleryRequest $request, $id)
    {
        //on success-proceed

        //catch input
        $title = $request->input('name');
        $property = $request->input('property');
        $audience = $request->input('audience');
        $desc = $request->input('description');
        $cover = $request->file('cover');
        $status = $request->input('status');

        //get gallery property
        $property = EstateProperty::find($property);

        //gallery instance
        $gallery = Gallery::find($id);

        //check if image not null
        if (!empty($cover)) {

            //ext
            $fileExt = $cover->getClientOriginalExtension();

            //org name
            #TODO: Uncomment line below if you need to use original file name
//            $orgName = $cover->getClientOriginalName();

            //org path
            $orgPath = $cover->getRealPath();

            //mime
            #TODO: Uncomment line below if you need to use file mime
//            $mime = $cover->getMimeType();

            //new name
            $newName = md5(str_random(16)) . '.' . $fileExt;

            //directory
            $directory = config('settings.property_storage_gallery') . '/' . $property->id . '/' . 'covers';

            //thumb
            $thumbDir = $directory . '/thumbs';

            //create directories
            Storage::disk('common')->makeDirectory($directory);
            Storage::disk('common')->makeDirectory($thumbDir);

            //storage paths
            $path = public_path($directory);
            $thumbPath = public_path($thumbDir . '/' . $newName);

            //url paths
            $url = ($directory . '/' . $newName);
            $thumbUrl = ($thumbDir . '/' . $newName);

//            dd(array($cover->path(), $cover->getRealPath(), $orgPath));

            //resize and save thumbnail
            Image::make($orgPath)->resize(96, 96)->save($thumbPath);

            //save cover
            $cover->move($path, $newName);

            //pass cover url only if cover present
            $gallery->cover = $url;
            $gallery->thumbnail = $thumbUrl;

        }

        $gallery->audience_id = $audience;
        $gallery->title = $title;
        $gallery->summary = $desc;
        $gallery->status = $status;

        //check if saved
        if ($property->galleries()->save($gallery)) {
            //redirect with success message
            //pass link name
            //pass success link route
            return redirect()->route('estate.rental.property.gallery.show', ['id' => $gallery->id])
                ->with('success', $title . ' gallery updated.')
                ->with('link_name', 'Add photos to gallery')
                ->with('success_link', route('estate.rental.property.image.create', ['id' => $gallery->id]));
        }

        //error
        return redirect()->back()
            ->with('error', 'Failed updating gallery. Please try again!')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
