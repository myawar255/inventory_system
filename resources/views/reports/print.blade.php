@extends('layouts.app')

@section('css_after')
    <style>
    </style>
@endsection
@section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
            <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <h1 class="mb-0 pb-0 display-4" id="title">Reports</h1>
                </div>
                <!-- Title End -->
            </div>
        </div>
        <button class="btn btn-icon btn-icon-start btn-primary mb-4 download_btn" type="button" onclick="download()"
            style="display: none">
            <i data-acorn-icon="download"></i>
            <span>Download PDF</span>
        </button>
        <div id="gen_report">Generating Report</div>

        <!-- Title and Top Buttons End -->
        <div id="mydiv" class="ps-5 pt-5">

            <table class="table table-bordered fixed">

                <div class="lib_head" style="display: none">
                    <div class="d-flex justify-content-center">
                        <img src="{{ asset('acron/img/logo/logo-blue-light.svg') }}" alt="" style="width: 30%">
                    </div>
                    <br>
                    <div class="d-flex justify-content-center">
                        <h1 class=""><span class="text-primary">Date: </span>{{ date('d M,Y') }}</h1>
                    </div>
                </div>
                <thead>
                    <tr>
                        <th scope="col">Data</th>
                        <th scope="col">Count</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $data = ['total_books', 'issued_books', 'returned_books', 'requested_books', 'reserved_books', 'renewed_books', 'total_users', 'total_students', 'total_faculty'];
                    @endphp
                    @foreach ($data as $val)
                        <tr>
                            <th>{{ ucwords(str_replace('_', ' ', $val)) }}</th>
                            <td class="{{ $val }}">0</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('js_after')
    <script>
        function download() {
            $('.lib_head').show()
            const element = document.getElementById('mydiv');


            // Use html2canvas to capture the content of the element
            html2canvas(element).then(canvas => {
                // Use jsPDF to create a new PDF object
                const pdf = new jsPDF('l', 'mm', 'a4');

                // Calculate the width and height of the PDF page
                const pageWidth = 290;
                const pageHeight = 200;

                // Calculate the scale of the image based on the page size and the size of the element
                const scaleX = pageWidth / canvas.width;
                const scaleY = pageHeight / canvas.height;
                const scale = Math.min(scaleX, scaleY);

                // Calculate the dimensions of the image on the PDF page
                const imgWidth = canvas.width * scale;
                const imgHeight = canvas.height * scale;

                // Add the canvas image to the PDF document
                const imgData = canvas.toDataURL('image/png');
                pdf.addImage(imgData, 'PNG', 0, 0, imgWidth, imgHeight);

                // Save the PDF document
                pdf.save('LibraryReport.pdf');
            });
            $('.lib_head').hide()

        }

        var arr = ['total_books', 'issued_books', 'returned_books', 'requested_books', 'reserved_books', 'renewed_books',
            'total_users', 'total_students', 'total_faculty'
        ]

        $.each(arr, function(index, value) {
            var myUrl = '{{ route('reports.getData', ':value') }}'
            url = myUrl.replace(':value', value);


            $.ajax({
                url: url,
                type: 'GET',
                async: false,
                dataType: 'json',
                success: function(data) {
                    $(`.${value}`).html(data);
                    if (index === arr.length - 1) {
                        $('#gen_report').hide()
                        $('.download_btn').show()
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error getting ' + value + ': ' + textStatus + ' - ' + errorThrown);
                }
            });
        });
    </script>
@endsection
