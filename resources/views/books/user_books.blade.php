@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">Books</h1>
                </div>
            </div>
        </div>

        <div class="row">
            @if ($books->count() == 0)
                <div class="col-12 col-xl-8 col-xxl-9 mb-5">
                    No books found
                </div>
            @else
                <div class="col-12 col-xl-8 col-xxl-9 mb-5">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-2 mb-5">
                        @foreach ($books as $book)
                            <div class="col">
                                <div class="card h-100" onclick="book_detail({{ $book->id }})">
                                    <img src="{{ $book->image_url }}" class="card-img-top sh-19" alt="card image">
                                    <div class="card-body pb-0">
                                        <h5 class="heading mb-3">
                                            <a href="#" class="body-link stretched-link">

                                                <div class="text-black"><span class="dot"
                                                        style="background: {{ $book->category->background }}"></span>{{ $book->category->name }}
                                                </div>
                                                <div class=" cta-3 text-primary">{{ $book->name }}</div>
                                            </a>
                                            <div class="col-auto">
                                                <span class="align-middle text-muted">
                                                    @if (strlen($book->desc) > 50)
                                                        {{ substr($book->desc, 0, 50) . '...' }}
                                                    @else
                                                        {{ $book->desc }}
                                                    @endif
                                                </span>
                                            </div>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="col-12 col-xl-4 col-xxl-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-5">
                            <div class="card-body row g-0">
                                <div class="col-12">
                                    <form action="{{ route('book.user') }}" method="POST">
                                        @csrf
                                        <div class="cta-3">Search Books</div>
                                        @if (isset($search_string) || isset($search_category))
                                            <div class="text-muted mb-3">Showing Results for
                                                @isset($search_string)
                                                    "<span class="text-primary fw-bold">{{ $search_string }}</span>"
                                                @endisset
                                                @isset($search_category)
                                                    "<span class="text-primary fw-bold">{{ $search_category }}</span>"
                                                @endisset
                                            </div>

                                            <a class="btn btn-icon btn-icon-start btn-outline-primary"
                                                href="{{ route('book.user') }}">
                                                <i data-acorn-icon="error-hexagon" class="me-1" data-acorn-size="17"></i>
                                                <span>Clear Filter</span>
                                            </a>
                                        @else
                                            <div class="text-muted mb-3">Search Books by names & Categories</div>
                                            <div class="d-flex flex-column justify-content-start">
                                                <div class="text-muted mb-2">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Search by Name">
                                                </div>
                                            </div>

                                            <div class="d-flex flex-column justify-content-start">
                                                <div class="text-muted mb-2">
                                                    <select id="inputState" name="category" class="form-select">
                                                        <option selected="selected" disabled>Search by Category</option>
                                                        @foreach ($categories as $cat)
                                                            <option value="{{ $cat->id }}">
                                                                {{ $cat->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <button class="btn btn-icon btn-icon-start btn-primary" type="submit">
                                                <i data-acorn-icon="search" class="me-1" data-acorn-size="17"></i>
                                                <span>Search</span>
                                            </button>
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @isset($categories[0])
                        <div class="col-12 col-sm-6 col-xl-12">
                            <h2 class="small-title">Categories</h2>
                            <div class="card mb-5">
                                <div class="card-body">
                                    <div class="row g-0">
                                        <div class="col-12 col-sm-6 mb-n2">
                                            @foreach ($categories->chunk(ceil($categories->count() / 2))->first() as $category)
                                                <a href="{{ route('book.user', ['category' => $category->id]) }}"
                                                    class="body-link d-block mb-2">{{ $category->name }}</a>
                                            @endforeach
                                        </div>
                                        <div class="col-12 col-sm-6 mb-n2">
                                            @foreach ($categories->chunk(ceil($categories->count() / 2))->last() as $category)
                                                <a href="{{ route('book.user', ['category' => $category->id]) }}"
                                                    class="body-link d-block mb-2">{{ $category->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endisset

                    @if ($popular_books->count() > 0)
                        <div class="col-12">
                            <h2 class="small-title">Most Popular Books</h2>
                            <div class="mb-5">
                                <div class="row mb-n2">
                                    @foreach ($popular_books as $book)
                                        <div class="col-12 col-md-6 col-xl-12 mb-2"
                                            onclick="book_detail({{ $book->id }})">
                                            <div class="card ">
                                                <div class="row g-0 h-100">
                                                    <div class="col-auto">
                                                        <img src="{{ $book->image_url }}" alt="books"
                                                            class="card-img card-img-horizontal sw-10 sw-sm-14">
                                                    </div>
                                                    <div class="col position-static">
                                                        <div class="card-body ">
                                                            <div class="d-flex flex-column">
                                                                <a href="#" class="stretched-link body-link">
                                                                    <div class="clamp-line" data-line="2"
                                                                        style="overflow: hidden; text-overflow: ellipsis; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2;">
                                                                        {{ $book->name }}</div>
                                                                    <div class="text-muted mb-3">
                                                                        @if (strlen($book->desc) > 30)
                                                                            {{ substr($book->desc, 0, 30) . '...' }}
                                                                        @else
                                                                            {{ $book->desc }}
                                                                        @endif
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
    @include('common.modal.add_edit_modal')
@endsection
