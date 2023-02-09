<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::query();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('nama', function ($row) {
                    $name = $row->name;
                    return $name;
                })
                ->addColumn('email', function ($row) {
                    $email = $row->email;
                    return $email;
                })
                ->addColumn('action', function ($row) {
                    $action =  '<a class="btn btn-sm btn-warning modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="' . action('UserController@edit', $row->id) . '"  data-toggle="tooltip" data-placement="top" title="Edit" >Edit</a>';
                    $action = $action .  '<a class="btn btn-sm btn-danger hapus ml-2" href="Javascript:void(0)"   data-url="' . action('UserController@destroy', $row->id) . '"  data-toggle="tooltip" data-placement="top" title="Edit" >Hapus</a>';

                    return $action;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('user.index');
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserPostRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        User::create($data);
        toastr()->success('Data Tersimpan', 'Berhasil');
        return redirect()->action('UserController@index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    public function update(UserPostRequest $request, $id)
    {
        $data = $request->validated();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($data['password']);
        }
        User::where('id', $id)->update(array_filter($data));
        toastr()->success('Data Tersimpan', 'Berhasil');
        return redirect()->action('UserController@index');
    }


    public function destroy($id)
    {
        $data = User::where('id', $id)->first();
        $data->delete();
        $result['code'] = '200';
        return response()->json($result);
    }
}
