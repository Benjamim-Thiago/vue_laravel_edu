<?php

namespace BEN\Http\Controllers\Admin;

use BEN\Models\User;
use BEN\Forms\UserForm;
use Illuminate\Http\Request;
use BEN\Http\Controllers\Controller;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users = User::paginate(5);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $form = \FormBuilder::create(UserForm::class, [
                    'url' => route('admin.users.store'),
                    'method' => 'POST'
        ]);
        return view('admin.users.create', compact('form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $form = \FormBuilder::create(UserForm::class);
        if (!$form->isValid()) {
            return redirect()
                            ->back()
                            ->withErrors($form->getErrors())
                            ->withInput();
        }

        $data = $form->getFieldValues();
        $result = User::createFully($data);

        session()->flash('message', 'Usuário criado com sucesso');
        $request->session()->flash('user_created', [
            'id' => $result['user']->id,
            'password' => $result['password']
        ]);
        //return redirect()->route('admin.users.index');
        return redirect()->route('admin.users.show_details');
    }

    public function showDetails()
    {
        $userData = session('user_created');
        $user = User::findOrFail($userData['id']);
        $user->password = $userData['password'];
        return view('admin.users.show_details', compact('user'));
    }
    /**
     * Display the specified resource.
     *
     * @param  \BEN\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user) {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \BEN\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user) {
        $form = \FormBuilder::create(UserForm::class, [
                    'url' => route('admin.users.update', $user->id),
                    'method' => 'PUT',
                    'model' => $user
        ]);
        return view('admin.users.edit', compact('form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \BEN\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user) {
        $form = \FormBuilder::create(UserForm::class, [
                    'data' => ['id' => $user->id]
        ]);

        if (!$form->isValid()) {
            return redirect()
                            ->back()
                            ->withErrors($form->getErrors())
                            ->withInput();
        }

        $data = $form->getFieldValues();
        $user->update($data);

        session()->flash('message', 'Usuário editado com sucesso');
        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \BEN\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user) {
        $user->delete();
        session()->flash('message', 'Usuário excluído com sucesso');
        return redirect()->route('admin.users.index');
    }

}
