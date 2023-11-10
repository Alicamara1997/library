<?php
include "header.php";

$authors=getAllRows("author");

var_dump($authors);
?>
<form  action="savebook.php" method="post">
    <div>
      <label for="title">Title :</label>
      <input type="text"  id="name"  name="book_title">
    </div> 
    <div>
      <label  for="description">Description :</label>
      <textarea  id="message"  name="book_description"></textarea>
    </div>
    <div>
      <label  for="author">Author :</label>
      <select name="book_author" id="pet-select">
        <option value="">--Please choose an option--</option>
<?php  
      foreach ( $authors as $author   ){
?>
         <option value=<?=$author['id']?>><?=$author['name']?></option>

<?php
      }
?>
     </select>
    </div>
    <div  class="button">
      <button  type="submit">Send</button>
    </div>
  </form>