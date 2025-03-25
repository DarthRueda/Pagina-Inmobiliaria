<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show($id)
    {
        try {
            // Fetch user data by ID
            $user = User::findOrFail($id);

            // Log user data
            \Log::info('User data fetched successfully:', $user->toArray());

            // Return user data as JSON
            return response()->json($user);
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error fetching user data:', ['error' => $e->getMessage()]);

            // Return error response
            return response()->json(['error' => 'User not found or an error occurred'], 404);
        }
    }
}