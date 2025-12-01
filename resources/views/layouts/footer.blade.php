<footer class="bg-[#0E1129] text-white pt-12">
    <div class="max-w-[1200px] mx-auto px-4">

        <!-- Top Footer Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-10">

            <!-- Logo + Contact -->
            <div>
                <div class="flex items-center gap-3">
                    <img src="images/logo.png" class="h-10" />
                </div>

                <p class="mt-6 text-[18px] font-inter font-semibold">
                    +012 3456 7890
                </p>

                <p class="mt-2 text-[14px] font-inter text-[#A7A7C2]">
                    contact@bdstore.com
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-inter font-semibold text-[18px]">Quick Links</h4>
                <ul class="mt-4 space-y-3 text-[#A7A7C2]">
                    <li><a href="/" class="hover:text-white">Home</a></li>
                    <li><a href="{{ route('central.about') }}" class="hover:text-white">About</a></li>
                    <li><a href="{{ route('central.contact') }}" class="hover:text-white">Contact</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div>
                <h4 class="font-inter font-semibold text-[18px]">Company</h4>
                <ul class="mt-4 space-y-3 text-[#A7A7C2]">
                    <li><a href="{{ route('central.refund') }}" class="hover:text-white">Refund</a></li>
                    <li><a href="{{ route('central.terms') }}" class="hover:text-white">Terms and Conditions</a></li>
                    <li><a href="{{ route('central.privacy') }}" class="hover:text-white">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Subscribe -->
            <div>
                <h4 class="font-inter font-semibold text-[18px]">Subscribe</h4>

                <div class="mt-4 flex items-center bg-white rounded-[12px] overflow-hidden h-[50px] w-full">

                    <input
                        type="text"
                        class="w-full h-full px-4 text-[15px] font-inter text-[#6E7191] placeholder-[#6E7191] outline-none"
                        placeholder="Get Products Updates" />

                    <button
                        class="bg-[#F5385D] h-full px-4 flex items-center justify-center rounded-r-[12px]">
                        <img src="images/arrow-right.svg" class="w-[18px] h-[18px]" />
                    </button>
                </div>
            </div>

        </div>

        <!-- Divider -->
        <div class="border-t border-[#1B1E3C] my-8"></div>

        <!-- Bottom Bar -->
        <div class="flex flex-col md:flex-row justify-between items-center text-[#A7A7C2] text-sm">

            <!-- Social Icons -->
            <div class="flex items-center gap-4 mb-4 md:mb-0">
                <a href="#"><img src="images/fb.svg" class="h-7 w-7" /></a>
                <a href="#"><img src="images/ig.svg" class="h-7 w-7" /></a>
                <a href="#"><img src="images/x.svg" class="h-7 w-7" /></a>
                <a href="#"><img src="images/linkedin.svg" class="h-7 w-7" /></a>
            </div>

            <!-- Copyright -->
            <p>© 2020 BD Store. All rights reserved</p>
        </div>

    </div>
</footer>