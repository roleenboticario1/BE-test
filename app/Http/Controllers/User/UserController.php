<?php

namespace App\Http\Controllers\User; 

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\UserRequest;
use App\Services\geoPlgin\geoPlginServices;
use App\Http\Resources\User\UserResourceCollection;
use App\Http\Resources\User\UserResource;

class UserController extends Controller
{   
    public function index(){

        $user = User::all();

        return response()->json([
            'message' => 'User successfully Fetched.',
            'details' =>  new UserResourceCollection($user)
        ], 200);
    }

    public function store(UserRequest $request){

        $data = $request->validated();

        $name =  $data['name'];
        $email =  $data['email'];
        $ip_address =  $data['ip_address'];

        $geo = new geoPlginServices;
        $geoData = $geo->getCountryAndCity($ip_address);

        $user = new User;
        $user->name = $name;
        $user->email = $email;
        $user->ip_address = $ip_address;
        $user->city = $geoData['geoplugin_city'];
        $user->country = $geoData['geoplugin_countryName'];
        $user->save();

        return response()->json([
            'message' => 'User successfully saved.',
        ], 201);
    }

    public function show($id){

        $user = User::find($id);

        if(!$user){
            return response()->json([
                'message' => 'User not found.',
            ], 404); 
        }

        return response()->json([
            'message' => 'User successfully Fetched.',
            'details' =>  UserResource::make($user)
        ], 200);
    }
}
