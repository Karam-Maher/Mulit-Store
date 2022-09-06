@extends('dashboard.layouts.master')
@section('title', 'Trash Categories')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">Trash</li>
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
            <th>status</th>
            <th>Image</th>
            <th>Deleted At</th>
            <th colspan="2">Action</th>

        </tr>
    </thead>
    @forelse ($categories as $category)
    <tbody>
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->status }}</td>
            <td><img src="{{ asset('storage/' . $category->image) }}" height="50"></td>
            <td>{{ $category->deleted_at }}</td>
            <td>
            <form action="{{ route('dashboard.categories.restore', $category->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-outline-info">Restore</button>
                </form>
            </td>
            <td>
                <form action="{{ route('dashboard.categories.force-delete', $category->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
    </tbody>

    @empty
    <td colspan="7">No categories defined..</td>
    @endforelse
</table>
{{$categories->withQueryString()->appends(['search' => 1])->links()}}
@endsection
