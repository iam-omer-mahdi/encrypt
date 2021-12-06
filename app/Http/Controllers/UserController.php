<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct ()
    {
        return $this->middleware(['can:not-user'])->except('changePass','updatePass');
        return $this->middleware(['auth'])->only('changePass','updatePass');
    }

    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'username' => 'required|string|unique:users',
            'email' => 'email|unique:users|nullable',
            'phone' => 'unique:users|min:10|nullable',
            'role' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('users.index')->with(['success' => 'تمت اضافة المستخدم بنجاح']);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => 'required',
            'username' => ['required','string', Rule::unique('users')->ignore($user->id)],
            'email' => ['email', Rule::unique('users')->ignore($user->id),'nullable'],
            'phone' => [Rule::unique('users')->ignore($user->id),'min:10','nullable'],
            'role' => 'required',
        ]);

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')->with(['success' => 'تم تعديل المستخدم بنجاح']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('users.index')->with(['success' => 'تم حذف المستخدم بنجاح']);
    }

    public function changePass($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return redirect()->route('home')->with(['error' => 'ليس لديك الصلاحية لعمل هذا الاجراء']);
        }
        if ($user->id == auth()->user()->id) {
            return view('auth.changePass', compact('user'));
        } else {
            return redirect()->route('home')->with(['error' => 'ليس لديك الصلاحية لعمل هذا الاجراء']);
        }
    }

    public function updatePass(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'password' => 'required|confirmed|min:6',
            'old_password' => 'required',
        ]);

        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->route('home')->with(['success' => 'تم تعديل كلمة المرور بنجاح']);
        } else {
            return redirect()->back()->with(['error' => 'كلمة المرور غير صحيحة']);
        }
    }
}
