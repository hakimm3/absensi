<canvas id="linechart" width="400" height="100"></canvas>

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"
        integrity="sha512-ElRFoEQdI5Ht6kZvyzXhYG9NqjtkmlkfYk0wr6wHxU9JEHakS7UJZNeml5ALk+8IKlU6jDgMabC3vkumRokgJA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
       
    </script>
    <script>
        const chart_1 = document.getElementById('linechart');
        // const linechart = new Chart(chart_1, {
        //     type: 'line',
        //     data: {
        //         labels: data_label,
        //         datasets: [{
        //             label: 'Jumlah Late Attendance',
        //             data: data_bulan,
        //             fill: false,
        //             borderColor: 'rgb(75, 192, 192)',
        //             tension: 0.1
        //         }]
        //     },
        //     options: {
        //         backgroundColor: '#999',
        //         borderColor: 'rgb(75, 192, 192)',
        //     }
        // });

        var labels = [];
        var present = [];
        var late = [];

        @foreach ($attendanceResult as $item)
            labels.push('{{ $item['month_year'] }}');
            present.push({{ $item['present'] }});
            late.push({{ $item['late'] }});
        @endforeach


        // const labels = ['January 2022', 'February 2022', 'March 2022', 'April 2022', 'May 2022', 'June 2022', 'July 2022'];
        const data = {
            labels: labels,
            datasets: [{
                    label: 'Present',
                    data: present,
                    borderColor: "#ff0000",
                    backgroundColor: "#ff0000",
                    yAxisID: 'y',
                },
                {
                    label:  'Late',
                    data: late,
                    borderColor: "#0000ff",
                    backgroundColor: "#0000ff",
                    yAxisID: 'y1',
                }
            ]
        };


        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Attendance Chart'
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',

                        // grid line settings
                        grid: {
                            drawOnChartArea: false, // only want the grid lines for one axis to show up
                        },
                    },
                }
            },
        };


        const linechart = new Chart(chart_1, config);
    </script>
@endpush
