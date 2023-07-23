<?php 
 
namespace App\Http\Controllers; 
 
use App\User; 
use Illuminate\Http\Request; 
use Hash; 
 
class UserController extends Controller 
{ 
    /** 
     * Display a listing of the resource. 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function index() 
    { 
        $user = User::all(); 
 
        return view('user.index',compact('user')); 
    } 
 
    /** 
     * Show the form for creating a new resource. 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function create() 
    { 
        return view('user.create'); 
    } 
 
    /** 
     * Store a newly created resource in storage. 
     * 
     * @param  \Illuminate\Http\Request  $request 
     * @return \Illuminate\Http\Response 
     */ 
    public function store(Request $request) 
    { 
        $request->validate([ 
            'name' => 'required', 
            'email' => 'required',  
            'password' => 'required' 
         
        ]); 
 
        User::create($request->all()); 
    
        return redirect()->route('user.index') 
                        ->with('success','User created successfully.'); 
    } 
 
    /** 
     * Display the specified resource. 
     * 
     * @param  \App\User  $user 
     * @return \Illuminate\Http\Response 
     */ 
    public function show(User $user) 
    { 
        return view('user.show',compact('user')); 
    } 
 
    /** 
     * Show the form for editing the specified resource. 
     * 
     * @param  \App\User  $user 
     * @return \Illuminate\Http\Response 
     */ 
    public function edit(User $user) 
    { 
        return view('user.edit',compact('user')); 
    } 
 
    /** 
     * Update the specified resource in storage. 
     * 
     * @param  \Illuminate\Http\Request  $request 
     * @param  \App\User  $user 
     * @return \Illuminate\Http\Response 
     */ 
    public function update(Request $request, User $user) 
    { 
        $request->validate([ 
            'name' => 'required', 
            'email' => 'required', 
            'icNo' => 'required', 
            'phoneNo' => 'required', 
            'password' => 'required', 
        ]); 
   
        $user->update($request->all()); 
   
        return redirect()->route('user.index') 
                        ->with('success','User updated successfully'); 
    } 
 
    /** 
     * Remove the specified resource from storage. 
     * 
     * @param  \App\User  $user 
     * @return \Illuminate\Http\Response 
     */ 
    public function destroy(User $user) 
    { 
        $user->delete(); 
   
        return redirect()->route('user.index') 
                        ->with('success','User deleted successfully'); 
    } 
}
