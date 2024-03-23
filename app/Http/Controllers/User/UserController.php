<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponse;

    private $users;

    public function __construct()
    {   
        $this->users = new User();
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->users->all();

        return $this->showAll($users, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $users = $this->users->findOrFail($id);

        return $this->showOne($users, 200);
    }
}
