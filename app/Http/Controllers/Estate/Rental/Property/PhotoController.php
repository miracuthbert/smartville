<?php

namespace App\Http\Controllers\Estate\Rental\Property;

use App\Http\Requests\Estate\Rental\Property\StorePhotoRequest;
use App\Models\Image\Gallery;
use App\Models\Image\Photo;
use App\Models\v1\Estate\EstateProperty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use ExtCountries;
use Illuminate\Support\Facades\Storage;
use Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        //gallery
        $gallery = Gallery::find($id);

        //Property
        $property = $gallery->galleryable;

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

        return view('v1.estates.properties.photos.create')
            ->with('app', $app)
            ->with('code', $code)
            ->with('currency', $currency)
            ->with('company', $company)
            ->with('property', $property)
            ->with('gallery', $gallery);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StorePhotoRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePhotoRequest $request)
    {
        //on validation success

        //catch input
        $caption = $request->input('caption');
        $property = $request->input('property');
        $gallery = $request->input('gallery');
        $audience = $request->input('audience');
        $desc = $request->input('description');
        $location = $request->input('location');
        $photo = $request->file('photo');
        $status = $request->input('status');
        $data = [];

        //property
        $property = EstateProperty::find($property);

        //gallery
        $gallery = Gallery::find($gallery);

        //resize image
        if (!empty($photo)) {

            //ext
            $fileExt = $photo->getClientOriginalExtension();
            $data = array_add($data, 'extension', $fileExt);

            //org name
            #TODO: Uncomment line below if you need to use original file name
//            $orgName = $photo->getClientOriginalName();

            //org path
            $orgPath = $photo->getRealPath();

            //mime
            #TODO: Uncomment line below if you need to use file mime
            $mime = $photo->getMimeType();
            $data = array_add($data, 'mime', $mime);

            //new name
            $newName = md5(str_random(16)) . '.' . $fileExt;
            $data = array_add($data, 'new_name', $newName);     //store new name to data

            //directory
            $directory = config('settings.property_storage_gallery') . '/' . $property->id . '/' . 'photos';

            //thumb
            $thumbDir = $directory . '/thumbs';

            //shelf
            $shelfDir = $directory . '/shelf';

            //create directories
            Storage::disk('common')->makeDirectory($directory);
            Storage::disk('common')->makeDirectory($shelfDir);
            Storage::disk('common')->makeDirectory($thumbDir);

            //storage paths
            $path = public_path($directory);
            $shelfPath = public_path($shelfDir . '/' . $newName);
            $thumbPath = public_path($thumbDir . '/' . $newName);

            //url paths
            $url = ($directory . '/' . $newName);
            $shelfUrl = ($shelfDir . '/' . $newName);
            $thumbUrl = ($thumbDir . '/' . $newName);

            //store shelf url to data
            $data = array_add($data, 'shelfUrl', $shelfUrl);     //store shelf url

            //resize and save thumbnail
            Image::make($orgPath)->resize(96, 96)->save($thumbPath);
            Image::make($orgPath)->resize(356, 280)->save($shelfPath);

            //save photo
            $photo->move($path, $newName);

        }

        //new photo init
        $photo = new Photo();
        $photo->audience_id = $audience;
        $photo->description = $desc;
        $photo->location = $location;
        $photo->caption = $caption;
        $photo->status = $status;

        //pass photo url only if photo present
        $photo->photo = $url;
        $photo->thumbnail = $thumbUrl;

        //photo data
        $photo->data = $data;

        //check if saved
        if ($gallery->photos()->save($photo)) {
            //redirect with success message
            //pass link name
            //pass success link route
            return redirect()->route('estate.rental.property.gallery.show', ['id' => $gallery->id])
                ->with('success', $caption . ' added to gallery.')
                ->with('link_name', 'Add more photos to gallery')
                ->with('success_link', route('estate.rental.property.image.create', ['id' => $gallery->id]));
        }

        //on error
        return redirect()->back()
            ->with('error', 'Failed adding photo to gallery. Please try again!')->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
