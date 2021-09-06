@extends('layout.public')

@section('content')
<div class="row">
  <div class="col-12 col-sm-6 col-md-6 col-lg-3">
    <article class="article">
      <div class="article-header">
        <div class="article-image" data-background="../assets/img/news/img08.jpg" style="background-image: url(&quot;../assets/img/news/img08.jpg&quot;);">
        </div>
        <div class="article-title">
          <h2><a href="#">Excepteur sint occaecat cupidatat non proident</a></h2>
        </div>
      </div>
      <div class="article-details">
        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. </p>
        <div class="article-cta">
          <a href="{{ route('product.detail') }}" class="btn btn-primary">Read More</a>
        </div>
      </div>
    </article>
  </div>
</div>
@endsection