<div class="row">
		<h2 class="sub-header" style="color: #FFF; text-align:center;">新生数据</h2>
		<div class="col-md-1"></div>
		<div class="col-md-10 table-responsive" style="border: 1px solid #ddd; border-radius:5px">
			<div class="row-fluid">
				<div class="span12">
					<table id="namelist" class="table table-striped">
					<thead>
						<tr>
			                <th>id</th>
			                <th>name</th>
			                <th>sex</th>
			                <th>seniorname</th>
		                </tr>
              		</thead>
					<tbody>
						<?php 
						foreach ($res as $new) {
							# code...
							if($new['sex']=='0'){
								$new['sex'] = "男";
							}
							elseif($new['sex'] == '1'){
								$new['sex'] = "女";
							}
							else{
								$new['sex'] = "保密";
							}
							echo "<tr><td>No.".$new['id']."</td><td>"."<a style=\"color: #FFF;\" href='student.php?id=".$new['id']."'>".htmlspecialchars($new['name'])."</a></td><td>".$new['sex']."</td><td>study with ".htmlspecialchars($new['seniorname'])."</td></tr>";
						};
						?>
					</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>