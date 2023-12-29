<style type="text/css">
li.nav-item.active a {
   background: #0b0f15;
}
.nav-pills>li.active>a, .nav-pills>li.active>a:hover, .nav-pills>li.active>a:focus {
   color: #fff;
   background-color: #0b0f15;
}
li.nav-item a {
   color: aliceblue;
}
li.nav-item a:hover{
   background: crimson;
   border-radius: 0;
}

</style>
                <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
               <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
                  <div class="section-bar clearfix">
                     <div class="section-title">
                        <span>Phim hot</span>
                        
                     </div>
                  </div>
                  <section class="tab-content">
                   <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                        <div class="halim-ajax-popular-post-loading hidden"></div>
                        <div id="halim-ajax-popular-post" class="popular-post">
                           @foreach($phimhot_sidebar as $key => $hot_sidebar)
                           <div class="item post-37176">
                              <a href="{{route('movie',$hot_sidebar->slug)}}" title="{{$hot_sidebar->title}}">
                                 <div class="item-link">
                                    <img class="lazy post-thumb" src="{{asset('uploads/movie/'.$hot_sidebar->image)}}" alt="{{$hot_sidebar->title}}" title="{{$hot_sidebar->title}}" />
                                    <span class="is_trailer">
                                      @if($hot_sidebar->resolution==0)
                                        HD
                                      @elseif($hot_sidebar->resolution==1)
                                          SD
                                      @elseif($hot_sidebar->resolution==2)
                                       FullHD
                                      @else
                                         Trailer
                                      @endif

                                    </span>
                                 </div>

                                 <p class="title">{{$hot_sidebar->title}}</p>

                                     
                              </a>
                             

                              <div style="float: left;">
                                
                                     
                                                 
                              </div>

                           </div>
                          @endforeach
                          
                        </div>
                     </div>
                  </section>
                  <div class="clearfix"></div>
               </div>
            </aside>

                <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
               <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
                  <div class="section-bar clearfix">
                     <div class="section-title">
                        <span>Phim sắp chiếu</span>
                        
                     </div>
                  </div>
                  <section class="tab-content">
                   <div role="tabpanel" class="tab-pane active halim-ajax-popular-post">
                        <div class="halim-ajax-popular-post-loading hidden"></div>
                        <div id="halim-ajax-popular-post" class="popular-post">
                           @foreach($phimhot_trailer as $key => $hot_trailer)
                           <div class="item post-37176">
                              <a href="{{route('movie',$hot_trailer->slug)}}" title="{{$hot_trailer->title}}">
                                 <div class="item-link">
                                    <img class="lazy post-thumb" src="{{asset('uploads/movie/'.$hot_trailer->image)}}" alt="{{$hot_trailer->title}}" title="{{$hot_trailer->title}}" />
                                    <span class="is_trailer">
                                      @if($hot_trailer->resolution==0)
                                        HD
                                      @elseif($hot_trailer->resolution==1)
                                          SD
                                      @elseif($hot_trailer->resolution==2)
                                       FullHD
                                      @else
                                         Trailer
                                      @endif

                                    </span>
                                 </div>
                                 <p class="title">{{$hot_trailer->title}}</p>
                              </a>
                           
                              <div style="float: left;">
                                 <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                 <span style="width: 0%"></span>
                                 </span>
                              </div>
                           </div>
                          @endforeach
                          
                        </div>
                     </div>
                  </section>
                  <div class="clearfix"></div>
               </div>
            </aside>
             {{-- <aside id="sidebar" class="col-xs-12 col-sm-12 col-md-4">
               <div id="halim_tab_popular_videos-widget-7" class="widget halim_tab_popular_videos-widget">
                  <div class="section-bar clearfix">
                     <div class="section-title">
                        <span>Top Views</span>
                       
                     </div>
                  </div>
                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                       <li class="nav-item">
                         <a class="nav-link filter-sidebar" id="home-tab" data-toggle="tab" href="#ngay" role="tab" aria-controls="home" aria-selected="true">Ngày</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link filter-sidebar" id="profile-tab" data-toggle="tab" href="#tuan" role="tab" aria-controls="profile" aria-selected="false">Tuần</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link filter-sidebar" id="contact-tab" data-toggle="tab" href="#thang" role="tab" aria-controls="contact" aria-selected="false">Tháng</a>
                       </li>
                     </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade " id="ngay" role="tabpanel" aria-labelledby="home-tab">
                           <div id="halim-ajax-popular-post" class="popular-post">

                           <div class="item post-37176">
                              <a href="chitiet.php" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ">
                                 <div class="item-link">
                                    <img src="https://ghienphim.org/uploads/GPax0JpZbqvIVyfkmDwhRCKATNtLloFQ.jpeg?v=1624801798" class="lazy post-thumb" alt="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" title="CHỊ MƯỜI BA: BA NGÀY SINH TỬ" />
                                    <span class="is_trailer">Trailer</span>
                                 </div>
                                 <p class="title">CHỊ MƯỜI BA: BA NGÀY SINH TỬ</p>
                              </a>
                              <div class="viewsCount" style="color: #9d9d9d;">3.2K lượt xem</div>
                              <div style="float: left;">
                                 <span class="user-rate-image post-large-rate stars-large-vang" style="display: block;/* width: 100%; */">
                                 <span style="width: 0%"></span>
                                 </span>
                              </div>
                              </div>
                              <span id="show0"></span>
                           </div>
                    </div>
                    <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="profile-tab">
                           <div id="halim-ajax-popular-post" class="popular-post">
                                  <span id="show1"></span>
                         
                           </div>
                    </div>
                    <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="contact-tab">
                           <div id="halim-ajax-popular-post" class="popular-post">

                                     <span id="show2"></span>
                           </div>
                    </div>
                  </div> --}}
                 
                  <div class="clearfix" style="background: #706e629e;"></div>
               </div>
            </aside>