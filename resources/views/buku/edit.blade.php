<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h4>Edit Buku</h4>
            <form method="post" action="{{ route('buku.update', $buku->id) }}">
            @csrf
            @method('PUT')
            <div>Judul <input type="text" name="judul" value="{{ $buku->judul }}"></div>
            <div>Penulis <input type="text" name="penulis" value="{{ $buku->penulis }}"></div>
            <div>Harga <input type="text" name="harga" value="{{ $buku->harga }}"></div>
            <div>Tanggal Terbit <input type="date" name="tgl_terbit" value="{{ $buku->tgl_terbit->format('Y-m-d') }}"></div>
            <button type="submit">Update</button>
            <a href="{{ '/buku' }}">Kembali</a>
            </form>
        </div>
    </body>
</html>
