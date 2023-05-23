<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use App\Jobs\ProcessDiscountsJob;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class UserController extends Controller
{
    public function getUser(Request $request)
    {
        return $request->user();
    }
    public function getAllUsers(Request $request)
    {
        $users = User::all();
        return response()->json($users);
    }
}
