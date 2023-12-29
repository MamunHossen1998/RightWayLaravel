<?php

namespace App\Http\Controllers;

// include "/laragon/www/Only-test/app/Services/OfferService.php";

use App\Http\Requests\StoreOfferRequest;
use App\Models\Category;
use App\Models\Location;
use App\Models\Offer;
use App\Services\OfferService;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($request->query());
        
        // $offers = Offer::all(); //ata akta way
        // $offers = Offer::with(['author', 'categories', 'locations'])->get();//ata akta way
        $query = Offer::with(['author', 'categories', 'locations']); //ata akta way
        // $offers = collect([]);//Not data found check er jonno
        $categories = Category::orderBy('title')->select('title', 'id')->get();
        $locations = Location::all();
        if(request()->query('status')){
            $query = $query->where('status',request()->query('status'));
        }
        if(request()->query('location')){
            $location = request()->query('location');
        }
        if(request()->query('category')){
            $catetory =request()->query('category');
        }
        if(request()->query('title')){
            $query = $query->where('title',request()->query('title'));
        }
        // print_r($query);
        
        $offers = $query->paginate(5);
        return view('offers.index',compact('offers', 'categories', 'locations'));
    }

    function MyOffers(Request $request){
        $this->authorize('MyView', Offer::class);
        $query = Offer::with(['author', 'categories', 'locations']); //ata akta way
        // $offers = collect([]);//Not data found check er jonno
        $categories = Category::orderBy('title')->select('title', 'id')->get();
        $locations = Location::all();
        if (request()->query('status')) {
            $query = $query->where('status', request()->query('status'));
        }
        if (request()->query('location')) {
            $location = request()->query('location');
        }
        if (request()->query('category')) {
            $catetory = request()->query('category');
        }
        if (request()->query('title')) {
            $query = $query->where('title', request()->query('title'));
        }
        $query = $query->where('author_id', auth()->user()->id);
        $offers = $query->paginate(5);
        return view('offers.index', compact('offers', 'categories', 'locations'));
     
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Offer::class);
        // $categories = Category::all();
        $categories = Category::orderBy('title')->get();
        $locations = Location::all();
        return view('offers.create', compact('categories', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOfferRequest $request, OfferService $offerServices)
    {
        $this->authorize('create', Offer::class);
        $offerServices->store(
            $request->validated(),
            $request->hasFile('offer_img') ? $request->file('offer_img') : null

        );
        // exit;

        // try {
        //     // throw new \Exception('Not created');
        // } catch (\Exception $e) {
        //     return redirect()->back()->with(['error' => "Sometimes went wrong"]);
        // }

        /* $data = array_merge([
            'author_id'=> auth()->user()->id,
        ], $request->all()); এই কাজটুকু এখন অফার সার্ভিস ক্লাসে করা হয়েছে।
// $request['author_id'] = auth()->user()->id;
        $offer = Offer::create($data);
        $offer->categories()->sync($request->get('categories'));
        $offer->locations()->sync($request->get('locations')); */


        return redirect()->back()->with(['success' => "Offer created sucessfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Offer $offer)
    {
        // return $offer;

        return view('offers.show', compact('offer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Offer $offer)
    {
        $this->authorize('update', $offer);

        // $categories = Category::all();
        $categories = Category::orderBy('title')->get();
        $locations = Location::all();
        return view('Offers.edit', compact('offer', 'categories', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreOfferRequest $request, Offer $offer, OfferService $offerServices)
    {
        $this->authorize('update', $offer);
        $offerServices->update(
            $offer,
            $request->validated(),
            $request->hasFile('offer_img') ? $request->file('offer_img') : null

        );
        return redirect()->back()->with(['success' => "Offer updated sucessfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        $offer->delete();
        return response('delete success');
    }
}
