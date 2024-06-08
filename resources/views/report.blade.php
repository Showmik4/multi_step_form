@extends('layouts.app')
@section('title'){{ 'Result' }}@endsection
@section('header.css')
<style>
    html body .content .content-wrapper {
        padding: 5px 20px 5px 20px;
    }
</style>
@endsection
@section('content')
<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Results</a></li>
                </ol>
            </div>
            <h4 class="page-title">Results</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="text-end mb-3">
                    {{-- <a href="{{ route('latestnews.create') }}" class="btn btn-md btn-info "><i
                            class="ft-plus"></i>Create
                        New</a> --}}
                </div>
                <table id="resultTable" class="table dt-responsive nowrap w-100"></table>
            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
@endsection
@section('footer.js')
<script>
    $(document).ready(function () {
            $('#resultTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    "url": "{{route('report_list')}}",
                    "type": "POST",
                    data: function (d) {
                        d._token = "{{csrf_token()}}";
                    },
                },
                columns: [
                    {title: 'First Name', data: 'first_name', name: 'first_name', className: "text-center", orderable: true, searchable: true},
                    {title: 'Last Name', data: 'last_name', name: 'last_name', className: "text-center", orderable: false, searchable: false},  
                    {title: 'Email', data: 'email', name: 'email', className: "text-center", orderable: false, searchable: false},
                    {title: 'Total Marks(%)', data: 'total_marks', name: 'total_marks', className: "text-center", orderable: false, searchable: false},               
                  
                ]
            });
        });

      
</script>
@endsection