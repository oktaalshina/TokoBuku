<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <a href="{{ route('buku.create') }}" class="btn btn-primary float-end">Tambah Buku</a>

        <form method="GET" action="{{ route('buku.index') }}">
            <input type="text" name="search" placeholder="Masukkan judul buku..."
                value="{{ request('search') }}">
            <button type="submit">Cari</button>
        </form>

        <form method="GET" action="{{ route('buku.index') }}">
            <label for="penulis" class="form-label">Pilih penulis</label>
            <select name="penulis" id="penulis" class="form-select" onchange="this.form.submit()">
                <option value="">-- Semua Penulis --</option>
                @foreach($data_penulis as $penulis)
                    <option value="{{ $penulis->penulis }}" 
                        {{ request('penulis') == $penulis->penulis ? 'selected' : '' }}>
                        {{ $penulis->penulis }}
                    </option>
                @endforeach
            </select>
        </form>

        <h1>Daftar Buku</h1>
        @if ($data_buku->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Harga</th>
                        <th>Tanggal Terbit</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data_buku as $index => $buku)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                        <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                        <td>
                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin akan dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-danger">Tidak ada data ditemukan</p>
    @endif

    <div class="container mt-4">
            <div class="row">
                <div class="col">
                    <div class="card text-bg-primary mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Total Buku</h4>
                            <p class="card-text fs-3">{{ $total_buku }}</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card text-bg-primary mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Total harga semua buku</h4>
                            <p class="card-text fs-3">{{"Rp. ".number_format($total_harga_semua_buku, 2, ',', '.')}}</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card text-bg-primary mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Harga Tertinggi</h4>
                            <p class="card-text fs-3">{{ "Rp. ".number_format($harga_tertinggi, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="card text-bg-primary mb-4">
                        <div class="card-body">
                            <h4 class="card-title">Harga Terendah</h4>
                            <p class="card-text fs-3">{{ "Rp. ".number_format($harga_terendah, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h1>5 Buku Terbaru</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lima_buku as $index => $limaBuku)
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $limaBuku->judul }}</td>
                    <td>{{ $limaBuku->penulis }}</td>
                    <td>{{ "Rp. ".number_format($limaBuku->harga, 2, ',', '.') }}</td>
                    <td>{{ $limaBuku->tgl_terbit->format('d/m/Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
</html>