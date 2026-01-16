<x-filament-widgets::widget>
    <x-filament::section>
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-danger-500" />
                Error Log
            </div>
        </x-slot>

        <x-slot name="headerEnd">
            @php $stats = $this->getErrorStats(); @endphp
            @if($stats['total'] > 0)
                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold {{ $stats['critical'] > 0 ? 'bg-danger-100 text-danger-700 dark:bg-danger-900/30 dark:text-danger-400' : 'bg-warning-100 text-warning-700 dark:bg-warning-900/30 dark:text-warning-400' }}">
                    {{ $stats['total'] }} error{{ $stats['total'] > 1 ? 's' : '' }} today
                </span>
            @else
                <span class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-semibold bg-success-100 text-success-700 dark:bg-success-900/30 dark:text-success-400">
                    ✓ No errors
                </span>
            @endif
        </x-slot>

        @php $errors = $this->getRecentErrors(); @endphp

        @if(count($errors) === 0)
            <div class="flex flex-col items-center justify-center py-8 text-center">
                <div class="w-12 h-12 rounded-full bg-success-100 dark:bg-success-900/20 flex items-center justify-center mb-3">
                    <x-heroicon-o-check-circle class="w-6 h-6 text-success-500" />
                </div>
                <h4 class="text-sm font-medium text-gray-900 dark:text-white">All Systems Operational</h4>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">No errors have been logged today</p>
            </div>
        @else
            <div class="space-y-3">
                @foreach($errors as $error)
                    <div class="group relative p-3 rounded-lg {{ $error['level'] === 'ERROR' ? 'bg-warning-50 dark:bg-warning-900/10 border border-warning-200 dark:border-warning-800/30' : 'bg-danger-50 dark:bg-danger-900/10 border border-danger-200 dark:border-danger-800/30' }}">
                        
                        {{-- Header Row --}}
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                @if($error['level'] === 'ERROR')
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-bold bg-warning-200 text-warning-800 dark:bg-warning-800/50 dark:text-warning-300">
                                        <x-heroicon-m-exclamation-triangle class="w-3 h-3" />
                                        Warning
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs font-bold bg-danger-200 text-danger-800 dark:bg-danger-800/50 dark:text-danger-300">
                                        <x-heroicon-m-x-circle class="w-3 h-3" />
                                        Critical
                                    </span>
                                @endif
                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ \Carbon\Carbon::parse($error['time'])->format('M j, g:i A') }}
                                </span>
                            </div>
                            
                            {{-- Copy Button --}}
                            <button 
                                type="button"
                                x-data="{ copied: false }"
                                x-on:click="
                                    navigator.clipboard.writeText($refs.errorText{{ $loop->index }}.innerText);
                                    copied = true;
                                    setTimeout(() => copied = false, 2000);
                                "
                                class="p-1.5 rounded-md bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 transition-colors"
                                title="Copy error message"
                            >
                                <template x-if="!copied">
                                    <x-heroicon-o-clipboard-document class="w-4 h-4" />
                                </template>
                                <template x-if="copied">
                                    <x-heroicon-o-check class="w-4 h-4 text-success-500" />
                                </template>
                            </button>
                        </div>
                        
                        {{-- Error Message --}}
                        <p 
                            x-ref="errorText{{ $loop->index }}"
                            class="text-sm text-gray-800 dark:text-gray-200 font-mono leading-relaxed break-words select-all cursor-text"
                        >{{ $error['message'] }}</p>
                        
                        {{-- Time ago --}}
                        <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                            {{ \Carbon\Carbon::parse($error['time'])->diffForHumans() }}
                        </p>
                    </div>
                @endforeach
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>