<section class="site-section pt-5 pb-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <div class="owl-carousel owl-theme home-slider">
          @foreach($topPosts as $key => $value)
            <div>
              <a href="blog-single.html" class="a-block d-flex align-items-center height-lg" style="background-image: url('{{ URL::to('/') }}/upload/images/{{ $value['avatar'] }}'); ">
                <div class="text half-to-full">
                  <span class="category mb-5">{{ $value['name'] }}</span>
                  <div class="post-meta">
                    
                    <span class="author mr-2">{{ $value['username'] }}</span>&bullet;
                    <span class="mr-2">{{ $value['publish_date'] }}</span> &bullet;
                    <span class="ml-2"><span class="fa fa-comments"></span> 3</span>
                    
                  </div>
                  <h3>{{ $value['title'] }}</h3>
                  <p>{!! $value['sapo'] !!}</p>
                </div>
              </a>
            </div>
          @endforeach          
        </div>
        
      </div>
    </div>          
  </div>
</section>