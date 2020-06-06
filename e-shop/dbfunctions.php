<?php

session_start();

function firstname_from_username($username,$password){
    include "db.php";
    $results=$db->prepare("SELECT firstname FROM users WHERE username = ? AND password = ?");
    $results->bindParam(1, $username);
    $results->bindParam(2, $password);
    $results->execute();
    $result=$results->fetch(PDO::FETCH_ASSOC);
    return $result;

}
function lock_user($userid,$lockstatus){
    include 'db.php';
    try{
        $stmt= $db->prepare('update users set status = ? where id = ?');
        $stmt->bindParam(1, $lockstatus);
        $stmt->bindParam(2, $userid);
        $stmt->execute();

    }

    catch (PDOException $e) {

        echo 'Could not lock user';
    }
}
function find_user_status($userid){
    include "db.php";
    $results=$db->prepare("SELECT status FROM users WHERE id = ?");
    $results->bindParam(1, $userid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function find_user_id_by_username($username){
    include "db.php";
    $results=$db->prepare("SELECT id FROM users WHERE username = ?");
    $results->bindParam(1, $username);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;

}
function admin_exists($username,$password){
    include "db.php";

    $results=$db->prepare("SELECT isadmin FROM users WHERE username = ? AND password = ?");
    $results->bindParam(1, $username);
    $results->bindParam(2, $password);
    $results->execute();
    $result=$results->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function username_email_exists($username,$email){
    include "db.php";

    $results=$db->prepare("SELECT username,email FROM users WHERE username = ? OR email = ?");
    $results->bindParam(1, $username);
    $results->bindParam(2, $email);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}

function user_exists($username,$password){
    include "db.php";

    $results=$db->prepare("SELECT username,password FROM users WHERE username = ? AND password = ?");
    $results->bindParam(1, $username);
    $results->bindParam(2, $password);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function find_session($userid){
    include "db.php";

    $results=$db->prepare("SELECT id FROM users WHERE id = ?");
    $results->bindParam(1, $userid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function username_exists($username){
    include "db.php";

    $results=$db->prepare("SELECT username FROM users WHERE username = ?");
    $results->bindParam(1, $username);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function email_exists($email){
    include "db.php";

    $results=$db->prepare("SELECT email FROM users WHERE email = ?");
    $results->bindParam(1, $email);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function prod_title_image_exists($title,$image){
    include "db.php";

    $results=$db->prepare("SELECT title,image FROM products WHERE title = ? OR image = ?");
    $results->bindParam(1, $title);
    $results->bindParam(2, $image);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;


}
function getUsers(){

    include "db.php";

    $results=$db->query("select * from users");
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;

}
function get_prod_info_from_id($prodid){
    include 'db.php';
    $results=$db->prepare("SELECT price,title,image,description FROM products WHERE id =?");
    $results->bindValue(1, $prodid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function get_user_history_by_id($userid){
    include 'db.php';
    $results=$db->prepare("SELECT Title,Image,Price,DateAdded FROM History WHERE CustID =?");
    $results->bindValue(1, $userid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function getUserByUsername($search){
    include "db.php";
    $results=$db->prepare("SELECT firstname, lastname FROM users WHERE username = ?");
    $results->bindValue(1, $search);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function getUsernameByid($id){
    include "db.php";
    $results=$db->prepare("SELECT username FROM users WHERE id = ?");
    $results->bindValue(1, $id);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function getProduct_Views(){
    include "db.php";
    $results=$db->query("SELECT id, ProductID, ViewCount FROM ProductViewReport WHERE ROWNUM <= 5 ORDER BY ViewCount ASC");
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function getProducts(){

    include "db.php";

    $results=$db->query("select * from products");
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;

}

function registerUser($firstname, $lastname, $email, $username, $password){
    include "db.php";

        try {
            $results = $db->prepare("insert into users (firstname, lastname, email, username, password) values(?,?,?,?,?)");


            $results->bindValue(1, $firstname);
            $results->bindValue(2, $lastname);
            $results->bindValue(3, $email);
            $results->bindValue(4, $username);
            $results->bindValue(5, $password);

            $results->execute();


            return "User created";
        } catch (Exception $e) {
            return "Error creating user" . $e;
        }
}
function insertUser($firstname, $lastname, $email, $username, $password, $isadmin){
    include "db.php";

    try {
        $results = $db->prepare("insert into users (firstname, lastname, email, username, password, isadmin) values(?,?,?,?,?,?)");


        $results->bindValue(1, $firstname);
        $results->bindValue(2, $lastname);
        $results->bindValue(3, $email);
        $results->bindValue(4, $username);
        $results->bindValue(5, $password);
        $results->bindValue(6, $isadmin);
        $results->execute();


        return "User created";
    } catch (Exception $e) {
        return "Error creating user" . $e;
    }
}
function insertProduct($price, $title, $image, $description, $categories_id){
    include "db.php";

    try {
        $results = $db->prepare("insert into products (price, title, image, description, categories_id) values(?,?,?,?,?)");


        $results->bindValue(1, $price);
        $results->bindValue(2, $title);
        $results->bindValue(3, $image);
        $results->bindValue(4, $description);
        $results->bindValue(5, $categories_id);
        $results->execute();


        return "Product added";
    } catch (Exception $e) {
        return "Error adding product user" . $e;
    }
}

function addCart($CustID, $ProdID){
    include "db.php";

    try {
        $results = $db->prepare("insert into ShoppingCarts (CustID, ProdID) values(?,?)");


        $results->bindValue(1, $CustID);
        $results->bindValue(2, $ProdID);
        $results->execute();


        return "Product added to cart";
    } catch (Exception $e) {
        return "Error adding product to cart" . $e;
    }
}
function addReview($userID, $ProdID, $Review, $fname){
    include "db.php";

    try {
        $results = $db->prepare("insert into reviews (productID, userID, review, firstname) values(?,?,?,?)");


        $results->bindValue(1, $ProdID);
        $results->bindValue(2, $userID);
        $results->bindValue(3, $Review);
        $results->bindValue(4, $fname);
        $results->execute();


        return "Product added to cart";
    } catch (Exception $e) {
        return "Error adding product to cart" . $e;
    }
}

function searchProduct($search){
    include "db.php";
    $search='%'.$search.'%';
    $results=$db->prepare("SELECT * from products WHERE description LIKE ? OR title LIKE ? OR price LIKE ?");
    $results->bindValue(1, $search);
    $results->bindValue(2, $search);
    $results->bindValue(3, $search);

    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function getCategories(){
    include "db.php";

    $results=$db->query("select * from categories");
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;

}
function getTop_ViewProduct(){
    include "db.php";

    $results=$db->query("select ProductID from ProductViewReport order by ViewCount DESC");
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function getTop_BoughtProduct(){
    include "db.php";

    $results=$db->query("select ProductID from ProductBoughtReport order by BoughtCount DESC");
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function getReviews_ofProduct($productID){
    include "db.php";

    $results=$db->prepare("SELECT * FROM reviews WHERE productID = ?");
    $results->bindValue(1, $productID);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function get_user_rating($userid,$prodid){
    include "db.php";

    $results=$db->prepare("SELECT rating FROM products_ratings WHERE product = ? AND user_vote_id = ?");
    $results->bindValue(1, $prodid);
    $results->bindValue(2, $userid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function getProductsByCategory($search){
    include "db.php";
    $results=$db->prepare("SELECT * FROM products WHERE categories_id = ?");
    $results->bindValue(1, $search);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function getCategoryName($search){
    include "db.php";
    $results=$db->prepare("SELECT name FROM categories WHERE id = ?");
    $results->bindValue(1, $search);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray[0]["name"];
}
function delete_review($reviewid){
    include 'db.php';
    try {
        $stmt = $db->prepare('DELETE FROM reviews WHERE id=?');
        $stmt->bindParam(1, $reviewid);
        $stmt->execute();


    } catch (PDOException $e) {
        echo "Could not delete review" . $e;
    }
}
function get_number_votes($prodid){
    include "db.php";
    $results=$db->prepare("SELECT id FROM products_ratings WHERE product = ?");
    $results->bindValue(1, $prodid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function delete_user($userid) {
    include 'db.php';
    try {
        $stmt = $db->prepare('DELETE FROM users WHERE id=?');
        $stmt->bindParam(1, $userid);
        $stmt->execute();


    } catch (PDOException $e) {
        echo "Could not delete user" . $e;
    }
}
function find_orderID_of_cart_product_duplicates($userid,$prodid){
    include 'db.php';
    $results=$db->prepare("SELECT orderID FROM ShoppingCarts WHERE CustID = ? AND ProdID = ?");
    $results->bindParam(1, $userid);
    $results->bindParam(2, $prodid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function remove_orderID($orderID){
    include 'db.php';
    try {
        $stmt = $db->prepare('DELETE FROM ShoppingCarts WHERE orderID=?');
        $stmt->bindParam(1, $orderID);
        $stmt->execute();

    } catch (PDOException $e) {
        echo "Could not delete product" . $e;
    }
}
function update_password_by_id($password,$userid){
    include 'db.php';
    try{
        $stmt= $db->prepare('update users set password = ? where id = ?');
        $stmt->bindParam(1, $password);
        $stmt->bindParam(2, $userid);
        $stmt->execute();

    }

    catch (PDOException $e) {

        echo 'Could not update password' .$e;
    }
}

function remove_orderID_by_ProductID_and_UserID($userid,$prodid) {
    include 'db.php';
    try {
        $stmt = $db->prepare('DELETE FROM ShoppingCarts WHERE CustID=? AND ProdID=?');
        $stmt->bindParam(1, $userid);
        $stmt->bindParam(2, $prodid);
        $stmt->execute();


    } catch (PDOException $e) {
        echo "Could not delete product" . $e;
    }
}
function delete_prod($prodid) {
    include 'db.php';
    try {
        $stmt = $db->prepare('DELETE FROM products WHERE id=?');
        $stmt->bindParam(1, $prodid);
        $stmt->execute();
        return "Success";

    } catch (PDOException $e) {
        return "Could not delete product";
    }
}
function find_admin_by_id($userid){
    include 'db.php';
    $results=$db->prepare("SELECT isadmin FROM users WHERE id = ?");
    $results->bindParam(1, $userid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;

}
function give_admin($userid){
    include 'db.php';
    try{
        $stmt= $db->prepare('update users set isadmin = 1 where id = ?');
        $stmt->bindParam(1, $userid);
        $stmt->execute();

}

catch (PDOException $e) {

echo 'Could not update to admin' .$e;
  }

}
function revoke_admin($userid){
    include 'db.php';
    try{
        $stmt= $db->prepare('update users set isadmin = 0 where id = ?');
        $stmt->bindParam(1, $userid);
        $stmt->execute();

    }

    catch (PDOException $e) {

        echo 'Could not remove admin' .$e;
    }

}
function find_prodname_by_id($prodid){
    include 'db.php';
    $results=$db->prepare("SELECT name FROM categories WHERE id = ?");
    $results->bindParam(1, $prodid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function rating_exists($rating){
    include 'db.php';
    $results=$db->prepare("SELECT id FROM products WHERE id = ?");
    $results->bindParam(1, $rating);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function accept_rating($product,$rating,$useridvote){
    include "db.php";

    try {
        $results = $db->prepare("insert into products_ratings (product, rating,user_vote_id) values(?,?,?)");


        $results->bindValue(1, $product);
        $results->bindValue(2, $rating);
        $results->bindValue(3, $useridvote);
        $results->execute();


        return "Rating added";
    } catch (Exception $e) {
        return "Error adding rating" . $e;
    }
}
function insert_delivery($userid,$prodid){
    include "db.php";

    try {
        $results = $db->prepare("insert into Deliveries (CustID, ProdID) values(?,?)");

        $results->bindValue(1, $userid);
        $results->bindValue(2, $prodid);

        $results->execute();

        return "Product added";
    } catch (Exception $e) {
        return "Error adding rating" . $e;
    }
}
function insert_history($userid,$prodtitle,$prodimage,$prodprice){
    include "db.php";

    try {
        $results = $db->prepare("insert into History (CustID, Title, Image, Price) values(?,?,?,?)");

        $results->bindValue(1, $userid);
        $results->bindValue(2, $prodtitle);
        $results->bindValue(3, $prodimage);
        $results->bindValue(4, $prodprice);

        $results->execute();

        return "Product added";
    } catch (Exception $e) {
        return "Error adding rating" . $e;
    }
}
function productViewReport_exists($prodid){
    include "db.php";
    $results=$db->prepare("SELECT ProductID FROM ProductViewReport WHERE ProductID = ?");
    $results->bindParam(1, $prodid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;

}
function add_ProductViewCount($prodid,$ViewCount){
    include "db.php";
    try {
    $results = $db->prepare("insert into ProductViewReport (ProductID, ViewCount) values(?,?)");
    $results->bindValue(1, $prodid);
    $results->bindValue(2, $ViewCount);
    $results->execute();

    return "Product added";
    } catch (Exception $e) {
    return "Error adding product to table" . $e;
    }
}
function update_ViewCount($prodid){
    include 'db.php';
    try {
        $stmt = $db->prepare('update ProductViewReport set ViewCount = ViewCount + 1 where ProductID = ?');
        $stmt->bindParam(1, $prodid);
        $stmt->execute();
    }catch (PDOException $e) {

        echo 'Could not update ViewCount' .$e;
    }
    }
function add_ProductBoughtCount($prodid,$BoughtCount){
    include "db.php";
    try {
        $results = $db->prepare("insert into ProductBoughtReport (ProductID,BoughtCount) values(?,?)");
        $results->bindValue(1, $prodid);
        $results->bindValue(2, $BoughtCount);

        $results->execute();

        return "Product added";
    } catch (Exception $e) {
        return "Error adding product to table" . $e;
    }
}
function update_BoughtCount($prodid){
    include 'db.php';
    try {
        $stmt = $db->prepare('update ProductBoughtReport set BoughtCount = BoughtCount + 1 where ProductID = ?');
        $stmt->bindParam(1, $prodid);
        $stmt->execute();
    }catch (PDOException $e) {

        echo 'Could not update BoughtCount' .$e;
    }
}
function productBoughtReport_exists($prodid){
    include "db.php";
    $results=$db->prepare("SELECT ProductID FROM ProductBoughtReport WHERE ProductID = ?");
    $results->bindParam(1, $prodid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;

}
function find_rating_avg_of_product($prodid){
    include 'db.php';
    $results=$db->prepare("SELECT AVG(rating)  AS rating_average
    FROM products p
    LEFT JOIN products_ratings pr ON pr.product = p.id
    WHERE p.id = ?");

    $results->bindParam(1, $prodid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function getFeatured(){
    include 'db.php';
    $results=$db->query("select * from FeaturedPanel ORDER BY id ASC");
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;

}
function getProductInfo_by_id($prodid){
    include 'db.php';
    $results=$db->prepare("SELECT id,price,title,image FROM products WHERE id = ?");
    $results->bindParam(1, $prodid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function getProductInfo_from_CartUserID($userid){
    include "db.php";
    $results=$db->prepare("SELECT id,price,title,description,image
    FROM products p
    LEFT JOIN ShoppingCarts sc ON sc.ProdID = p.id
    WHERE sc.CustID = ?");

    $results->bindParam(1, $userid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function Featured_Exists($prodid){
    include 'db.php';
    $results=$db->prepare("SELECT ProductID FROM FeaturedPanel WHERE ProductID = ?");
    $results->bindParam(1, $prodid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function getProductInfo_andViews(){
    include "db.php";
    $results=$db->query("SELECT p.title,sc.id,sc.ProductID,sc.ViewCount,p.image
    FROM products p
    INNER JOIN ProductViewReport sc ON sc.ProductID = p.id ORDER BY sc.ViewCount DESC");

    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function getProductInfo_andBought(){
    include "db.php";
    $results=$db->query("SELECT p.title,sc.id,sc.ProductID,sc.BoughtCount,p.image
    FROM products p
    INNER JOIN ProductBoughtReport sc ON sc.ProductID = p.id ORDER BY sc.BoughtCount DESC");

    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function getProductInfo_andDeliveries($userid){

        include "db.php";
        $results=$db->prepare("SELECT sc.DeliveryID,p.title,p.image,sc.DateAdded
    FROM products p
    LEFT JOIN Deliveries sc ON sc.ProdID = p.id
    WHERE sc.CustID = ? ORDER BY sc.DateAdded");

        $results->bindParam(1, $userid);
        $results->execute();
        $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
        return $resultsArray;

}
function find_product_and_userid($productid,$uservoteid)
{
    include 'db.php';
    $results=$db->prepare("SELECT product,user_vote_id
                                  FROM products_ratings WHERE  product = ? AND user_vote_id = ?");
    $results->bindValue(1, $productid);
    $results->bindValue(2, $uservoteid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function deliveries_find_product_and_userid($productid,$userid)
{
    include 'db.php';
    $results=$db->prepare("SELECT CustID,ProdID
                                  FROM Deliveries WHERE  CustID = ? AND ProdID = ?");
    $results->bindValue(1, $userid);
    $results->bindValue(2, $productid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);
    return $resultsArray;
}
function getUserInfo_by_id($userid){
    include "db.php";
    $results=$db->prepare("SELECT username, firstname, lastname, email FROM users WHERE id = ?");
    $results->bindValue(1, $userid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function get_product_id_by_title($prodtitle){
    include "db.php";
    $results=$db->prepare("SELECT id FROM products WHERE title = ?");
    $results->bindValue(1, $prodtitle);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function update_user_lastactivity($userid, $LastActivity){
    include "db.php";
    try {
        $results=$db->prepare('UPDATE users SET LastActivity = ? WHERE id = ?');
        $results->bindValue(1, $LastActivity);
        $results->bindValue(2, $userid);

        $results->execute();
        if ($results->rowCount() > 0 )
            return "LastActivity updated";
        else
            return "LastActivity not updated ";
    } catch (PDOException $e) {
        //this works only if: db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION)
        return "Error Updating LastActivity";
    }
}
function get_user_lastactivity($userid){
    include "db.php";
    $results=$db->prepare("SELECT LastActivity FROM users WHERE id = ?");
    $results->bindValue(1, $userid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function update_user_status($userid,$status){
    include "db.php";
    try {
        $results=$db->prepare('UPDATE users SET  Status = ? WHERE id = ?');
        $results->bindValue(1, $status);
        $results->bindValue(2, $userid);

        $results->execute();
        if ($results->rowCount() > 0 )
            return "Status updated";
        else
            return "Status not updated ";
    } catch (PDOException $e) {
        //this works only if: db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION)
        return "Error Updating Status";
    }
}
function verify_review_user($reviewid,$productid,$userid){
    include "db.php";
    $results=$db->prepare("SELECT id,productID,userID FROM reviews WHERE id = ? AND productID = ? AND userID = ?");
    $results->bindValue(1, $reviewid);
    $results->bindValue(2, $productid);
    $results->bindValue(3, $userid);
    $results->execute();
    $resultsArray=$results->fetchAll(PDO::FETCH_ASSOC);

    return $resultsArray;
}
function updateProduct($prodprice,$prodtitle,$proddescription,$prodid) {
    include "db.php";
    try {
        $results=$db->prepare('UPDATE products SET `price` = ? , title = ?, description = ? WHERE id = ?');
        $results->bindValue(1, $prodprice);
        $results->bindValue(2, $prodtitle);
        $results->bindValue(3, $proddescription);
        $results->bindValue(4, $prodid);

        $results->execute();
        if ($results->rowCount() > 0 )
            return "Product updated";
        else
            return "Product not updated " . $prodid;
    } catch (PDOException $e) {
        //this works only if: db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION)
        return "Error Updating Product: " . $e;
    }
}
function updateUser($username,$firstname,$lastname,$email,$userid) {
    include "db.php";
    try {
        $results=$db->prepare('UPDATE users SET username = ?, firstname = ?, lastname = ?, email = ? WHERE id = ?');
        $results->bindValue(1, $username);
        $results->bindValue(2, $firstname);
        $results->bindValue(3, $lastname);
        $results->bindValue(4, $email);
        $results->bindValue(5, $userid);

        $results->execute();
        if ($results->rowCount() > 0 )
            return "User updated";
        else
            return "User not updated " . $userid;
    } catch (PDOException $e) {
        //this works only if: db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION)
        return "Error Updating Product: " . $e;
    }
}
function updateReview($review,$reviewid){
    include "db.php";
    try {
        $results=$db->prepare('UPDATE reviews SET review = ? WHERE id = ?');
        $results->bindValue(1, $review);
        $results->bindValue(2, $reviewid);
        $results->execute();
        if ($results->rowCount() > 0 )
            return "Review updated";
        else
            return "Review not updated " . $reviewid;
    } catch (PDOException $e) {
        //this works only if: db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION)
        return "Error Updating Review: " . $e;
    }
}
function updateFeatured($prodid,$rowid){
    include "db.php";
    try {
        $results=$db->prepare('UPDATE FeaturedPanel SET ProductID = ? WHERE SlotId = ?');
        $results->bindValue(1, $prodid);
        $results->bindValue(2, $rowid);
        $results->execute();
        if ($results->rowCount() > 0 )
            return "Featured updated";
        else
            return "Featured not updated " . $prodid;
    } catch (PDOException $e) {
        //this works only if: db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION)
        return "Error Updating Review: " . $e;
    }
}