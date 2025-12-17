<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Schedule System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold mb-8">Test Schedule System</h1>
        
        <!-- All Barbers -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-2xl font-bold mb-4">Semua Kapster</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($allBarbers as $barber)
                <div class="border rounded-lg p-4">
                    <h3 class="font-bold">{{ $barber->name }}</h3>
                    <p class="text-sm text-gray-600">{{ $barber->level_display }}</p>
                    <p class="text-sm">{{ $barber->schedule_display }}</p>
                    <div class="mt-2">
                        <h4 class="text-sm font-semibold">Jadwal Detail:</h4>
                        @foreach($barber->schedules as $schedule)
                        <div class="text-xs text-gray-500">
                            {{ $schedule->day_display }}: {{ $schedule->formatted_time }}
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Test Different Days -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-2xl font-bold mb-4">Test Ketersediaan per Hari</h2>
            
            @php
                $testDates = [
                    '2025-12-16' => 'Senin',    // Monday
                    '2025-12-17' => 'Selasa',   // Tuesday  
                    '2025-12-18' => 'Rabu',     // Wednesday
                    '2025-12-19' => 'Kamis',    // Thursday
                    '2025-12-20' => 'Jumat',    // Friday
                    '2025-12-21' => 'Sabtu',    // Saturday
                    '2025-12-22' => 'Minggu',   // Sunday
                ];
            @endphp

            @foreach($testDates as $date => $dayName)
            <div class="mb-6 border-b pb-4">
                <h3 class="text-lg font-semibold mb-3">{{ $dayName }} ({{ $date }})</h3>
                @php
                    $availableBarbers = \App\Models\Barber::getAvailableForDate($date);
                @endphp
                
                @if($availableBarbers->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                    @foreach($availableBarbers as $barber)
                    @php
                        $dayOfWeek = strtolower(\Carbon\Carbon::parse($date)->format('l'));
                        $schedule = $barber->schedules()->where('day_of_week', $dayOfWeek)->first();
                    @endphp
                    <div class="bg-green-50 border border-green-200 rounded p-3">
                        <div class="font-medium text-green-800">{{ $barber->name }}</div>
                        <div class="text-sm text-green-600">{{ $barber->level_display }}</div>
                        @if($schedule)
                        <div class="text-xs text-green-500">{{ $schedule->formatted_time }}</div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @else
                <div class="text-gray-500 italic">Tidak ada kapster yang tersedia</div>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>