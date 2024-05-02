<div id="product-details">
    <!-- Product details will be displayed here -->
</div>
<script>
    $(document).ready(function() {
        // var productId = {{ $product->id }}; 
        // Assuming you have the product ID available in the view

        $.ajax({
            url: "{{ route('products.show', ['id' => ':id']) }}".replace(':id', productId),
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // Update the DOM with the received product data
                $('#product-details').html('<p>Name: ' + response.name + '</p><p>Description: ' + response.description + '</p>');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
</script>
