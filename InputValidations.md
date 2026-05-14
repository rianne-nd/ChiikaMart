# Registration Form Input Validation Review

## 1. Existing JavaScript Validations

### A. Password Match Verification
```javascript
if (password !== confirmPassword) { ... }
```
**Explanation:** Compares the active value of the `Password` field and the `Confirm Password` field. If they mismatch, it halts submission and displays a SweetAlert2 error box.
**Status:** ✅ Good. Prevents database inserts for mistyped passphrases.

### B. Birthday Range Limit (No Future Dates)
```javascript
if (selectedDate > today) { ... }
```
**Explanation:** Validates that the parsed `birthday` input is not strictly greater than the current date (with hours zeroed out).
**Status:** ✅ Good. Prevents logical errors in user data, such as users claiming they haven't been born yet.

### C. Numeric Input Enforcement
```javascript
function allowOnlyNumber(element) {
    element.value = element.value.replace(/[^0-9]/g, "");
}
```
**Explanation:** Bound to the `input` event on Phone Number and Zip Code. It constantly sweeps the field to instantly replace non-numeric characters using Regex.
**Status:** ✅ Good UI pattern. It immediately corrects the user dynamically as they are typing.

---

## 2. Validation Constraints Critique & Defense (`maxlength`)

Here is an analysis of the implemented `maxlength` values in `RegistrationPage.php`. Many standard database setups base their column sizes roughly on increments like 50, 100, 150, or 255. 

### Names
* **`txtFirstname` (49)** / **`txtLastname` (49)**
  * **Defense:** 49 characters are generous for name properties. It easily accounts for individuals with multiple names or hyphens.
  * **Critique:** Usually, database architectures allocate exactly 50 (`VARCHAR(50)`). Limiting to 49 leaves 1 byte randomly unused, though it is fundamentally fine.

### Personal Details
* **`txtSuffix` (9)**
  * **Defense:** Very reasonable limit for standard suffixes (e.g., "Jr.", "Sr.", "III", "Esq."). Nothing further is needed.
* **`txtPhoneNumber` (11) - *(Updated from 9)* **
  * **Defense:** Enforces exactly 11 digits to match the standard format (e.g., 09XX XXX XXXX) avoiding extremely long broken entries.
  * **Critique Fix:** Originally set to 9, which would have made the new JS format validation impossible to fulfill.
* **`txtEmail` (99)**
  * **Defense:** 99 covers practically all consumer email addresses (`johndoe123@gmail.com`).
  * **Critique:** RFC 5321 dictates a maximum length of 254 for email addresses (`VARCHAR(255)`). 99 might risk cutting off very formal, enterprise-level names. Next iteration should consider bumping to `254`.
* **`txtPassword` / `txtConfirmPassword` (254)**
  * **Defense:** An excellent length limitation. By giving `254` characters, you allow password manager applications and specific users to formulate long, highly secure passphrases.

### Address Details
* **`txtStreet` (149)**
  * **Defense:** Street addresses can be notoriously long when accounting for Unit Number, Building Name, and Block lines. 149 is perfect for a standard `VARCHAR(150)` structure. 
* **`txtBarangay` (49)** / **`txtCity` (49)** / **`txtProvince` (49)**
  * **Defense:** Highly optimal. Almost no province, region, or city reaches 50 characters, ensuring safety without compromising edge cases.
* **`txtZipCode` (9)**
  * **Defense:** Solid choice. Typical zip-codes range from 4 digits (Philippines) to 5-9 digits (US structures).

---

## 3. Implemented Additional JavaScript Validations

For thorough security, the following validations were added before executing the registration creation process:

### Phone Format Check (For PH 11 digits starting in 09)
```javascript
if (phoneNumber.length !== 11 || !phoneNumber.startsWith("09")) {
    Swal.fire({
        title: "Error!",
        text: "Please enter a valid 11-digit mobile number starting with 09.",
        icon: "warning",
        confirmButtonText: "OK"
    });
    return;
}
```
**Explanation:** Paired with the character regex, this ensures exact bounds and proper area format constraints before submission.

### Minimum Password Length Restriction
```javascript
if (password.length < 8) {
    Swal.fire({
        title: "Error!",
        text: "For your security, passwords must be at least 8 characters long.",
        icon: "warning",
        confirmButtonText: "OK"
    });
    return;
}
```
**Explanation:** Prevents usage of weak or short passwords (e.g. `123`, `abc`) forcing better hygiene.
