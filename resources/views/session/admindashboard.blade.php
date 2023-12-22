<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
</head>
<body class="bg-gray-50">


  
    <!-- ========== HEADER ========== -->
    <header class="sticky top-0 inset-x-0 flex flex-wrap sm:justify-start sm:flex-nowrap z-[48] w-full bg-slate-50 border-b text-sm py-2.5 sm:py-4 lg:ps-64">
      <nav class="flex basis-full items-center w-full mx-auto px-4 sm:px-6 md:px-8" aria-label="Global">
        <div class="me-5 lg:me-0 sm:hidden">
          <a class="flex-none text-2xl font-semibold text-teal-600" href="#" aria-label="Brand">MedisMap</a>
        </div>
  
        <div class="w-full flex items-center justify-end ms-auto sm:justify-between sm:gap-x-3 sm:order-3">
          <div class="sm:hidden">
            <button type="button" class="w-[2.375rem] h-[2.375rem] inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-full border border-transparent text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none ">
              <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
            </button>
          </div>
  
          <div class="hidden sm:block">
            <div class="me-5 lg:me-0">
              <a class="flex-none text-2xl font-semibold text-teal-600" href="#" aria-label="Brand">{{ Auth::user()->name }} dashboard</a>
            </div>
          </div>
  
          <div class="flex flex-row items-center justify-end gap-2">
            <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
              <button id="hs-dropdown-with-header" type="button" class="p-2 inline-flex justify-center items-center gap-x-2 text-sm font-semibold border border-transparent rounded-lg focus:ring-2 focus:ring-teal-600 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none">
                <span>{{ Auth::user()->name }}</span>
                <svg class="ms-1 flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
              </button>
  
              <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-[15rem] bg-white shadow-md rounded-lg p-2" aria-labelledby="hs-dropdown-with-header">
                <div class="py-3 px-5 -m-2 bg-gray-100 rounded-t-lg">
                  <p class="text-sm text-gray-500">Signed in as</p>
                  <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}@gmail.com</p>
                </div>
                <div class="mt-2 py-2 first:pt-0 last:pb-0">
                  <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-teal-500" href="{{ route('profile.edit') }}">
                    {{ __('Profile') }}
                  </a>
                  <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:ring-2 focus:ring-teal-500">
                    @csrf                   
                    <button type="submit" onclick="confirmLogout()" class="cursor-pointer w-full text-left">{{ __('Logout') }}</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <!-- ========== END HEADER ========== -->
  
    <!-- ========== MAIN CONTENT ========== -->
    <!-- Sidebar Toggle -->
    <div class="sticky top-0 inset-x-0 z-20 bg-white border-y px-4 sm:px-6 md:px-8 lg:hidden">
      <div class="flex items-center py-4">
        <!-- Navigation Toggle -->
        <button type="button" class="text-gray-500 hover:text-gray-600" data-hs-overlay="#application-sidebar" aria-controls="application-sidebar" aria-label="Toggle navigation">
          <span class="sr-only">Toggle Navigation</span>
          <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
        </button>
        <!-- End Navigation Toggle -->
  
        <!-- Breadcrumb -->
        <ol class="ms-3 flex items-center whitespace-nowrap" aria-label="Breadcrumb">
          <li class="flex items-center text-sm text-gray-800 dark:text-gray-400">
            Application Layout
            <svg class="flex-shrink-0 mx-3 overflow-visible h-2.5 w-2.5 text-gray-400" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <path d="M5 1L10.6869 7.16086C10.8637 7.35239 10.8637 7.64761 10.6869 7.83914L5 14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            </svg>
          </li>
          <li class="text-sm font-semibold text-gray-800 truncate" aria-current="page">
            Dashboard
          </li>
        </ol>
        <!-- End Breadcrumb -->
      </div>
    </div>
    <!-- End Sidebar Toggle -->
  
    <!-- Sidebar -->
    <div id="application-sidebar" class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform hidden fixed top-0 start-0 bottom-0 z-[60] w-64 bg-teal-100 border-e border-slate-300 pt-7 pb-10 overflow-y-auto lg:block lg:translate-x-0 lg:end-auto lg:bottom-0 [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 ">
      <div class="px-6">
        <a class="flex-none text-2xl text-teal-600 font-bold" href="#" aria-label="Brand">MedisMap</a>
      </div>
  
      <nav class="hs-accordion-group p-6 w-full flex flex-col flex-wrap" data-hs-accordion-always-open>
        <ul class="space-y-1.5">
          <li>
            <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-teal-300" href="#">
              <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
              Home Admin
            </a>
          </li>
  
          <li class="hs-accordion" id="users-accordion">
            <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-teal-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-lg hover:bg-teal-300">
              <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
              Users
  
              <svg class="hs-accordion-active:block ms-auto hidden w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
  
              <svg class="hs-accordion-active:hidden ms-auto block w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
            </button>
  
            <div id="users-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
              <ul class="hs-accordion-group ps-3 pt-2" data-hs-accordion-always-open>
                <li class="hs-accordion" id="users-accordion-sub-1">
                  <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-teal-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-lg hover:bg-gray-100">
                    Lorem, ipsum.
  
                    <svg class="hs-accordion-active:block ms-auto hidden w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
  
                    <svg class="hs-accordion-active:hidden ms-auto block w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                  </button>
  
                  <div id="users-accordion-sub-1-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
                    <ul class="pt-2 ps-2">
                      <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100" href="#">
                          Lorem, ipsum.
                        </a>
                      </li>
                      <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100" href="#">
                          Lorem, ipsum.
                        </a>
                      </li>
                      <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100" href="#">
                          Lorem, ipsum.
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
                <li class="hs-accordion" id="users-accordion-sub-2">
                  <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-teal-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-lg hover:bg-gray-100">
                    Lorem, ipsum.
  
                    <svg class="hs-accordion-active:block ms-auto hidden w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
  
                    <svg class="hs-accordion-active:hidden ms-auto block w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
                  </button>
  
                  <div id="users-accordion-sub-2-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden ps-2">
                    <ul class="pt-2 ps-2">
                      <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100" href="#">
                          Lorem, ipsum.
                        </a>
                      </li>
                      <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100" href="#">
                          Lorem, ipsum.2
                        </a>
                      </li>
                      <li>
                        <a class="flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-gray-100" href="#">
                          Lorem, ipsum.
                        </a>
                      </li>
                    </ul>
                  </div>
                </li>
              </ul>
            </div>
          </li>
          <li class="hs-accordion" id="users-accordion">
            <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-teal-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-lg hover:bg-teal-300">
              <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" ><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
              Dashboard
  
              <svg class="hs-accordion-active:block ms-auto hidden w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m18 15-6-6-6 6"/></svg>
  
              <svg class="hs-accordion-active:hidden ms-auto block w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
            </button>
  
            <div id="users-accordion-child" class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300 hidden">
              <ul class="hs-accordion-group ps-3 pt-2" data-hs-accordion-always-open>
                <li class="hs-accordion" id="users-accordion-sub-1">
                  <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-teal-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-lg hover:bg-gray-100">
                    Dashboard Users
                  </button>
                </li>
                <li class="hs-accordion" id="users-accordion-sub-2">
                  <button type="button" class="hs-accordion-toggle w-full text-start flex items-center gap-x-3.5 py-2 px-2.5 hs-accordion-active:text-teal-600 hs-accordion-active:hover:bg-transparent text-sm text-slate-700 rounded-lg hover:bg-gray-100">
                    Dasboard Penulis
                  </button>
                </li>
              </ul>
            </div>
          </li>

          <li><a class="w-full flex items-center gap-x-3.5 py-2 px-2.5 text-sm text-slate-700 rounded-lg hover:bg-teal-300" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" data-slot="icon" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z" />
            </svg>
            Map
          </a></li>
        </ul>
      </nav>
    </div>
    <!-- End Sidebar -->
  
    <!-- Content -->
    <div class="w-full pt-10 px-4 sm:px-6 md:px-8 lg:ps-72">

      <!-- Page Heading -->
      <header class="h-screen">

        <!-- Toast -->
        <div id="toast" class="max-w-xs mb-5 bg-teal-600 border border-gray-200 rounded-xl shadow-lg" role="alert">
          <div class="flex p-4 text-sm text-white font-bold">
            Hello {{ Auth::user()->name }} Welcome Back!!

            <div class="ms-auto">
              <button id="closeToast" type="button" class="inline-flex flex-shrink-0 justify-center items-center h-5 w-5 rounded-lg text-white hover:text-white opacity-50 hover:opacity-100 focus:outline-none focus:opacity-100">
                <span class="sr-only">Close</span>
                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
              </button>
            </div>
          </div>
        </div>
        <!-- End Toast -->

      </header>

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

      <!-- End Page Heading -->
    </div>
    <!-- End Content -->

    
    <!-- ========== END MAIN CONTENT ========== -->
  

  <script>
    document.getElementById('closeToast').addEventListener('click', function() {
      document.getElementById('toast').style.display = 'none';
    });
  </script>
  <script src="./node_modules/preline/dist/preline.js"></script>
</body>
</html>