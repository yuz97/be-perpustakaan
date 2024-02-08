<form action="{{ route('category.create') }}" method="post" id="modal-input">
    @csrf
    <div class=" form-group">
        <label for="name">Nama Kategori</label>
        <input type="text" id="name" name="name" value="{{ old('name')}}" class="form-control">
        <span class="text-danger error-text name_error"></span>
    </div>
    <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Simpan</button>
</form>