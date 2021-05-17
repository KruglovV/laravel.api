<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function getAllBooks() {
        $books = Book::get()->toJson(JSON_PRETTY_PRINT);
        return response($books, 200);
    }

    public function getBook($id) {
        if(Book::where('id', $id)->exists()) {
            $book = Book::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($book, 200);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }

    public function createBook(Request $request) {
        $book = new Book;
        $book->name = $request->name;
        $book->author = $request->author;
        $book->save();

        return response()->json([
            "message" => "Book successfully added"
        ], 201);
    }

    public function updateBook(Request $request, $id) {
        if(Book::where('id', $id)) {
            $book = Book::find('id');

            $book->name = is_null($request->name) ? $book->name : $request->name;
            $book->author = is_null($request->author) ? $book->author : $request->author;

            return response()->json([
                "message" => "Book successfully updated"
            ], 200);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }

    public function deleteBook($id) {
        if(Book::where('id', $id)->exist()) {
            $book = Book::find($id);
            $book->delete();

            return response()->json([
                "message" => "Book deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Book not found"
            ], 404);
        }
    }
}
