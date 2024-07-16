<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('title', 'like', "%$search%")
                  ->orWhere('description', 'like', "%$search%")
                  ->orWhere('genre', 'like', "%$search%");
        }

        $books = $query->paginate(10);

        return response()->json($books);
    }

    public function borrow(Request $request, $id)
    {
        // Logic to borrow a book (add to session)
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['error' => 'Book not found'], 404);
        }

        $borrowedBooks = session()->get('borrowed_books', []);
        $borrowedBooks[$id] = $book;
        session()->put('borrowed_books', $borrowedBooks);

        return response()->json(['message' => 'Book borrowed successfully']);
    }

    public function returnBook(Request $request, $id)
    {
        // Logic to return a book (remove from session)
        $borrowedBooks = session()->get('borrowed_books', []);
        if (isset($borrowedBooks[$id])) {
            unset($borrowedBooks[$id]);
            session()->put('borrowed_books', $borrowedBooks);
            return response()->json(['message' => 'Book returned successfully']);
        }

        return response()->json(['error' => 'Book not found in borrowed list'], 404);
    }

    public function borrowedBooks()
    {
        $borrowedBooks = session()->get('borrowed_books', []);
        return response()->json($borrowedBooks);
    }
}
