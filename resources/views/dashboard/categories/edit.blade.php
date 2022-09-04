@extends('dashboard.layouts.master')
@section('title', 'Edit Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories / Edit</li>
@endsection


@section('content')
    <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('dashboard.categories._form',[
            'button_lable' => 'Update'
        ])
    </form>

@endsection
