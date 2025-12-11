<div class="space-y-6">


    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">


        <div class="bg-white shadow-md rounded-xl p-5 flex items-center hover:shadow-lg transition">
            <div class="bg-pink-700 text-white w-14 h-14 flex items-center justify-center rounded-lg text-3xl">
                <i class="ri-calendar-event-fill"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-xl font-bold text-gray-700">Bookings</h2>
                <p class="text-2xl font-extrabold text-pink-700">{{ $bookings ?? 0 }}</p>
            </div>
        </div>


        <div class="bg-white shadow-md rounded-xl p-5 flex items-center hover:shadow-lg transition">
            <div class="bg-pink-700 text-white w-14 h-14 flex items-center justify-center rounded-lg text-3xl">
                <i class="ri-check-double-fill"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-xl font-bold text-gray-700">Approved</h2>
                <p class="text-2xl font-extrabold text-green-600">{{ $approved ?? 0 }}</p>
            </div>
        </div>


        <div class="bg-white shadow-md rounded-xl p-5 flex items-center hover:shadow-lg transition">
            <div class="bg-pink-700 text-white w-14 h-14 flex items-center justify-center rounded-lg text-3xl">
                <i class="ri-user-fill"></i>
            </div>
            <div class="ml-4">
                <h2 class="text-xl font-bold text-gray-700">Users</h2>
                <p class="text-2xl font-extrabold text-blue-700">{{ $users ?? 0 }}</p>
            </div>
        </div>

    </div>


    <div class="bg-white p-6 rounded-xl shadow-md">
        <h2 class="text-xl font-bold text-gray-700 mb-4">Monthly Income</h2>

        <canvas id="incomeChart" height="110"></canvas>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('incomeChart').getContext('2d');

    const incomeChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($months ?? ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']) !!},
            datasets: [{
                label: 'Income',
                data: {!! json_encode($income ?? [0,0,0,0,0,0,0,0,0,0,0,0]) !!},
                borderWidth: 3,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
