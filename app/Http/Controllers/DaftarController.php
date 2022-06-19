<?php

namespace App\Http\Controllers;

use App\Models\Daftar;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DaftarController extends Controller
{
    public function index()
    {
        $daftars = Daftar::latest()->paginate(10);
        return view('daftar.index', compact('daftars'));
    }

    public function create()
    {
        return view('daftar.create');
    }


    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama'     => 'required',
            'email'   => 'required',
            'wa'   => 'required',
            'jenis_kelamin' => ['required'],
            'ttl' => ['required'],
            'cv'     => 'required|mimes:png,jpg,jpeg,pdf',
            'ktp'     => 'required|mimes:png,jpg,jpeg,pdf',
            'ijazah'     => 'required|mimes:png,jpg,jpeg,pdf',
        ]);

        //upload image
        $cv = $request->file('cv');
        $ktp = $request->file('ktp');
        $ijazah = $request->file('ijazah');
        $cv->storeAs('public/daftar', $cv->hashName());
        $ktp->storeAs('public/daftar', $ktp->hashName());
        $ijazah->storeAs('public/daftar', $ijazah->hashName());

        $password = '123';
        $daftar = Siswa::create([
            'rombel_id' => '1',
            'nama'     => $request->nama,
            'nis'   => $request->email,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'wa'   => $request->wa,
            // 'password' => Hash::make($request->password),
            'password' => Hash::make($password),
            'cv'     => $cv->hashName(),
            'ktp'     => $ktp->hashName(),
            'ijazah'     => $ijazah->hashName(),
        ]);

        if ($daftar) {
            //redirect dengan pesan sukses
            return redirect()->route('login')->with(['success' => 'Data Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('daftar.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    public function edit(Blog $blog)
    {
        return view('blog.edit', compact('blog'));
    }


    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $blog
     * @return void
     */
    public function update(Request $request, Blog $blog)
    {
        $this->validate($request, [
            'title'     => 'required',
            'content'   => 'required'
        ]);

        //get data Blog by ID
        $blog = Blog::findOrFail($blog->id);

        if ($request->file('image') == "") {

            $blog->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/blogs/' . $blog->image);

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/blogs', $image->hashName());

            $blog->update([
                'image'     => $image->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        }

        if ($request->file('image1') == "") {

            $blog->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/blogs/' . $blog->image1);

            //upload new image
            $image1 = $request->file('image1');
            $image1->storeAs('public/blogs', $image1->hashName());


            $blog->update([
                'image1'     => $image1->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        }
        if ($request->file('image2') == "") {

            $blog->update([
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        } else {

            //hapus old image
            Storage::disk('local')->delete('public/blogs/' . $blog->image2);

            //upload new image
            $image2 = $request->file('image2');
            $image2->storeAs('public/blogs', $image2->hashName());


            $blog->update([
                'image2'     => $image2->hashName(),
                'title'     => $request->title,
                'content'   => $request->content
            ]);
        }

        if ($blog) {
            //redirect dengan pesan sukses
            return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('blog.index')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        Storage::disk('local')->delete('public/blogs/' . $blog->image);
        Storage::disk('local')->delete('public/blogs/' . $blog->image1);
        Storage::disk('local')->delete('public/blogs/' . $blog->image2);
        $blog->delete();

        if ($blog) {
            //redirect dengan pesan sukses
            return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('blog.index')->with(['error' => 'Data Gagal Dihapus!']);
        }
    }
}
