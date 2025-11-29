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
        return BookResource::collection(Book::all());
    }

    /**
     * ==========2===========
     * Simpan buku baru ke dalam penyimpanan.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required|string',
            'author' => 'required|string',
            'published_year' => 'required|digits:4'
        ]);

        if ($valid->fails()) {
            return response()->json($valid->errors(), 422);
        }

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
            'published_year' => $request->published_year
        ]);

        return new BookResource($book);
    }

    /**
     * =========3===========
     * Tampilkan detail buku tertentu.
     */
    public function show(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        return new BookResource($book);
    }

    /**
     * =========4===========
     * Fungsi untuk memperbarui data buku tertentu
     */
    public function update(Request $request, string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $valid = Validator::make($request->all(), [
            'title' => 'sometimes|string',
            'author' => 'sometimes|string',
            'published_year' => 'sometimes|digits:4'
        ]);

        if ($valid->fails()) {
            return response()->json($valid->errors(), 422);
        }

        $book->update($request->all());

        return new BookResource($book);
    }

    /**
     * =========5===========
     * Hapus buku tertentu dari penyimpanan.
     */
    public function destroy(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Data successfully deleted']);
    }

    /**
     * =========6===========
     * Ubah status ketersediaan buku (ubah field is_available)
     */
    public function borrowReturn(string $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Data not found'], 404);
        }

        $book->is_available = !$book->is_available;
        $book->save();

        return new BookResource($book);
    }
}
