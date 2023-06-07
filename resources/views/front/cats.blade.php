@inject('cats', App\Services\CatsService::class)
<div class="card mt-5">
    <div class="card-header">
        <h2>Restoranų sąrašas:</h2>
    </div>
    <div class="card-body">
        <ul class="list-group">
            {{-- <div class="cat-line">
                <a href="{{route('front-index')}}">All car services:</a>
    </div> --}}
    @forelse($cats->get() as $cat)
    <div class="cat-line">
        <a href="{{route('cats-show', $cat)}}">{{$cat->title}}</a>
    </div>
    @empty
    <li class="list-group-item">
        <div class="cat-line">No categories</div>
    </li>
    @endforelse
    </ul>
</div>
</div>
