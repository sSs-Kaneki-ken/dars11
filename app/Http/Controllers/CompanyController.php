<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyStoreRequest;
use App\Http\Requests\CompanyUpdateRequest;

use App\Models\Company;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function main()
    {
        $companies = Company::leftJoin('users', 'companies.user_id', '=', 'users.id')
            ->select('companies.*', 'users.name as user_name', 'users.id as user_id')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $users = User::all();

        return view('companies.company', compact('companies', 'users'));
    }

    public function store(CompanyStoreRequest $request)
    {
        $data = $request->all();

        $data['is_active'] = 0;

        Company::create($data);

        return redirect()->route('company.main')->with('check', ['Успешно добавлено данные', 'success']);
    }
    public function update(CompanyUpdateRequest $request, Company $company)
    {
        $updatedData = $request->all();

        $updatedData['name'] = !empty($request['name']) ? $request['name'] : $company->name;
        $updatedData['phone'] = !empty($request['phone']) ? $request['phone'] : $company->phone;

        $company->update($updatedData);

        return redirect()->route('company.main')->with('check', ['Успешно обновлено данные', 'primary']);
    }

    public function search(Request $request)
    {
        $companies = Company::leftJoin('users', 'companies.user_id', '=', 'users.id')
            ->select('companies.*', 'users.name as user_name', 'users.id as user_id')
            ->where('companies.name','LIKE','%'.$request->search.'%')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        $users = User::all();

        return view('companies.company', compact('companies', 'users'));
    }
    
    public function deleteAll()
    {
        Company::query()->delete();
        return redirect()->route('company.main')->with('check', ['Успешно удалено все данные!', 'danger']);
    }

    public function delete(Company $id)
    {
        $id->delete();
        return redirect('/companies')
            ->with('check', ['Успешно удалено данные', 'danger']);
    }
}
