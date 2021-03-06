<?php

namespace App\Http\Controllers;

use App\Helpers\HttpResponseHelper;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    protected  $user;
    protected $baseUrl;
    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->user = new User();
        $this->baseUrl = $urlGenerator->to('/');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
       return view('home');
    }


    public function userList()
    {
        //
        $url = $this->baseUrl."".Storage::url('public/profile/');
        $itemPerPage = 3;
        $data = $this->user->allPaginatedUsers($itemPerPage);
        return view('userList',[
            'data'=>$data,
            'url'=>$url
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        //
        return view('createUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateUserRequest $request)
    {
        $request->validated();
        $this->user->createUser($request);
       return  HttpResponseHelper::Response(true,'User Created Successfully',NULL,200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        //
        $data = $this->user->getAccountDetails($id);
        return view('privateProfile',
            [
            'profile'=>$data
           ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        //
        $url = $this->baseUrl."".Storage::url('public/profile/');
        $data = $this->user->getAccountDetails($id);
        return view('editUserView',[
            'data'=>$data,
            'url'=>$url
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EditUserRequest $request, $id)
    {
        //
        $request->validated();

        if($request->hasFile('file'))
        {
            $file = $request->file('file');
            $ext = $file->extension();
            $newName = time()."-".rand(0,9999);
            $filename = $newName.".".$ext;
            $data = $this->user->getAccountDetails($id);
            /**
             * delete file if it already exists
             */
            $data->pic=='default.png'?NULL : Storage::delete('/public/profile/'.$data->pic);
            $file->storeAs('/public/profile/', $newName.'.' . $ext,['disk' => 'local']);
            $this->user->adminUpdateUserData($request,$id,$filename);
            return HttpResponseHelper::Response(true,'User Profile Updated Successfully',
                NULL,200);
        }

        $this->user->adminUpdateUserData($request,$id,NULL);
        return HttpResponseHelper::Response(true,'User Profile Updated Successfully',[],200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $data = $this->user->getAccountDetails($id);
        /**
         * delete file if it already exists
         */
        $data->pic=='default.png'? NULL : Storage::delete('/public/profile/'.$data->pic);
      $deleted =  $this->user->deleteUser($id);
      if($deleted)
      {

          return  HttpResponseHelper::Response(true,
              'User deleted Successfully',NULL,200);

      }

        return  HttpResponseHelper::Response(true,
            'Delete Action Failed',NULL,422);

    }


}
