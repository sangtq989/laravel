  <div class="sidebar-box">
    <h3 class="heading">Popular Posts</h3>
    <div class="post-entry-sidebar">
      <ul>
        @foreach($info['mostViewsPost'] as $key => $value)
        <li>
          <a href="">
            <img src="{{ URL::to('/') }}/upload/images/{{ $value['avatar'] }}" alt="{{ $value['avatar'] }}" class="mr-4">
            <div class="text">
              <h4>{!! $value['title'] !!}</h4>
              <div class="post-meta">
                <span class="mr-2">{{ $value['publish_date'] }}</span>
              </div>
            </div>
          </a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
