@extends('dashboard.layouts.master')

@section('title', $category->name)

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Categories</li>
    <li class="breadcrumb-item active">{{ $category->name }}</li>
@endsection


@section('content')



    <table class="table">
        <thead>
            <tr>

                <th>Name</th>
                <th>Store</th>
                <th>status</th>
                <th>Image</th>
                <th>Created At</th>

            </tr>
        </thead>
        @php
            $products = $category
                ->products()
                ->with('store')
                ->latest()
                ->paginate(5);
        @endphp
        @forelse ($products as $product)
            <tbody>
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->store->name }}</td>
                    <td>{{ $product->status }}</td>
                    <td><img src="{{ asset('storage/' . $product->image) }}" height="50"></td>
                    <td>{{ $product->created_at }}</td>
                </tr>
            </tbody>

        @empty
            <td colspan="5">No categories defined..</td>
        @endforelse
    </table>
    {{$products->links()}}
@endsection
