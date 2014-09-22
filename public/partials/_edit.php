<h2 class="section-title">Edit a Host</h2>

<form ng-submit="updateHost()">

	<div class="form-group">
		<label for="ipaddress">IP Address:</label>
		<input type="text" id="ipaddress" class="form-control" ng-model="processedHost.ipaddress">
		<div class="error">{{ errors.ipaddress[0] }}</div><!-- end error -->
	</div><!-- end form-group -->

	<div class="form-group">
		<label for="subnet">Subnet:</label>
		<input type="text" id="subnet" class="form-control" ng-model="processedHost.subnet">
		<div class="error">{{ errors.subnet[0] }}</div><!-- end error -->
	</div><!-- end form-group -->

	<div class="form-group">
		<label for="desc">Description:</label>
		<textarea name="desc" class="form-control" ng-model="processedHost.description"></textarea>
		<div class="error">{{ errors.description[0] }}</div><!-- end error -->
	</div><!-- end form-group -->

	<div class="form-group">
		<label for="enabled">Enabled:</label>
		<input type="checkbox" id="enabled" ng-model="processedHost.enabled">
	</div><!-- end form-group -->

	<div class="form-group">
		<input type="submit" class="btn btn-success" value="Confirm">
		<input type="submit" class="btn btn-danger" value="Cancel" ng-click="resetForm()">
	</div><!-- end form-group -->

</form>