<h2 class="section-title">Add new Host</h2>

<form ng-submit="addHost()">

	<div class="form-group">
		<label for="ipaddress">IP Address:</label>
		<input type="text" id="ipaddress" class="form-control" ng-model="formValues.ipaddress">
		<div class="error">{{ error.ipaddress[0] }}</div><!-- end error -->
	</div><!-- end form-group -->

	<div class="form-group">
		<label for="subnet">Subnet:</label>
		<input type="text" id="subnet" class="form-control" ng-model="formValues.subnet">
		<div class="error">{{ error.subnet[0] }}</div><!-- end error -->
	</div><!-- end form-group -->

	<div class="form-group">
		<label for="desc">Description:</label>
		<textarea name="desc" class="form-control" ng-model="formValues.desc"></textarea>
		<div class="error">{{ error.description[0] }}</div><!-- end error -->
	</div><!-- end form-group -->

	<div class="form-group">
		<label for="enabled">Enabled:</label>
		<input type="checkbox" id="enabled" ng-model="formValues.enabled">
	</div><!-- end form-group -->

	<div class="form-group">
		<input type="submit" class="btn btn-success" value="Add Host">
	</div><!-- end form-group -->

</form>