      <div class="row g-0 align-items-center">
          @if ($book->image_url != null)
              <div class="col-5 pe-5">
                  <img src="{{ $book->image_url }}" class="card-img sh-15 sh-sm-25 scale mb-5"
                      alt="vertical content image">
              </div>
          @endif
          <div class="col ps-0">
              <div class="card-body ps-0">
                  <h2 class="text-primary mb-0">{{ $book->name }}</h2>
                  <h6 class="text-alternate">{{ $book->isbn_number }}</h6>
              </div>
          </div>
      </div>


      <div class="mb-3">
          <h4>Description</h4>
          <p class="text-alternate">{{ $book->desc }}</p>
      </div>
      <div class="mb-3">
          <h4>Published Date</h4>
          <p class="text-alternate">{{ $book->published_date }}</p>
      </div>
      <div class="mb-3">
          <h4>Category</h4>
          <p class="text-alternate"><span class="dot" style="background:{{ $book->category->background }}"></span>
              &nbsp;{{ $book->category->name }}
          </p>
      </div>
      <div class="mb-3">
          <h4>Author</h4>
          <p class="text-alternate">{{ $book->author->name }}</p>
      </div>

      <hr>
      <div class="mb-3">
          <h4>User Info</h4>
          <p class="text-alternate">{!! $user->complete_name_styled() !!}</p>
      </div>
      <input type="hidden" name="user_name" value="{{ $user->id }}">
