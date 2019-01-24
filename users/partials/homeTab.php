<div role="tabpanel" class="tab-pane active" id="home">
	<div class="row">
		<br>
		<div class="col-md-12">
		<?php
			if(isset($_SESSION['classPostAdded'])){
		?>
		<div class="alert alert-success alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $_SESSION['classPostAdded']; ?>
		</div>
		<?php
				unset($_SESSION['classPostAdded']);
			}
		?>

		<?php
			if(isset($_SESSION['classPostAddFailed'])){
		?>
		<div class="alert alert-danger alert-dismissible">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $_SESSION['classPostAddFailed']; ?>
		</div>
		<?php
				unset($_SESSION['classPostAddFailed']);
			}
		?>
		</div>

		<div class="col-md-12">
			<div class="panel panel-warning" style="box-shadow: 0 2px 3px rgba(0, 0, 0, 0.3);">
				<form action="../controllers/classroom.php" method="POST">
				<div class="panel-body">
					<input type="hidden" name="classId" value="<?php echo $classId; ?>">
					<input type="hidden" name="userId" value="<?php echo $studentId; ?>">
					<textarea name="text" class="form-control" cols="30" rows="4" required style="resize: vertical" placeholder="Add new post"></textarea>
				</div>
				<div class="panel-footer">
					<button type="submit" name="class-post" class="btn btn-primary">Add Post</button>
				</div>
				</form>
			</div>
		</div>
		<div class="col-md-12"><br><h4>ALL POSTS</h4><hr></div>

		<?php
			$query="SELECT * FROM class_posts WHERE classId='{$classId}' ORDER BY id DESC";
			$res=mysqli_query($connection, $query);

			while($row=mysqli_fetch_array($res)){
		?>
		
		<div class="col-md-12">
			<div class="panel panel-warning" style="box-shadow: 0 2px 3px rgba(0, 0, 0, 0.3);">
				<div class="panel-body">
					<?php echo nl2br($row['text']); ?>
				</div>
				<div class="panel-footer">
					<div class="row">
						<div class="col-md-4">
							<span class="avtr"><b><a href="#"><?php echo ucwords(getUser($row['userId'])['name']); ?></a></b></span>
						</div>
						<div class="col-md-4">
							<div class="row">
								<div class="col-md-7" style="color: gray">
									<span class="glyphicon glyphicon-calendar" style="color: orange !important"></span>&nbsp;
									<?php echo convertedDate($row['timestamp'])['date']; ?>
								</div>
								<div class="col-md-5" style="color: gray">
									<span class="glyphicon glyphicon-time" style="color: orange !important"></span>&nbsp;
									<?php echo convertedDate($row['timestamp'])['time']; ?>
								</div>
							</div>
						</div>

						<div class="col-md-4 text-right">
							<?php if($row['userId']==$studentId){ ?>
							<form action="../controllers/classroom.php" method="POST" style="display: inline">
								<input type="hidden" name="classId" value="<?php echo $classId; ?>">
								<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
								<button type="submit" name="delete-class-post" class="btn btn-warning btn-xs" onclick="return confirm('Are you sure?')">Delete</button>
							</form>
							<?php } ?>
							<button class="btn btn-info btn-xs">Comments</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</div>