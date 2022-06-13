<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Data</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow rounded">
                    <div class="card-body">
                        <form action="{{ route('daftar.store') }}" method="POST" enctype="multipart/form-data">
                        
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-bold">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama">
                                <!-- error message untuk title -->
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" rows="5" placeholder="Masukkan Email">{{ old('email') }}</input>
                                <!-- error message untuk content -->
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Jenis Kelamin</label>
                                    @error('jenis_kelamin')
                                        <div class="alert alert-danger mt-2">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                <select name="jenis_kelamin" class="form-control">
                                    <option value="">-Pilih-</option>
                                    <option @if(old('jenis_kelamin')=='Laki-Laki') selected @endif value="Laki-Laki">Laki-Laki</option>
                                    <option @if(old('jenis_kelamin')=='Perempuan') selected @endif value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Masukkan Cv</label>
                                <input type="file" class="form-control @error('cv') is-invalid @enderror" name="cv">
                            
                                <!-- error message untuk title -->
                                @error('cv')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Masukkan KTP</label>
                                <input type="file" class="form-control @error('ktp') is-invalid @enderror" name="ktp">
                            
                                <!-- error message untuk title -->
                                @error('ktp')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Masukkan Ijazah</label>
                                <input type="file" class="form-control @error('ijazah') is-invalid @enderror" name="ijazah">
                            
                                <!-- error message untuk title -->
                                @error('ijazah')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                            <label class="font-weight-bold">Tanggal Lahir</label>
                                <input type="date" class="form-control" name="ttl" value="{{ old('ttl') }}">
                            </div>

                            
                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'content' );
</script>
</body>
</html>