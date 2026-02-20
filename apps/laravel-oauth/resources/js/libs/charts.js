// resources/js/charts.js
import ApexCharts from "apexcharts";
// window.ApexCharts = ApexCharts;

/**
 * Default 30 color palette
 * Disusun agar kontras dan tidak terlalu mirip
 */
// prettier-ignore
const DEFAULT_COLORS = [
    "#FF0000", "#00FF00", "#0000FF", "#FFFF00", "#FF00FF",
    "#00FFFF", "#FFA500", "#800080", "#008000", "#FFC0CB",
    "#A52A2A", "#008080", "#FFD700", "#4B0082", "#7FFF00",
    "#F08080", "#4682B4", "#D2691E", "#9ACD32", "#8B0000",
    "#40E0D0", "#EE82EE", "#808000", "#000080", "#FA8072",
    "#32CD32", "#87CEEB", "#FF4500", "#6A5ACD", "#2F4F4F"
];

/**
 * @typedef {Object} Series
 * @property {string} name - Nama series
 * @property {number[]} data - Array angka
 */

/**
 * @typedef {Object} ChartOptions
 * @property {string} [type="line"] - Tipe chart ('line', 'bar', 'area', 'donut', dll)
 * @property {Series[]} [series] - Array of series
 * @property {string[]} [categories] - Label sumbu X
 * @property {string[]} [colors] - Array warna untuk series
 * @property {Object} [yaxis] - Konfigurasi Y-axis {title: {text}, min, max}
 * @property {number} [height=300] - Tinggi chart
 * @property {boolean} [dataLabelsEnabled=false] - Tampilkan data labels
 * @property {string} [strokeCurve="smooth"] - Tipe kurva stroke ('smooth', 'straight', dll)
 * @property {boolean} [legendShow=true] - Tampilkan legend
 */

/**
 * Membuat chart ApexCharts dengan opsi dinamis dan default values.
 * @param {string} selector - CSS selector dari elemen DOM tempat chart dirender
 * @param {ChartOptions} [options={}] - Opsi chart
 * @returns {ApexCharts} Instance chart yang dibuat
 *
 *  @example
 * import Chart from './charts';
 * Chart("#demo-chart", {
 *     type: "line",
 *     series: [
 *         { name: "Digital Goods", data: [28, 48, 40, 19, 86, 27, 90] }
 *     ],
 *     categories: ["Jan", "Feb", "Mar", "Apr", "May"]
 * });
 */

export default function chart(
    selector,
    {
        type = "line",
        series = [
            {
                name: "Default Series",
                data: [10, 20, 15, 25, 30], // default angka contoh
            },
        ],
        categories = ["Label 1", "Label 2", "Label 3", "Label 4", "Label 5"],
        colors = DEFAULT_COLORS,
        yaxis = {
            title: { text: "Y-Axis Value" },
            min: 0,
            max: Math.max(...series.flatMap((s) => s.data)) + 10,
        },
        height = 180,
        dataLabelsEnabled = false,
        strokeCurve = "smooth",
        legendShow = true,
    } = {},
) {
    // Default options ApexCharts
    const chartOptions = {
        chart: {
            type,
            height,
            toolbar: { show: false },
        },
        series,
        colors,
        dataLabels: { enabled: dataLabelsEnabled },
        stroke: { curve: strokeCurve },
        legend: { show: legendShow },
        xaxis: type !== "donut" && type !== "pie" ? { categories } : undefined,
        yaxis: type !== "donut" && type !== "pie" ? yaxis : undefined,
        tooltip: {
            x: { format: "MMM dd yyyy" },
        },
    };

    const chart = new ApexCharts(
        document.querySelector(selector),
        chartOptions,
    );

    chart.render();
    return chart;
}

/* 
    =========================
        CONTOH PENGGUNAAN
    =========================

    -- 1. Line Chart di #sales-chart --
    chart("#sales-chart", {
        type: "line",
        series: [
            { name: "Digital Goods", data: [28, 48, 40, 19, 86, 27, 90] },
            { name: "Electronics", data: [65, 59, 80, 81, 56, 55, 40] },
        ],
        categories: [
            "2023-01-01",
            "2023-02-01",
            "2023-03-01",
            "2023-04-01",
            "2023-05-01",
            "2023-06-01",
            "2023-07-01",
        ],
    });

    -- 2. Pie Chart di #pie-chart --
    chart("#pie-chart", {
        type: "donut",
        series: [700, 500, 400, 600, 300, 100],
        colors: ["#0d6efd", "#20c997", "#ffc107", "#d63384", "#6f42c1", "#adb5bd"],
    });

    -- 3. Sparkline (mini line chart) contoh --
    chart("#sparkline-chart", {
        type: "line",
        height: 50,
        series: [{ name: "Visitors", data: [5, 10, 8, 12, 7, 15] }],
        strokeCurve: "straight",
        legendShow: false,
        dataLabelsEnabled: false,
    });
*/
