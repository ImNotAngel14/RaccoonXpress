CREATE VIEW `shopping_cart_view` AS
	SELECT 
    	sc.`shoppingCart_id`, 
        p.`product_name`, 
        sc.`quantity`,
        p.`product_id`
        p.`product_price`, 
        p.`product_image1`,
        sc.`user_id` 
    FROM `shopping_cart` sc
    INNER JOIN `products` p
    ON sc.`product_id`= p.`product_id`