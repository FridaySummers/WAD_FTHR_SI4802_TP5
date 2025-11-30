<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use App\Http\Resources\BookResource;

class BooksController extends Controller
{
    /**
     * ==========1===========
     * Tampilkan daftar semua buku
     */
    public function index()
    {
        $books = Book::all();
        return response()-> json(['data'=> $books]);
    }

    /**
     * ==========2===========
     * Simpan buku baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        $book = Book::create([
            'title'=> $request-> title, 
            'author'=> $request-> author, 
            'published_year'=> $request-> published_year, 
            'is_available'=> $request-> is_available??true, 

        ]);
        return response()-> json([
            'message'=> 'buku berhasil ditambahkan',
            'data'=> $book, 
        ], 201);
    }

    /**
     * =========3===========
     * Tampilkan detail buku tertentu.
     */
    public function show(string $id)
    {
        $book = Book::find($id);
        if (!$book) return response()-> json(['message'=> 'buku tidak ditemukan !'],404);
        return response()-> json(['data'=> $book]);
    }

    /**
     * =========4===========
     * Fungsi untuk memperbarui data buku tertentu
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);
        if (!$book) return response()-> json(['massage'=> 'buku tidak ditemukan !'],404);
        $book-> update($request->all());
        return response()-> json([
            'massage'=> 'buku berhasil diedit',
            'data'=> $book, 
        ], 200);
    }

    /**
     * =========5===========
     * Hapus buku tertentu dari penyimpanan.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);
        if (!$book) return response()-> json(['massage'=> 'buku tidak ditemukan'],404);
        $book-> delete();
        return response()-> json([
            'massage'=> 'buku berhasil dihapus',    
        ], 200);
    }

    /**
     * =========6===========
     * Ubah status ketersediaan buku (ubah field is_available)
     */
    public function borrowReturn(string $id)
    {
        $book = Book::findOrFail($id);
        $book->update(['is_available' => !$book->is_available]);

        return (new BookResource($book))
            ->additional([
                'message' => 'Book availability status changed successfully'
            ])
            ->response()
            ->setStatusCode(200);
    }
}
    