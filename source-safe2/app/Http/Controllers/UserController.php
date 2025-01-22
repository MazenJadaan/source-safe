<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getAll();
        return response()->json($users);
    }

    public function show($id)
    {
        $user = $this->userService->findById($id);
        return $user ? response()->json($user) : response()->json(['message' => 'User not found'], 404);
    }
    public function showNotifications()
{
    $notifications = Auth::user()->notifications; // Or unreadNotifications
    return view('notifications.index', compact('notifications'));
}
public function markAllAsRead()
{
    Auth::user()->unreadNotifications->markAsRead();
    return redirect()->route('showNotifications');
}



}
