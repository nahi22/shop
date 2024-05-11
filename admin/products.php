<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>products</title>
    <link rel="stylesheet" href="../styles/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>
  <body>
    <div class="apranq">
      <h1>Ապրանքներ</h1>
      <a class="avel" href="add-product.php">Ավելացնել ապրանք</a>
    </div>

    <div class="value" style="margin-top:20px;">
      <?php  echo "<table style='text-align:center;width:1340px;' >";
      echo "<tr class='all'>
              <th class='th'>Id</th>
              <th class='th'>name</th>
              <th class='th'>image</th>
              <th class='th'>price</th>
              <th class='th'>created_at</th>
              <th class='th'>updeated_at</th>
              <th class='th'>choose</th>
            </tr>";

      require '../config.php';

      $res_sql = "";


        $conn = new mysqli("localhost","root","","test");
        $res_sql = $conn -> query("SELECT * FROM products");

        if($res_sql->num_rows>0){
          while($row = $res_sql->fetch_assoc()){
            $file_name = "..//images/products/". $row['img'];
            // echo $file_name;exit;
            echo '<tr class="all">';
            echo '<td class="styled-td">'.$row['id'].'</td>';
            echo '<td class="styled-td">'.$row['name'].'</td>';
            echo '<td class="styled-td"><img src="'. $row['img'] .'"; style="width:60px; height:60px;"></td>';
            echo '<td class="styled-td">'.$row['price'].'</td>';
            echo '<td class="styled-td">'.$row['created_at'].'</td>';
            echo '<td class="styled-td">'.$row['updated_at'].'</td>';
            echo '<td class="styled-td actions-list"><a class="upd" href="updeat.php?id='.$row['id'].'"><i class="fas fa-pen" style="color:green"></i></a>'.
            '  <form action="delete.php?id='.$row['id'].'" method="post" onsubmit="return confirm(\'Do you really want to delete this product?\');">
            <button class="but2" type="submit"><i class="fas fa-trash" style="color:red"></i></button>
            </form>
            </td>';
            echo '</tr>';
          }
        }
// <a class="delete"  href="delete.php?id='.$row['id'].'">delete</a>

                // class TableRows extends RecursiveIteratorIterator {
                //   function __construct($it) {
                //     parent::__construct($it, self::LEAVES_ONLY);
                //   }
                //
                //   function current() {
                //     return "<td style='text-align:center;width:220px;border:1px solid black;'>" . parent::current(). "</td>";
                //   }
                //
                //   function beginChildren() {
                //     echo "<tr>";
                //   }
                //
                //   function endChildren() {
                //     echo "</tr>" . "\n";
                //   }
                // }
        // set the resulting array to associative
        // $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        // foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        //   // if ($k==img) {
        //   //   $v="../images/products/".$v;
        //   //
        //   // }
        //   echo $v;
        //
        // }
      // } catch(PDOException $e) {
      //   echo "Error: " . $e->getMessage();
      // }
      // $conn = null;
      // echo "</table>";
       ?>
       <!-- echo ".<img src='../../images/products/'.$getcustomerobj->image "/>."; -->
    </div>
  </body>
</html>
