/*
	-- Queries used in the project across all tables
*/

-- UPDATE
--  updates customer name from `customer` table where id=1
UPDATE customer
SET custName = 'Samrudhi Usapkar'
WHERE id = 1;

-- DELETE
-- removes the record with id=2 from `orders` table
DELETE FROM orders
WHERE id = 2;

-- SELECT *
-- retreives all the records from `product` table
SELECT * FROM `product`;

-- SELECT last
-- retreives all the records of column `title` from `category` table
SELECT title FROM category;

-- SELECT ALL last
-- retreives all the records including duplicate entries
SELECT ALL title FROM category;

-- SELECT DISTINCT
-- retreives distinct `wishlistProduct` records excluding duplicate entries from `customer_wishlist` table
SELECT DISTINCT wishlistProduct FROM customer_wishlist;

-- SELECT columname
-- retrieves the records of multiple columns specified from `` table
SELECT 	id, unitPrice, itemQuantity, totalPrice
FROM order_item;

-- 		ROUND & AS
-- retrieves the records from `order_item` table by rounding upto 2 decimal places and naming the column as `Rate Per Piece`
SELECT  ROUND(totalPrice/itemQuantity, 2) AS
"Rate Per Piece"
FROM order_item;

-- WHERE (<, >=, <=)
-- 	<
SELECT * FROM `orders` WHERE `totalAmount` < 200;
SELECT * FROM `orders` WHERE `totalAmount` <= 200;
SELECT * FROM `orders` WHERE `totalAmount` > 200;
SELECT * FROM `orders` WHERE `totalAmount` >= 200;
-- 	=
SELECT custName FROM `customer` WHERE `userName` = "SAMRU";
-- 	<>	
SELECT * FROM `product_stock` WHERE `newQty` <> 4;
-- 	AND
SELECT * FROM `user` WHERE `newQty`="sysadmin" AND fkRoleId = "1" ;
-- 	OR
SELECT * FROM `product` WHERE `categoryId`="10" OR `categoryId` = "5" ;
-- 	NOT
SELECT * FROM `orders` WHERE `orderType`!="RET";
-- 	BETWEEN 
SELECT * FROM `orders` WHERE `orderDate` BETWEEN "2023-02-01" AND "2023-02-28";
-- 	NOT BETWEEN
SELECT * FROM `orders` WHERE `orderDate` NOT BETWEEN "2023-02-10" AND "2023-02-15";
-- 	IN
SELECT * FROM `product` WHERE `categoryId` IN (2,4,6,8,10);
-- 	NOT IN
SELECT * FROM `product` WHERE `categoryId` IN (1,3,5);
-- 	LIKE %, _ , LIKE + AND + OR
SELECT * FROM `customer` WHERE `custName` LIKE "%sam%";
SELECT * FROM `customer` WHERE `custName` LIKE "%sam";
SELECT * FROM `customer` WHERE `custName` LIKE "sam%";
SELECT * FROM `customer` WHERE `custName` LIKE "s_m%";
SELECT * FROM `customer` WHERE `custName` LIKE "s_m%" AND `userName` LIKE "s_m%";
SELECT * FROM `customer_address` WHERE `homeAddress` LIKE "s_m%" OR `officeAddress` LIKE "s_m%";

-- 	NULL
SELECT * FROM `product` WHERE `productImg` IS NULL;

-- ORDER BY (SINGLE COLUMN / MULTI COULUMN)
-- 	DESC
SELECT * FROM `orders` ORDER BY `orderDate` DESC;
-- 	ASC
SELECT * FROM `orders` ORDER BY `totalAmount` ASC;

SELECT * FROM `orders` ORDER BY `orderDate` DESC, `totalAmount` ASC;
-- 	LIMIT
SELECT * FROM `orders` ORDER BY `orderDate` DESC, `totalAmount` ASC LIMIT 100;
-- 	OFFSET
SELECT * FROM `product` LIMIT 10 OFFSET 4;
-- ----

-- SELECT (Aggregates)
-- 	COUNT
SELECT COUNT(*) as "total customer" FROM `customer`;

-- 		-Distinct
SELECT DISTINCT fkProductId as "unique products" FROM `order_item`;
-- 		-Count and sum
SELECT COUNT(fkProductId) as "product", SUM(totalPrice) FROM `order_item`;

-- 	SUM
SELECT SUM(totalAmount) FROM `orders`;
-- 	AVG
SELECT AVG(totalAmount) FROM `orders` WHERE orderDate BETWEEN "2023-01-01" AND "2023-01-31";
-- 	MIN
SELECT MIN(totalAmount) FROM `product`;
-- 	MAX
SELECT MAX(productQty) FROM `product`;
-- 	(Combo of min and max)
SELECT MIN(totalPrice), MAX(totalPrice) FROM `order_item` WHERE orderDate BETWEEN "2023-01-01" AND "2023-01-31";

-- SELECT (Grouping)
-- 	GROUP BY
SELECT COUNT(fkProductId) as "product", SUM(totalPrice) FROM `order_item` GROUP BY fkOrderId;
-- 	HAVING
SELECT * from customer_address HAVING homeAddress LIKE "%Huddersfield%";
-- 	ORDER BY
SELECT categoryId, COUNT(*) as "products count" from product GROUP BY categoryId ORDER BY productQty;

-- SUQERIES (with Equality)
-- NESTED SUBQUERIES 
-- 	IN
-- 	ANY
-- 	ALL
-- 	DISTINCT
-- 	EXISTS
-- SELECT from Multiple tables

-- Simple Joins
-- Alternative JOIN Constructs
-- 	ON
-- 	USING
-- 	NATURAL JOIN
-- ----
-- Simple Join with Condition
-- Sorting a Join
-- Three Table Join
-- Multiple Grouping Columns
-- Inner Joins
-- Outer Joins
-- Left Outer Join
-- Right Outer Join
-- Full Outer Join
-- Full Outer Join