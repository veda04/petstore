/*
  -- Queries used in the project across all tables
*/
-- UPDATE
--  updates customer name from `customer` table where id=1
UPDATE 
  customer 
SET 
  custName = 'Rebecca Smith' 
WHERE 
  id = 1;
-- DELETE
-- removes the record with id=2 from `orders` table
DELETE FROM 
  order_item
WHERE 
  id = 2;
-- SELECT *
-- retreives all the records from `product` table
SELECT 
  * 
FROM 
  `product`;
-- SELECT last
-- retreives all the records of column `title` from `category` table
SELECT 
  title 
FROM 
  category;
-- SELECT ALL last
-- retreives all the records including duplicate entries
SELECT 
  ALL title 
FROM 
  category;
-- SELECT DISTINCT
-- retreives distinct `wishlistProduct` records excluding duplicate entries from `customer_wishlist` table
SELECT 
  DISTINCT wishlistProduct 
FROM 
  customer_wishlist;
-- SELECT columname
-- retrieves the records of multiple columns specified from `` table
SELECT 
  id, 
  unitPrice, 
  itemQuantity, 
  totalPrice 
FROM 
  order_item;
--     ROUND & AS
-- retrieves the records from `order_item` table by rounding upto 2 decimal places and naming the column as `Rate Per Piece`
SELECT 
  ROUND(totalPrice / itemQuantity, 2) AS "Rate Per Piece" 
FROM 
  order_item;
-- WHERE (<, >=, <=)
--   <
SELECT 
  * 
FROM 
  `orders` 
WHERE 
  `totalAmount` < 200;
SELECT 
  * 
FROM 
  `orders` 
WHERE 
  `totalAmount` <= 200;
SELECT 
  * 
FROM 
  `orders` 
WHERE 
  `totalAmount` > 200;
SELECT 
  * 
FROM 
  `orders` 
WHERE 
  `totalAmount` >= 200;
--   =
SELECT 
  custName 
FROM 
  `customer` 
WHERE 
  `userName` = "janedoe";
--   <>  
SELECT 
  * 
FROM 
  `product_stock` 
WHERE 
  `newQty` <> 4;
--   AND
SELECT 
  * 
FROM 
  `user` 
WHERE 
  `username` = "sysadmin" 
  AND fkRoleId = "1";
--   OR
SELECT 
  * 
FROM 
  `product` 
WHERE 
  `categoryId` = "10" 
  OR `categoryId` = "5";
--   NOT
SELECT 
  * 
FROM 
  `orders` 
WHERE 
  `orderType` != "RET";
--   BETWEEN 
SELECT 
  * 
FROM 
  `orders` 
WHERE 
  `orderDate` BETWEEN "2023-02-01" 
  AND "2023-02-28";
--   NOT BETWEEN
SELECT 
  * 
FROM 
  `orders` 
WHERE 
  `orderDate` NOT BETWEEN "2023-02-10" 
  AND "2023-02-15";
--   IN
SELECT 
  * 
FROM 
  `product` 
WHERE 
  `categoryId` IN (2, 4, 6, 8, 10);
--   NOT IN
SELECT 
  * 
FROM 
  `product` 
WHERE 
  `categoryId` IN (1, 3, 5);
--   LIKE %, _ , LIKE + AND + OR
SELECT 
  * 
FROM 
  `customer` 
WHERE 
  `custName` LIKE "%reb%";
SELECT 
  * 
FROM 
  `customer` 
WHERE 
  `custName` LIKE "%doe";
SELECT 
  * 
FROM 
  `customer` 
WHERE 
  `custName` LIKE "Reb%";
SELECT 
  * 
FROM 
  `customer` 
WHERE 
  `custName` LIKE "s_p%";
SELECT 
  * 
FROM 
  `customer` 
WHERE 
  `custName` LIKE "j_n%" 
  AND `userName` LIKE "j_n%";


-- FROM HERE ONWARD
SELECT 
  * 
FROM 
  `customer_address` 
WHERE 
  `homeAddress` LIKE "p_e%" 
  OR `officeAddress` LIKE "p_e%";
--   NULL
SELECT 
  * 
FROM 
  `product` 
WHERE 
  `productImg` IS NULL;
-- ORDER BY (SINGLE COLUMN / MULTI COULUMN)
--   DESC
SELECT 
  * 
FROM 
  `orders` 
ORDER BY 
  `orderDate` DESC;
--   ASC
SELECT 
  * 
FROM 
  `orders` 
ORDER BY 
  `totalAmount` ASC;
SELECT 
  * 
FROM 
  `orders` 
ORDER BY 
  `orderDate` DESC, 
  `totalAmount` ASC;
--   LIMIT
SELECT 
  * 
FROM 
  `orders` 
ORDER BY 
  `orderDate` DESC, 
  `totalAmount` ASC 
LIMIT 
  100;
--   OFFSET
SELECT 
  * 
FROM 
  `product` 
LIMIT 
  10 OFFSET 4;
-- ----
-- SELECT (Aggregates)
--   COUNT
SELECT 
  COUNT(*) as "total customer" 
FROM 
  `customer`;
--     -Distinct
SELECT 
  DISTINCT fkProductId as "unique products" 
FROM 
  `order_item`;
--     -Count and sum
SELECT 
  COUNT(fkProductId) as "product", 
  SUM(totalPrice) 
FROM 
  `order_item`;
--   SUM
SELECT 
  SUM(totalAmount) 
FROM 
  `orders`;
--   AVG
SELECT 
  AVG(totalAmount) 
FROM 
  `orders` 
WHERE 
  orderDate BETWEEN "2023-01-01" 
  AND "2023-01-31";
--   MIN
SELECT 
  MIN(totalAmount) 
FROM 
  `product`;
--   MAX
SELECT 
  MAX(productQty) 
FROM 
  `product`;
--   (Combo of min and max)
SELECT 
  MIN(totalPrice), 
  MAX(totalPrice) 
FROM 
  `order_item` 
WHERE 
  orderDate BETWEEN "2023-01-01" 
  AND "2023-01-31";
-- SELECT (Grouping)
--   GROUP BY
SELECT 
  COUNT(fkProductId) as "product", 
  SUM(totalPrice) 
FROM 
  `order_item` 
GROUP BY 
  fkOrderId;
--   HAVING
SELECT 
  * 
from 
  customer_address 
HAVING 
  homeAddress LIKE "%Huddersfield%";
--   ORDER BY
SELECT 
  categoryId, 
  COUNT(*) as "products count" 
from 
  product 
GROUP BY 
  categoryId 
ORDER BY 
  productQty;
-- SUQERIES (with Equality)
SELECT 
  * 
from 
  orders 
WHERE 
  fkCustomerId = (
    SELECT 
      id 
    from 
      customer 
    WHERE 
      id = 2
  );
-- NESTED SUBQUERIES 
--   IN
SELECT 
  * 
from 
  orders 
WHERE 
  fkCustomerId IN (
    SELECT 
      id 
    from 
      customer 
    WHERE 
      userName = (
        SELECT 
          username 
        FROM 
          user 
        WHERE 
          name = 'Veda'
      )
  );
--   ANY
SELECT 
  * 
from 
  product 
WHERE 
  productPrice >= ANY(
    SELECT 
      AVG(totalAmount) 
    FROM 
      orders 
    WHERE 
      orderType = "RET"
  );
--   ALL
SELECT 
  * 
from 
  product 
WHERE 
  productPrice > ALL(
    SELECT 
      AVG(totalAmount) 
    FROM 
      orders 
    WHERE 
      orderType = "ORD"
  );
--   DISTINCT
SELECT 
  DISTINCT A.custName, 
  A.custEmail 
FROM 
  customer AS A, 
  customer AS B 
WHERE 
  A.custName = B.userName;
--   EXISTS
SELECT 
  * 
FROM 
  user_role AS R 
WHERE 
  EXISTS (
    SELECT 
      * 
    FROM 
      user AS U 
    WHERE 
      U.fkRoleId = R.id
  );
-- SELECT from Multiple tables
SELECT 
  c.title, 
  description 
FROM 
  category c, 
  user_role ur 
WHERE 
  c.title = ur.title;
-- Simple Joins
SELECT 
  u.*, 
  ul.title 
FROM 
  `user` u 
  JOIN user_role ul ON u.fkRoleId = ul.id;
-- Alternative JOIN Constructs
--   ON
SELECT 
  ps.*, 
  v.vendorName 
FROM 
  `product_stock` ps 
  JOIN vendor v ON ps.fkVendorId = v.id --   USING
  --   NATURAL JOIN
  -- ----
  -- Simple Join with Condition
SELECT 
  o.orderDate, 
  o.orderType, 
  c.custName 
FROM 
  orders o, 
  customer c 
WHERE 
  o.fkCustomerId = c.id 
  AND totalAmount >= 200;
-- Sorting a Join
SELECT 
  ps.dateOfPruch, 
  p.productName, 
  ps.newQty 
FROM 
  product p, 
  product_stock ps 
WHERE 
  p.id = ps.fkProductId 
ORDER BY 
  ps.dateOfPruch, 
  p.productName;
-- Three Table Join
SELECT 
  ps.dateOfPruch, 
  p.productName, 
  ps.newQty, 
  v.vendorName, 
  v.vendorAddress 
FROM 
  product p, 
  product_stock ps, 
  vendor v 
WHERE 
  p.id = ps.fkProductId 
  AND v.id = ps.fkVendorId 
ORDER BY 
  ps.dateOfPruch, 
  p.productName;
-- Multiple Grouping Columns
SELECT 
  p.productName, 
  COUNT(*) AS "qty_sold" 
FROM 
  order_item o, 
  product p 
WHERE 
  o.fkProductId = p.id 
GROUP BY 
  o.fkProductId 
ORDER BY 
  p.productName;
-- Inner Joins
SELECT 
  c.custName, 
  c.custEmail, 
  ca.homeAddress, 
  ca.officeAddress 
FROM 
  customer c 
  INNER JOIN customer_address ca 
WHERE 
  ca.fkCustomerId = c.id 
ORDER BY 
  c.custName;
-- Outer Joins
-- Left Outer Join
SELECT 
  c.custName, 
  c.custEmail, 
  ca.homeAddress, 
  ca.officeAddress 
FROM 
  customer c 
  LEFT OUTER JOIN customer_address ca ON ca.fkCustomerId = c.id;
-- Right Outer Join
SELECT 
  c.custName, 
  c.custEmail, 
  ca.homeAddress, 
  ca.officeAddress 
FROM 
  customer c 
  RIGHT OUTER JOIN customer_address ca ON ca.fkCustomerId = c.id;
-- Full Outer Join
SELECT 
  c.custName, 
  c.custEmail, 
  ca.homeAddress, 
  ca.officeAddress 
FROM 
  customer c 
  LEFT OUTER JOIN customer_address ca ON ca.fkCustomerId = c.id 
UNION 
SELECT 
  c.custName, 
  c.custEmail, 
  ca.homeAddress, 
  ca.officeAddress 
FROM 
  customer c 
  RIGHT OUTER JOIN customer_address ca ON ca.fkCustomerId = c.id;
