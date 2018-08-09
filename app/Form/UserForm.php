<?php

namespace BEN\Form;

use BEN\Models\User;
use \Illuminate\Validation\Rule;
use Kris\LaravelFormBuilder\Form;

class UserForm extends Form {

    public function buildForm() {
        $id = $this->getData('id');
        //dd($id);
        $this
            ->add('name', 'text', [
                'label' => 'Nome',
                'rules' => 'required|max:255'
            ])
            ->add('email', 'email', [
                'label' => 'E-mail',
                'rules' => ['required','string','email','max:255', Rule::unique('users')->ignore($id)]
            ])
            ->add('type', 'select', [
                'label' => 'Tipo de Usuário',
                'choices' => roles(),
                'rules' => 'required|in:' . implode(',', array_keys($this->roles()))
            ])
            ->add('send_mail','checkbox', [
                'label' => 'Enviar e-mail de boas-vindas',
                'value' => true,
                'checked' => false
            ]);
    }

    protected function roles(){
        return [
            User::ROLE_ADMIN => 'Administrador',    
            User::ROLE_TEACHER => 'Professor',    
            User::ROLE_STUDENT => 'Estudante'
        ];
    }

}
