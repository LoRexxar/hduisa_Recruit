
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>新生信息管理系统</title>
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="http://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/LoRexxar.css">
    <link rel="stylesheet" href="../css/styles.css">    
</head>
<body>
<div class="container back" style="height: 100vh; width: 100vw; margin-top:0px">
    
    <!-- body -->
    <div class="row head container">
        <div class="navbar-header">
            <p class="navbar-brand">Welcome <?php echo htmlspecialchars($_SESSION['username']);?></p>
            <a class="navbar-brand head-text" href="javascript:;" onclick="logout()">退出</a>
            <p class="navbar-brand head-text" id="msg"></p>
        </div>

        		<div class="navbar-collapse collapse">
		    <form class="form-search form-signin navbar-form navbar-right"  action="search.php" method="GET">
			    <Select NAME="field" class="form-control head-text" onclick="onsearch(this)">   
				<Option VALUE="name">姓名</option>   
				<Option VALUE="oldDriver">老司机</option>  
				<Option VALUE="studyNumber">学号</option>
				<Option VALUE="evaluate">评价</option> 
				<Option VALUE="direction">方向</option>     
				</Select> 

				<input type="text" class="input-medium search-query form-control head-text"  style="margin-left:20px" name="keywords">
				<button type="submit"  style="margin-left:20px; min-width:100px" class="btn form-control head-text">Search</button>
			</form>

		</div>
    </div>