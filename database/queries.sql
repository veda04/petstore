/*
*******************************************************************************
*                                                                             *
*   Document Title: SQL Query Documentation                                   *
*   Authors:        Veda Salkar, Riddhi Tailor, Muhammad Ali                  *
*                                                                             *
*******************************************************************************
*/

## UPDATE
-- Update the customer name for a specific customer with the given ID
UPDATE customer 
SET custName = 'Rebecca Smith' 
WHERE id = 1;

## DELETE
-- Delete an order item with the given ID
DELETE FROM order_item 
WHERE id = 2;

## SELECT *
-- Select all columns from the product table
SELECT * 
FROM product;

-- Select only the title column from the category table
SELECT title 
FROM category;

-- Select all titles from the category table, including duplicates
SELECT ALL title 
FROM category;

-- Select all distinct from product name in the customer_wishlist table
SELECT DISTINCT w.fkproductid, p.productName 
FROM customer_wishlist w 
LEFT JOIN product p
ON w.fkProductId = p.id;

## SELECT columname
-- Select specific columns from the order_item table
SELECT id, unitPrice, itemQuantity, totalPrice 
FROM order_item;

## ROUND & AS
-- Calculate the rate per piece for each order item
SELECT ROUND(totalPrice / itemQuantity, 2) AS "Rate Per Piece" 
FROM order_item;

/*
## WHERE (<, 
    >, 
    >=, 
    <=, 
    =, 
    <>, 
    AND, 
    OR, 
    NOT, 
    BETWEEN, 
    NOT 
    BETWEEN
    IN,
    NOT IN
  )
*/
-- Select all orders with a total amount less than 200
SELECT * 
FROM orders 
WHERE totalAmount < 200;

-- Select all orders with a total amount less than or equal to 200
SELECT * 
FROM orders 
WHERE totalAmount <= 200; 

-- Select all orders with a total amount greater than 200
SELECT * 
FROM orders 
WHERE totalAmount > 200;

-- Select all orders with a total amount greater than or equal to 200
SELECT * 
FROM orders 
WHERE totalAmount >= 200;

-- Select the customer name for a specific customer with the given username
SELECT custName 
FROM customer 
WHERE userName = "janedoe";

-- Select all rows from the product_stock table where the new quantity is not equal to 4
SELECT * 
FROM product_stock 
WHERE newQty <> 4;

-- Select all users with the given username and role ID
SELECT * 
FROM user 
WHERE username = "sysadmin" AND fkRoleId = "1";

-- Select all products with category ID 10 or 5
SELECT * 
FROM product 
WHERE categoryId IN (10, 5);

-- Select all orders that are not returns
SELECT * 
FROM orders 
WHERE orderType != "RET";

-- Select all orders with an order date between the given range
SELECT * 
FROM orders 
WHERE orderDate BETWEEN "2023-02-01" AND "2023-02-28";

-- Select all orders with an order date outside the given range
SELECT * 
FROM orders 
WHERE orderDate NOT BETWEEN "2023-02-10" AND "2023-02-15";

-- Returns all products with category id 2, 4, 6, 8, or 10
SELECT *
FROM product
WHERE categoryId IN (2, 4, 6, 8, 10);

-- Returns all products with category id not 1, 3, or 5
SELECT *
FROM product
WHERE categoryId NOT IN (1, 3, 5);

/*
## LIKE (
  %, _ , LIKE + AND + OR
)
*/
-- Returns all customers with "reb" in their name
SELECT *
FROM customer
WHERE custName LIKE "%reb%";

-- Returns all customers with "doe" at the end of their name
SELECT *
FROM customer
WHERE custName LIKE "%doe";

-- Returns all customers with names starting with "Reb"
SELECT *
FROM customer
WHERE custName LIKE "Reb%";

-- Returns all customers with names starting with "s" followed by any character, followed by "p" followed by any characters
SELECT *
FROM customer
WHERE custName LIKE "s_p%";

-- Returns all customers with names starting with "j" followed by any character, followed by "n" followed by any characters, and whose username also follows that pattern
SELECT *
FROM customer
WHERE custName LIKE "j_n%"
AND userName LIKE "j_n%";

-- Returns all customer addresses with "s_a" in the address or "h_m" in the officeAddress
SELECT *
FROM customer_address
WHERE address LIKE "s_a%"
OR officeAddress LIKE "h_m%";

## NULL
-- Returns all products with null values for productImg
SELECT *
FROM product
WHERE productImg IS NULL;

/* ORDER BY (
    SINGLE COLUMN,
    MULTI COULUMN,
    DESC,
    ASC,
    LIMIT,
    OFFSET
  )
*/
-- Select all columns from the orders table and order them in descending order by orderDate
SELECT *
FROM   `orders`
ORDER  BY `orderdate` DESC;

-- Select all columns from the orders table and order them in ascending order by totalAmount
SELECT *
FROM   `orders`
ORDER  BY `totalamount` ASC;

-- Select all columns from the orders table and order them in descending order by orderDate, then in ascending order by totalAmount
SELECT *
FROM   `orders`
ORDER  BY `orderdate` DESC,
`totalamount` ASC;

-- Select all columns from the orders table and order them in descending order by orderDate, then in ascending order by totalAmount, and limit the result set to 20 rows
SELECT *
FROM   `orders`
ORDER  BY `orderdate` DESC,
`totalamount` ASC
LIMIT  20;

-- Select 10 rows from the product table, starting from row number 4
SELECT *
FROM   `product`
LIMIT  10 offset 4;

/*
## SELECT (
    Aggregates,
    COUNT,
    Distinct,
    Count and sum,
    SUM,
    AVG,
    MIN,
    MAX,
    Combo of min and max
  )
*/
-- Count the number of rows in the customer table and alias the result as 'total customer'
SELECT Count(*) AS "total customer"
FROM   `customer`;

-- Select distinct values of fkProductId from the order_item table and alias the result as 'unique products'
SELECT DISTINCT fkproductid AS "unique products"
FROM   `order_item`;

-- Count the number of rows in the order_item table where fkProductId is not null and alias the result as 'product', also sum the totalPrice column
SELECT Count(fkproductid) AS "product",
Sum(totalprice)
FROM   `order_item`;

-- Sum the totalAmount column in the orders table
SELECT Sum(totalamount)
FROM   `orders`;

-- Selects the average total amount of orders placed in January 2023
SELECT Avg(totalamount)
FROM   `orders`
WHERE  orderdate BETWEEN "2023-01-01" AND "2023-01-31";

-- Selects the minimum price among all products
SELECT Min(productprice)
FROM   `product`;

-- Selects the maximum quantity among all products
SELECT Max(productqty)
FROM   `product`;

-- Selects the minimum and maximum total amount of orders placed in January 2023
SELECT Min(totalamount),
Max(totalamount)
FROM   `orders`
WHERE  orderdate BETWEEN "2023-01-01" AND "2023-01-31";

## SELECT (Grouping)
## GROUP BY
-- Counts the number of products and calculates the total price for each order
SELECT Count(fkproductid) AS "product",
Sum(totalprice)
FROM   `order_item`
GROUP  BY fkorderid;

## HAVING
-- Selects all customer addresses that contain the string "Huddersfield"
SELECT *
FROM   customer_address
HAVING address LIKE "%huddersfield%";

## ORDER BY
-- Groups products by category and counts the number of products in each category
SELECT categoryid,
Count(*) AS "products count"
FROM   product
GROUP  BY categoryid
ORDER  BY productqty;

## SUQERIES (with Equality)
-- Selects all orders made by a customer with ID 2
SELECT *
FROM   orders
WHERE  fkcustomerid = (SELECT id
  FROM   customer
  WHERE  id = 2);


## NESTED SUBQUERIES 
## IN
-- Selects all orders made by customers with usernames associated with a user named "Veda"
SELECT *
FROM   orders
WHERE  fkcustomerid IN (SELECT id
  FROM   customer
  WHERE  username IN (SELECT username
    FROM   user
    WHERE  name = 'Veda'));

## ANY
-- Select all products with a price greater than or equal to the average total amount of returned orders
SELECT *
FROM   product
WHERE  productprice >= any (SELECT Avg(totalamount)
  FROM   orders
  WHERE  ordertype = "ret");

## ALL
-- Select all products with a price greater than the maximum average total amount of orders
SELECT *
FROM   product
WHERE  productprice > ALL (SELECT Avg(totalamount)
  FROM   orders
  WHERE  ordertype = "ord");

## DISTINCT
-- Select distinct customer names and email addresses where the customer name is the same as another customer's username
SELECT DISTINCT A.custname,
A.custemail
FROM   customer AS A,
customer AS B
WHERE  A.custname = B.username;

## EXISTS
-- Select all user roles where there exists a user with the same role id
SELECT *
FROM   user_role AS R
WHERE  EXISTS (SELECT *
  FROM   user AS U
  WHERE  U.fkroleid = R.id);

## SELECT from Multiple tables
-- Select the title and description of categories where the title matches a user role's title
SELECT c.title,
description
FROM   category c,
user_role ur
WHERE  c.title = ur.title;

## Simple Joins
-- Select all user information and their corresponding user role titles
SELECT u.*,
ul.title
FROM   `user` u
JOIN user_role ul
ON u.fkroleid = ul.id;

## Alternative JOIN Constructs
## ON
-- Select all product stock information and their corresponding vendor names
SELECT ps.*,
v.vendorname
FROM   `product_stock` ps
JOIN vendor v
ON ps.fkvendorid = v.id;

## USING NATURAL JOIN
## Simple Join with Condition
-- Select the order date, type, and customer name of all orders with a total amount of 200 or more
SELECT o.orderdate,
o.ordertype,
c.custname
FROM   orders o,
customer c
WHERE  o.fkcustomerid = c.id
AND totalamount >= 200;

## Sorting a Join
-- Select the purchase date, product name, and new quantity of all product stock, ordered by purchase date and then by product name
SELECT ps.dateofpruch,
p.productname,
ps.newqty
FROM   product p,
product_stock ps
WHERE  p.id = ps.fkproductid
ORDER  BY ps.dateofpruch,
p.productname; 

## Three Table Join
-- Selects product purchase information along with vendor details and sorts by date and product name
SELECT ps.dateOfPruch, p.productName, ps.newQty, v.vendorName, v.vendorAddress 
FROM product p, product_stock ps, vendor v 
WHERE p.id = ps.fkProductId AND v.id = ps.fkVendorId 
ORDER BY ps.dateOfPruch, p.productName;

## Multiple Grouping Columns
-- Selects the name of each product and the total quantity sold, grouped by product and sorted by product name
SELECT p.productName, COUNT(*) AS "qty_sold"
FROM order_item o, product p 
WHERE o.fkProductId = p.id 
GROUP BY o.fkProductId 
ORDER BY p.productName;

## Inner Joins
-- Selects customer details and their corresponding address details ordered by customer name
SELECT c.custName, c.custEmail, ca.address, ca.title 
FROM customer c 
INNER JOIN customer_address ca 
WHERE ca.fkCustomerId = c.id 
ORDER BY c.custName;

## Outer Joins
## Left Outer Join
-- Selects customer details and their corresponding address details, returning NULL if there is no match, ordered by customer name
SELECT c.custName, c.custEmail, ca.address, ca.title 
FROM customer c 
LEFT OUTER JOIN customer_address ca ON ca.fkCustomerId = c.id;

## Right Outer Join
-- Selects customer details and their corresponding address details, returning NULL if there is no match, ordered by customer name
SELECT c.custName, c.custEmail, ca.address, ca.title 
FROM customer c 
RIGHT OUTER JOIN customer_address ca ON ca.fkCustomerId = c.id;

## Full Outer Join
-- Selects customer details and their corresponding address details, returning NULL if there is no match, ordered by customer name
SELECT c.custName, c.custEmail, ca.address, ca.title 
FROM customer c 
LEFT OUTER JOIN customer_address ca ON ca.fkCustomerId = c.id 
UNION 
SELECT c.custName, c.custEmail, ca.address, ca.title 
FROM customer c 
RIGHT OUTER JOIN customer_address ca ON ca.fkCustomerId = c.id;