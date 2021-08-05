<?php
global $stockFool; // we'll need this below
?>
<div class="wrap">
    <h2>stockFool Settings</h2>

    <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
    	<?php $stockFool->the_nonce(); ?>
    	<table class="form-table">
			<tbody>
				<tr>
					<th scope="row" valign="top">Financial Modeling Prep API Key</th>
					<td>
            <label>
              <div class="panel panel-primary">
                <div class="panel-heading">
                </div>
                  <div class="panel-body">
                    <input name="<?php echo $stockFool->get_field_name('financialmodelingprep_API'); ?>"  class="controls settingsInput" type="text" value="<? echo $stockFool->get_setting('financialmodelingprep_API'); ?>" />
                  </div>
              </div>
					</td>
				</tr>
			</tbody>
    	</table>
    	<input id="submit" class="button-primary" type="submit" value="Save Settings" />
    </form>
</div>
