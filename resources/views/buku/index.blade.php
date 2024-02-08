@extends('layouts.app')

@section('content')
<div class="success" data-flash="{{ session('message') }}"></div>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>

</div>
<div class=" d-flex justify-content-between align-items-center my-3">
    @can('create book')
    <button class="btn btn-primary  mb-2" id="btn-create" data-toggle="modal" data-target="#tambah-buku"><i
            class="fas fa-plus"></i>
        buku</button>
    @endcan
    <div>
        <form method="get" action="{{ route('book.index') }}"
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" name="keyword" class="form-control bg-light border-1 small"
                    placeholder="masukkan judul..." style="width: 400px;" aria-label="Search"
                    aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<form class="form" method="get" action="{{ route('book.search') }}">
    <div class="row mt-2 mb-4">
        <div class="col-md-4">
            <input type="text" class="form-control  bg-light" name="judul" placeholder="title">
        </div>
        <div class="col-md-4">
            <input type="text" class="form-control bg-light" name="mintahun" placeholder="min tahun">
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" name="maxtahun" class="form-control bg-light border-1 small" placeholder="max tahun"
                    aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append"> -
                </div>
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search fa-sm"></i>
                </button>

            </div>
        </div>
    </div>
</form>


<div class="row">
    <div class="col">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tahun Terbit</th>
                    <th>Ketebalan</th>
                    <th>Harga</th>
                    <th colspan="3" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($books->count() != null)
                @foreach ($books as $book => $item)
                <tr>
                    <td>{{ $books->firstItem()+$book }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->release_year }}</td>
                    <td>{{ $item->thickness }}</td>
                    <td>{{ $item->price }}</td>
                    <td class="text-center">
                        @can('delete book')

                        <form action="{{ route('book.delete',$item->id) }}" id="delete-buku{{ $item->id }}"
                            method="post">
                            @csrf @method('delete')

                        </form>
                        <button class="btn btn-danger text-center btn-delete" type="button" data-id="{{ $item->id }}">
                            <i class="fas fa-trash"></i></button>
                        @endcan

                        @can('update book')
                        <button class="btn btn-warning text-center btn-edit" data-target="#edit-buku"
                            data-toggle="modal" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></button>
                        @endcan

                        <button class="btn btn-info btn-detail" data-target="#detail-buku" data-toggle="modal"
                            data-id="{{ $item->id }}"><i class="fas fa-eye"></i></button>

                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="9" class="text-center"> -- Buku masih kosong -- </td>
                </tr>
                @endif

            </tbody>
        </table>
        <div class="d-flex justify-content-center">{{ $books->links() }}</div>
    </div>
</div>
@endsection
@include('components.sweetalert-component')
@section('modal')
{{-- tambah modal --}}
<div class="modal fade" id="tambah-buku" data-backdrop="static" keyboard="false" tabindex="-1"
    aria-labelledby="tambahbuku" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahbuku">Tambah Buku</h5>
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
<div class="modal fade" id="edit-buku" data-backdrop="static" keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Buku</h5>
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
<div class="modal fade" id="detail-buku" data-backdrop="static" keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Buku</h5>
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
                url:`http://127.0.0.1:8000/books/create`,
                method:'GET',
                success:function(data){
                    $('#tambah-buku').find('.modal-body').html(data);
                    $('#tambah-buku').show()

                    $('#modal-input').submit(function(e){

                        e.preventDefault();

                        $.ajax({
                            url:`http://127.0.0.1:8000/books/create`,
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
                               let msg_error =  data.responseJSON.errors;
                               $.each(msg_error,function(key,val){
                                $(`.${key}_error`).text(val[0]);
                               })

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
                url:`http://127.0.0.1:8000/books/${id}/edit`,
                method:'GET',
                _token:"{{ csrf_token() }}",
                success:function(data){
                    $('#edit-buku').find('.modal-body').html(data);
                    $('#edit-buku').show()
                }
            })

        })
        // button detail
        $('.btn-detail').on('click',function(){
            let id = $(this).data('id');
            $.ajax({
                url:`http://127.0.0.1:8000/books/${id}`,
                method:'GET',
                _token:"{{ csrf_token() }}",
                success:function(data){
                    $('#detail-buku').find('.modal-body').html(data);
                    $('#detail-buku').show()
                }
            })

        })


            $('.btn-delete').on('click',function(){
                let id = $(this).data('id');
                Swal.fire({
                    title: 'PERINGATAN!',
                    text: `Yakin ingin menghapus Buku.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancle',
                }).then((result) => {
                    if (result.value) {
                        $(`#delete-buku${id}`).submit();
                    }
                })
            })
    })
</script>
@endpush