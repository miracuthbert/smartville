<?php

namespace App\Http\Controllers\User;

use App\Avatar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Image;

class AvatarController extends Controller
{

    /**
     * AvatarController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * AvatarController avatar.
     * Handles User Avatar Upload View
     * */
    public function avatar()
    {
        //user
        $user = Auth::user();

        //avatars
        $avatars = $user->avatars()->latest()->get();

        return view('v1.user.avatar.upload')
            ->with('avatars', $avatars);
    }

    /**
     * AvatarController store.
     * @param Request $request
     * Handles User Avatar Upload and Storing To DB
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,jpg,png,gif',
            'type' => 'required',
            'data-alt' => 'required',
        ]);

        //grab
        $image = $request->file('image');
        $type = $request->input('type');
        $alt = $request->input('data-alt');
        $user = Auth::user();

        //ext
        $fileExt = $image->getClientOriginalExtension();

        //org name
        $orgName = $image->getClientOriginalName();

        //org path
        $orgPath = $image->getRealPath();

        //mime
        $mime = $image->getMimeType();

        //new name
        $newName = md5(str_random(16)) . '.' . $fileExt;

        //directory
        $directory = config('settings.avatar_storage_user') . '/' . $user->id;

        //thumb
        $thumbDir = config('settings.avatar_storage_user') . '/' . $user->id . '/' . 'thumbs';

        //create directories
        Storage::disk('common')->makeDirectory($directory);
        Storage::disk('common')->makeDirectory($thumbDir);

        //storage paths
        $path = public_path($directory . '/' . $newName);
        $thumbPath = public_path($thumbDir . '/' . $newName);

        //url paths
        $url = ($directory . '/' . $newName);
        $thumbUrl = ($thumbDir . '/' . $newName);

        //image data
        $data = [
            'url' => $url,
            'thumbUrl' => $thumbUrl,
            'alt' => $alt,
            'mime' => $mime,
            'tag' => 'profile; logo; avatar;',
            'description' => 'user profile picture',
            'gallery' => 'profile pictures',
        ];

        //debug
//        dd([$newName, $type, $data]);

        //resize
        Image::make($orgPath)->resize(468, 249)->save($path);
        Image::make($orgPath)->resize(96, 96)->save($thumbPath);

        //save
        $avatar = new Avatar();
        $avatar->name = $newName;
        $avatar->type = $type;
        $avatar->data = $data;
        $avatar->status = 1;

        //debug
//        dd($avatar);

        if ($user->avatars()->save($avatar)) {
            //catch id
            $id = $avatar->id;

            //disable previous logo
            $user->avatars()->where('id', '<>', $id)->where('status', 1)->update(['status' => 0]);

            return redirect()->route('user.profile')
                ->with('success', 'User profile picture uploaded successfully.');
        } else {

            return redirect()->back()
                ->with('error', 'user profile picture upload failed. No changes made.');
        }

    }

    /**
     * AvatarController update.
     * @param $id
     * @return mixed
     * Handles User Avatar Update and Swapping of Avatar
     */
    public function update($id)
    {
        //avatar
        $avatar = Avatar::find($id);

        if ($avatar == null)
            abort(401);

        //user
        $user = $avatar->avatarable;

        if ($avatar->update(['status' => 1])) {

            //disable previous logo
            $user->avatars()->where('id', '<>', $id)->where('status', 1)->update(['status' => 0]);

            return redirect()->back()
                ->with('success', 'Your profile picture has been changed successfully.');
        }

        //error
        return redirect()->back()
            ->with('error', 'Profile picture swapping failed. No changes made.');
    }

    /**
     * AvatarController delete.
     * @param $id
     * @return mixed
     * Handles User Avatar Deletion
     */
    public function delete($id)
    {
        if (Avatar::destroy($id))
            return redirect()->back()
                ->with('success', 'Image deleted successfully.');

        return redirect()->back()
            ->with('error', 'Sorry, image deletion failed. Please try again.');
    }

}
