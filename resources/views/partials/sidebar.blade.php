<nav class="space-y-1 text-[15px]">
  <a href="{{ route('admin.dashboard') }}"
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black @if(request()->routeIs('admin.dashboard')) bg-white/15 @endif">
    <ion-icon name="home-outline" class="text-xl"></ion-icon>
    <span>Dashboard</span>
  </a>

  <a href="{{ route('admin.users.index') }}"
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black @if(request()->routeIs('admin.employees.*')) bg-white/15 @endif">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
    </svg>
    <span>User Management</span>
  </a>


  <a href="{{ route('admin.categories.index') }}"
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 6.75h12M8.25 12h12m-12 5.25h12M3.75 6.75h.007v.008H3.75V6.75Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0ZM3.75 12h.007v.008H3.75V12Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm-.375 5.25h.007v.008H3.75v-.008Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
    </svg>

    <span>Category Management</span>
  </a>

  <a href="{{ route('admin.books.index') }}"
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
    </svg>

    <span>Books</span>
  </a>

  <!-- <a href=""
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
    </svg>
    <span>Notificaions</span>
  </a> -->

  <a href="{{ route('admin.books.parts.index', ['book' => 1]) }}"
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Z" />
    </svg>

    <span>Book Part</span>
  </a>

  <a href="{{ route('admin.banners.index') }}"
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 0 0-7.5 0v4.5m11.356 0a8.959 8.959 0 0 1-4.285 7.938l-.322.18c-.903.51-1.91.81-2.994.81s-2.091-.3-2.994-.81l-.322-.18a8.959 8.959 0 0 1-4.285-7.938m11.356 0V6a3.75 3.75 0 0 0-7.5 0v4.5m7.5 0a48.667 48.667 0 0 1-7.5 0" />
    </svg>

    <span>Banners</span>
  </a>

  <a href=""
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z" />
    </svg>

    <span>Share and Earn</span>
  </a>

  <a href=""
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black">
    <ion-icon name="time-outline" class="text-xl"></ion-icon>
    <span>Daily Earn</span>
  </a>

  <a href=""
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black">
    <ion-icon name="megaphone-outline" class="text-xl"></ion-icon>
    <span>Advertisement</span>
  </a>

  <!-- <a href=""
    class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black">
    <ion-icon name="person-outline" class="text-xl"></ion-icon>
    <span>Profile</span>
  </a> -->

  <!-- <form method="POST" action="{{ route('logout') }}" class="pt-2">
    @csrf
    <button class="w-full flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-white/100 hover:text-black">
      <ion-icon name="log-out-outline" class="text-xl"></ion-icon>
      <span>Sign Out</span>
    </button>
  </form> -->
</nav>