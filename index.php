<?php require "config.php"?>

<?php  
    if(isset($_POST['upload'])){
       $name = $_FILES['file']['name'];
       $tmpname = $_FILES['file']['tmp_name'];
       $size = $_FILES['file']['size'];
       $type = $_FILES['file']['type'];
       $ext = pathinfo($name, PATHINFO_EXTENSION);

       $fname = pathinfo($name, PATHINFO_FILENAME);
       $pname = preg_replace("/\s+/","_",$fname);
       $finalname = $fname."_".date("mjYHis").".".$ext;

       if(!empty($name)){
           if($size <= 2000000){
               if($ext == "docx" || $ext == "pptx" || $ext == "csv"|| $ext == "xlsx" || $ext == "pdf" || $ext == "txt"){
                
                $final_file = "files/".$finalname;
               
                if($final_file){ 
                    $msg = "Successfully Uploaded"; 
                   
                    $query = "INSERT INTO `filestore` (`name`,`path`,`date`) VALUES ('$name', '$final_file', CURDATE())";
                    $fire = mysqli_query ($con, $query);
                    $upload = move_uploaded_file($tmpname, $final_file);

                    if($upload && $fire){
                        echo $msg;
                    }
                }

               }else{
                   echo "File is not allowed";
               }
           }else{
               echo "File size must be less than 2 mb";
           }
       }else{
           echo "Please choose a file";
       }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
        body{
            /*background-color: #272727;*/
        }
        .customBtn {
        padding: 10px;
        color: white;
        background-color: #FFA233;
        border: 0px solid #000;
        border-radius: 5px;
        cursor: pointer;
        outline: none;
        }

        .customBtn:hover {
        background-color: #FF8A33;
        }

        #customTxt {
        margin-left: 10px;
        font-family: sans-serif;
        color: #aaa;
        }

        .box{
           position: absolute;
           top: 50%;
           left: 50%;
           transform: translate(-50%,-50%); 
        }
        .container{
            text-align: center;
        }
        h2{
            color: #fff;
        }
        .marginTop{
            margin-Top: 10px;
        }
        

    </style>
</head>
<body>
    <div class="container">
        <h2 class="">File Upload System</h2>

     <div class="box">
     <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
        
        <input name="file" type="file" id="realFile" hidden="hidden"/>
        <Button name="" type="button" id="customBtn" class="customBtn">Choose File</Button>
        <span id="customTxt">No File Chosen</span>
        <div class="upbtn">
        <input value="Upload" type="submit" name="upload" class="customBtn marginTop">
        </div>

    </form>
     </div>
    </div>

    <script>
        const realfile = document.getElementById("realFile");
        const custombtn = document.getElementById("customBtn");
        const customtxt = document.getElementById("customTxt");

        custombtn.addEventListener("click", function(){
            realfile.click();
        });

        realfile.addEventListener("change", function(){
            if(realfile.value){
                customtxt.innerHTML = realfile.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            }else{
                customtxt.innerHTML = "No File Chosen...";
            }
        });
    </script>
</body>
</html>