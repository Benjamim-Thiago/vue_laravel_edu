@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3>Listagem Usuários</h3>
        {!! Button::primary(Icon::create('pencil'). ' Novo Turma')->asLinkTo(route('admin.class_informations.create')) !!}
    </div>

    <div class="row">
        {!!
            Table::withContents($class_informations->items())
             ->striped()
             ->callback('Ações', function($field, $model){
                $linkEdit = route('admin.class_informations.edit', ['class_informations' => $model->id]);
                $linkShow = route('admin.class_informations.show', ['class_informations' => $model->id]);
                return 
                Button::link(Icon::create('pencil'). ' Editar')->asLinkTo($linkEdit) . ' | ' . 
                Button::link(Icon::create('folder-open'). '&nbsp;&nbsp;Ver')->asLinkTo($linkShow);
             })
        !!}
        <div align="center">
            {!! $class_informations->links() !!}
        </div>
    
    </div>
</div>   
@endsection
