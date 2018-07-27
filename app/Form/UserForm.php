<?php

namespace BEN\Form;

use Kris\LaravelFormBuilder\Form;

class UserForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text',[
                'label'=>'Nome',
                'rules' => 'required|string|max:255'
            ])
            ->add('email', 'email', [
                'label'=>'E-mail',
                 'rules' => 'required|string|email|max:255|unique:users'
            ]);
    }
}
