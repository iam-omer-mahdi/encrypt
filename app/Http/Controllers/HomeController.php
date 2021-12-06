<?php

namespace App\Http\Controllers;

use App\Models\State;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\Qualification;
use Illuminate\Support\Facades\Crypt;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $memberships = Membership::all();
        $states = State::all();
        $qualifications = Qualification::all();

        return view('home', compact('memberships', 'states', 'qualifications'));
    }

    // Create
    public function create()
    {
        $states = State::all();
        $qualifications = Qualification::all();

        return view('create', compact('states', 'qualifications'));
    }

    // Store
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'sex' => 'required',
            'phone' => ['required',function ($attribute, $value, $fail) {
                $memberships = Membership::all();
                foreach ($memberships as $member) {
                    if(Crypt::decrypt($member->phone) == $value) {
                        $fail('رقم الهاتف مستعمل من قبل الرجاء استخدام رقم اخر');
                    }
                }
            }],
            'state_id' => 'required',
            'district' => 'required|string',
            'joining_date' => 'required|date',
            'qualification_id' => 'required',
            'national_number' => ['required','numeric',function ($attribute, $value, $fail) {
                $memberships = Membership::all();
                foreach ($memberships as $member) {
                    if(Crypt::decrypt($member->national_number) == $value) {
                        $fail('الرقم الوطني مستعمل من قبل الرجاء استخدام رقم اخر');
                    }
                }
            }],
            'form_number' => ['required','numeric',function ($attribute, $value, $fail) {
                $memberships = Membership::all();
                foreach ($memberships as $member) {
                    if(Crypt::decrypt($member->form_number) == $value) {
                        $fail('رقم الاستمارة مستعمل من قبل الرجاء استخدام رقم اخر');
                    }
                }
            }],
        ]);

        Membership::create([
            'name' => Crypt::encrypt($request->name),
            'age' => Crypt::encrypt($request->age),
            'sex' => Crypt::encrypt($request->sex),
            'phone' => Crypt::encrypt($request->phone),
            'state_id' => Crypt::encrypt($request->state_id),
            'district' => Crypt::encrypt($request->district),
            'joining_date' => Crypt::encrypt($request->joining_date),
            'qualification_id' => Crypt::encrypt($request->qualification_id),
            'national_number' => Crypt::encrypt($request->national_number),
            'form_number' => Crypt::encrypt($request->form_number),
        ]);

        return redirect()->route('home')->with('success', 'تمت اضافة العضوية بنجاح');
    }

    // Edit
    public function edit($id)
    {
        $membership = Membership::find($id);
        $states = State::all();
        $qualifications = Qualification::all();

        return view('edit', compact('membership', 'states', 'qualifications'));
    }

    // Update
    public function update(Request $request, $id)
    {
        $member = Membership::find($id);
        $id = $member->id;

        $request->validate([
            'name' => 'required|string',
            'age' => 'required|numeric',
            'sex' => 'required',
            'phone' => [
                'required',
                function ($attribute, $value, $fail) use($id) {
                    $memberships = Membership::all();
                    foreach ($memberships as $membership) {
                        if((Crypt::decrypt($membership->phone) == $value) && ($membership->id !== $id)) {
                            $fail('رقم الهاتف مستعمل من قبل الرجاء استخدام رقم اخر');
                        }
                    }
                },
            ],
            'state_id' => 'required',
            'district' => 'required|string',
            'joining_date' => 'required|date',
            'qualification_id' => 'required',
            'national_number' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use($id) {
                    $memberships = Membership::all();
                    foreach ($memberships as $membership) {
                        if((Crypt::decrypt($membership->national_number) == $value) && ($membership->id !== $id)) {
                            $fail('الرقم الوطني مستعمل من قبل الرجاء استخدام رقم اخر');
                        }
                    }
                },
            ],
            'form_number' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($id) {
                    $memberships = Membership::all();
                    foreach ($memberships as $membership) {
                        if((Crypt::decrypt($membership->form_number) == $value) && ($membership->id !== $id)) {
                            $fail('رقم الاستمارة مستعمل من قبل الرجاء استخدام رقم اخر');
                        }
                    }
                },
            ],
        ]);

        $member->name = Crypt::encrypt($request->name);
        $member->age = Crypt::encrypt($request->age);
        $member->sex = Crypt::encrypt($request->sex);
        $member->phone = Crypt::encrypt($request->phone);
        $member->state_id = Crypt::encrypt($request->state_id);
        $member->district = Crypt::encrypt($request->district);
        $member->joining_date = Crypt::encrypt($request->joining_date);
        $member->qualification_id = Crypt::encrypt($request->qualification_id);
        $member->national_number = Crypt::encrypt($request->national_number);
        $member->form_number = Crypt::encrypt($request->form_number);
        $member->save();

        return redirect()->route('home')->with('success', 'تمت تعديل العضوية بنجاح');
    }

    // Destroy
    public function destroy($id)
    {
        if (Membership::find($id)) {
            Membership::find($id)->delete();
        }

        return redirect()->route('home')->with('success', 'تم حذف العضوية بنجاح');
    }
}
