@extends('layouts.admin-area')

@section('title')
    Simulasi Monte Carlo
@endsection

@section('admincontent')
<body>
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Simulasi Monte Carlo</h1>
        </div>

        <div class="section-body">
                <div class="row" >
                    <div class="col-lg-3 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col">
                                    @php
                                                    $r=16;
                                                    $d = 26;
                                                    $Zi = $r;
                                                    $m = 99;
                                                    $o = 20;
                                                @endphp                               
                                    <div class="form-group">
                                        <label>d</label>
                                        <input type="text" class="form-control" id="d" value="{{$d}}">
                                    </div>
                                                                   
                                    <div class="form-group">
                                        <label>Zi</label>
                                        <input type="text" class="form-control" id="Zi" value="{{$Zi}}">
                                    </div>
                                                                   
                                    <div class="form-group">
                                        <label>o</label>
                                        <input type="text" class="form-control" id="o" value="{{$o}}">
                                    </div>
                                                                   
                                    <div class="form-group">
                                        <label>m</label>
                                        <input type="text" class="form-control" id="m" value="{{$m}}">
                                    </div>

                                    <div class="row" style="margin-top: 10px">
                                        <a class="btn btn-success" value="Submit" style="margin-left: 10px">Generate</a>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9 col-md-12 col-12 col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="col">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-md" id="categoryTable">
                                            <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Angka Acak</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @for ($i = 0; $i<=11; $i++) 
                                                    <tr>
                                                        <th scope="row">{{$i+1}}</th>
                                                        <td>
                                                            {{$r=($d*$Zi+$o)}}
                                                        </td>
                                                    </tr>    
                                                @endfor                                                        
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

</body>
{{-- @livewire('admin.categories') --}}

@endsection

@push('prepend-script')
    <script>
        $('#import').click(function(){
            $('#montecarloModal').modal('show');
        });

        @if (session('success')){
            swal('Data Berhasil Disimpan!', '', 'success');
            // $('#montecarloTable tbody').append('"');
        }
        @endif

        $('#delete').click(function(){
            swal({
                text: "Apakah kamu yakin akan menghapus data ini?",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete){
                    $.ajax({
                        type: "GET",
                        url: "/delete/",
                        success: function() 
                        {
                            swal("Poof! Your imaginary file has been deleted!", 
                            {
                                icon: "success",
                            })
                            .then(okay => {
                                if (okay){
                                    window.location.href = "/home";
                                }
                            })
                        },
                    });
                } 
                else {
                }
            });
        });
    </script>
    
@endpush

{{-- @include('pages.admin.categories.edit') --}}


{{-- @push('prepend-script')
    <script>

        $(function () {
        
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        var table = $('#categoryTable').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            paging: false, 
            info: false,
            // ordering: false,
            searching: false,
            order:  [[ 0, 'desc' ]],
            ajax: "{{ route('categories.index') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'categories_name', name:'categories_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            
        });

        $('#createNewCategories').click(function(){
            $('#saveBtn').val("create-categories");
            $('#categories_id').val('');
            $('#categoriesForm').trigger("reset");
            $('#modalHeading').html("Tambah Category");
            $('#categoriesModal').modal('show');
            $('#saveBtn').html('Save Changes');
            $('#categories_nameError').text('');
            $("#categories_name").removeClass('is-invalid');
        });
        
        $('body').on('click', '.editCategories', function () {
            var categories_id = $(this).data('id');
            $.get("{{ route('categories.index') }}" +'/' + categories_id +'/edit', function (data) {
                $('#modalHeading').html("Edit Category");
                $('#saveBtn').val("edit-categories");
                $('#saveBtn').html('Save Changes');
                $('#categoriesModal').modal('show');
                $('#categories_nameError').text('');
                $("#categories_name").removeClass('is-invalid');
                $('#categories_id').val(data.id);
                $('#categories_name').val(data.categories_name);
            })
        });
        
        $('#saveBtn').click(function (e) {
            e.preventDefault();
            $(this).html('Sending..');
        
            $.ajax({
                data: $('#categoriesForm').serialize(),
                url: "{{ route('categories.store') }}",
                type: "POST",
                dataType: 'json',
                success: function (data) {
                    // $('#categories_nameError').text(data.responseJSON.errors.categories_name);
                    $('#categoriesForm').trigger("reset");
                    $('#categoriesModal').modal('hide');
                    // $('#categories_nameError').text(data.responseJSON.errors.categories_name);
                    table.draw();
                    swal('Data Berhasil Disimpan!', '', 'success');
                    // console.log('form: '+result);  
                    $('#saveBtn').html('Save Changes');
                },
                error: function (data) {
                    $("#categories_name").addClass('is-invalid');
                    // console.log(errors.categories_name);
                    // $('#categories_nameError').text(data.responseJSON.errors.categories_name);
                    $('#categories_nameError').text(data.responseJSON.errors.categories_name);
                    // $('#categories_nameError').text(xhr.responseText);
                    // console.log('Error:', data);
                    // swal(data, $errors, 'error');
                    $('#saveBtn').html('Save Changes');
                }
            });
            
        });
    
        $('body').on('click', '.deleteCategories', function (){
            var categories_id = $(this).data("id");
            // var text = (this).prop("categories_name");
            swal({
                text: "Apakah kamu yakin akan menghapus kategori ini?",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete){
                $.ajax({
                    type: "DELETE",
                    url: "{{ route('categories.store') }}"+'/'+ categories_id,
                    
                    success: function (data) {
                        table.draw();
                        swal('Data berhasil dihapus!', {
                        icon: 'success',
                        });
                    },
                    error: function (data) {
                        console.log('Error:', data);
                    }
                });
            } 
            else {
            }
            });

        });
    });
    </script>
@endpush --}}
