<div class="card mb-3" style="max-width: 540px;">
    <div class="row no-gutters">
        <div class="col-md-4">
            <img src="{{ asset('storage/books/'.$book->image_url) }}" alt="{{ $book->title }}" width="150" height="250"
                class="thumbnail">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $book->title }}</h5>
                <div class="card-text">
                    <tr>
                        <td>
                            <b>Deskripsi</b>
                        </td> <br>
                        <td>{{ Str::limit($book->description,20) }}</td>
                    </tr><br>
                    <tr>
                        <td>Harga </td>
                        <td>Rp {{ number_format($book->price,0,',','.') }}</td>
                    </tr><br>
                    <tr>
                        <td>Kategori </td>
                        <td>{{ $book->category->name }}</td>
                    </tr><br>
                    <tr>
                        <td>Halaman:</td>
                        <td>{{ $book->total_page }}</td>
                    </tr><br>
                    <tr>
                        <td>Ketebalan:</td>
                        <td>{{ $book->thickness }}</td>
                    </tr><br>

                    <small class="text-muted">Tahun Release {{ $book->release_year }}</small>
                </div>
            </div>
        </div>
    </div>
</div>