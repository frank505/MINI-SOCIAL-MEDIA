<?php

namespace App\Http\Controllers;

use App\Helpers\HttpResponseHelper;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\EditBioMessageRequest;
use App\Http\Requests\ProfilePictureRequest;
use App\Http\Requests\ProfileStatusRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\UrlGenerator;

class ProfileController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $user;
    public $url;

    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->middleware(['auth','verified']);
        $this->user = new User();
        $this->url = $urlGenerator->to('/');
    }


    public function profilePictureView()
    {
        $id = Auth::user()->id;
        $data = $this->user->getAccountDetails($id);
        $pic = $data->pic=='default.png'? 'default.png':$this->url."".Storage::url('public/profile/'.$data->pic);
        return view('profilePicture',
            [
                "details"=>$pic
            ]);
    }


    public function editProfilePicture(ProfilePictureRequest $request)
    {
     $request->validated();
     $file = $request->file("file");
     $ext = $file->extension();
     $newName = time()."-".rand(0,9999);
     $filename = $newName.".".$ext;
     $id = Auth::user()->id;
     $data = $this->user->getAccountDetails($id);
     /**
     * delete file if it already exists
      */
     $data->pic=='default.png'?NULL : Storage::delete('/public/profile/'.$data->pic);
     $file->storeAs('/public/profile/', $newName.'.' . $ext,['disk' => 'local']);
     $this->user->updateProfilePictureName($filename,$id);
     return HttpResponseHelper::Response(TRUE,'Profile Changed Successfully',NULL, 200);
    }


    public function bioMessageView()
    {
        $id = Auth::user()->id;
        $data = $this->user->getAccountDetails($id);
        return view('bioMessage',[
            'message'=>$data->bio
        ]);
    }


    public function editBioMessage(EditBioMessageRequest $request)
    {
      $request->validated();
      $id = Auth::user()->id;
      $this->user->editBioMessage($request->message,$id);
      return HttpResponseHelper::Response(TRUE,'Bio Message Edited Successfully',NULL,200);
    }


    public function changePasswordView()
    {
        return view('changePassword');
    }


    public function changePassword(ChangePasswordRequest $request)
    {
        $request->validated();
        $id = Auth::user()->id;
        $hashPassword = Hash::make($request->password);
         $this->user->changePassword($hashPassword,$id);
        return HttpResponseHelper::Response(TRUE,'Password was changed successfully',
            NULL,200);

    }


   public function displayProfileStatusView()
   {
       $id = Auth::user()->id;
       $data = $this->user->getAccountDetails($id);
       return view('profileStatus',
           [
               "profile_status"=>$data->pvt
           ]);
   }


   public function editProfileStatus(ProfileStatusRequest $request)
   {
       $request->validated();
       $id = Auth::user()->id;
       $this->user->editProfileStatus($request->profile_status,$id);
       return HttpResponseHelper::Response(TRUE,'Profile status changed successfully',
           NULL,200);
   }


}
