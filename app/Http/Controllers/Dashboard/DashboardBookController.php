<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardBookController extends Controller
{
    public function index()
    {
        // dd(request('search'));
        
        // $book_data = Book::latest();

        // if (request('search')) {
        //     $book_data->where('nama', 'like', '%' . request('search'). '%');
        // }
        return view('book.all',[
            'publisher'=>Publisher::all(),
            'books' => Book::latest()->filter(request(['search', 'publisher']))->paginate(5)
        ]);
    }

    public function show(Book $book)
    {
        return view('book.detail', [
            'book' => $book
        ]);
    }

    public function create()
    {
        return view('book.create', [
            'publisher' => Publisher::all() //mengambil data publisher
        ]);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'publisher_id' => 'required',
            'nama'         => 'required|max:255',
            'pengarang'    => 'required|max:255',
            'harga'        => 'required',
            'release'      => 'required'
        ]);

        Book::create($validateData);
        return redirect('/dashboard/book/all')->with('success', 'Book has been addes !');
    }

    public function destroy(Book $book)
    {
        Book::destroy($book->id);
        return redirect('/dashboard/book/all')->with('success', 'Data has been deleted');
    }

    public function edit(Book $book)
    {
        return view('book.edit', [
            'publisher' => Publisher::all(),
            "book"      => $book
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $validateData = $request->validate([
            'publisher_id' => 'required',
            'nama'         => 'required|max:255',
            'pengarang'    => 'required|max:255',
            'harga'        => 'required',
            'release'      => 'required'
        ]);

        Book::where('id', $book->id)
                    ->update($validateData);

        return redirect('/dashboard/book/all')->with('success', 'Data has been updated !');
    }
}
