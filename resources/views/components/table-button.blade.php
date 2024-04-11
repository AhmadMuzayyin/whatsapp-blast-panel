@props(['view', 'edit', 'delete', 'params', 'route'])
<div>
    @if ($view == true)
        <a href="javascript:;" class="text-info" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
            data-bs-original-title="View info" aria-label="View"><ion-icon name="eye-sharp"></ion-icon></a>
    @endif
    @if ($edit == true)
        <a href="javascript:;" class="text-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
            data-bs-original-title="Edit info" aria-label="Edit"><ion-icon name="pencil-sharp"></ion-icon></a>
    @endif
    @if ($delete == true)
        <button type="button" id="delete-{{ $params->id }}" style="background: transparent; border: 0;"
            class="text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title=""
            data-bs-original-title="Delete" aria-label="Delete">
            <ion-icon name="trash-sharp"></ion-icon>
        </button>
        @push('js')
            <script>
                $('#delete-{{ $params->id }}').on('click', function() {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ $route ?? '' }}",
                                type: 'DELETE',
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                success: function(data) {
                                    Swal.fire({
                                        text: "Your file has been deleted.",
                                        icon: 'success',
                                        confirmButtonText: 'Ok'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            location.reload();
                                        }
                                    });
                                }
                            });
                        }
                    })
                });
            </script>
        @endpush
    @endif
</div>
