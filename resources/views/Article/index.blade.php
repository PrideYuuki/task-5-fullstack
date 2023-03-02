@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <div class="row">
      <div class="col-md-12">
          <div>
              <h3 class="text-center my-4">DATA ARTICLE</h3>
              <hr>
          </div>
          <div class="card border-0 shadow-sm rounded">
              <div class="card-body">
                  <a href="{{ route('articles.create') }}" class="btn btn-md btn-success mb-3">TAMBAH ARTICLE</a>
                  <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th scope="col">IMAGE</th>
                          <th scope="col">TITLE</th>
                          <th scope="col">CONTENT</th>
                          <th scope="col">NAME CATEGORY</th>
                          <th scope="col">ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse ($articles as $item)
                          <tr>
                            <tr>
                              <td class="text-center">
                                  <img src="{{ asset('/storage/articles/'.$item->image) }}" class="rounded" style="width: 150px">
                              </td>
                              <td>{{ $item->title }}</td>
                              <td>{{ $item->content }}</td>
                              <td>{{ $item->category['name'] }}</td>
                              <td class="text-center">
                                  <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('articles.destroy', $item->id) }}" method="POST">
                                      
                                      <a href="{{ route('articles.edit', $item->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                  </form>
                              </td>
                            </tr>
                          </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Article belum Tersedia.
                            </div>
                        @endforelse
                      </tbody>
                    </table>  
              </div>
          </div>
      </div>
  </div>
</div>
@endsection