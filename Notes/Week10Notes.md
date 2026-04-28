# Week 10 Notes - Chart.js Dashboard

## 1) Basic Chart.js Setup

1. Add a canvas in your HTML.
2. Load Chart.js using the CDN.
3. Create a chart by passing a type, labels array, and datasets array.

```html
<div>
	<canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
```

```js
const ctx = document.getElementById("myChart");

new Chart(ctx, {
	type: "bar",
	data: {
		labels: ["Red", "Blue", "Yellow", "Green"],
		datasets: [{
			label: "Votes",
			data: [12, 19, 3, 5],
			borderWidth: 1
		}]
	},
	options: {
		scales: {
			y: {
				beginAtZero: true
			}
		}
	}
});
```

## 2) Passing PHP Data to JavaScript (Dynamic Charts)

Key rule: **Chart.js expects arrays** for `labels` and `datasets`.

### Step A - Prepare arrays in PHP

```php
$labels = array_column($depts, "departmentDescription");
$data = array_column($depts, "total_users");
```

### Step B - Send arrays to JS with `json_encode`

```php
<script>
	window.barData = {
		labels: <?= json_encode($labels) ?>,
		data: <?= json_encode($data) ?>
	};
</script>
```

### Step C - Use the data in JavaScript

```js
new Chart(document.getElementById("myChart"), {
	type: "bar",
	data: {
		labels: window.barData.labels,
		datasets: [{
			data: window.barData.data
		}]
	}
});
```

## 3) How It Applies to the ChiikaMart Dashboard

- **Dashboard.php** queries the database and converts result sets into arrays.
- The arrays are assigned to `window.*` variables using `json_encode`.
- **Service.js** reads those `window.*` variables and creates Chart.js charts.

## 4) Chart Types Used

- Line chart for **Sales Over Time**
- Line/area chart for **User Registration Trend**
- Doughnut chart for **Order Status Breakdown**
- Bar charts for **Top Selling Products**, **Revenue by Character/Collection**, **Review Star Distribution**, and **Lowest Stock Watchlist**

## 5) Quick Checklist

- Do you have a `<canvas>` element in the dashboard?
- Is Chart.js loaded before your custom JS?
- Are your labels and data arrays printed using `json_encode`?
- Is your chart JS checking for missing data or missing canvas elements?

## 6) Next Step (Future)

We can move the dashboard Chart.js logic into a dedicated dashboard JS file later. The PHP data flow stays the same.
