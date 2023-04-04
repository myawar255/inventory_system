Total Issued Books: {{ $books->count() }}
<br><br>
@foreach ($books as $book)
    <div class="card mb-2  border-primary">
        <a href="#" class="row g-0 sh-10">
            <div class="col-auto">
                <div class="sw-9 sh-10 d-inline-block d-flex justify-content-center align-items-center">
                    <img src="https://ui-avatars.com/api/?background=ECF5FF&color=1ea8e7&name={{ $book->user->name }}" class="img-fluid rounded-xl" alt="thumb">
                </div>
            </div>
            <div class="col">
                <div class="card-body d-flex flex-column ps-0 pt-0 pb-0 h-100 justify-content-center">
                    <div class="d-flex flex-column">
                        <div class="text-primary">{{ $book->user->name }}</div>
                        <div class="text-small text-muted">issued date: {{ $book->issued_date }}</div>
                        <div class="text-small text-muted">return date: {{ $book->return_date }}</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
@endforeach
