<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\Usery;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class UserController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(
            User::all()
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // validate input fields
        $request->validated($request->all());

        // validate user from database
        $user_exist = User::where('name', $request->name)->orwhere('email',$request->email)->orwhere('password', $request->password)->exists();
        if ($user_exist) {
            return $this->error('', 'Duplicate Entry', 400);
        }

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
        ]);


        // return message
        return $this->success('', 'Successfully Saved', 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreUserRequest $request, User $user)
    {
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();

        // $user->update($request->all());
        return new UserResource($user);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->success('', 'Successfully Deleted', 200);
    }
    public function search(Request $request)
    {
        $activePage = $request->activePage;
        $searchKeyword = $request->searchKeyword;
        $orderAscending = $request->orderAscending;
        $orderBy = $request->orderBy;
        $orderAscending  ? $orderAscending = "asc" : $orderAscending = "desc";
        $searchKeyword == null ? $searchKeyword = "" : $searchKeyword = $searchKeyword;
        $orderBy == null ? $orderBy = "id" : $orderBy = $orderBy;

        $data = UserResource::collection(
            User::where("id", "like", "%" . $searchKeyword . "%")
                ->orWhere("name", "like", "%" . $searchKeyword . "%")
                ->orWhere("email", "like", "%" . $searchKeyword . "%")
                ->orWhere("password", "like", "%" . $searchKeyword . "%")
                ->skip(($activePage - 1) * 10)
                ->orderBy($orderBy, $orderAscending)
                ->take(10)
                ->get()
        );
        $pages = User::where("id", "like", "%" . $searchKeyword . "%")
            -> orWhere("name", "like", "%" . $searchKeyword . "%")
            ->orWhere("email", "like", "%" . $searchKeyword . "%")
            ->orWhere("password", "like", "%" . $searchKeyword . "%")
            ->orderBy($orderBy, $orderAscending)
            ->count();

        return compact('pages', 'data');
    }
}
