# Week 10 Notes

## Scope of this note
These notes summarize the code changes currently in your working tree compared to the last pushed commit on branch `Base-code`.

- Baseline commit: `a03c190`
- Remote baseline: `origin/Base-code`
- Diff source: local uncommitted changes after the previous push

## 1) JavaScript updates in scripts/Service.js

### A. Number-only input logic added
You added a listener for `txtFirstName` and a helper function that removes non-digits.

```js
const inputNumber = document.getElementById("txtFirstName");

inputNumber.addEventListener("input", function() {
    allowOnlyNumber(this);
});

function allowOnlyNumber(element) {
    element.value = element.value.replace(/[^0-9]/g, "");
}
```

### B. addFunc changes
- Added guard:
  - if first name length is below 5, function returns early.
- Success message changed to simple `alert(returnedData)`.


### D. Datepicker initialization added
Inside `$(document).ready(...)`:

```js
$('.datepicker').datepicker({
    maxDate: new Date(),
    format: 'yyyy-mm-dd',
    autoClose: true
});
```

## 2) View updates in views/RegistrationPage.php

### A. Datepicker input added
A new input was added near the top of the row:

```html
<input type="text" class="datepicker">
```

### C. Extra input attribute
- First name input now has `maxlength="49"`.

## 5) Model update in model/registrationModel.php

### B. Sample password-check block commented out
- The sample block under `// Change based on use...` is now fully commented.

## 6) Dynamic Department Cards (Major Week 10 Feature)

This week adds a dynamic dashboard card system driven by department data and user counts.

### A. New/updated functions in bl/DepartmentManagement.php

`DepartmentManagement` now has two data retrieval functions used by different screens:

1. `getDepartment()`
- Purpose: fetch departments for the registration dropdown.
- Data source: `readDepartment()` from `departmentModel`.

2. `getCardDepartment()` (new)
- Purpose: fetch aggregated data for dashboard cards.
- Data source: `cardDepartment()` from `departmentModel`.

```php
public function getCardDepartment() {
    $response = $this->depsModel->cardDepartment();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
```

### B. New query function in model/departmentModel.php

Added `cardDepartment()` to build the dashboard card dataset:

- Selects each department description.
- Counts matched registrations as `total_users`.
- Uses `LEFT JOIN` so departments still appear even with zero users.

Current JOIN in working tree:

```sql
ON u.departmentID = d.departmentID
```

### C. Dynamic rendering in views/Dashboard.php

Dashboard is no longer static placeholder HTML.

- Requires `DepartmentManagement.php`
- Calls `getCardDepartment()`
- Loops through `$depts`
- Creates one Materialize card per department
- Displays:
  - `departmentDescription`
  - `total_users`

## 7) Dashboard page changes in views/Dashboard.php

Dashboard now behaves as a data-driven summary page and reflects live department/user totals from the database query flow:

`Dashboard.php` -> `DepartmentManagement::getCardDepartment()` -> `Department::cardDepartment()` -> SQL aggregate result -> card loop in view.

## 9) Quick review checklist (for study/testing)

Use this checklist when reviewing Week 10 behavior:

1. Registration page loads with no JS errors.
2. Datepicker opens and saves date format `yyyy-mm-dd`.
3. Add button sends payload with `fname`, `lName`, and `dept`.
4. Add flow still works when department is selected.
5. Dashboard cards show department names and user counts.
6. Login page still works with Service.js loaded.

## 10) Files changed since previous push

- `bl/DepartmentManagement.php`
- `bl/UserManagement.php`
- `controllers/UserController.php`
- `model/departmentModel.php`
- `model/registrationModel.php`
- `scripts/Service.js`
- `views/Dashboard.php`
- `views/RegistrationPage.php`
