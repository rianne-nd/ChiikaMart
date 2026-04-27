![][image1]

# **Chiikawa-Themed Online Shop**

# **🌸 1\. The User Side (The "Adoption" Center)**

| Feature | Description | Approved |
| :---- | :---- | :---- |
| **Plushie Catalog** | **The Catalog:** A grid of all available plushies with their image, price, and name. **Filters:** Users can filter by **Character** (Chiikawa, Hachiware, Usagi, Momonga) or **Size** (Keychain, Small, Medium, Jumbo). **Collections Tag:** Special tags for limited editions like "Pajama Party," "Restaurant Theme," or "Halloween." | \[ \] \[ \] \[ \] |
| **The Cart** | Standard shopping cart functionality: users can add items, adjust quantity, and view the total price before checkout. | \[ \] |
| **User Accounts & Order History** | Login/registration.  **My Profile**: Users can update their display name, email, and save a default shipping address so they don't have to type it every time. Users can view past "adoptions" and check the status of current orders: "Processing," "Shipped," or "Delivered." | \[ \] \[ \] \[ \] |
| **Wishlist (Favorites)** | A simple heart-icon feature allowing users to save plushies they wish to "adopt" later. | \[ \] |
| **Shopping & Checkout:** | **Adoption Cart:** Add to cart, change quantities (e.g., "I want *two* Usagi keychains\!"), and a running total price. **Stock Checking:** If a plushie only has 2 left in stock, the cart won't let the user try to buy 3\. *(Teachers love this logic\!)* **Checkout:** A simple form to confirm the order and address (simulating "Cash on Delivery" to keep your code simple). | \[ \] \[ \] \[ \] |
| **Star Ratings & Reviews** | Users can submit a 1-5 star rating and a textual review for adopted plushies (e.g., "He is so soft and squishy\! 5/5"). | \[ \] |
| **Featured list** | **The Spotlight Carousel**: When a user lands on index.php, the very first thing they see is a sliding carousel or a highlighted grid of the featured items. **Smart Querying**: Your PHP code will just ask the database: "Hey, grab me the 5 products where is\_featured \= 1." If the Admin turns them all off, the section just gracefully hides itself. | \[ \] \[ \]  |

#  **2\. The Admin Dashboard** 

This section demonstrates key business and inventory management capabilities essential for an e-commerce platform.

| Feature | Description | Approved |
| :---- | :---- | :---- |
| **Store Overview (Analytics)** | **At-a-Glance Stats:** Total Sales Revenue, Total Number of Orders, and Total Registered Users. **Low Stock Alerts:** A warning box that automatically lists any plushies where the stock quantity has dropped below 5\. | \[ \] \[ \]  |
| **Inventory Management (CRUD)** | **Add/Edit Plushies:** Upload new products, set the price, assign the character/collection, and set the starting stock quantity. **Soft Delete** **(Deactivate)**: Instead of deleting a product entirely (which breaks past order histories), the Admin can toggle is\_active \= 0 to hide it from the store. | \[ \] \[ \]  |
| **Order Fulfillment** | **Manage Orders:** The Admin sees a list of all user orders. **Status Updates:** The Admin can click a dropdown to change an order from "Pending" to "Shipped." (This instantly updates what the user sees on their Order History page\!). | \[ \] \[ \]  |
| **Category Management** | **Master Tables:** The Admin can add new Characters or Collections without touching the database code. If a new anime character drops, they just add it via the dashboard. | \[ \] |
| **User Management** | **Review Management:** The Admin can view all product reviews and delete or hide inappropriate ones. **User Management:** View all registered users and deactivate accounts if necessary. | \[ \] \[ \] |
| **Featured list** | **The Toggle Switch:** On the Admin Dashboard, next to every Product or Collection, there is a simple "Feature on Homepage" toggle (On/Off). **Campaign Control:** If the Admin wants to feature the "Pajama Party Collection," they just flip the switch. When the campaign is over, they flip it off, and it instantly disappears from the User homepage. | \[ \] \[ \]  |

**\=======================================================================**


### **Group 1: Users & Access (The Adoption Center)**

tbl\_roles

| Column | Datatype | Note |
| :---- | :---- | :---- |
| **roleID** | **INT (PK, AI)** | 1 \= Admin, 2 \= Customer |
| **roleName** | **VARCHAR(20)** |  |
| **createdAt** | **TIMESTAMP** |  |
| **updatedAt** | **TIMESTAMP** |  |

tbl\_users

| Column | Datatype | Note |
| :---- | :---- | :---- |
| **userID** | **INT (PK, AI)** |  |
| **firstName** | **VARCHAR(50)** |  |
| **lastName** | **VARCHAR(50)** |  |
| **suffix** | **VARCHAR(10)** | Optional |
| **birthday** | **DATE** | Optional |
| **email** | **VARCHAR(100)** | UNIQUE |
| **password** | **VARCHAR(255)** | Hashed for security |
| **phoneNumber** | **VARCHAR(20)** |  |
| **street** | **VARCHAR(150)** |  |

Group 2: The Store Catalog (The Plushies\!)  
This is where the Admin manages inventory, categories, and the "Featured" items.

tbl\_characters

| Column | Datatype | Note |
| :---- | :---- | :---- |
| **characterID** | **INT (PK, AI)** |  |
| **charName** | **VARCHAR(50)** | e.g., "Chiikawa", "Hachiware", "Usagi" |
| **createdAt** | **TIMESTAMP** |  |
| **updatedAt** | **TIMESTAMP** |  |

collections

| Column | Datatype | Note |
| :---- | :---- | :---- |
| **collectionID** | **INT (PK, AI)** |  |
| **collectionName** | **VARCHAR(100)** | e.g., "Pajama Party", "Halloween" |
| **isFeatured** | **TINYINT(1)** | 1 \= Show on homepage (Default: 0\)  |
| **createdAt** | **TIMESTAMP** |  |
| **updatedAt** | **TIMESTAMP** |  |

Products (Main Inventory Table)

| Column | Datatype | Note |
| :---- | :---- | :---- |
| **productID** | **INT (PK, AI)** |  |
| **productName** | **VARCHAR(100)** | e.g., "Jumbo Usagi Cheering Plush" |
| **description** | **TEXT** | "Super soft and full of energy\!" |
| **price** | **DECIMAL(10,2)** | e.g., 1500.00 |
| **stockQuantity** | **INT** | Crucial: Drops when someone buys one\! |
| **characterID** | **INT (FK)** | FK to characters.characterID |
| **collectionID** | **INT (FK)** | FK to collections.collectionID |
| **imageURL** | **VARCHAR(255)** | Path to the cute picture |
| **isFeatured** | **TINYINT(1)** | 1 \= Spotlight this specific plushie |
| **isActive** | **TINYINT(1)** | Soft Delete: 0 \= Hide from store (Default: 1\)  |
| **createdAt** | **TIMESTAMP** |  |
| **updatedAt** | **TIMESTAMP** |  |

Group 3: Shopping Cart & Orders (The Business Logic)  
This is the heart of the e-commerce store. It tracks what people want to buy, and what they actually bought.

cart\_items

| Column | Datatype | Note |
| :---- | :---- | :---- |
| **cartID** | **INT (PK, AI)** |  |
| **userID** | **INT (FK)** | FK to uesrs.userID |
| **productID** | **INT (FK)** | FK to products.productID |
| **quantity** | **INT** | e.g., "I want 2 of these" (Default: 1\)  |
| **createdAt** | **TIMESTAMP** |  |
| **updatedAt** | **TIMESTAMP** |  |

order\_statuses

| Column | Datatype | Note |
| :---- | :---- | :---- |
| **statusID** | **INT (PK, AI)** | 1=Pending, 2=Processing, 3=Shipped |
| **statusName** | **VARCHAR(50)** |  |
| **createdAt** | **TIMESTAMP** |  |
| **updatedAt** | **TIMESTAMP** |  |

orders

| Column | Datatype | Note |
| :---- | :---- | :---- |
| **orderID** | **INT (PK, AI)** |  |
| **userID** | **INT (FK)** | FK to users.userID |
| **totalAmount** | **DECIMAL(10,2)** | The final calculated price |
| **shippingAddress** | **TEXT** | Snapshot: Where it was shipped |
| **statusID** | **INT (FK)** | FK to order\_statuses.statusID |
| **orderDate** | **DATETIME** |  |
| **createdAt** | **TIMESTAMP** |  |
| **updatedAt** | **TIMESTAMP** |  |

order\_items

| Column | Datatype | Note |
| :---- | :---- | :---- |
| **itemID** | **INT (PK, AI)** |  |
| **orderID** | **INT (FK)** | FK to orders.orderID |
| **productID** | **INT (FK)** | FK to products.productID |
| **quantity** | **INT** | How many they bought |
| **priceAtPurchase** | **DECIMAL(10,2)** | Pro Move: If admin changes price later, the past receipt stays accurate\! |
| **createdAt** | **TIMESTAMP** |  |
| **updatedAt** | **TIMESTAMP** |  |

Group 4: Engagement (Wishlists & Reviews)  
The fun social features to make the site feel alive.

wishlists

| Column | Datatype | Note |
| :---- | :---- | :---- |
| **wishlistID** | **INT (PK, AI)** |  |
| **userID** | **INT (FK)** | FK to uesrs.userID |
| **productID** | **INT (FK)** | FK to products.productID |
| **createdAt** | **TIMESTAMP** |  |
| **updatedAt** | **TIMESTAMP** |  |

Reviews

| Column | Datatype | Note |
| :---- | :---- | :---- |
| **reviewID** | **INT (PK, AI)** |  |
| **userID** | **INT (FK)** | FK to uesrs.userID |
| **productID** | **INT (FK)** | FK to products.productID |
| **ratingValue** | **DECIMAL(2,1)** | Allows 4.5 stars\! |
| **reviewText** | **TEXT** | "So squishy\!\!" |
| **isApproved** | **TINYINT(1)** | 1 \= Public. Admin can change to 0 if spam. |
| **createdAt** | **TIMESTAMP** |  |
| **updatedAt** | **TIMESTAMP** |  |

Changes made:

* **Added the `tbl_` Prefix:** Every single table was renamed to start with `tbl_` (e.g., `users` became `tbl_users`, `products` became `tbl_products`).  
* **Updated Foreign Keys:** All the foreign key references were updated to point to the new `tbl_` table names so your relationships don't break.  
* **Set User Defaults:** In `tbl_users`, we explicitly set the default `roleID` to `2` (Customer) and `isActive` to `1` (Active) so new registrations are handled automatically.  
* **Standardized Timestamps:** We made absolutely sure that *every* single table includes the `createdAt` and `updatedAt` tracking columns.  
* **Added Auto-Build Commands:** Added `CREATE DATABASE IF NOT EXISTS chiikamart_db;` and `USE chiikamart_db;` to the top of the SQL script so you can just paste it into HeidiSQL and it will build the whole thing from scratch automatically.  
* **Synced the Plan:** We updated your website plan document so the table names and all the specific address columns (street, barangay, city, etc.) perfectly match your new SQL code.
