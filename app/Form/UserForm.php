<?php

namespace BEN\Form;

use Kris\LaravelFormBuilder\Form;
use \Illuminate\Validation\Rule;

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
        ]);
    }

}
