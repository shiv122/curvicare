<div class="">
    {{-- <h4>{{ $label ?? '' }}</h4> --}}
    <div id="{{ $id }}" class=" d-flex justify-content-center {{ $class }}">
    </div>


</div>

@push('component-script')
    <script>
        var guage_chart_{{ $id }} = {
            chart: {
                height: 180,
                width: 180,
                type: 'radialBar',
                sparkline: {
                    enabled: true
                },
                dropShadow: {
                    enabled: true,
                    blur: 3,
                    left: 1,
                    top: 1,
                    opacity: 0.1
                }
            },
            colors: ['#51e5a8'],
            plotOptions: {
                radialBar: {
                    offsetY: -10,
                    startAngle: -150,
                    endAngle: 150,
                    hollow: {
                        size: '77%'
                    },
                    track: {
                        background: '#ebe9f1',
                        strokeWidth: '50%'
                    },
                    dataLabels: {
                        name: {
                            offsetY: -30,
                            show: true,
                            color: '#888',
                            fontSize: '20px'
                        },
                        value: {
                            color: '#5e5873',
                            fontSize: '2rem',
                            fontWeight: '600'
                        }
                    }
                },
                track: {
                    background: '#fff',
                    strokeWidth: '67%',
                    margin: 0, // margin is in pixels
                    dropShadow: {
                        enabled: true,
                        top: -3,
                        left: 0,
                        blur: 4,
                        opacity: 0.35
                    }
                },
            },

            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    type: 'horizontal',
                    shadeIntensity: 0.5,
                    gradientToColors: ['#ABE5A1'],
                    inverseColors: true,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 100]
                }
            },
            series: [{{ $value }}],
            stroke: {
                lineCap: 'round'
            },
            labels: ['{{ $label }}'],
            grid: {
                padding: {
                    bottom: 30
                }
            }
        };
        guage_chart_var_{{ $id }} = new ApexCharts(document.querySelector('#{{ $id }}'),
            guage_chart_{{ $id }});
        guage_chart_var_{{ $id }}.render();
    </script>
@endpush
