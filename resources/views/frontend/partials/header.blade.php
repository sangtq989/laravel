<header role="banner">
  <div class="top-bar">
    <div class="container">
      <div class="row">
        <div class="col-9 social">
          <a href="#"><span class="fa fa-twitter"></span></a>
          <a href="#"><span class="fa fa-facebook"></span></a>
          <a href="#"><span class="fa fa-instagram"></span></a>
          <a href="#"><span class="fa fa-youtube-play"></span></a>
        </div>
        <div class="col-3 search-top">
          <!-- <a href="#"><span class="fa fa-search"></span></a> -->
          <form action="#" class="search-top-form">
            <span class="icon fa fa-search"></span>
            <input type="text" id="s" placeholder="Type keyword to search...">
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container logo-wrap">
    <div class="row pt-5">
      <div class="col-12 text-center">
        <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
        <h1 class="site-logo"><a href="index.html">{{ $info['name'] }}</a></h1>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-md  navbar-light bg-light">
    <div class="container">     
      <div class="collapse navbar-collapse" id="navbarMenu">
        <ul class="navbar-nav mx-auto">
          @foreach($info['cates'] as $key => $item)
              @if(empty($item['subChilds']))
                <li class="nav-item">
                 <a href="" class="nav-link">{{ $item['name'] }}</a>                    
               </li>
              @else
                 <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="category.html" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $item['name'] }}</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown04">    
                        @foreach($item['subChilds'] as $key => $item)
                          <a class="dropdown-item" href="category.html">{{ $item['name'] }}</a>    
                        @endforeach
                    </div> 
                </li>                  
              @endif                  
          @endforeach                
      </ul>      
    </div>
  </div>
</nav>
</header>