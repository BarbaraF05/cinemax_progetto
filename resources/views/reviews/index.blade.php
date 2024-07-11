{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Recensioni per questo film </h1>

    <div class="row">
        @foreach ($reviews as $review)
            <div class="col-md-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Voto: {{ $review->rating }} / 5</h5>
                        <p class="card-text">{{ $review->comment }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        Recensione aggiunta il {{ $review->created_at->format('d/m/Y') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
 --}}

 @extends('layouts.app')

 @section('content')
 <div class="container">
     <h1 class="mb-4">Recensioni per questo film</h1>
 
     <div class="row">
         @foreach ($reviews as $review)
             <div class="col-md-6 mb-4">
                 <div class="card h-100 shadow-sm">
                     <div class="card-body">
                         <h5 class="card-title">Voto: {!! printStars($review->rating) !!}</h5>
                         <p class="card-text">{{ $review->comment }}</p>
                     </div>
                     <div class="card-footer text-muted">
                         Recensione aggiunta il {{ $review->created_at->format('d/m/Y') }}
                     </div>
                 </div>
             </div>
         @endforeach
     </div>
 </div>
 @endsection
 
 @php
 function printStars($rating) {
     $html = '';
     $fullStars = floor($rating);
     $halfStar = ceil($rating) > $fullStars ? 1 : 0;
 
     for ($i = 0; $i < $fullStars; $i++) {
         $html .= '<i class="fas fa-star text-warning"></i>';
     }
     if ($halfStar) {
         $html .= '<i class="fas fa-star-half-alt text-warning"></i>';
     }
 
     return $html;
 }
 @endphp