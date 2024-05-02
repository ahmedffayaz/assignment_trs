<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Document</title>
</head>
<body>
@extends('adminlte.master')
@section('create')

<div class="container mt-5 mb-5" style="margin-left: 360px; width: 890px;   display: block; text-align:center;">
    <h2>Add New Product</h2>
    <form id="ajaxForm">
        @csrf
        <input type="file" name="image">
        <div class="form-row py-3">
            <div class="col">
                <input type="text" class="form-control" placeholder="Enter Product Name" name="name">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Enter Product Price" name="price">
            </div>
        </div>
        <div class="form-row">
            <textarea class="form-control my-3" placeholder=" Describe Details Of Product" cols="7" rows="7" name="description"></textarea>
        </div>
        <button class="btn btn-success mb-5" type="button" id="saveBtn">Add Product</button>
    </form>
</div>
<script>
    $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        var form = $('#ajaxForm')[0]
        $('#saveBtn').click(function() {
            console.log('clicked');
            var myform = new FormData(form);

            $.ajax({
                url: "{{route('product.create')}}",
                method: 'POST',
                processData: false,
                contentType: false,
                data: myform,
                headers: {
        'X-CSRF-TOKEN': csrfToken
    },
                success: function(response)
                {
                    if(response)
                    {
                        $('#ajaxForm')[0].reset();
                        swal("Product Stored",response, "success");
                    }
                },
                error: function (error)
                {
                   if(error)
                   {
                    console.log(error)
                   }
                }
                
            })
        })
    });
</script>
@endsection
<script src="{{ asset ('js/app.js') }}"></script>
<script src="{{ asset ('js/adminlte.js') }}"></script>
<script src="{{ asset ('plugins/some-plugin.js') }}"></script>
</body>
</html>