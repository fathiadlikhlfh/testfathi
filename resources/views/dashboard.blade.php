<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
  <script src="{{ asset('js/map.js') }}"></script>
  <script src="{{ asset('js/geolet.js') }}"></script>

  <style>
    .user-location-circle {
      animation: grow 0.4s ease-in-out infinite alternate;
    }

    @keyframes grow {
      0% {
        r: 0;
      }
      100% {
        r: 10;
      }
    }
  </style>

</head>
<body>

  {{-- semacam Cookie atau Toast --}}
  <div id="cookies-simple-with-dismiss-button" class="fixed top-0 start-1/2 transform -translate-x-1/2 z-[60] sm:max-w-4xl w-full mx-auto p-6">
      <!-- Card -->
    <div class="p-4 bg-teal-50 border border-teal-600 rounded-xl shadow-sm max-w-xl mx-auto">
      <div class="flex justify-between items-center gap-x-5 sm:gap-x-10">
        <h2 class="text-sm text-gray-600 font-semibold">
          Halo <span class="text-teal-600">{{ Auth::user()->name }}</span>  Selamat Datang Kembali !!
        </h2>
        <button type="button" class="p-2 inline-flex items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent bg-teal-600 text-white hover:bg-teal-800 disabled:opacity-50 disabled:pointer-events-none" data-hs-remove-element="#cookies-simple-with-dismiss-button">
          <span class="sr-only">Dismiss</span>
          <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"></path><path d="m6 6 12 12"></path></svg>
        </button>
      </div>
    </div>
      <!-- End Card -->
  </div>
  {{-- semacam Cookie atau Toast End--}}

  {{-- Header Navbar --}}
  <header class="relative flex flex-wrap sm:justify-start sm:flex-nowrap z-50 w-full mt-4 sm:mt-10 text-sm py-4">
    <nav class="max-w-[85rem] w-full mx-auto px-4 sm:flex sm:items-center sm:justify-between" aria-label="Global">
      <div class="flex items-center justify-between">
        <a class="flex-none text-3xl font-bold text-teal-600" href="#">MedisMap</a>
        <div class="sm:hidden">
          <button type="button" class="hs-collapse-toggle p-2 inline-flex justify-center items-center text-teal-600 gap-x-2 rounded-lg border border-teal-700 hover:border-teal-400 disabled:opacity-50 disabled:pointer-events-none" data-hs-collapse="#navbar-with-mega-menu" aria-controls="navbar-with-mega-menu" aria-label="Toggle navigation">
            <svg class="hs-collapse-open:hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
            <svg class="hs-collapse-open:block hidden flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
          </button>
        </div>
      </div>
      <div id="navbar-with-mega-menu" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow sm:block">
        <div class="flex flex-col gap-5 mt-5 sm:flex-row sm:items-center sm:justify-end sm:mt-0 sm:ps-5">
          <a class="font-medium text-teal-600 hover:text-teal-400" href="#">About</a>
          <a class="font-medium text-teal-600 hover:text-teal-400" href="#">Fitures</a>

          {{-- Dropdown --}}
          <div class="hs-dropdown [--strategy:static] sm:[--strategy:fixed] [--adaptive:none]">
            <button id="hs-mega-menu-basic-dr" type="button" class="flex items-center w-full text-teal-600 hover:text-teal-400 font-medium">
              {{ Auth::user()->name }}
              <svg class="ms-1 flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
            </button>
  
            <div class="hs-dropdown-menu transition-[opacity,margin] duration-[0.1ms] sm:duration-[150ms] hs-dropdown-open:opacity-100 opacity-0 sm:w-48 z-10 bg-white sm:shadow-md rounded-lg p-2 before:absolute top-full sm:border before:-top-5 before:start-0 before:w-full before:h-5 hidden" style="">
              <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm font-semibold text-teal-600 hover:text-teal-400 hover:bg-gray-50" href="{{ route('profile.edit') }}">
                {{ __('Profile') }}
              </a>
              <form method="POST" action="{{ route('logout') }}" class="py-2 px-3 rounded-lg text-sm font-semibold text-teal-600 hover:text-teal-400 hover:bg-gray-50">
                @csrf
                <button type="submit" class="cursor-pointer w-full text-left">{{ __('Logout') }}</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  {{-- Header Navbar End --}}

  <!-- Hero -->
  <div class="relative overflow-hidden">
    <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-24">
      <div class="text-center">
        <h1 class="text-2xl sm:text-4xl font-bold text-teal-600">
          Find the Nearest Health Facility
        </h1>

        <p class="text-2xl sm:text-4xl font-bold mt-3 text-teal-600">
          with detailed Information.
        </p>

        <div class="mt-7 sm:mt-12 mx-auto max-w-xl relative">
          <!-- Form -->
          <form>
            <div class="relative z-10 flex space-x-3 p-3">
              <div class="flex-[1_0_0%]">
                <label for="hs-search-article-1" class="block text-sm text-gray-700 font-medium dark:text-white"><span class="sr-only">Search article</span></label>
                <input type="email" name="hs-search-article-1" id="hs-search-article-1" class="py-2.5 px-4 block w-full border-2 rounded-lg border-teal-600 placeholder:text-teal-600 text-teal-600" placeholder="Cari Faskes">
              </div>
              <div class="flex-[0_0_auto]">
                <a class="w-[46px] h-[46px] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border bg-teal-600 text-white hover:bg-teal-700 disabled:opacity-50 disabled:pointer-events-none" href="#">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                  </svg>
                </a>
              </div>
            </div>
          </form>
          <!-- End Form -->
        </div>
      </div>
    </div>
  </div>
  <!-- End Hero -->

  <!-- Card Blog -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Title -->
    <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
      <h2 class="text-2xl text-teal-600 font-bold md:text-4xl md:leading-tight">MedisMap Fitur</h2>
      <p class="mt-1 text-teal-600 font-semibold">Daftar daftar faskes yang tersedia di MedisMap</p>
    </div>
    <!-- End Title -->

    <!-- Grid -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Card -->
      <a class="group hover:bg-gray-100 rounded-xl p-5 transition-all" href="#">
        <div class="aspect-w-16 aspect-h-10">
          <img class="w-full object-cover rounded-xl" src="{{ asset('img/rumahsakit.jpg') }}" alt="Rumah Sakit">
        </div>
        <h2 class="mt-5 text-lg text-teal-600 font-bold">
          Rumah Sakit
        </h2>
        <h3 class="mt-2 text-base font-semibold text-gray-800">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet dignissimos deleniti expedita, sapiente dolore in dolorem tenetur atque placeat ad?
        </h3>
        <p class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold text-black group-hover:text-teal-600">
          Learn more
          <svg class="flex-shrink-0 w-4 h-4 transition ease-in-out group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </p>
      </a>
      <!-- End Card -->

      <!-- Card -->
      <a class="group hover:bg-gray-100 rounded-xl p-5 transition-all" href="#">
        <div class="aspect-w-16 aspect-h-10">
          <img class="w-full object-cover rounded-xl" src="{{ asset('img/klinik.jpg') }}" alt="Image Description">
        </div>
        <h2 class="mt-5 text-lg text-teal-600 font-bold">
          Klinik
        </h2>
        <h3 class="mt-2 text-base font-semibold text-gray-800">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet dignissimos deleniti expedita, sapiente dolore in dolorem tenetur atque placeat ad?
        </h3>
        <p class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold text-black group-hover:text-teal-600">
          Learn more
          <svg class="flex-shrink-0 w-4 h-4 transition ease-in-out group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </p>
      </a>
      <!-- End Card -->

      <!-- Card -->
      <a class="group hover:bg-gray-100 rounded-xl p-5 transition-all" href="#">
        <div class="aspect-w-16 aspect-h-10">
          <img class="w-full object-cover rounded-xl" src="{{ asset('img/apotik.jpg') }}" alt="Image Description">
        </div>
        <h2 class="mt-5 text-lg text-teal-600 font-bold">
          Apotik
        </h2>
        <h3 class="mt-2 text-base font-semibold text-gray-800">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet dignissimos deleniti expedita, sapiente dolore in dolorem tenetur atque placeat ad?
        </h3>
        <p class="mt-3 inline-flex items-center gap-x-1 text-sm font-semibold text-black group-hover:text-teal-600">
          Learn more
          <svg class="flex-shrink-0 w-4 h-4 transition ease-in-out group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
        </p>
      </a>
      <!-- End Card -->
    </div>
    <!-- End Grid -->
  </div>
  <!-- End Card Blog -->

  <!-- FAQ -->
  <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <!-- Title -->
    <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
      <h2 class="text-2xl font-bold md:text-3xl md:leading-tight text-teal-600">
        About Us
      </h2>
    </div>
    <!-- End Title -->

    <div class="max-w-5xl mx-auto">
      <!-- Grid -->
      <div class="grid sm:grid-cols-2 gap-6 md:gap-12">
        <div>
          <h3 class="text-lg font-semibold text-teal-600">
            Lorem ipsum dolor sit.
          </h3>
          <p class="mt-2 text-gray-600">
            Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique molestias perferendis deserunt vitae in cupiditate, modi ducimus quidem corrupti nisi?
          </p>
        </div>
        <!-- End Col -->

        <div>
          <h3 class="text-lg font-semibold text-teal-600">
            Lorem ipsum dolor sit.
          </h3>
          <p class="mt-2 text-gray-600">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Temporibus mollitia quos, impedit nulla aut ipsum ipsam aliquid nostrum tempore vitae.
          </p>
        </div>
        <!-- End Col -->
      </div>
      <!-- End Grid -->
    </div>
  </div>
  <!-- End FAQ -->

  {{-- Map --}}
  <div class="container mx-auto flex-row justify-center items-center">
    <div class="text-center">
      <h1 class="text-2xl font-bold mb-4 text-teal-600">You are Here</h1>
    </div>
    <div class="">
      <div id="map" style="width: 800px; height: 400px;" class="mx-auto"></div>
    </div>
  </div>
  {{-- end Map --}}


  {{-- Footer --}}
  <footer class="w-full py-5 mx-auto">
    <!-- Grid -->
    <div class="text-center sm:flex sm:justify-between sm:items-center">
      <div>
        <a class="flex-none text-2xl text-teal-600 font-bold sm:ml-28" href="#" aria-label="Brand">MedisMap</a>
      </div>
      <!-- End Col -->
  
      {{-- Text CopyRight --}}
      <div class="">
        <p class="text-gray-500">We're part of the <a class="font-semibold text-teal-600 hover:text-teal-700" href="#">MedisMap</a> family.</p>
        <p class="text-gray-500">© MedisMap. 2022. All rights reserved.</p>
      </div>
      {{-- Text CopyRight End --}}

      <!-- Social Brands -->
      <div class="space-x-2 sm:mr-28">
        <a class="inline-flex justify-center items-center w-10 h-10 text-center text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white transition dark:text-gray-500 dark:hover:text-gray-200 dark:hover:bg-gray-800" href="#">
          <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
          </svg>
        </a>
        <a class="inline-flex justify-center items-center w-10 h-10 text-center text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white transition dark:text-gray-500 dark:hover:text-gray-200 dark:hover:bg-gray-800" href="#">
          <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
          </svg>
        </a>
        <a class="inline-flex justify-center items-center w-10 h-10 text-center text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white transition dark:text-gray-500 dark:hover:text-gray-200 dark:hover:bg-gray-800" href="#">
          <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
          </svg>
        </a>
        <a class="inline-flex justify-center items-center w-10 h-10 text-center text-gray-500 hover:bg-gray-100 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2 focus:ring-offset-white transition dark:text-gray-500 dark:hover:text-gray-200 dark:hover:bg-gray-800" href="#">
          <svg class="flex-shrink-0 w-3.5 h-3.5" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M3.362 10.11c0 .926-.756 1.681-1.681 1.681S0 11.036 0 10.111C0 9.186.756 8.43 1.68 8.43h1.682v1.68zm.846 0c0-.924.756-1.68 1.681-1.68s1.681.756 1.681 1.68v4.21c0 .924-.756 1.68-1.68 1.68a1.685 1.685 0 0 1-1.682-1.68v-4.21zM5.89 3.362c-.926 0-1.682-.756-1.682-1.681S4.964 0 5.89 0s1.68.756 1.68 1.68v1.682H5.89zm0 .846c.924 0 1.68.756 1.68 1.681S6.814 7.57 5.89 7.57H1.68C.757 7.57 0 6.814 0 5.89c0-.926.756-1.682 1.68-1.682h4.21zm6.749 1.682c0-.926.755-1.682 1.68-1.682.925 0 1.681.756 1.681 1.681s-.756 1.681-1.68 1.681h-1.681V5.89zm-.848 0c0 .924-.755 1.68-1.68 1.68A1.685 1.685 0 0 1 8.43 5.89V1.68C8.43.757 9.186 0 10.11 0c.926 0 1.681.756 1.681 1.68v4.21zm-1.681 6.748c.926 0 1.682.756 1.682 1.681S11.036 16 10.11 16s-1.681-.756-1.681-1.68v-1.682h1.68zm0-.847c-.924 0-1.68-.755-1.68-1.68 0-.925.756-1.681 1.68-1.681h4.21c.924 0 1.68.756 1.68 1.68 0 .926-.756 1.681-1.68 1.681h-4.21z"/>
          </svg>
        </a>
      </div>
      <!-- End Social Brands -->
  
      
    </div>
    <!-- End Grid -->
  </footer>
  {{-- End Footer --}}

  <script src="{{ asset('js/map.js') }}"></script>
  <script src="{{ asset('js/geolet.js') }}"></script>
  <script src="./node_modules/preline/dist/preline.js"></script>
</body>
</html>