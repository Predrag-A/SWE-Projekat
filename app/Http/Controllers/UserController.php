<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\User;
use Auth;

class UserController extends Controller
{

    /*
     * Sprecava pristup korisnicima koji nisu prijavljeni. 
     * Ako nekom pogledu treba da se dozvoli pristup:
     * $this->middleware('auth', ['except' => ['index', 'show']]);
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {        
        $users =  User::orderBy('first_name','asc')->paginate(10);
        return view('pages.users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('pages.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //U slucaju da neko pokusa preko direktnog linka da izvrsi izmenu
        if(auth()->user()->id != $id){
            $users =  User::orderBy('first_name','asc')->paginate(10);
            return redirect('/korisnici')->with(array('error' => 'Nije moguće izmeniti tuđi nalog!', 'users' => $users));
        }

        $user = User::find($id);
        return view('pages.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'img' => 'image|nullable|max:1999'
        ]);

        // Hendlovanje uploada
        if($request->hasFile('img')){

            // Uzimanje imena fajla sa ekstenzijom
            $fileNameWithExt = $request->file('img')->getClientOriginalName();
            // Samo ime fajla
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // Samo ekstenzija
            $extension = $request->file('img')->getClientOriginalExtension();
            // Ime za cuvanje, ovako se radi zbog duplikata
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // Upload slike
            $path = $request->file('img')->storeAs('public/avatars', $fileNameToStore);            
        }

        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        if($request->hasFile('img')){
            // Brisanje prethodne slike iz memorije
            if($user->user_img !== 'default.jpg'){
                Storage::delete('public/avatars/' . $user->user_img);
            }            
            $user->user_img = $fileNameToStore;
        }

        $user->save();

        return redirect('/korisnici'. '/' . $user->id)->with('success', 'Uspešna izmena naloga!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
