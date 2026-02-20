import LibChart from "../libs/charts";

export function demoChart() {
    LibChart("#demo-chart", {
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
}
