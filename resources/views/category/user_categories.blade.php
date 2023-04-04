@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">Books Categories</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-xl-8 col-xxl-9 mb-5">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-3 g-2 mb-5">

                    @foreach ($categories as $category)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ $category->image_url }}" class="card-img-top sh-19" alt="card image">
                                <div class="card-body pb-0">
                                    <h5 class="heading mb-3">
                                        <a href="{{ route('book.user', ['category' => $category->id]) }}"
                                            class="body-link stretched-link">
                                            <span class="clamp-line sh-5" data-line="2"
                                                style="overflow: hidden; text-overflow: ellipsis; -webkit-box-orient: vertical; display: -webkit-box; -webkit-line-clamp: 2;">
                                                <span class="badge"
                                                    style="background: {{ $category->background }}">&nbsp;&nbsp;</span>
                                                {{ $category->name }}</span>
                                        </a>
                                        <div class="col-auto pe-3">
                                            <i data-acorn-icon="book" class="me-2" data-acorn-size="17"></i>
                                            <span class="align-middle">{{ $category->books->count() }} Books</span>
                                        </div>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-12 col-xl-4 col-xxl-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-5">
                            <div class="card-body row g-0">
                                <div class="col-12">
                                    <form action="{{ route('categories.user') }}" method="POST">
                                        @csrf
                                        <div class="cta-3">Search Categories</div>
                                        @if (isset($search_string))
                                            <div class="text-muted mb-3">Showing Results for" <span
                                                    class="text-primary fw-bold">{{ $search_string }}</span>"</div>

                                            <a class="btn btn-icon btn-icon-start btn-outline-primary"
                                                href="{{ route('categories.user') }}">
                                                <i data-acorn-icon="error-hexagon" class="me-1" data-acorn-size="17"></i>
                                                <span>Clear Filter</span>
                                            </a>
                                        @else
                                            <div class="text-muted mb-3">Search categories by names</div>
                                            <div class="d-flex flex-column justify-content-start">
                                                <div class="text-muted mb-2">
                                                    <input type="text" name="name" class="form-control"
                                                        placeholder="Enter Name to Search">
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
                    @if ($popular_books->count() > 0)
                        <div class="col-12">
                            <h2 class="small-title">Most Popular Books</h2>
                            <div class="mb-5">
                                <div class="row mb-n2">
                                    @foreach ($popular_books as $book)
                                        <div class="col-12 col-md-6 col-xl-12 mb-2"
                                            onclick="book_detail({{ $book->id }})">
                                            <div class="card">
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

@section('js_after')
@endsection
