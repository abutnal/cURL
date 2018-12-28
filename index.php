<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>cURL</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="jscript.php"></script>
    <style>.title{font-size: 18px;} .panel-heading{padding:4px 0px 4px 12px !important;}</style>
</head>
<body>
    <div class="container">
        <br><br>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                 <div id="message"></div>
                 <div class="panel panel-primary">
                     <div class="panel-heading"><span class="title"><b>CRUD using cURL in PHP</b></span></div>
                     <div class="panel-body">
                       
     <form action="controller.php" method="post" id="saveForm">
         <div class="row">
             <div class="col-md-12">
                <input type="hidden" value="saveform" name="saveform">
               <div class="form-group">
                    <input type="text" name="username" placeholder="Username" id="" class="form-control">
               </div></div>
             <div class="col-md-12"><div class="form-group">
                 <input type="password" name="password" placeholder="Password" id="" class="form-control">
             </div></div>
             <div class="col-md-12"><input type="submit" value="Register" name="submit"  id="" class="btn btn-primary pull-right"></div>
         </div>
     </form>


     <div id="UpdateFormView"></div>

                     </div>
                 </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <table class="table table-bordered">
                </table>
            </div>
        </div>
    </div>
</body>
</html>