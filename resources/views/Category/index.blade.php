@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">DATA CATEGORY</h3>
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('category.create') }}" class="btn btn-md btn-success mb-3">TAMBAH CATEGORY</a>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">NAME CATEGORY</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($category as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('category.destroy', $item->id) }}" method="POST">
                                            <a href="{{ route('category.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Category belum Tersedia.
                                    </div>
                                @endforelse
                                </tbody>
                            </table>  
                            {{ $category->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection