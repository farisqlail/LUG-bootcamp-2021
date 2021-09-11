@extends('layout.public')

@section('content')
<div class="row">
  @if (!empty($produk))
  @foreach ($produk as $data)
      <div class="col-12 col-sm-6 col-md-6 col-lg-3">
    <article class="article">
      <div class="article-header">
        <div class="article-image" data-background="{{asset('storage/thumbs/produk/' . $data->thumb)}}" style="background-image: url(&quot;../assets/img/news/img08.jpg&quot;);">
        </div>
        <div class="article-title">
          <h2><a href="#">{{$data->nama_produk}}</a></h2>
        </div>
      </div>
      <div class="article-details">
        <div class="text-right">
          @if ($data->stock > 0)
              <button type="button" class="btn btn-success">
                Stock <span class="badge badge-light">{{$data->stock}}</span>
              </button>
          @else
          <button type="button" class="btn btn-dasnger">
            Stock <span class="badge badge-light">Habis</span>
          </button>
          @endif
        </div>
        <p>{!!$data->deskripsi!!}</p>
        <div class="article-cta">
          <a href="{{ route('home.show', $data->id_produk) }}" class="btn btn-primary">Beli Produk</a>
        </div>
      </div>
    </article>
  </div>
  @endforeach
  
  @else

  @endif
  
</div>
@endsection