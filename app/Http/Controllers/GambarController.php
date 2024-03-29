<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;

use App\Gambar;

class GambarController extends Controller
{
    public function index($komik_id, $ch, $id)
    {
        $gambar = Gambar::where("chapter_id", $id)->get();
        return view('/backend/gambar/index', ['gambar' => $gambar, 'komik_id' => $komik_id, 'ch' => $ch, 'chapter_id' => $id]);
    }

    public function tambah($komik_id, $ch, $id)
    {
        return view('/backend/gambar/tambah', ['komik_id' => $komik_id, 'ch' => $ch, 'chapter_id' => $id]);
    }

    public function store(Request $request)
    {
		// menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        if(count($request->file('file')) > 0) {
            foreach ($file as $f) {

                $nama_gambar = time()."_".$request->chapter_id."-".$f->getClientOriginalName();

                // isi dengan nama folder tempat kemana file diupload
                $tujuan_upload = 'data_gambar/komik-'.$request->komik_id.'/ch-'.$request->ch;
                $f->move($tujuan_upload,$nama_gambar); 
        
                Gambar::create([
                    'chapter_id' => $request->chapter_id,
                    'nama_gambar' => $nama_gambar,
                ]);
            }
        }

        return redirect(route('gambar', ['komik_id'=>$request->komik_id,'ch'=>$request->ch,'id'=>$request->chapter_id])); 
    }

    public function ubah($komik_id, $ch, $id, $gid)
    {
        $gambar = Gambar::find($gid);

        return view('/backend/gambar/ubah', ['gambar' => $gambar, 'komik_id' => $komik_id, 'ch' => $ch, 'chapter_id' => $id]);
    }

    public function update($id, Request $request)
    {
        // menyimpan data file yang diupload ke variabel $file
		$file = $request->file('file');
		$nama_gambar = time()."_".$file->getClientOriginalName();

      	// isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_gambar/komik-'.$request->komik_id.'/ch-'.$request->ch;
		$file->move($tujuan_upload,$nama_gambar);

        $gambar = Gambar::find($id);
        $gambar->nama_gambar = $nama_gambar;
        $gambar->save();

        return redirect(route('gambar', ['komik_id'=>$request->komik_id,'ch'=>$request->ch,'id'=>$request->chapter_id])); 
    }

    public function hapus($komik_id, $ch, $gid)
    {
        $gambar = Gambar::find($gid);
	    File::delete('data_gambar/komik-'.$komik_id.'/ch-'.$ch.'/'.$gambar->nama_gambar);
	    // hapus data
	    Gambar::find($gid)->delete();

        return redirect()->back();
    }
}
