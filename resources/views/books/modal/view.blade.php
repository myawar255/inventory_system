<div class="row g-0 align-items-center">
    @if ($data->image_url != null)
        <div class="col-5 pe-5">
            <img src="{{ $data->image_url }}" class="card-img sh-15 sh-sm-25 scale mb-5" alt="vertical content image">
        </div>
    @endif
    <div class="col ps-0">
        <div class="card-body ps-0">
            <h2 class="text-primary mb-0">{{ $data->name }}</h2>
            <h6 class="text-alternate">{{ $data->isbn_number }}</h6>
        </div>
    </div>
</div>


<div class="mb-3">
    <h4>Description</h4>
    <p class="text-alternate">{{ $data->desc }}</p>
</div>
<div class="mb-3">
    <h4>Published Date</h4>
    <p class="text-alternate">{{ $data->published_date }}</p>
</div>
<div class="mb-3">
    <h4>Category</h4>
    <p class="text-alternate"><span class="badge" style="background:{{ $data->category->background }}">&nbsp;&nbsp;</span>{{ $data->category->name }}</p>
</div>
<div class="mb-3">
    <h4>Author</h4>
    <p class="text-alternate">{{ $data->author->name }}</p>
</div>
<div class="mb-3">
    <h4>Total Quantity</h4>
    <p class="text-alternate">{{ $data->qty }}</p>
</div>
<div class="mb-3">
    <h4>Remaining Quantity</h4>
    <p class="text-alternate">{{ $data->remaining }}</p>
</div>

<div class="d-flex justify-content-end">
    <button type="button" class="btn btn-primary me-2" onclick="view_issue_status({{ $data->id }})">view issue status</button>
</div>
