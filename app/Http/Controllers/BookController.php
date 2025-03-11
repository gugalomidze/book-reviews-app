<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Validator;
use File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BookController extends Controller
{
    // this method will show books listing page
    public function index(Request $request)
    {

        $books = Book::orderBy('created_at', 'DESC');

        if (!empty($request->keyword)) {
            $books->where('title', 'like', '%'.$request->keyword.'%');
        }

        $books = $books->paginate(10);

        return view('books.list', [
            'books' => $books
        ]);
    }

    // this method will store books in a database
    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request) {
        $rules = [
            'title' => 'required|min:5',
            'author' => 'required|min:3',
            'status' => 'required'
        ];

        if (!empty($request->image)) {
            $rules['image'] = 'image';
        }


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('books.create')->withInput()->withErrors($validator);
        }

        // save book in DB
        $book = new Book();
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->status = $request->status;
        $book->save();

        // upload book image

        if (!empty($request->image)) {
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('uploads/books'),$imageName);

            $book->image = $imageName;
            $book->save();

            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('uploads/books/'.$imageName));

            $img->resize(900);
            $img->save(public_path('uploads/books/thumb/'.$imageName));
        }


        return redirect()->route('books.index')->with('success', 'book added successfully!!!');

    }

    // this method will edit books in a database
    public function edit($id)
    {
        $book = Book::findOrFail($id);

        return view('books.edit',[
            'book' => $book
        ]);
    }

    // this method will update
    public function update($id, Request $request)
    {
        $book = Book::findOrFail($id);

        $rules = [
            'title' => 'required|min:5',
            'author' => 'required|min:3',
            'status' => 'required'
        ];

        if (!empty($request->image)) {
            $rules['image'] = 'image';
        }


        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('books.edit', $book->id)->withInput()->withErrors($validator);
        }

        // update book in DB
        $book->title = $request->title;
        $book->description = $request->description;
        $book->author = $request->author;
        $book->status = $request->status;
        $book->save();

        // upload book image

        if (!empty($request->image)) {

            File::delete(public_path('uploads/books/'.$book->image));
            File::delete(public_path('uploads/books/thumb'.$book->image));

            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time().'.'.$ext;
            $image->move(public_path('uploads/books'),$imageName);

            $book->image = $imageName;
            $book->save();

            // Generate image Thumbnail
            $manager = new ImageManager(Driver::class);
            $img = $manager->read(public_path('uploads/books/'.$imageName));
            $img->resize(990);
            $img->save(public_path('uploads/books/thumb/'.$imageName));
        }


        return redirect()->route('books.index', $book->id)->with('success', 'book updated successfully!!!');
    }

    // this method will delete
    public function destroy(Request $request)
    {
        $book = Book::find($request->id);

        if ($book == null) {
            session()->flash('error', 'Book not found');
            return response()->json([
                'status' => false,
                'message' => 'Book not found'
            ]);
        } else {
            File::delete(public_path('uploads/books/'.$book->image));
            File::delete(public_path('uploads/books/thumb'.$book->image));
            $book->delete();
        }

        session()->flash('error', 'Book deleted successfully!!!');
        return response()->json([
            'status' => true,
            'message' => 'Book deleted successfully!!!'
        ]);

    }
}
