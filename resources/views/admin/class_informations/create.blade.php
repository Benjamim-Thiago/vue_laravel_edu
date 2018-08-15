@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Novo Usuário</h3>
            {!!
                form($form->add('insert', 'submit', [
                    'attr' => ['class' => 'btn btn-success btn-block'],
                    'label' => Icon::create('floppy-disk'). '&nbsp;&nbsp;Inserir'
                ]))
            !!}
        </div>
    </div>
    <br>
</div>   
@endsection
