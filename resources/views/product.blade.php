<!DOCTYPE html>
<html>

<head>
    <title>Laravel</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @extends('adminlte.master')
        @section('table')

        <div id="product-details">
    <!-- Product details will be displayed here -->
</div>


        <div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="modal-content">
    <div class="container mt-5 mb-5" style="width: 700px;   display: block; text-align:center;">
    <h2>Edit Your Product</h2>
    <div id="error-container">
    <span id="error-message"></span>
</div>
    <form id="ajaxForm">
        @csrf
        <div class="form-row py-3">
            <div class="col">
                <input type="hidden" name="Productid" id="Productid">
                <input type="text" class="form-control" placeholder="Enter Product Name" name="name" id="name">
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Enter Product Price" name="price" id="price">
            </div>
        </div>
        <div class="form-row">
            <textarea class="form-control my-3" placeholder=" Describe Details Of Product" cols="7" rows="7" name="description" id="description"></textarea>
        </div>
        <button class="btn btn-success mb-5" type="button" id="saveBtn">Update Product</button>
    </form>
</div>
    </div>
  </div>
</div>
        <div class="container mt-3" style="margin-left: 260px; width: 1090px;   display: block;
  height: 500px;
  overflow-y: scroll;">
            <table class="table table-bordered data-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        @endsection
    </div>
</body>
<script type="text/javascript">
    $(function() {
        var table = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/products/view') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'price',
                    name: 'price'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
        $('body').on('click', '.viewButton', function() {
            var id = $(this).data('id')
            $.ajax({
                url: '{{ url("show/") }}' + '/' + id,
                method: 'GET',
                success: function(response)
                {
                    // $("#myModal").show(); // Show the modal
                    console.log(response)
                    // $('#Productid').val(response.id)
                    
                    $('#name').val(response.name)
                    $('#price').val(response.price)
                    $('#description').val(response.description)
                    // swal("Product Stored",'das', "success");
 
                },
                error: function (error)
                {
                    console.log(error)
                }
            })
        });
        $('body').on('click', '.editButton', function() {
            var id = $(this).data('id')
            $.ajax({
                url: '{{ url("products/") }}' + '/' + id,
                method: 'GET',
                success: function(response)
                {
                    $("#myModal").show(); // Show the modal
                    console.log(response)
                    $('#Productid').val(response.id)
                    $('#name').val(response.name)
                    $('#price').val(response.price)
                    $('#description').val(response.description)
                    // swal("Product Stored",'das', "success");
 
                },
                error: function (error)
                {
                    // var errorMessage = error.response.responseText;
                    console.log(error.response.responseText.name)
                }
            })
        });

        $('body').on('click', '.deleteButton', function() {
            var id = $(this).data('id')
            $.ajax({
                url: '{{ url("delete/") }}' + '/' + id,
                method: 'GET',
                success: function(response)
                {
     
                    table.draw();
                        swal("Product Deleted",response, "success");
                },
                error: function (error)
                {
                    console.log(error)
                }
            })
        });


        $(document).ready(function() {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
        // $.ajaxSetup({
        //         headers:{
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        // });
        var form = $('#ajaxForm')[0]
        $('#saveBtn').click(function() {
            console.log('clicked');
            var myform = new FormData(form);

            $.ajax({
                url: "{{route('products.edits')}}",
                method: 'POST',
                processData: false,
                contentType: false,
                data: myform,
                headers: {
        'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
    },
                success: function(response)
                {
                    if(response)
                    {
                        // $("#myModal").hide();
                        // $('.modal-backdrop').show();
                        table.draw();
                        $('#ajaxForm')[0].reset(); // Reset the form
                        swal("Product Updated",response, "success");
                    }
                },
                error: function (error)
                {
                   if(error)
                   {
                    console.log(error)
                    // responceText
                   }
                }
            })
        })

        
    });
    });
 

    
</script>

<script src="{{ asset ('js/app.js') }}"></script>
<script src="{{ asset ('js/adminlte.js') }}"></script>
<script src="{{ asset ('plugins/some-plugin.js') }}"></script>

</html>