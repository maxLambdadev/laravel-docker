<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Trainers;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainers = Trainers::with('user.courses')->get();
        
        return view('trainerslist', ['trainers' => $trainers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.trainer-register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'firstName' => ['required', 'string', 'max:255'],
            'lastName' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class, 'same:verify_email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'regex:/^(\+\d{1,3}(\s|)\(\d{3}\)(\s|)\d{3}(\s|)\d{4}|\+\d{1,3}(\s|)\d{3}(\s|)\d{3}(\s|)\d{4})$/'],
            'photo' => ['image','mimes:jpeg,png,jpg,gif','max:2048'],
            'jobTitle' => ['required', 'string', 'max:255'],
            'provider' => ['required', 'string', 'max:255'],
            'title' => ['string', 'max:255'],
        ]);

        $user = User::create([
            'title' => $request->title,
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $path = "";
        if($request->photo) {
            $path = $request->file('photo')->store('photos', 'public');
        }

        $trainer = Trainers::create([
            'user_id' => $user->id,
            'jobTitle' => $request->jobTitle,
            'provider' => $request->provider,
            'phone' => $request->phone,
            'photo' => $path,
            'bio' => $request->bio,
            'approved' => false
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $trainer = Trainers::with('user.courses')->where('id', $id)->get();
        return view('trainerdetail', ['trainer' => $trainer]);
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
    public function update(Request $request, string $id)
    {
        //
        if($request->mode == "approve"){
            $this->validate($request, [
                'approved' => 'boolean',
            ]);
            $item = Trainers::findOrFail($id);
            $item->update([
                'approved' => $request->approved
            ]);

            return redirect('trainers');
        }else {
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
