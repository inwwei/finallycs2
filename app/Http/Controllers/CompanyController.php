<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
       $company = Company::where('user_id',$user->id)->get();
       if (!$company) {
        return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
    }
    return response()->success($company->toArray(), [], '0',  200);
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
        $datas = $request->validate([
            'id' => 'sometimes',
            'name' => 'sometimes',
            'identification_number' => 'sometimes',
            'username' => 'sometimes',
            'email' => 'required',
            'password' => 'sometimes',
            'email'=> 'sometimes',
            'branch'=>'sometimes',
            'ceo_firstname'=> 'sometimes',
            'ceo_lastname'=> 'sometimes',
            'company_tel'=> 'sometimes',
            'ceo_tel'=> 'sometimes',
            'amphoe'=> 'sometimes',
            'district'=> 'sometimes',
            'province'=> 'sometimes',
            'postal_code'=> 'sometimes',
            'lat'=> 'sometimes',
            'lng'=> 'sometimes',
            'role'=> 'sometimes',
        ]);
        $datas['user_id'] = Auth::user()->id;

        $company = Company::create($datas);
        if (!$company) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }

        return response()->success($company->toArray(), [], '0',  200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $query = Company::find($id);
        return response()->success($query, [], '0',  200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datas = $request->validate([
            'id' => 'sometimes',
            'name' => 'sometimes',
            'identification_number' => 'sometimes',
            'username' => 'sometimes',
            'email' => 'required',
            'password' => 'sometimes',
            'email'=> 'sometimes',
            'branch'=>'sometimes',
            'ceo_firstname'=> 'sometimes',
            'ceo_lastname'=> 'sometimes',
            'company_tel'=> 'sometimes',
            'ceo_tel'=> 'sometimes',
            'amphoe'=> 'sometimes',
            'district'=> 'sometimes',
            'province'=> 'sometimes',
            'postal_code'=> 'sometimes',
            'lat'=> 'sometimes',
            'lng'=> 'sometimes',
            'role'=> 'sometimes',
        ]);
        $datas['user_id'] = Auth::user()->id;
        $company = Company::where('id',$datas['id'])->update($datas);
        if (!$company) {
            return response()->error(['ไม่พบข้อมูลพนักงาน'], '40');
        }

        return response()->success($company, [], '0',  200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->error(['ไม่พบข้อมูลสินค้าที่ต้องการ'], '40');
        }
        $result = $company->delete();
        if (!$result) {
            return response()->error(['ทำการลบไม่สำเร็จ'], '40');
        }
        return response()->success($company->toArray(), [], '0', 200);
    }
}
