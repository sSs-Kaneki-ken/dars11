<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function main()
    {
        $users = User::orderBy('id', 'DESC')
            ->paginate(10);

        return view('users.user', ['users' => $users]);
    }

    public function store(UserStoreRequest $request)
    {
        $data = $request->all();


        User::create($data);

        return redirect('/')->with('check', ['Успешно добавлено данные', 'success']);
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());

        return redirect()->route('user.main')->with('check', ['Успешно обновлено данные', 'primary']);
    }
    public function delete(User $id)
    {
        $id->delete();
        return redirect()->redirect('user.main')->with('check', ['Успешно удалено данные', 'danger']);
    }

    public function search(Request $request)
    {
        $users = User::where('name', 'LIKE','%'. $request->search .'%')
            ->orderBy('id', 'DESC')
            ->paginate(10);

        return view('users.user', ['users' => $users]);
    }
    public function deleteAll()
    {
        User::query()->delete();
        return redirect()->route('user.main')->with('check', ['Успешно удалено все данные!', 'danger']);
    }
}
