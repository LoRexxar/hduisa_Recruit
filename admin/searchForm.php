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
