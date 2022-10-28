@if ($posts->count())
    <div>
      <h4>Recent Posts</h4>
      <ul class="list-unstyled">
        @foreach ($posts as $post)
          <li class="list-group-item">
              <a href="{{ url($post->slug) }}">{{ $post->title }}</a>
              <span class="float-right text-muted text-sm">{{ $post->created_at->diffForHumans() }}</span>
          </li>
        @endforeach
      </ul>
    </div>
@else
    <div class="">
      <h4>Recent Posts</h4>
        <div class="alert alert-info">
            <span>No posts yet.</span>
        </div>
    </div>
@endif

@if ($comments->count())
    <div>
        <h4>Recent Comment</h4>
        <ul class="list-unstyled">
          @foreach ($comments as $comment)
          <li class="list-group-item">
              <a href="{{ url($comment->slug) }}">{{ $comment->content }}</a>
              <span class="float-right text-muted text-sm">{{ $comment->created_at->diffForHumans() }}</span>
          </li>
      @endforeach
        </ul>
    </div>
@else
    <div>
        <h4>Recent Comment</h4>
        <div class="alert alert-info">
            <span>No comments yet.</span>
        </div>
    </div>
@endif

