<form action="{{ route('book.create') }}" method="post" id="modal-input" enctype="multipart/form-data">
    @csrf
    <div class=" form-group">
        <label for="title">Judul</label>
        <input type="text" id="title" name="title" value="{{ old('title')}}" class="form-control">
        <span class="text-danger error-text title_error"></span>
    </div>
    <div class=" form-group">
        <label for="description">Deskripsi</label>
        <textarea name="description" class="form-control" rows="2" id="description">{{ old('description') }}</textarea>
        <span class="text-danger error-text description_error"></span>
    </div>
    <div class=" form-group">
        <select name="category_id" id="category_id" class="form-control">
            <option value="" disabled selected>Pilih Kategori</option>
            @foreach ($categories as $key => $val)
            <option value="{{$key}}">{{ $val }}</option>
            @endforeach
        </select>
        <span class="text-danger error-text category_id_error"></span>
    </div>
    <div class=" form-group">
        <label for="title">Tahun Terbit</label>
        <input type="text" id="release_year" name="release_year" value="{{ old('release_year')}}" class="form-control">
        <span class="text-danger error-text release_year_error"></span><br>
        <small class="text-muted">*Tahun Rilis minimal 1980 - 2021</small>
    </div>
    <div class=" form-group">
        <label for="price">Harga</label>
        <input type="text" id="price" name="price" value="{{ old('price')}}" class="form-control">
        <span class="text-danger error-text price_error"></span>
    </div>
    <div class=" form-group">
        <label for="total_page">Jumlah Halaman</label>
        <input type="text" name="total_page" class="form-control">
        <span class="text-danger error-text total_page_error"></span>
    </div>
    <div class=" form-group">
        <label for="image_url">Gambar</label>
        <input onchange="showImage('.show-image',this.files[0])" type="file" id="image_url" name="image_url"
            value="{{ old('name')}}" class="form-control">
        <img src="" alt="" class="show-image mt-2 mb-3 img-thumbnail" width="150" height="250" style="display: none">
    </div>
    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
</form>
