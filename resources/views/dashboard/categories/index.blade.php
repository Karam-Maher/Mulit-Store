@extends('dashboard.layouts.master')
@section('title', 'Categories')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
@endsection


@section('content')

    <x-alert type="success"/>
    <x-alert type="danger"/>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Parent</th>
                <th>Image</th>
                <th>Created At</th>
                <th colspan="2">Action</th>

            </tr>
        </thead>
        @forelse ($categories as $category)
            <tbody>
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->parent_id }}</td>
                    <td><img src="{{ asset('storage/' . $category->image) }}" height="50"></td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <a href="{{ route('dashboard.categories.edit', $category->id) }}"
                            class="btn btn-outline-success">Edit</a>
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
            <td colspan="7">No categories defined..</td>
        @endforelse
    </table>
@endsection
