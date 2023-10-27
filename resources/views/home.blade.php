@extends('layouts')

@section('content')

<!-- Search Form-->
<div class="container">
  <div class="search-form pt-3 rtl-flex-d-row-r">
      <form action="#" method="">
          <input class="form-control" type="search" placeholder="Search in SAT">
          <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
      </form>
      <!-- Alternative Search Options -->
      <div class="alternative-search-options">
          <div class="dropdown"><a class="btn btn-danger dropdown-toggle" id="altSearchOption"
                  href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i
                      class="fa-solid fa-sliders"></i></a>
              <!-- Dropdown Menu -->
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="altSearchOption">
                  <li><a class="dropdown-item" href="#"><i class="fa-solid fa-microphone"> </i>Voice
                          Search</a></li>
                  <li><a class="dropdown-item" href="#"><i class="fa-solid fa-image"> </i>Image
                          Search</a></li>
              </ul>
          </div>
      </div>
  </div>
</div>

<livewire:category-products />


@endsection