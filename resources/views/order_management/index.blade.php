@extends('layouts.app')
@section('css_after')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <h1 class="mb-0 pb-0 display-4" id="title">Order Management</h1>
                </div>
            </div>
        </div>

        <a href="{{ route('order_management.create') }}" class="btn btn-icon btn-icon-start btn-primary mb-4" type="button" >
            <i data-acorn-icon="plus"></i>
            <span>Add Order</span>
        </a>
        <a  class="btn btn-light all_select mb-4" type="button" >
            <span> @lang('Mark_all')</span>
            <input type="checkbox" name="check_data" class=" select_all  delete-all-checkBox  form-check-input mt-0"
            style=" margin-left:5px; cursor:pointer;" id="select-all" {{-- value="true" --}} />
        </a>
        <a href="javascript:void(0);" class="btn btn-sm btn-danger delete-all" style="display: none"
        data-url="{{ route('order_bulk_delete') }}">
        <i class="fa fa-trash"></i>
        @lang('Delete_Selected')
        (<span id="lengthcek" style="font-weight: bolder;">0 </span> )
    </a>


        {{-- -----Table----- --}}
        @php
            $tableName = 'datatable';
            $tableData = [ '#','Order ID', 'Company Name', 'Status', 'Delivery Date', 'Actions'];
        @endphp
        @include('common.table.table')
    </div>

    @include('common.modal.add_edit_modal')
@endsection

@section('js_after')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/0.10.0/lodash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="{{ asset('acron/js/checked.js') }}"></script>

    {{-- **Show Data** --}}
    <script>
        var tabelDataArray = [ 'id','order_number', 'company_name', 'status', 'delivery', 'action'];
        var get_data_url = "{{ route('get_orders') }}"
    </script>
    @include('common.js.get_data')

    {{-- **Save Data** --}}
    <script>
        var add_form_url = "{{ route('order_management.create') }}"
        var save_data_url = "{{ route('order_management.store') }}"
        var add_title = "Add Order"
    </script>
    @include('common.js.add_data')


    {{-- **Update Data** --}}
    <script>
        var edit_form_url = '{{ route('products.edit', ':id') }}'
        var update_data_url = '{{ route('products.update', ':id') }}'
        var edit_title = "Edit Order"
    </script>
    @include('common.js.edit_data')


    {{-- **Delete Data** --}}
    <script>
        var delete_data_url = '{{ route('products.destroy', ':id') }}'
    </script>
    @include('common.js.delete_data')

    <script>
         let flag = false;
        let checkBox_array = document.getElementsByClassName('checkboks')
        $(".delete-all-checkBox").change(function() {

            if (this.checked) {
                let idsArray = [];
                let flag = false;
                checkBox_array.forEach(element => {
                    // idsArray.push(element.value)
                    element.checked = true;
                    checkBoxChange(element.value)

                });
                DeleteAll()

            } else {
                checkBox_array.forEach(element => {
                    element.checked = false;
                });
                uncheckedContent();
                emptyArray();

            }



        });

        function handDelete() {
            let checkBox = document.getElementsByClassName('delete-all-checkBox')[0];
            if (checkBox_array.length && checkBox.checked) {
                checkBox.checked = false;
                //    flag = false;
            } else {
                // flag = true;
                // checkBox.checked = false;

            }
        }
    </script>
@endsection
