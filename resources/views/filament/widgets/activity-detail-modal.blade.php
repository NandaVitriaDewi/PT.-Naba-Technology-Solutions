<div class="space-y-4 text-sm">
    <div class="rounded-lg bg-gray-50 p-4 dark:bg-gray-900 border border-gray-200 dark:border-gray-800">
        <div class="flex justify-between items-center mb-2">
            <span class="font-semibold text-gray-500 uppercase text-xs">Aktivitas:</span>
            <span class="px-2 py-1 bg-primary-500/10 text-primary-600 rounded font-medium text-xs">{{ $record->subject }}</span>
        </div>
        <p class="text-base font-bold text-gray-800 dark:text-gray-100">{{ $record->description }}</p>
        <p class="text-xs text-gray-400 mt-1">Waktu: {{ $record->created_at->format('d M Y, H:i:s') }} ({{ $record->created_at->diffForHumans() }})</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- Data Sebelum (Old Values) --}}
        <div class="rounded-lg border border-red-200 bg-red-50/50 p-4 dark:bg-red-950/20 dark:border-red-900/50">
            <h4 class="font-bold text-red-600 dark:text-red-400 mb-2 flex items-center gap-1.5 text-xs uppercase tracking-wider">
                <x-filament::icon icon="heroicon-m-arrow-left-circle" class="w-4 h-4" />
                Sebelum Diubah (Old Data)
            </h4>
            <div class="bg-white dark:bg-gray-900 p-3 rounded border border-red-100 dark:border-red-900/30 font-mono text-xs overflow-x-auto max-h-60">
                @if(!empty($record->old_values))
                    <pre>{{ json_encode($record->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @else
                    <span class="text-gray-400 italic">Tidak ada data terekam (Data baru / Create)</span>
                @endif
            </div>
        </div>

        {{-- Data Sesudah (New Values) --}}
        <div class="rounded-lg border border-green-200 bg-green-50/50 p-4 dark:bg-green-950/20 dark:border-green-900/50">
            <h4 class="font-bold text-green-600 dark:text-green-400 mb-2 flex items-center gap-1.5 text-xs uppercase tracking-wider">
                <x-filament::icon icon="heroicon-m-arrow-right-circle" class="w-4 h-4" />
                Sesudah Diubah (New Data)
            </h4>
            <div class="bg-white dark:bg-gray-900 p-3 rounded border border-green-100 dark:border-green-900/30 font-mono text-xs overflow-x-auto max-h-60">
                @if(!empty($record->new_values))
                    <pre>{{ json_encode($record->new_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                @else
                    <span class="text-gray-400 italic">Tidak ada data</span>
                @endif
            </div>
        </div>
    </div>
</div>