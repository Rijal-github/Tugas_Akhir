<div>
    <div class="bg-white rounded-2xl shadow-md p-6 w-full">
        <div class="flex justify-between items-start mb-4">
            <h2 class="text-sm text-gray-400 font-semibold">Grafik Ritasi</h2>
            <div class="bg-indigo-50 p-2 rounded-full">
                <i class="fas fa-chart-bar text-indigo-600 text-sm"></i>
            </div>
        </div>
        <canvas id="ritasiChart" height="100"></canvas>
    </div>
      
<script>
    const ctx = document.getElementById('ritasiChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Ritasi',
                data: [12, 19, 3, 5, 2, 17, 10, 15, 7, 8, 6, 9],
                backgroundColor: '#6366f1'
            }]
        }
    });
</script>

    </script>
</div>
{{-- document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('ritasiChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Ritasi',
                data: [45, 78, 67, 80, 65, 179, 50, 99, 25, 60, 49, 70],
                backgroundColor: function(ctx) {
                    return ctx.dataIndex === 5 ? '#4F46E5' : '#E0E7FF'; // Highlight bulan Juni
                },
                borderRadius: 8,
                barPercentage: 0.5,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: true }
            },
            scales: {
                y: {
                    display: false
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
}); --}}
