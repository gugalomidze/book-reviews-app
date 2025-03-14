@extends('layouts.app')

@section('main')
<div class="container">
    <div class="row my-5">
        <div class="col-md-3">
            @include('layouts.sidebar')
        </div>
        <div class="col-md-9">
            @include('layouts.message')
                <div class="card border-0 shadow">
                    <div class="card-header  text-white">
                        Books
                    </div>

                    <div class="d-flex justify-content-between mt-4 px-3">
                        <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>

                        <form action="" method="get">
                            <div class="d-flex">
                                <input type="text" value="{{ Request::get('keyword')}}" class="form-control" name="keyword" placeholder="Search">
                                <button type="submit" class="btn btn-primary ms-2">Search</button>
                                <a href="{{ route('books.index') }}" class="btn btn-secondary ms-2">
                                    Clear
                                </a>
                            </div>
                        </form>

                    </div>

                    <div class="card-body pb-0">
                        <table class="table table-striped mt-3">
                            <thead class="table-dark">
                                <tr>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th width="150">Action</th>
                                </tr>
                                <tbody>
                                    @forelse ($books as $book)
                                        <tr>
                                            <td>{{ $book->title }}</td>
                                            <td>{{ $book->author }}r</td>
                                            <td>3.0 (3 Reviews)</td>
                                            <td>
                                                @if ($book->status == 1)
                                                    <span class="text-success">
                                                        Active
                                                    </span>
                                                @else
                                                <span class="text-danger">
                                                    Block
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-success btn-sm"><i class="fa-regular fa-star"></i></a>
                                                <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary btn-sm"><i class="fa-regular fa-pen-to-square"></i>
                                                </a>
                                                <a href="#" onclick="deleteBook({{ $book->id }});" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-danger">
                                                Books not found
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </thead>
                        </table>
                        @if ($books->isNotEmpty())
                            {{ $books->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@section('script')
    <script>
        function deleteBook(id) {
            if(confirm('are you sure you want to delete?')) {
                $.ajax({
                    url: '{{ route("books.destroy") }}',
                    type: 'delete',
                    data: {id: id},
                    headers: {
                        'X-CSRF-TOKEN' : '{{ csrf_token() }}'
                    },
                    success: function(response){
                        window.location.href = '{{ route("books.index") }}';
                    }
                })
            }
        }
    </script>
@endsection
