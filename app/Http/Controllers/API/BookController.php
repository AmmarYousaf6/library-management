<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     *
     */
    public function __construct()
    {
//        $this->middleware('auth:api')->except([
//            'index',
//            'show'
//        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */

    public function index()
    {
        $books = (new Book)->paginate(10);

        return response()->json([
            'data' => $books,
            'message' => 'Success',
            'status' => 200
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateBookRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateBookRequest $request)
    {
        $book = new Book();
        $book->title = $request->title;
        $book->isbn = $request->isbn;
        $book->published_at = $request->published_at;
        $book->save();

        return response()->json([
            'data' => $book,
            'message' => 'Book has been saved',
            'status' => 200,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Book $book)
    {
        return response()->json([
            'data' => $book,
            'message' => 'Success',
            'status' => 200
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'published_at' => $request->published_at
        ]);

        return response()->json([
            'data' => $book,
            'message' => 'Book has been updated!',
            'status' => 200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json([
            'message' => 'Book has been removed',
            'status' => 200
        ]);
    }

    /**
     * Checkout the specified resource from storage.
     *
     * @param Request $request
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkout(Request $request, Book $book)
    {
        if ($request->route('book')->status === Book::STATUS['CHECKED_OUT']) {
            return response()->json([
                'data' => [],
                'message' => 'The book is not available.',
                'code' => 200,
            ]);
        }

        DB::transaction(function () use ($book) {
            $user_id = 1;//Auth::user()->getAuthIdentifier();
            $book->users()->attach($user_id, [
                'action' => config('enums.book_action.CHECKOUT')
            ]);
            $book->status = Book::STATUS['CHECKED_OUT'];
            $book->update();
        });

        return response()->json([
            'data' => [],
            'message' => 'Success checking-out book',
            'code' => 200,
        ]);
    }

    /**
     * Checkin the specified resource from storage.
     *
     * @param Request $request
     * @param Book $book
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkin(Request $request, Book $book)
    {
        if ($request->route('book')->status === Book::STATUS['AVAILABLE']) {
            return response()->json([
                'data' => [],
                'message' => 'The book is not checked-out.',
                'code' => 200,
            ]);
        }

        DB::transaction(function () use ($book) {
            $user_id = 1;//Auth::user()->getAuthIdentifier();
            $book->users()->attach($user_id, [
                'action' => config('enums.book_action.CHECKIN')
            ]);
            $book->status = Book::STATUS['AVAILABLE'];
            $book->update();
        });

        return response()->json([
            'data' => [],
            'message' => 'Success checking-in book',
            'code' => 200,
        ]);
    }


}
