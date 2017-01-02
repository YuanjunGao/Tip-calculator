<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Calculator App Prework</title>
    <style>
    h1{
      color:#337ab7;
      text-align: center;

    }

    a {
      text-decoration: none;
      color:black;
      font-weight: bold;
    }

    body{
      background-color: #E7F6E1;
    }

    p.left{
      text-align: left;
      margin:20px 0 5px 50px;
    }

    div.form_container{
      background-color:#f2a779;
      text-align:center;
      margin:auto;
      padding:30px auto;
      width:400px;
      height:450px;
      border-radius: 5px;
    }
    form{
      padding:30px 30px 0 30px;
    }
    span.important{
      font-size: 20px;
      font-weight: bold;
    }

    span.danger{
      color:red;
      padding: 10px;
      border: 3px solid black;
    }

    .formSubmit{
      font-weight: bold;
      background-color:#4CAF50;
      color:white;
      font-size: 16px;
      margin: 20px 2px 0 2px;
      cursor: pointer;
      padding: 5px 10px;
      border-radius: 60%;
    }

    .small{
      font-size:12px;
    }

    .result{
      border: 3px solid black;
      width:60%;
      background-color:yellow;
      margin:30px auto 30px auto;
    }

    label{
      font-size: 0.8rem;
    }
    input{
      border-radius: 5px;
    }
    </style>

  </head>
  <body>
    <h1>Tip Calculator</h1>
    <div class="form_container">
        <form  action="" method="post">
            <label>
              Bill Subtotal: $
              <input type="text" name="subTotal" value="<?= isset($_POST['subTotal']) ? ($_POST['subTotal']) : ''?>">
            </label>
            <p class="left">Tip Percentage:</p>
            <?php
              $buttonValues = array("0.1","0.15","0.2","other");
              $buttonPercents = array("10%","15%","20%","Other");
              for($var = 0; $var < 4; $var++){
                echo "<label><input type='radio' name='percent' value='$buttonValues[$var]'> $buttonPercents[$var]</label>";
              }
            ?>

            <!-- Alternative way to output radios
            <label><input type="radio" name="percent" value="0.1"> 10%</label>
            <label><input type="radio" name="percent" value="0.15"> 15%</label>
            <label><input type="radio" name="percent" value="0.2"> 20%</label>
            <label><input type="radio" name="percent" value="other">Other</label>
            -->

            <br>

            <label class="small">Other Percentage:
              <input type="text" name="otherPercent" value="<?= isset($_POST['otherPercent']) ? $_POST['otherPercent'] : ''?>" placeholder="other percentage">
            </label>
            <br>
            <input class="formSubmit" type="submit" name="formSubmit" value="Calculate">
        </form>


    <?php
//check if subtotal is entered and correct
        if(!isset($_POST["subTotal"]) || $_POST["subTotal"] == ""){
            echo"<p><span class='danger'>Please Enter the subtotal!</span></p>";
            exit();
        }
        else{
            if(is_numeric($_POST["subTotal"]) && $_POST["subTotal"] > 0){ //check if subtotal is a correct number
              $subTotal = $_POST["subTotal"];
            }else{
                echo"<p><span class='danger'>Please Enter correct subtotal!</span></p>";
                exit();
              }
        }
//check if percentage is entered correct
        if(!isset($_POST["percent"])){
            echo"<p><span class='danger'>Please choose the percentage!</span></p>";
            exit();
        }
        else{
            if($_POST["percent"] == "other"){
                $otherPercentage = $_POST["otherPercent"];
                if(is_numeric($otherPercentage) && $otherPercentage > 0){
                    $percentage = $otherPercentage;
                }else{
                  echo"<p><span class='danger'>Please Enter correct other percentage!</span></p>";
                  exit();
                }
            }
            else{
              $percentage = $_POST["percent"];
            }
        }
//calculate the result
        $tip = round($subTotal * $percentage,2,PHP_ROUND_HALF_UP);
        $total = $subTotal + $tip;
        echo "<div class='result'><p><span class='important'>The tip amount:$$tip</span></p>";
        echo "<p><span class='important'>The total amount:$$total</span></p></div>";
    ?>
  </div>
  </body>
</html>
