@extends('dashboard.layouts.master')
@section('title', 'Categories')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
@endsection


@section('content')

<x-alert type="success" />
<x-alert type="danger" />

<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" placeholder="Name" class="mx-2" :value="request('name')"/>
    <select name="status" class="form-control mx-2">
        <option value="">All</option>
        <option value="active" @selected(request('status') == 'active')>Active</option>
        <option value="archived"  @selected(request('status') == 'archived')>Archived</option>
    </select>
    <button class="btn btn-dark mx-2">Filter</button>
</form>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Parent</th>
            <th>Product #</th>
            <th>status</th>
            <th>Image</th>
            <th>Created At</th>
            <th colspan="2">Action</th>

        </tr>
    </thead>
    @forelse ($categories as $category)
    <tbody>
        <tr>
            <td>{{ $category->id }}</td>
            <td> <a href="{{route('dashboard.categories.show',$category->id)}}"> {{ $category->name }}</a></td>
            <td>{{ $category->parent->name }}</td>
            <td>{{ $category->products_number }}</td>
            <td>{{ $category->status }}</td>
            <td><img src="{{ asset('storage/' . $category->image) }}" height="50"></td>
            <td>{{ $category->created_at }}</td>
            <td>
                <a href="{{ route('dashboard.categories.edit', $category->id) }}" class="btn btn-outline-success">Edit</a>
            </td>
            <td>
                <form action="{{ route('dashboard.categories.destroy', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    </tbody>

    @empty
    <td colspan="9">No categories defined..</td>
    @endforelse
</table>
{{$categories->withQueryString()->appends(['search' => 1])->links()}}
@endsection
