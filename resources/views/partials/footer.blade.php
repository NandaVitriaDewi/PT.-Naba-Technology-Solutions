@php
    $setting  = \App\Models\SiteSetting::current();
    $footer   = \App\Models\FooterSetting::current();
    $services = \App\Models\Service::active()->get();

    $namaPerusahaan = $setting->company_name ?: 'PT. Naba Technology Solutions';
    $iconClass  = 'mt-0.5 size-5 shrink-0';
    $badgeClass = ['gelap' => 'bg-white/10', 'terang' => 'bg-ice text-navy'];
@endphp

<footer class="bg-footer text-white">
    <div class="wrap grid gap-10 py-14 sm:grid-cols-2 lg:grid-cols-[2fr_1.2fr_.9fr_1.3fr] lg:gap-12 lg:py-[72px]">

        {{-- 1. Profil --}}
        <div class="sm:col-span-2 lg:col-span-1">
            <div class="flex items-center gap-4">
                <img src="{{ $footer->logoUrl() }}" alt="" class="h-[55px] w-auto rounded-[5px]">
                <div>
                    <p class="text-lg font-bold lg:text-xl">{{ $namaPerusahaan }}</p>
                    @if ($footer->tagline)
                        <p class="text-sm">{{ $footer->tagline }}</p>
                    @endif
                </div>
            </div>

            @if ($footer->description)
                <p class="mt-6 max-w-[398px] text-base">{{ $footer->description }}</p>
            @endif

            @if (! empty($footer->badges))
                <div class="mt-6 flex flex-wrap gap-3 text-sm font-bold">
                    @foreach ($footer->badges as $badge)
                        <span class="rounded-md px-4 py-1 {{ $badgeClass[$badge['style'] ?? 'gelap'] ?? $badgeClass['gelap'] }}">{{ $badge['text'] ?? '' }}</span>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- 2. Bidang layanan (dari menu Data Layanan) --}}
        <div>
            <h3 class="text-sm font-bold">{{ $footer->services_title ?: 'BIDANG LAYANAN' }}</h3>
            <ul class="mt-5 space-y-3 text-sm">
                @foreach ($services as $item)
                    <li class="flex items-center gap-3">
                        <span class="size-2 shrink-0 rounded-full bg-steel"></span>
                        <a href="/layanan/{{ $item->slug }}" class="hover:underline">{{ $item->title }}</a>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- 3. Navigasi --}}
        <div>
            <h3 class="text-sm font-bold">{{ $footer->nav_title ?: 'NAVIGASI' }}</h3>
            <ul class="mt-5 space-y-3 text-sm">
                @foreach ($footer->nav_links ?? [] as $link)
                    <li><a href="{{ $link['url'] ?? '#' }}" class="hover:underline">{{ $link['label'] ?? '' }}</a></li>
                @endforeach
            </ul>
        </div>

        {{-- 4. Kantor pusat (dari Halaman Kontak) --}}
        <div>
            <h3 class="text-sm font-bold">{{ $footer->office_title ?: 'KANTOR PUSAT' }}</h3>
            <ul class="mt-5 space-y-4 text-sm">
                @if ($setting->address)
                    <li class="flex gap-3">
                        <svg class="{{ $iconClass }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/><path d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z"/></svg>
                        <span>{{ $setting->address }}</span>
                    </li>
                @endif
                @if ($setting->phone)
                    <li class="flex gap-3">
                        <svg class="{{ $iconClass }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z"/></svg>
                        <a href="tel:{{ $setting->phone }}" class="hover:underline">{{ $setting->phone }}</a>
                    </li>
                @endif
                @if ($setting->email)
                    <li class="flex gap-3">
                        <svg class="{{ $iconClass }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
                        <a href="mailto:{{ $setting->email }}" class="break-all hover:underline">{{ $setting->email }}</a>
                    </li>
                @endif
                @if ($setting->hours)
                    <li class="flex gap-3">
                        <svg class="{{ $iconClass }}" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg>
                        <span>{{ $setting->hours }}</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    {{-- 5. Baris bawah --}}
    <div class="bg-footer-bar py-5">
        <p class="wrap text-xs">© {{ date('Y') }} {{ $footer->copyright ?: $namaPerusahaan . '. Hak cipta dilindungi undang-undang.' }}</p>
    </div>
</footer>