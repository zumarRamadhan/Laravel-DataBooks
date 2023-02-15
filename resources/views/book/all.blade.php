{{-- @dd($books) --}}

{{-- @if (Route::is('dashboard.book.all'))

@extends('dashboard.layouts.main')



@endif --}}

@extends('layouts.main')


@section('content')

<div class="col-md-8">
    <div class="row">
        <h1 align="center" class="m-5">Data Buku</h1>
        <div class="col-md-8">
            @if (Route::is('dashboard')) 
            <form action="/dashboard/book/all">
                <div class="col-md-4">
                    <select class="form-select" name="publisher" id="">
                        <option name="publisher" value="0"> -- Pengarang --</option>
                        @foreach ($publisher as $item)
                        @if (request('publisher') == $item->id)
                        {{-- <option name="category" value="{{ $item->id }}"> -- Pengarang --</option> --}}
                        <option name="publisher" value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                        @else
                        <option name="publisher" value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                {{-- @if (request('category'))
                    <input type="text" name="category" value="{{ request('category') }}">
                @endif --}}
                <div class="input-group mb-3">
                    {{-- @if (request('category'))
                    <input type="text" name="category" value="{{ request('category') }}" class="form-control" placeholder="Category... ">
                    @endif --}}
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search... ">
                    <button class="btn btn-primary" type="submit" id="search" type="submit">Search</button>
                </div>
            </form>
            @else
            <form action="/book/all">
                <div class="col-md-4">
                    <select class="form-select" name="publisher" id="">
                        <option name="publisher" value="0"> -- Pengarang --</option>
                        @foreach ($publisher as $item)
                        @if (request('publisher') == $item->id)
                        {{-- <option name="category" value="{{ $item->id }}"> -- Pengarang --</option> --}}
                        <option name="publisher" value="{{ $item->id }}" selected>{{ $item->nama }}</option>
                        @else
                        <option name="publisher" value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                {{-- @if (request('category'))
                    <input type="text" name="category" value="{{ request('category') }}">
                @endif --}}
                <div class="input-group mb-3">
                    {{-- @if (request('category'))
                    <input type="text" name="category" value="{{ request('category') }}" class="form-control" placeholder="Category... ">
                    @endif --}}
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search... ">
                    <button class="btn btn-primary" type="submit" id="search" type="submit">Search</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>

    @if (session()->has('success'))
        <div class="alert alert-success col-lg-12" role="alert">
        {{ session ('success')}}
        </div>
    @endif

    <div class="card">
        <table class="table table-hover">
            @if (Route::is('dashboard'))     
            <a type="button" class="btn btn-primary w-25 m-3" href="/dashboard/book/create/" >Add New Data</a>
            @endif
          

           
            <thead>
                <tr class="bg-dark text-white">
                <th scope="col">id</th>
                <th scope="col">Nama Buku</th>
                <th scope="col">Pengarang</th>
                <th scope="col">Harga</th>
                @if (Route::is('dashboard'))
                    <th scope="col">Action</th>
                @endif
                </tr>
            </thead>
            <tbody>
           
            @if (Route::is('dashboard'))    
                @php
                    $i = $books->firstItem();
                @endphp
            @else
                @php
                    $no = 1;
                @endphp
            @endif

            @foreach ($books as $book)
                <tr>
                @if (Route::is('dashboard'))
                    <th>{{$i++}}</th>
                @else
                    <th>{{$no++}}</th>
                @endif
                <td>{{$book->nama}}</td>
                <td>{{$book->publisher->nama}}</td>
                <td>{{$book->harga}}</td>
                
                @if (Route::is('dashboard'))
                
                    <td>
                    <a type="button" class="btn btn-primary" href="/dashboard/book/detail/{{$book->id}}" >Detail</a>
                        <a type="button" class="btn btn-warning"  href="/dashboard/book/edit/{{ $book->id }}" >Edit</a>
                        <form action="/dashboard/book/delete/{{ $book->id }}" method="post" class="d-inline">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger" onclick="return confirm('Are you sure ?')">Hapus</button>
                
                        </form>
                    </td>
                    
                @endif

                </tr>
            @endforeach
            </tbody>
        </table>
        
        {{-- <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item"><a class="page-link" href="#">Previous</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
          </nav> --}}
        {{-- <div class="d-flex justify-content-center">
            {!! $books->links() !!}
        </div> --}}
    </div>
    @if (Route::is('dashboard'))
        <div class="mt-3">{!! $books->links() !!}</div>
    @endif
</div>
@endsection