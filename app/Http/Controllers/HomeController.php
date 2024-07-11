<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if( auth()->user()->isdefault){
            return view('pages.changepass');
        }

        $page = '';

        switch ( auth()->user()->type) {
            case 5:
                $page = 'pages.home'; // Admin view
                break;
            default:
                // Handle other usertypes or provide a default view
                $page = 'pages.homeborrower';
                break;
        }

        if($page == 'pages.home') {
            $labels = [];
            $borrowed = [];
            $returned = [];
            
            $genres = DB::table('library_genres')->get();
            foreach($genres as $genre){
                $labels[] = $genre->genre_name;
                $borrowed[] = DB::table('library_circulation')
                    ->where('circulation_status', 2)
                    ->where('library_books.book_genre', $genre->id)
                    ->join('library_books', 'library_circulation.circulation_book_id', '=', 'library_books.id')
                    ->count();
                $returned[] = DB::table('library_circulation')
                    ->where('circulation_status', 3)
                    ->where('library_books.book_genre', $genre->id)
                    ->join('library_books', 'library_circulation.circulation_book_id', '=', 'library_books.id')
                    ->count();
            }

            $datasets = [
                'labels' => $labels,
                'datasets' => [
                    [
                        'label' => 'Borrowed',
                        'data' => $borrowed
                    ],
                    [
                        'label' => 'Returned',
                        'data' => $returned
                    ],
                ] 
            ];

            $jsonData = DB::table('library_circulation')
                ->leftJoin('library_books', 'library_circulation.circulation_book_id', '=', 'library_books.id')
                ->leftJoin('employee_personalinfo', 'library_circulation.circulation_members_id', '=', 'employee_personalinfo.employeeid')
                ->join('library_status', 'library_circulation.circulation_status', '=', 'library_status.id')
                ->join('libraries', 'library_books.library_branch', '=', 'libraries.id')
                ->where('library_circulation.circulation_deleted', 0)
                ->where('library_circulation.circulation_status', '!=', 3)
                ->whereNotNull('library_circulation.circulation_due_date') // Ensure there is a due date
                ->whereDate('library_circulation.circulation_due_date', '<', now()) // Filter overdue items
                ->select(
                    'employee_personalinfo.contactnum',
                    'library_circulation.*', 
                    'library_books.book_title', 
                    'library_books.book_author', 
                    'libraries.library_name', 
                    'library_status.status_name'
                )
                ->get();

            foreach ($jsonData as $item) {
                $item->circulation_due_date = new \DateTime($item->circulation_due_date);
                $item->circulation_due_date = $item->circulation_due_date->format('F d, Y');
            }

            $totalBorrowed = DB::table('library_circulation')->where('circulation_deleted', 0)->where('circulation_status', 2)->count();
            $totalReturned = DB::table('library_circulation')->where('circulation_deleted', 0)->where('circulation_status', 3)->count();
            $totalIssued = DB::table('library_circulation')->where('circulation_deleted', 0)->where('circulation_status', 1)->count();
            $totalLost = DB::table('library_circulation')->where('circulation_deleted', 0)->where('circulation_status', 4)->count();

            return view($page, [
                'jsonData' => $jsonData,
                'totalBorrowed' => $totalBorrowed,
                'totalReturned' => $totalReturned,
                'totalIssued' => $totalIssued,
                'totalLost' => $totalLost,
                'transactions' => $datasets,
            ]);
        }else{
            return view($page);
        }
    }
}
