<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\movie_genre;
use App\Models\Rating;
use App\Models\User;
use Auth;
use DB;
use Hash;

class IndexController extends Controller
{
     public function getdangnhap(){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $category_home = Category::with('movie')->orderBy('id','DESC')->where('status',1)->get();
        return view('pages.dangnhap', compact('category','genre','country','category_home'));
    }
     public function getdangky(){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $category_home = Category::with('movie')->orderBy('id','DESC')->where('status',1)->get();
        return view('pages.dangky', compact('category','genre','country','category_home'));
    }

 public function postdangnhap(Request $req){
        $credentials = array('email'=>$req->email,'password'=>$req->password);
        if(Auth::attempt($credentials)){
                return redirect()->to('/');
        }else{
            return redirect()->route('dang-nhap');
        }
       
    }
    public function getlogout(){
        Auth::logout();
        return redirect()->to('/');
    }
 public function postdangky(Request $req){
            

        $user = new User();
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
       return redirect()->route('dang-nhap');
    }


    public function locphim(){
        

        $sapxep = $_GET['order'];
        $genre_get = $_GET['genre'];
        $country_get = $_GET['country'];
        $year_get = $_GET['year'];

        if ($sapxep=='' && $genre_get=='' && $country_get=='' && $year_get==''){

                return redirect()->back();
        }else{
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_trailer = Movie::where('resolution',3)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('10')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('20')->get();
        //lay du lieu
        $movie = Movie::withCount('episode');
        if ($genre_get){
           $movie = $movie->where('genre_id','=',$genre_get);
        }elseif($country_get){
           $movie = $movie->where('country_id','=',$country_get);

        }elseif($year_get){
              $movie = $movie->where('year','=',$year_get);
        }elseif($order){
              $movie = $movie->orderBy('title','=','ASC');
        }

        $movie = $movie->orderBy('ngaycapnhat','DESC')->paginate(40);

     return view('pages.locphim', compact('category','genre','country','movie','phimhot_sidebar','phimhot_trailer'));

        }

    }
    public function home(){
        $phimhot = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->get();
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $phimhot_trailer = Movie::where('resolution',3)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('10')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('20')->get();
        $country = Country::orderBy('id','DESC')->get();
        $category_home = Category::with('movie')->orderBy('id','DESC')->where('status',1)->get();
    	return view('pages.home', compact('category','genre','country','category_home','phimhot','phimhot_sidebar','phimhot_trailer'));
    }
    public function category($slug){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
         $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('20')->get();
         $phimhot_trailer = Movie::where('resolution',3)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('10')->get();
        $cate_slug = Category::where('slug',$slug)->first();
        $movie = Movie::where('category_id',$cate_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(40);
    	return view('pages.category', compact('category','genre','country','cate_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function year($year){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution',3)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('10')->get();
        $year = $year;
        $movie = Movie::where('year',$year)->orderBy('ngaycapnhat','DESC')->paginate(40);
        return view('pages.year', compact('category','genre','country','year','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function tag($tag){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
         $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('20')->get();
        $tag = $tag;
        $movie = Movie::where('tags','LIKE','%'.$tag.'%')->orderBy('ngaycapnhat','DESC')->paginate(40);
        $phimhot_trailer = Movie::where('resolution',3)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('10')->get();
        return view('pages.tags', compact('category','genre','country','tag','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function genre($slug){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution',3)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('10')->get();
        $genre_slug = Genre::where('slug',$slug)->first();
        $movie_genre = Movie_genre::where('genre_id',$genre_slug->id)->get();
            $many_genre = [];
            foreach($movie_genre as $key => $movi){
                $many_genre[] = $movi->movie_id;
            }
            $movie = Movie::whereIn('id',$many_genre)->orderBy('ngaycapnhat','DESC')->paginate(40);
    	return view('pages.genre', compact('category','genre','country','genre_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function country($slug){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution',3)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('10')->get();
        $country_slug = Country::where('slug',$slug)->first();
        $movie = Movie::where('country_id',$country_slug->id)->orderBy('ngaycapnhat','DESC')->paginate(40);
    	return view('pages.country', compact('category','genre','country','country_slug','movie','phimhot_sidebar','phimhot_trailer'));
    }
    public function movie($slug){
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution',3)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('10')->get();
        $movie = Movie::with('category','genre','country','movie_genre')->where('slug',$slug)->where('status',1)->first();
        //lay 3 tap gan nhat
        $episode = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','DESC')->take(3)->get();
        // lay tong tap phim
        $episode_current_list = Episode::with('movie')->where('movie_id',$movie->id)->get();
        $episode_current_list_count = $episode_current_list->count();
        

        $episode_tapdau = Episode::with('movie')->where('movie_id',$movie->id)->orderBy('episode','ASC')->take(1)->first();
        $related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();
        //danh gia phim
        $rating = Rating::where('movie_id',$movie->id)->avg('rating');
        $rating = round($rating);
        $count_total = Rating::where('movie_id',$movie->id)->count();
return view('pages.movie', compact('category','genre','country','movie','related','phimhot_sidebar','phimhot_trailer','episode','episode_tapdau','episode_current_list_count','rating','count_total'));
    }
    public function add_rating(Request $request){
        $data = $request->all();
        $ip_address = $request->ip();

        $rating_count = Rating::where('movie_id',$data['movie_id'])->where('ip_address',$ip_address)->count();
        if($rating_count>0){
            echo 'exist';

        }else{
            $rating = new Rating();
            $rating->movie_id= $data['movie_id'];
            $rating->rating= $data['index'];
            $rating->ip_address= $ip_address;
            $rating->save();
            echo 'done';

        }
    }
    public function timkiem(){
        if(isset($_GET['search'])){
            $search = $_GET['search'];

        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution',3)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('10')->get();
       
        $movie = Movie::withCount('episode')->where('title','LIKE','%'.$search.'%')->orderBy('ngaycapnhat','DESC')->paginate(40);
         return view('pages.timkiem', compact('category','genre','country','search','movie','phimhot_sidebar','phimhot_trailer'));
        }else {
            return redirect()->to('/');
        }
       
       
    }
    public function watch($slug,$tap){
        
     
      
        $category = Category::orderBy('position','ASC')->where('status',1)->get();
        $genre = Genre::orderBy('id','DESC')->get();
        $country = Country::orderBy('id','DESC')->get();
        $phimhot_sidebar = Movie::where('phim_hot',1)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('20')->get();
        $phimhot_trailer = Movie::where('resolution',3)->where('status',1)->orderBy('ngaycapnhat','DESC')->take('10')->get();
        $movie = Movie::with('category','genre','country','movie_genre','episode')->where('slug',$slug)->where('status',1)->first();
        $related = Movie::with('category','genre','country')->where('category_id',$movie->category->id)->orderBy(DB::raw('RAND()'))->whereNotIn('slug',[$slug])->get();

       if(isset($tap)){

             $tapphim = $tap;
             $tapphim = substr($tap,4,20);
             $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();
        }else{
            $tapphim = 1; 
            $episode = Episode::where('movie_id',$movie->id)->where('episode',$tapphim)->first();

        }
    	return view('pages.watch',compact('category','genre','country','movie','phimhot_sidebar','phimhot_trailer','episode','tapphim','related'));
    }
    public function episode(){
    	return view('pages.episode');
    }
}
