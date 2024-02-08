@extends('layouts.app')
@section('content')
<div class="success" data-flash="{{ session('message') }}"></div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
</div>
<div class="row">
    <div class="col">
        <button class="btn btn-primary  mb-2" id="btn-create" data-toggle="modal" data-target="#tambah-kategori"><i
                class="fas fa-plus"></i>
            kategori</button>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th colspan="3" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if($categories->count() != null)
                @foreach ($categories as $category => $item)
                <tr>
                    <td>{{ $categories->firstItem()+$category }}</td>
                    <td>{{ $item->name }}</td>
                    <td class="text-center">
                        <form action="{{ route('category.delete',$item->id) }}" id="delete-kategori{{ $item->id }}"
                            method="post">
                            @csrf @method('delete')

                        </form>
                        <button class="btn btn-danger text-center btn-delete" type="button" data-id="{{ $item->id }}"><i
                                class="fas fa-trash"></i></button>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-warning text-center btn-edit" data-target="#edit-kategori"
                            data-toggle="modal" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-info btn-detail" data-target="#detail-kategori" data-toggle="modal"
                            data-id="{{ $item->id }}"><i class="fas fa-eye"></i></button>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="5" class="text-center"> -- Kategori masih kosong -- </td>
                </tr>
                @endif

            </tbody>
        </table>
        <div class="d-flex justify-content-center">{{ $categories->links() }}</div>
    </div>
</div>
@endsection
@include('components.sweetalert-component')

@section('modal')
{{-- tambah modal --}}
<div class="modal fade" id="tambah-kategori" data-backdrop="static" keyboard="false" tabindex="-1"
    aria-labelledby="tambahkategori" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahkategori">Tambah Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

            </div>

        </div>
    </div>
</div>

{{-- detail modal --}}
<div class="modal fade" id="detail-kategori" data-backdrop="static" keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

            </div>

        </div>
    </div>
</div>
{{-- edit modal --}}
<div class="modal fade" id="edit-kategori" data-backdrop="static" keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Kategori</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

            </div>

        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
    //flash messagee

        let flash = $('.success').data('flash');
        if(flash){
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'berhasil',
                text:`${flash}`,
                showConfirmButton: false,
                timer: 2000
            })
        }



    // button create
        $('#btn-create').on('click',function(){
            $.ajax({
                url:`http://127.0.0.1:8000/categories/create`,
                method:'GET',
                success:function(data){
                    $('#tambah-kategori').find('.modal-body').html(data);
                    $('#tambah-kategori').show()

                    $('#modal-input').submit(function(e){

                        e.preventDefault();

                        $.ajax({
                            url:`http://127.0.0.1:8000/categories/create`,
                            method:"POST",
                            data: new FormData(document.getElementById('modal-input')),
                            _token:"{{ csrf_token() }}",
                            dataType:"json",
                            processData:false,
                            contentType:false,
                            beforeSend: function() {
                               $(document)
                                 .find('span.error-text')
                                 .text('')
                            },
                            success: function(data) {
                              if (data.status != false) {
                                $('#modal-input')[0].reset();
                                $('.modal').each(function() {
                                  $(this).modal('hide')
                                })

                                Swal.fire({

                                 icon: 'success',
                                  position: 'center',
                                  icon: 'success',
                                  title:'SUCCESS',
                                  text: data.message,
                                  showConfirmButton: false,
                                  timer: 2000
                                })
                                setTimeout(() => {
                                  location.reload(true)
                                }, 1000);

                              }


                            },
                            error:function(data){
                               let msg_error =  data.responseJSON.errors.name[0];
                                $('.error-text').text(msg_error);
                            }

                        })
                    })
                }
            })

        })
    // button edit
        $('.btn-edit').on('click',function(){
            let id = $(this).data('id');
            $.ajax({
                url:`http://127.0.0.1:8000/categories/${id}/edit`,
                method:'GET',
                _token:"{{ csrf_token() }}",
                success:function(data){
                    $('#edit-kategori').find('.modal-body').html(data);
                    $('#edit-kategori').show()
                }
            })

        })
        //button detail
        $('.btn-detail').on('click',function(){
            let id = $(this).data('id');
            $.ajax({
                url:`http://127.0.0.1:8000/categories/${id}`,
                method:'GET',
                _token:"{{ csrf_token() }}",
                success:function(data){
                    $('#detail-kategori').find('.modal-body').html(data);
                    $('#detail-kategori').show()
                }
            })
        })

    //button delete
        $('.btn-delete').on('click',function(){
            let id = $(this).data('id');
            Swal.fire({
            title: 'PERINGATAN!',
            text: `Yakin ingin menghapus kategori.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancle',
                }).then((result) => {
                    if (result.value) {
                       $(`#delete-kategori${id}`).submit();
                    }
                })
        })



    })

</script>
@endpush