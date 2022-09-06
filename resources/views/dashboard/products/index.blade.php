@extends('dashboard.layouts.master')


@section('title','Products')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Products</li>
@endsection


@section('content')
<x-alert type="success" />
<x-alert type="danger" />

<form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
    <x-form.input name="name" placeholder="Product Name" class="mx-2" :value="request('name')"/>
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
            <th>Category</th>
            <th>Store</th>
            <th>Image</th>
            <th>Price</th>
            <th>Status</th>
            <th>Created At</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($products as $product)
        <tr>
            <td>{{$product->id}}</td>
            <td>{{$product->name}}</td>
            <td>{{$product->category_id}}</td>
            <td>{{$product->store_id}}</td>
            <td><img src="" alt=""></td>
            <td>{{$product->price}}</td>
            <td>{{$product->status}}</td>
            <td>{{$product->created_at}}</td>
            <td>
                <a href="{{route('dashboard.products.edit',$product->id)}}" class="btn btn-sm btn-outline-info">Edit</a>
            </td>
            <td>
                <form action="{{route('dashboard.products.destroy',$product->id)}}" method="post">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <td colspan="8">No products defined..</td>
        @endforelse
    </tbody>
</table>
{{$products->withQueryString()->appends(['search' => 1])->links()}}

@endsection