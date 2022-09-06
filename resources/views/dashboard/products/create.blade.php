@extends('dashboard.layouts.master')
@section('title', 'Create Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Product / Create</li>
@endsection


@section('content')
    <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @include('dashboard.products._form',[
'button_lable' => 'Add'
            ])
    </form>

@endsection
