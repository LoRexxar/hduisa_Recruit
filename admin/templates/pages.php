	<div class="row" style="text-align:center; ">
		<div id="pagelist" class="pagination">
			<ul>
				<li>
					<a   class="ppage" href="search.php?<?php echo 'field='.$field.'&keywords='.$keywords.'&pageId=';if(($pageId-1)>0){echo $pageId-1;}else{echo $pages;};?>">上一页</a>
				</li>
				<?php 
					for($i=1;$i<=$pages;$i++){
						echo "<li>";
						echo "<a class='ppage' href='"."search.php?field=".$field."&keywords=".$keywords."&pageId=".$i."'>".$i."</a>";
						echo "</li>";
					}
				?>
				<li>
					<a class="ppage" href="search.php?<?php echo 'field='.$field.'&keywords='.$keywords.'&pageId=';if(($pageId+1)<$pages){echo $pageId+1;}else{echo $pages;};?>">下一页</a>
				</li>
			</ul>
		</div>
	</div>
<script src="http://cdn.bootcss.com/jquery/3.1.0/jquery.min.js"></script>
	    <script type="text/javascript" src="../js/Undefined.js"></script>
</body>
</html>
