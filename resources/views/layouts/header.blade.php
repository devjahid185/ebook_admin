<!-- ✅ NAVIGATION (updated: 1200px container inside) -->
<header id="main-header"
        class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-transparent">

  <!-- 🔥 FIXED: 1200px max width -->
  <div class="max-w-[1200px] mx-auto">

    <div class="flex justify-between items-center h-16">

      <!-- 🌐 LOGO -->
      <a href="{{ route('home') }}" class="flex items-center gap-3">
        <img src="{{ asset('images/logo.png') }}" alt="BDStore"
             class="logo-img h-[45px] w-[171px] md:h-[45px] md:w-[171px] object-contain">
      </a>

      <!-- 🧭 DESKTOP MENU -->
      <nav class="hidden md:flex items-center space-x-6 text-[16px] font-inter font-inter-medium">
        <a href="{{ route('home') }}"
          class="{{ request()->routeIs('home') ? 'text-blue-800 font-inter font-semibold text-[16px]' : 'text-[#6E7191] hover:text-slate-900' }}">
          Home
        </a>
        <a href="{{ route('central.about') }}"
          class="{{ request()->routeIs('central.about') ? 'text-blue-800 font-inter text-[16px]' : 'text-[#6E7191] hover:text-slate-900' }}">
          About
        </a>
        <a href="{{ route('central.contact') }}"
          class="{{ request()->routeIs('central.contact') ? 'text-blue-800 font-inter text-[16px]' : 'text-[#6E7191] hover:text-slate-900' }}">
          Contact
        </a>
        <!-- <a href="{{ route('central.resources') }}"
          class="{{ request()->routeIs('central.resources') ? 'text-[#FF3951] font-inter text-[16px]' : 'text-[#6E7191] hover:text-slate-900' }}">
          Features
        </a>
        <a href="{{ route('central.pricing') }}"
          class="{{ request()->routeIs('central.pricing') ? 'text-[#FF3951] font-inter text-[16px]' : 'text-[#6E7191] hover:text-slate-900' }}">
          Pricing
        </a> -->
      </nav>

      <div class="hidden md:flex items-center gap-4">

    <!-- 🔘 LOG IN BUTTON (Exact Same Design) -->
    <a href="{{ route('login') }}"
       class="px-6 py-2 rounded-full text-blue-800 font-inter font-semibold text-[16px]
              border border-blue-200 bg-transparent hover:bg-red-50 transition">
        Log In
    </a>

    <!-- 🔴 CREATE STORE BUTTON (Exact Same Design) -->
    <a href="{{ route('register') }}"
   class="px-6 py-2 rounded-full text-white font-inter font-semibold text-[16px]
          bg-gradient-to-b from-blue-700 to-blue-500
          shadow-[0_5px_0_#1E40AF] 
          hover:translate-y-0.5 active:translate-y-1
          transition inline-flex items-center justify-center select-none">
    Register
</a>


</div>


      <!-- 🍔 MOBILE MENU BUTTON -->
      <button id="menu-btn"
              class="md:hidden flex items-center text-slate-700 hover:text-red-500 focus:outline-none p-2 rounded-lg"
              aria-expanded="false" aria-controls="mobile-menu">
        <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
      </button>

    </div>
  </div>

  <!-- 📱 MOBILE MENU -->
  <div id="mobile-menu" class="md:hidden hidden border-t border-gray-100 bg-white">
    <div class="max-w-[1200px] mx-auto px-4 py-3 space-y-2 text-base font-inter">

      <a href="{{ route('home') }}"
        class="block rounded-lg px-3 py-3 {{ request()->routeIs('home') ? 'text-blue-800 font-inter bg-red-50' : 'text-[#6E7191] hover:bg-gray-50' }}">
        Home
      </a>

      <a href="{{ route('central.about') }}"
        class="block rounded-lg px-3 py-3 {{ request()->routeIs('central.about') ? 'text-blue-800 font-inter bg-red-50' : 'text-[#6E7191] hover:bg-gray-50' }}">
        About
      </a>

      <a href="{{ route('central.contact') }}"
        class="block rounded-lg px-3 py-3 {{ request()->routeIs('central.contact') ? 'text-blue-800 font-inter bg-red-50' : 'text-[#6E7191] hover:bg-gray-50' }}">
        Contact
      </a>

      <!-- <a href="{{ route('central.resources') }}"
        class="block rounded-lg px-3 py-3 {{ request()->routeIs('central.resources') ? 'text-[#FF3951] font-inter bg-red-50' : 'text-[#6E7191] hover:bg-gray-50' }}">
        Features
      </a>

      <a href="{{ route('central.pricing') }}"
        class="block rounded-lg px-3 py-3 {{ request()->routeIs('central.pricing') ? 'text-[#FF3951] font-inter bg-red-50' : 'text-[#6E7191] hover:bg-gray-50' }}">
        Pricing
      </a> -->

      <div class="pt-3 border-t border-gray-100">

    <!-- 🔘 LOG IN (same design like screenshot) -->
    <a href="{{ route('login') }}"
       class="block rounded-full px-3 py-3 text-blue-800 font-inter font-semibold
              border border-blue-200 bg-white hover:bg-red-50 transition text-center">
        Log in
    </a>

    <!-- 🔴 CREATE STORE (same-to-same gradient button) -->
    <a href="{{ route('register') }}"
       class="block mt-3 px-4 py-3 text-white text-center font-inter font-semibold
              rounded-full
              bg-gradient-to-b from-blue-800 to-blue-600
              shadow-[0_6px_0_#1E40AF]
              hover:translate-y-0.5 active:translate-y-1
              transition-all duration-200">
        Register
    </a>

</div>


    </div>
  </div>
</header>


<!-- 🧠 Mobile Menu Script -->
<script>
  const menuBtn = document.getElementById('menu-btn');
  const mobileMenu = document.getElementById('mobile-menu');
  const icon = document.getElementById('menu-icon');

  menuBtn.addEventListener('click', () => {
    const expanded = menuBtn.getAttribute('aria-expanded') === 'true' || false;
    menuBtn.setAttribute('aria-expanded', !expanded);
    mobileMenu.classList.toggle('hidden');
    icon.classList.toggle('text-red-500');
  });
</script>

<!-- 🧠 Scroll Effect -->
<script>
document.addEventListener("scroll", function () {
    const header = document.getElementById("main-header");
    const logo = document.querySelector(".logo-img");

    if (window.scrollY > 30) {
        header.classList.remove("bg-transparent");
        header.classList.add("bg-white", "shadow-md");

        // logo.classList.add("scale-90");
    } else {
        header.classList.add("bg-transparent");
        header.classList.remove("bg-white", "shadow-md");

        // logo.classList.remove("scale-90");
    }
});
</script>


