<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
    
        $bukus = Buku::orderBy('id', 'desc')
                      ->when($search, function ($query, $search) {
                          return $query->where('judul', 'like', '%'.$search.'%')
                                       ->orWhere('pengarang', 'like', '%'.$search.'%')
                                       ->orWhere('penerbit', 'like', '%'.$search.'%');
                      })
                      ->paginate(10);
    
        return view('buku.index', compact('bukus', 'search'));
    }
    
    public function indexPublic(Request $request)
    {
    $search = $request->get('search');

    $buku = Buku::where('judul', 'like', "%$search%")
        ->orWhere('pengarang', 'like', "%$search%")
        ->orWhere('penerbit', 'like', "%$search%")
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('buku.public.index', compact('buku'));
    }
    
    public function showPublic($id)
    {
        $buku = Buku::where('id', $id)->first();
    
        if ($buku) {
            return view('buku.public.show', compact('buku'));
        } else {
            abort(404);
        }
    }
    
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input field
        $validatedData = $request->validate([
            'judul' => 'required|max:255',
            'penerbit' => 'required|max:255',
            'pengarang' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Proses upload image
        $path = $request->file('image')->store('public/images');

        // Simpan data buku ke database
        $buku = new Buku;
        $buku->judul = $validatedData['judul'];
        $buku->penerbit = $validatedData['penerbit'];
        $buku->pengarang = $validatedData['pengarang'];
        $buku->image = $path;
        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Book has been added successfully.');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
    
        return view('buku.show', compact('buku'));
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
    
        return view('buku.update', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
{
    $request->validate([
        'judul' => 'required',
        'penerbit' => 'required',
        'pengarang' => 'required',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    if ($request->hasFile('image')) {
        if ($buku->image) {
            Storage::delete('public/'.$buku->image);
        }
        $image = $request->file('image')->store('public');
        $image = str_replace('public/', '', $image);
    } else {
        $image = $buku->image;
    }

    $buku->update([
        'judul' => $request->judul,
        'penerbit' => $request->penerbit,
        'pengarang' => $request->pengarang,
        'image' => $image,
    ]);

    return redirect()->route('buku.index')
                     ->with('success', 'Data buku berhasil diperbarui');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buku $buku)
    {
        // Delete the image file from storage if it exists
    if ($buku->image) {
        Storage::delete('public/'.$buku->image);
    }

    // Delete the book
    $buku->delete();

    // Redirect to index page with success message
    return redirect()->route('buku.index')->with('success', 'Book deleted successfully!');

    }
}