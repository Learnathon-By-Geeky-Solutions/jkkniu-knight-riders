<div class="w-64 bg-white shadow-md flex-shrink-0" style="min-height: 100vh;">
    <div class="p-4 text-lg fw-semibold text-dark border-bottom">Menu Panel</div>
    <ul class="mt-4 list-unstyled">
        <!-- CMS Menu -->
        <li x-data="{ open: window.location.pathname.startsWith('/cms'), active: localStorage.getItem('activeMenu') || '' }" class="position-relative">
            <button @click="open = !open" class="w-100 d-flex justify-content-between align-items-center px-3 py-2 text-start border-0 bg-transparent">
                <span>CMS</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition-transform" :class="{ 'rotate-180': open }" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <div style="overflow: hidden;">
                <ul x-show="open" x-cloak class="ms-3 mt-1 list-unstyled bg-light rounded">
                    <li>
                        <a href="{{ route('cms.site-info') }}" @click="active = 'site-info'; localStorage.setItem('activeMenu', 'site-info')" class="d-block px-3 py-2 text-decoration-none text-dark" :class="{ 'bg-secondary text-white': active === 'site-info' }">Site Information</a>
                    </li>
                    <li>
                        <a href="{{ route('cms.home.banner.index') }}" @click="active = 'home-banner'; localStorage.setItem('activeMenu', 'home-banner')" class="d-block px-3 py-2 text-decoration-none text-dark" :class="{ 'bg-secondary text-white': active === 'home-banner' }">Home Banner</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="px-3 py-2">
            <a href="#" class="d-block text-decoration-none text-dark">Settings</a>
        </li>
    </ul>
</div>
