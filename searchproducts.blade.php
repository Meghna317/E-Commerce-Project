


    @if(count($products)>0)
        @foreach($products as $product)
        <tr>
            <th scope="row">{{ $product->id }}</th>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->category->name }}</td>
                <td>
                   <img src="/thumbnails/{{ $product->thumbnails()->first()->thumbnail }}" class="img-responsive" style="max-height: 120px; max-width: 120px;" alt="">
                </td>
                <td>
                    <input data-id="{{$product->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $product->status ? 'checked' : '' }}>
                </td>
                <td><a href="{{ route('admin.editproduct', $product->id) }}" class="btn btn-outline-primary">Update</a></td>
                <td>
                    <form action="{{ route('admin.deleteproduct', $product->id) }}" method="post">
                    <button class="btn btn-outline-danger" onclick="return confirm('Are you sure?')" type="submit">Delete</button>
                    @csrf
                    @method('delete')
                    </form>
                </td>
        </tr>
        @endforeach
    @else
        <tr>
            <td>No products found</td>
        </tr>
    @endif
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(function() {
      $('.toggle-class').change(function() {
          var status = $(this).prop('checked') == true ? 1 : 0;
          var id = $(this).data('id');

          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/changeStatus',
              data: {'status': status, 'id': id},
              success: function(data){
                //console.log(data.success)
                  toastr.options.closeButton = true;
                  toastr.options.closeMethod = 'fadeOut';
                  toastr.options.closeDuration = 100;
                  toastr.options.preventDuplicates = true;
                  toastr.success(data.success);
              }
          });
      })
    })
  </script>
