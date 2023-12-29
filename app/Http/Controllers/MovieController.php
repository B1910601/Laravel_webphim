<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Category;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Movie_genre;
use App\Models\Episode;
use App\Models\Info;
use Carbon\Carbon;
use File;
use Storage;
class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category_choose(Request $request){
        $data = $request->all();
        $movie= Movie::find($data['movie_id']);
        $movie->category_id = $data['category_id'];
        $movie->save();
    }
     public function country_choose(Request $request){
        $data = $request->all();
        $movie= Movie::find($data['movie_id']);
        $movie->country_id = $data['country_id'];
        $movie->save();
    }
    public function index()
    {
        $list = Movie::with('category','movie_genre','country','genre')->withCount('episode')->orderBy('id','DESC')->get();
       
        $category = Category::pluck('title', 'id');
        $country = Country::pluck('title', 'id');

        $Path=public_path()."/json_file/";
        if(!is_dir($Path)){
            mkdir($Path,0777,true);
        }
        File::put($Path.'movies.json',json_encode($list));
        return view('admincp.movie.index', compact('list','category','country'));
    }
    public function update_year(Request $request) {
            $data = $request->all();
            $movie = Movie::find($data['id_phim']);
            $movie->year = $data['year'];
            $movie->save(); 
    }
     public function update_season(Request $request) {
            $data = $request->all();
            $movie = Movie::find($data['id_phim']);
            $movie->season=$data['season'];
            $movie->save(); 
    }
    public function update_topview(Request $request) {
            $data = $request->all();
            $movie = Movie::find($data['id_phim']);
            $movie->topview=$data['topview'];
            $movie->save(); 
    }
    // public function filter_topview(Request $request) {
    //         $data = $request->all();
    //         $movie = Movie::where('topview',$data['value'])->orderBy('ngaycapnhat','DESC')->take(20)->get();

    //         $output = '';
    //         foreach($movie as $key => $mov){
    //             if($mov->resolution==0){
    //                 $text = 'HD';
    //             }else if($mov->resolution==1){
    //                 $text = 'SD';
    //             }else {
    //                 $text = 'FullHD';
    //             }
    //         $output.='<div class="item">
    //                           <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
    //                              <div class="item-link">
    //                                 <img src="'.url('uploads/movie/'.$mov->image).'" alt="'.$mov->title.'" title="'.$mov->title.'" />
    //                                 <span class="is_trailer">
    //                                     '.$text.'
    //                                 </span>
    //                              </div>
    //                              <p class="title">'.$mov->title.'</p>
    //                           </a>
    //                           <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
    //                           <div style="float: left;">
    //                              <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
    //                              <span style="width: 0%"></span>
    //                              </span>
    //                           </div>
    //                           </div>';
    //         }
    //         echo $output;
            
    // public function filter_default(Request $request) {
    //         $data = $request->all();
    //         $movie = Movie::where('topview',0)->orderBy('ngaycapnhat','DESC')->take(20)->get();

    //         $output = '';
    //         foreach($movie as $key => $mov){
    //             if($mov->resolution==0){
    //                 $text = 'HD';
    //             }else if($mov->resolution==1){
    //                 $text = 'SD';
    //             }else {
    //                 $text = 'FullHD';
    //             }
    //         $output.='<div class="item">
    //                           <a href="'.url('phim/'.$mov->slug).'" title="'.$mov->title.'">
    //                              <div class="item-link">
    //                                 <img src="'.url('uploads/movie/'.$mov->image).'" alt="'.$mov->title.'" title="'.$mov->title.'" />
    //                                 <span class="is_trailer">
    //                                     '.$text.'
    //                                 </span>
    //                              </div>
    //                              <p class="title">'.$mov->title.'</p>
    //                           </a>
    //                           <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
    //                           <div style="float: left;">
    //                              <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
    //                              <span style="width: 0%"></span>
    //                              </span>
    //                           </div>
    //                           </div>';
    //         }
    //         echo $output;
            
    // }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $list_genre = Genre::all();
        $country = Country::pluck('title','id');
        return view('admincp.movie.form', compact('category','genre','country','list_genre'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $movie = new Movie();
        $movie->title = $data['title'];
        $movie->sotap = $data['sotap'];
        $movie->thuocphim = $data['thuocphim'];
        $movie->trailer = $data['trailer'];
        $movie->resolution = $data['resolution'];
        $movie->phude = $data['phude'];
        $movie->tags = $data['tags'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->slug = $data['slug'];
        $movie->name_eng = $data['name_eng'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
        $movie->country_id = $data['country_id'];
        $movie->ngaytao = Carbon::now('Asia/Ho_Chi_Minh');
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
        foreach($data['genre'] as $key =>$gen ){

            $movie->genre_id = $gen[0];
        }
     
        // $movie->genre_id = $data['genre_id'];

        $get_image = $request->file('image');

        if($get_image){

            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('uploads/movie/',$new_image);
            $movie->image = $new_image;
        }
        $movie->save();

        $movie->movie_genre()->attach($data['genre']);
        return redirect()->route('movie.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::pluck('title','id');
        $genre = Genre::pluck('title','id');
        $list_genre = Genre::all();
        $country = Country::pluck('title','id');
        $movie =  Movie::find($id);
        $movie_genre = $movie->movie_genre;
        return view('admincp.movie.form', compact('category','genre','country','list_genre','movie','movie_genre'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $movie = Movie::find($id);
        $movie->title = $data['title'];
        $movie->sotap = $data['sotap'];
        $movie->thuocphim = $data['thuocphim'];
        $movie->trailer = $data['trailer'];
        $movie->tags = $data['tags'];
        $movie->thoiluong = $data['thoiluong'];
        $movie->slug = $data['slug'];
        $movie->name_eng = $data['name_eng'];
        $movie->resolution = $data['resolution'];
        $movie->phude = $data['phude'];
        $movie->phim_hot = $data['phim_hot'];
        $movie->description = $data['description'];
        $movie->status = $data['status'];
        $movie->category_id = $data['category_id'];
      
        $movie->country_id = $data['country_id'];
        $movie->ngaycapnhat = Carbon::now('Asia/Ho_Chi_Minh');
         foreach($data['genre'] as $key =>$gen ){

            $movie->genre_id = $gen[0];
        }
        $get_image = $request->file('image');

        if($get_image){
            if(file_exists('uploads/movie/'.$movie->image)){
                unlink('uploads/movie/'.$movie->image);
            }else{
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0,9999).'.'.$get_image->getClientOriginalExtension();
                $get_image->move('uploads/movie/',$new_image);
                $movie->image = $new_image;
            }
        }
        $movie->save();
         $movie->movie_genre()->sync($data['genre']);
          return redirect()->route('movie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $movie = Movie::find($id);
        //xoa anh
        if(file_exists('uploads/movie/'.$movie->image)){
            unlink('uploads/movie/'.$movie->image);
        }
        // xoa the loai
        Movie_genre::whereIn('movie_id',[$movie->id])->delete();
      
        Episode::whereIn('movie_id',[$movie->id])->delete();
        $movie->delete();

        return redirect()->back();
 

    }
}
