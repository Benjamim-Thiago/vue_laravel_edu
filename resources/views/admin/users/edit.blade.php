@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>Editar Usuário</h3>
        {!!
            form($form->add('insert', 'submit', [
                'attr' => ['class' => 'btn btn-primary btn-block'],
                'label' => 'Edit'
            ]))
        !!}
    </div>
</div>   
@endsection
