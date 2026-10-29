<x-filament-widgets::widget>
    @php
        $periods = ['7' => '7 Hari', '30' => '30 Hari', 'all' => 'Semua'];
    @endphp

    <div style="background-color: white; border: 1px solid #e2e8f0; border-radius: 0.75rem; box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); padding: 1.25rem;">
        
        {{-- HEADER --}}
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 1rem; padding-bottom: 1rem; margin-bottom: 1rem; border-bottom: 1px solid #f1f5f9;">
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="border-radius: 0.5rem; background-color: #eff6ff; padding: 0.5rem; color: #2563eb; flex-shrink: 0;">
                    <x-filament::icon icon="heroicon-o-clock" style="width: 1.25rem; height: 1.25rem;" />
                </div>
                <div>
                    <span style="font-size: 0.70rem; font-weight: 600; color: #94a3b8; text-transform: uppercase;">Aktivitas</span>
                    <h3 style="font-size: 1rem; font-weight: 700; color: #1e293b; line-height: 1.3;">Riwayat Perubahan Konten</h3>
                    <p style="margin-top: 0.125rem; font-size: 0.75rem; color: #64748b;">Perubahan yang disimpan admin pada konten website.</p>
                </div>
            </div>

            <div style="display: flex; align-items: center; gap: 0.5rem;">
                {{-- TOMBOL HAPUS (Muncul kalau ada data yang dicentang) --}}
                @if(count($selectedLogs) > 0)
                    <button type="button" wire:click="deleteSelected" wire:confirm="Yakin mau hapus riwayat yang dipilih?"
                        style="display: inline-flex; align-items: center; gap: 0.375rem; border: 1px solid #fecaca; background-color: #fef2f2; color: #dc2626; border-radius: 0.5rem; padding: 0.3rem 0.75rem; font-size: 0.75rem; font-weight: 700; cursor: pointer;"
                        onmouseover="this.style.backgroundColor='#fee2e2'" onmouseout="this.style.backgroundColor='#fef2f2'">
                        <x-filament::icon icon="heroicon-m-trash" style="width: 0.875rem; height: 0.875rem;" />
                        Hapus ({{ count($selectedLogs) }})
                    </button>
                @endif

                {{-- FILTER WAKTU --}}
                <div style="display: inline-flex; gap: 0.25rem; background-color: #f1f5f9; padding: 0.25rem; border-radius: 0.625rem;">
                    @foreach ($periods as $key => $label)
                        <button type="button" wire:click="setPeriod('{{ $key }}')"
                            style="border: 0; cursor: pointer; border-radius: 0.5rem; padding: 0.3rem 0.75rem; font-size: 0.75rem; font-weight: 700; 
                            {{ $period === (string) $key ? 'background-color: white; color: #1e293b; box-shadow: 0 1px 2px rgba(0,0,0,0.08);' : 'background-color: transparent; color: #64748b;' }}">
                            {{ $label }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- DAFTAR AKTIVITAS --}}
        @forelse ($this->rows as $row)
            <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 0.75rem; padding: 0.875rem 0.5rem; border-bottom: 1px solid #f1f5f9; border-radius: 0.5rem; transition: background-color 0.15s ease;"
                onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                
                <div style="display: flex; align-items: flex-start; gap: 0.75rem; min-width: 0; flex: 1 1 18rem;">
                    
                    {{-- CHECKBOX SELECT --}}
                    <div style="display: flex; align-items: center; height: 2rem;">
                        <input type="checkbox" wire:model.live="selectedLogs" value="{{ $row['id'] }}" 
                            style="width: 1rem; height: 1rem; border-radius: 0.25rem; border: 1px solid #cbd5e1; cursor: pointer; accent-color: #2563eb;">
                    </div>

                    <div style="border-radius: 0.5rem; background-color: #eff6ff; padding: 0.5rem; color: #2563eb; flex-shrink: 0;">
                        <x-filament::icon :icon="$row['icon']" style="width: 1.25rem; height: 1.25rem;" />
                    </div>
                    
                    <div style="min-width: 0;">
                        <p style="font-size: 0.875rem; font-weight: 600; color: #1e293b; line-height: 1.4;">{{ $row['description'] }}</p>
                        <div style="margin-top: 0.375rem; display: flex; flex-wrap: wrap; align-items: center; gap: 0.4rem; font-size: 0.75rem; color: #64748b;">
                            <span style="background-color: #eff6ff; color: #1d4ed8; border-radius: 9999px; padding: 0.1rem 0.55rem; font-weight: 600;">{{ $row['subject'] }}</span>
                            <span style="background-color: {{ $row['action']['bg'] }}; color: {{ $row['action']['color'] }}; border-radius: 9999px; padding: 0.1rem 0.55rem; font-weight: 600;">{{ $row['action']['label'] }}</span>
                            <span>{{ $row['time'] }} &middot; {{ $row['ago'] }}</span>
                            @if ($row['user'])
                                <span>&middot; oleh <strong style="color: #475569;">{{ $row['user'] }}</strong></span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div style="padding: 2.5rem 1rem; text-align: center; border: 1px dashed #cbd5e1; border-radius: 0.75rem;">
                <div style="display: inline-flex; border-radius: 9999px; background-color: #f1f5f9; padding: 0.75rem; color: #94a3b8;">
                    <x-filament::icon icon="heroicon-o-clock" style="width: 1.5rem; height: 1.5rem;" />
                </div>
                <p style="margin-top: 0.75rem; font-size: 0.875rem; font-weight: 600; color: #475569;">Belum ada aktivitas ({{ $periods[$period] }})</p>
                <p style="margin-top: 0.25rem; font-size: 0.75rem; color: #94a3b8;">Perubahan yang Anda simpan di admin akan muncul di sini.</p>
            </div>
        @endforelse

        {{-- Footer daftar --}}
        @if (count($this->rows) > 0)
            <div style="margin-top: 1rem; display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 0.75rem; font-size: 0.75rem; color: #64748b;">
                <span>Menampilkan {{ count($this->rows) }} dari {{ $this->totalLogs }} aktivitas ({{ $periods[$period] }})</span>
                @if ($this->totalLogs > $limit)
                    <button type="button" wire:click="loadMore"
                        style="border: 1px solid #e2e8f0; background-color: white; color: #475569; border-radius: 0.5rem; padding: 0.4rem 0.75rem; font-size: 0.75rem; font-weight: 700; cursor: pointer;"
                        onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='white'">
                        Muat lebih banyak
                    </button>
                @endif
            </div>
        @endif
    </div>
</x-filament-widgets::widget>