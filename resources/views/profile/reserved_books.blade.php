<h2 class="small-title">Reserved Books</h2>

@if ($books->count() == 0)
    No Books found
@endif

<div class="row row-cols-1 row-cols-sm-2 g-2">
    <div class="col-12 col-xl-8 col-xxl-9 mb-5">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-3 g-2 mb-5">
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
</div>


