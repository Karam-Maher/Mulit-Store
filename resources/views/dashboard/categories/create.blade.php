@extends('dashboard.layouts.master')
@section('title', 'Create Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories / Create</li>
@endsection


@section('content')
    <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.categories._form',[
'button_lable' => 'Add'
            ])
    </form>

@endsection
