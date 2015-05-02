<label class="control-label" for="inputUsername">Login:</label>
<form class="form-horizontal" action="/users/login" method="POST">
	<div class="form-group">
	    <label for="inputUsername" class="col-sm-2 control-label">Username</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="inputUsername" name="username" placeholder="Username">
	    </div>
  	</div>
  	<div class="form-group">
	    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
	    <div class="col-sm-10">
	      <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password">
	    </div>
  	</div>
  	<div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      	<input class="btn btn-lg btn-primary" type="submit" value="Login">
	    </div>
  	</div>
</form>