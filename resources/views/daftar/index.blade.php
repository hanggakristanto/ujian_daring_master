<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" />


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                scrollX: true,
            });
        });
    </script>
</head>

<body style="background: lightgray">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <a href="{{ route('daftar.create') }}" class="btn btn-md btn-success mb-3">TAMBAH DATA</a>
                        <table id="example" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>jenis_kelamin</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Cv</th>
                                    <th>KTP</th>
                                    <th>Ijazah</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($daftars as $daftar)
                                <tr>
                                    <td>{{ $daftar->nama }}</td>
                                    <td>{{ $daftar->email }}</td>
                                    <td>{{ $daftar->jenis_kelamin }}</td>
                                    <td>{{ $daftar->ttl }}</td>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/daftars/').$daftar->cv }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/daftars/').$daftar->ktp }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center">
                                        <img src="{{ Storage::url('public/daftars/').$daftar->ijazah }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('daftar.destroy', $daftar->id) }}" method="POST">
                                            <a href="{{ route('daftar.edit', $daftar->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <div class="alert alert-danger">
                                    Data Daftar belum Tersedia.
                                </div>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $daftars->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        //message with toastr
        // @if(session() - > has('success'))

        // toastr.success('{{ session('
        //     success ') }}', 'BERHASIL!');

        // @elseif(session() - > has('error'))

        // toastr.error('{{ session('
        //     error ') }}', 'GAGAL!');

        // @endif
    </script>



</body>

</html>