<div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            @if($movie['foto_sampul'])
              @php
                $imagePath = str_contains($movie['foto_sampul'], '/') 
                  ? '/storage/' . $movie['foto_sampul'] 
                  : '/images/' . $movie['foto_sampul'];
              @endphp
              <img src="{{ $imagePath }}" class="img-fluid rounded-start" alt="{{ $movie['judul'] }}">
            @else
              <div class="img-fluid rounded-start bg-secondary" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                <span class="text-white">No Image</span>
              </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $movie['judul'] }}</h5>
                <p class="card-text">{{ $movie['sinopsis'] }}</p>
                <a href="/movie/{{ $movie['id'] }}" class="btn btn-success">Lihat Selanjutnya</a>
            </div>
        </div>
    </div>
</div>
