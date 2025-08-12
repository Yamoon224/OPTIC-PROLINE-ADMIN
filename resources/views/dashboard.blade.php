<x-app-layout :pagename="__('locale.dashboard')">    
    <div class="grid grid-cols-12 2xl:grid-cols-12 gap-x-5">
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-custom-100 text-custom-500 dark:bg-custom-500/20">
                    <i data-lucide="wallet-2"></i>
                </div>
                <h5 class="mt-4 mb-2">XOF <span class="counter-value" data-target="{{ $orders->where('payment_status', 'paid')->sum('amount') }}">0</span></h5>
                <p class="text-slate-500 dark:text-zink-200">@lang('locale.total_revenue')</p>
            </div>
        </div>
        <!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto text-purple-500 bg-purple-100 rounded-full size-14 dark:bg-purple-500/20">
                    <i data-lucide="package"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $orders->count() }}">0</span></h5>
                <p class="text-slate-500 dark:text-zink-200">@lang('locale.total_orders')</p>
            </div>
        </div>
        <!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto text-green-500 bg-green-100 rounded-full size-14 dark:bg-green-500/20">
                    <i data-lucide="truck"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $orders->where('order_status', 'delivered')->sum('amount') }}">0</span></h5>
                <p class="text-slate-500 dark:text-zink-200">@lang('locale.delivered')</p>
            </div>
        </div>
        <!--end col-->
        <div class="col-span-12 card md:col-span-6 lg:col-span-3 2xl:col-span-2">
            <div class="text-center card-body">
                <div class="flex items-center justify-center mx-auto text-red-500 bg-red-100 rounded-full size-14 dark:bg-red-500/20">
                    <i data-lucide="package-x"></i>
                </div>
                <h5 class="mt-4 mb-2"><span class="counter-value" data-target="{{ $orders->where('order_status', 'shipped')->sum('amount') }}">0</span></h5>
                <p class="text-slate-500 dark:text-zink-200">@lang('locale.shipped')</p>
            </div>
        </div>
        <!--end col-->

        <div class="col-span-12 card 2xl:col-span-8">
            <div class="card-body">
                <div class="flex flex-col gap-4 mb-4 md:mb-3 md:items-center md:flex-row">
                    <h6 class="grow text-15">@lang('locale.sale_revenue_overview')</h6>
                </div>
                <div class="grid grid-cols-12 gap-4 mb-3">
                    <div class="col-span-12 md:col-span-6 lg:col-span-3">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center rounded-md size-12 text-sky-500 bg-sky-50 shrink-0 dark:bg-sky-500/10">
                                <i data-lucide="bar-chart"></i>
                            </div>
                            <div class="grow">
                                <p class="mb-1 text-slate-500 dark:text-zink-200">@lang('locale.total_sales')</p>
                                <h5 class="text-15"><span class="counter-value" data-target="{{ $orders->where('order_status', '!=', 'pending')->sum('amount') }}">0</span> <span class="text-sm">XOF</span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 md:col-span-6 lg:col-span-3">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center text-green-500 rounded-md size-12 bg-green-50 shrink-0 dark:bg-green-500/10">
                                <i data-lucide="trending-up"></i>
                            </div>
                            <div class="grow">
                                <p class="mb-1 text-slate-500 dark:text-zink-200">@lang('locale.total_profit')</p>
                                <h5 class="text-15"><span class="counter-value" data-target="{{ $orders->where('order_status', 'delivered')->sum('amount') }}">0</span> <span class="text-sm">XOF</span></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="salesRevenueOverview" class="apex-charts" data-chart-colors='["bg-custom-500", "bg-custom-400", "bg-custom-300"]' dir="ltr"></div>
            </div>
        </div>
        <!--end col-->     

        <div class="col-span-12 card lg:col-span-6 2xl:col-span-3">
            <div class="card-body">
                <div class="flex items-center mb-3">
                    <h6 class="grow text-15">@lang('locale.top_providers')</h6>
                </div>
                <ul class="divide-y divide-slate-200 dark:divide-zink-500">
                    @foreach ($topcompanies as $item)
                    <li class="flex items-center gap-3 py-2 first:pt-0 last:pb-0">
                        <div class="w-8 h-8 rounded-full shrink-0 bg-slate-100 dark:bg-zink-600">
                            <img src="{{ asset($item->logo) }}" alt="LOGO" class="w-8 h-8 rounded-full">
                        </div>
                        <div class="grow">
                            <h6 class="font-medium">{{ $item->name }}</h6>
                            <p class="text-slate-500 dark:text-zink-200">{{ $item->contact }}</p>
                        </div>
                        <div class="shrink-0">
                            <h6>{{ $item->total_orders }}</h6>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        
        <div class="col-span-12 card lg:col-span-6 2xl:col-span-3">
            <div class="card-body">
                <div class="flex items-center mb-3">
                    <h6 class="grow text-15">@lang('locale.top_selling_products')</h6>
                </div>
                <ul class="flex flex-col gap-5">
                    @foreach ($topproducts as $item)
                    <li class="flex items-center gap-3">
                        <div class="flex items-center justify-center w-10 h-10 rounded-md bg-slate-100 dark:bg-zink-600 overflow-hidden">
                            <img src="{{ asset($item->image) }}" alt="LOGO" class="w-full h-full object-cover">
                        </div>
                        <div class="overflow-hidden grow">
                            <h6 class="truncate">{{ $item->name }}</h6>
                            <div class="text-yellow-500">
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-fill"></i>
                                <i class="ri-star-half-fill"></i>
                            </div>
                        </div>
                        <h6 class="shrink-0"><i data-lucide="shopping-cart" class="inline-block align-middle size-4 text-slate-500 dark:text-zink-200 ltr:mr-1 rtl:ml-1"></i> {{ $item->total_ordered }}</h6>
                    </li>
                    @endforeach                   
                </ul>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end grid-->

    @push('scripts')
    <script src="{{ asset('libs/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        function rgbToHex(rgb) {
            // Extract RGB values using regular expressions
            const rgbValues = rgb.match(/\d+/g);

            if (rgbValues.length === 3) {
                var [r, g, b] = rgbValues.map(Number);
            }
            // Ensure the values are within the valid range (0-255)
            r = Math.max(0, Math.min(255, r));
            g = Math.max(0, Math.min(255, g));
            b = Math.max(0, Math.min(255, b));

            // Convert each component to its hexadecimal representation
            const rHex = r.toString(16).padStart(2, '0');
            const gHex = g.toString(16).padStart(2, '0');
            const bHex = b.toString(16).padStart(2, '0');

            // Combine the hexadecimal values with the "#" prefix
            const hexColor = `#${rHex}${gHex}${bHex}`;

            return hexColor.toUpperCase(); // Convert to uppercase for consistency
        }

        function getChartColorsArray(chartId) {
            const chartElement = document.getElementById(chartId);
            if (chartElement) {
                const colors = chartElement.dataset.chartColors;
                if (colors) {
                    const parsedColors = JSON.parse(colors);
                    const mappedColors = parsedColors.map((value) => {
                        const newValue = value.replace(/\s/g, "");
                        if (!newValue.includes("#")) {
                            const element = document.querySelector(newValue);  
                            if (element) {
                                const styles = window.getComputedStyle(element);
                                const backgroundColor = styles.backgroundColor;
                                return backgroundColor || newValue;
                            } else {
                                const divElement = document.createElement('div');
                                divElement.className = newValue;
                                document.body.appendChild(divElement);

                                const styles = window.getComputedStyle(divElement);
                                const backgroundColor = styles.backgroundColor.includes("#") ? styles.backgroundColor : rgbToHex(styles.backgroundColor);
                                return backgroundColor || newValue;
                            }
                        } else {
                            return newValue;
                        }
                    });
                    return mappedColors;
                } else {
                    console.warn(`chart-colors attribute not found on: ${chartId}`);
                }
            }
        }
        var options = {
            series: [{
                name: 'Total Sales',
                data:  @json($ordersStatsByMonth->pluck('total_orders')->toArray())
            }, {
                name: 'Total Profit',
                data:  @json($ordersStatsByMonth->pluck('total_delivered')->toArray())
            }],
            chart: {
                type: 'bar',
                height: 300,
                stacked: true,
                stackType: '100%',
                toolbar: {
                    show: false,
                },
            },
            xaxis: {
                categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            },
            tooltip: {
                y: { formatter: (val) => val }
            },
            grid: {
                show: true,
                padding: {
                    top: -20,
                    right: -10,
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '50%',
                },
            },
            colors: getChartColorsArray("salesRevenueOverview"),
            fill: { opacity: 1 },
            legend: { position: 'bottom', },
        };

        var chart = new ApexCharts(document.querySelector("#salesRevenueOverview"), options);
        chart.render();
    </script>
    @endpush
</x-app-layout>
