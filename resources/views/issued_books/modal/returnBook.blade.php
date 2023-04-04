<div class="modal modal-right large fade" id="returnModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="">Return Book</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body scroll-y mx-5">
                <div class="returnBookBlock">
                    <form id="issued_book_filter" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-4">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="returnRadio" id="inlineRadio1"
                                    checked value="issueid">
                                <label class="form-check-label" for="inlineRadio1">By issueID</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="returnRadio" id="inlineRadio2"
                                    value="user_name">
                                <label class="form-check-label" for="inlineRadio2">By User Name</label>
                            </div>
                        </div>

                        <div id="issueid-section" class="mb-4">
                            <div class="d-flex flex-column justify-content-start">
                                <div class="text-muted mb-2">
                                    <input type="text" name="id" class="form-control"
                                        placeholder="Search by issueID" value="lib_">
                                </div>
                            </div>
                        </div>

                        <div id="user-name-section" style="display: none;" class="mb-4">
                            <div class="d-flex flex-column justify-content-start">
                                <div class="text-muted mb-2">
                                    <select id="inputState" name="user_id" class="form-select">
                                        <option value="" selected disabled>Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->complete_name() }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                                @error('user_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button class="btn btn-icon btn-icon-start btn-primary" type="submit">
                            <i data-acorn-icon="search"></i>
                            <span>Fetch</span>
                        </button>
                    </form>
                    <div class="filter_books mt-5">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
