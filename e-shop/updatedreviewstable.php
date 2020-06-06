<?php
include 'dbfunctions.php';


$prodid = $_SESSION["tempproduct"];
$allreviews = getReviews_ofProduct($prodid);

if(sizeof($allreviews) < 1){
    echo'
<textarea id="comment" name="comment" style="width: 499px; height: 108px; resize: none;"></textarea>
<button id ="submit">Submit</button>
<div id="reviewboxnothing" class="box">
                            <div class="box-inner">
                                <h2 id="reviewheading">No reviews for this product yet</h2>
                            </div>
                        </div>';
}else{
echo'
<textarea id="comment" name="comment" style="width: 499px; height: 108px; resize: none;"></textarea>
<button id ="submit">Submit</button>';
foreach($allreviews as $pars){
    $ratingarray = get_user_rating($pars['userID'],$prodid);
    if(sizeof($ratingarray) == 1){
        $rating = $ratingarray[0]['rating'] . '/5';
    }else{ $rating = "Not Rated";}
    echo'
    <div id="mybox" class="box" data-myid=' . $pars['id'] . '>
        <div id="reviewbox" class="box-inner">
            <h2 id="reviewheading">'. $pars['firstname']  . ' says:</h2><h4 class="ratingdiv">Rating: '.$rating.')</h4>
             <p id="reviewpar" class="hellopar" value=' . $pars['id'] . '>'. $pars['review'] .'</p>
             </div>
             </div>
        ';
        if($_SESSION['id'] == $pars['userID']) {
            echo'
            <div id="reviewbuttons" class="myreviewbuttons" data-myid=' . $pars['id'] . '>
            <button id="delbutton" class="helloreview1" value=' . $pars['id']. '>Delete</button>
                 <button id="editbutton" class="helloreview2" value=' . $pars['id']. '>Edit</button></div>';
                 }?><?php echo'
             ';?><?php echo'';}}

unset($_SESSION["tempproduct"]);