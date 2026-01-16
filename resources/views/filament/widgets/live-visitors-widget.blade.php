<x-filament-widgets::widget>
    @php
        $data = $this->getVisitorData();
    @endphp

    <x-filament::section class="h-full">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6" wire:poll.10s>

            {{-- Left Column: Live Stats --}}
            <div class="flex flex-col justify-between h-full space-y-6">

                {{-- Live Counter --}}
                <div class="flex items-start gap-4">
                    <div
                        class="relative flex items-center justify-center flex-shrink-0 w-16 h-16 rounded-2xl bg-primary-50 dark:bg-primary-900/20 text-primary-600 dark:text-primary-400 ring-1 ring-inset ring-primary-100 dark:ring-primary-400/20">
                        <x-heroicon-o-users class="w-8 h-8" />
                        <span class="absolute top-0 right-0 flex w-4 h-4 -mt-1.5 -mr-1.5">
                            <span
                                class="absolute inline-flex w-full h-full bg-success-400 rounded-full opacity-75 animate-ping"></span>
                            <span
                                class="relative inline-flex w-4 h-4 bg-success-500 rounded-full border-2 border-white dark:border-gray-900"></span>
                        </span>
                    </div>
                    <div>
                        <div class="flex items-baseline gap-2">
                            <h2 class="text-4xl font-bold tracking-tight text-gray-950 dark:text-white">
                                {{ $data['active'] }}
                            </h2>
                            <span
                                class="text-sm font-medium text-success-600 dark:text-success-400 animate-pulse">Online</span>
                        </div>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            People on your site right now
                        </p>
                        <div
                            class="mt-2 inline-flex items-center px-2 py-1 rounded-md bg-gray-100 dark:bg-gray-800 text-xs font-medium text-gray-600 dark:text-gray-300">
                            <x-heroicon-m-arrow-trending-up class="w-3 h-3 mr-1" />
                            Peak today: {{ $data['peakToday'] }} visitors
                        </div>
                    </div>
                </div>

                {{-- Trend Chart --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs font-medium text-gray-500 uppercase tracking-wider">Traffic (Last
                            Hour)</span>
                    </div>
                    <div
                        class="flex items-end gap-1 h-12 w-full bg-gray-50 dark:bg-gray-900/50 rounded-lg p-2 border border-gray-100 dark:border-gray-800">
                        @if(empty($data['trend']) || max($data['trend']) == 0)
                            <div class="w-full h-full flex items-center justify-center text-xs text-gray-400">waiting for
                                data...</div>
                        @else
                            @foreach($data['trend'] as $count)
                                @php
                                    $maxHeight = max($data['trend']) ?: 1;
                                    $height = $maxHeight > 0 ? ($count / $maxHeight) * 100 : 0;
                                @endphp
                                <div class="flex-1 rounded-sm bg-primary-500 dark:bg-primary-400 transition-all duration-500 ease-out"
                                    style="height: {{ max(15, $height) }}%; opacity: {{ $count > 0 ? 1 : 0.2 }}"
                                    title="{{ $count }} visitors"></div>
                            @endforeach
                        @endif
                    </div>
                    <div class="flex justify-between mt-1 text-[10px] text-gray-400 font-medium">
                        <span>60 min ago</span>
                        <span>Now</span>
                    </div>
                </div>
            </div>

            {{-- Right Column: Performance Stats --}}
            <div
                class="relative bg-gray-50 dark:bg-gray-900/30 rounded-xl p-6 border border-gray-100 dark:border-gray-800/50 flex flex-col justify-center items-center text-center">

                <div class="mb-4">
                    <h3
                        class="text-sm font-semibold text-gray-900 dark:text-white flex items-center justify-center gap-2">
                        Performance
                    </h3>
                </div>

                <div
                    class="text-5xl font-black text-{{ $data['statusColor'] }}-600 dark:text-{{ $data['statusColor'] }}-400 tracking-tight">
                    {{ $data['avgResponseTime'] }}<span
                        class="text-2xl text-gray-400 dark:text-gray-500 font-bold ml-1">ms</span>
                </div>

                <p class="text-sm font-medium text-gray-500 dark:text-gray-400 mt-2">
                    Avg Response Time
                </p>

                <div
                    class="mt-4 inline-flex items-center px-3 py-1 rounded-full bg-{{ $data['statusColor'] }}-100 dark:bg-{{ $data['statusColor'] }}-900/30 text-{{ $data['statusColor'] }}-700 dark:text-{{ $data['statusColor'] }}-300 text-sm font-bold">
                    {{ $data['status'] }}
                </div>

                <div
                    class="mt-6 pt-6 w-full border-t border-gray-200 dark:border-gray-700/50 flex justify-between items-center px-4">
                    <span class="text-sm text-gray-500 dark:text-gray-400">Requests Today</span>
                    <span
                        class="text-lg font-bold text-gray-900 dark:text-white">{{ number_format($data['totalRequests']) }}</span>
                </div>

            </div>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>