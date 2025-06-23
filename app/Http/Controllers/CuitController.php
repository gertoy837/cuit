<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CuitController extends Controller
{
    // SELECT id.posts, user_id.posts, content.posts, name.users LEFT JOIN ..
    public function index(): View
    {
        $posts = Post::with('user')->latest()->get();

        return view('home', compact('posts'));
    }

    public function post(Request $request): RedirectResponse
    {
        Post::create([
            'user_id' => Auth::id(),
            'content' => $request->content, 
        ]);

        return redirect('/')->with('success', 'Your post has been saved!');
    }
}
