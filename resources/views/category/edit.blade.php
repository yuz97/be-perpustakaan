<form action="{{ route('category.edit', $category->id) }}" method="post">
    @csrf
    @method('put')
    <div class="form-group">

        <label for="name">Nama Kategori</label>
        <input type="text" id="name" name="name" value="{{ old('name') ?  request()->name : $category->name}}"
            class="form-control">
        <span class="text-danger error-text name_error"></span>
    </div>
    <button class="btn btn-primary"><i class="fas fa-paper-plane"></i> Update</button>
</form>
