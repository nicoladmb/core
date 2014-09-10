<table id="userlist" class="hascontrols grid" data-groups="<?php p($_['allGroups']);?>">
	<thead>
		<tr>
			<?php if ($_['enableAvatars']): ?>
			<th id='headerAvatar'></th>
			<?php endif; ?>
			<th id='headerName'><?php p($l->t('Username'))?></th>
			<th id="headerDisplayName"><?php p($l->t( 'Full Name' )); ?></th>
			<th id="headerPassword"><?php p($l->t( 'Password' )); ?></th>
			<th id="headerGroups"><?php p($l->t( 'Groups' )); ?></th>
			<?php if(is_array($_['subadmins']) || $_['subadmins']): ?>
			<th id="headerSubAdmins"><?php p($l->t('Group Admin')); ?></th>
			<?php endif;?>
			<th id="headerQuota"><?php p($l->t('Quota')); ?></th>
			<th id="headerStorageLocation"><?php p($l->t('Storage Location')); ?></th>
			<th id="headerLastLogin"><?php p($l->t('Last Login')); ?></th>
			<th id="headerRemove">&nbsp;</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($_["users"] as $user): ?>
		<tr data-uid="<?php p($user["name"]) ?>"
			data-displayname="<?php p($user["displayName"]) ?>">
			<?php if ($_['enableAvatars']): ?>
			<td class="avatar"><div class="avatardiv"></div></td>
			<?php endif; ?>
			<td class="name"><?php p($user["name"]); ?></td>
			<td class="displayName"><span><?php p($user["displayName"]); ?></span> <img class="svg action"
				src="<?php p(image_path('core', 'actions/rename.svg'))?>"
				alt="<?php p($l->t("change full name"))?>" title="<?php p($l->t("change full name"))?>"/>
			</td>
			<td class="password"><span>●●●●●●●</span> <img class="svg action"
				src="<?php print_unescaped(image_path('core', 'actions/rename.svg'))?>"
				alt="<?php p($l->t("set new password"))?>" title="<?php p($l->t("set new password"))?>"/>
			</td>
			<td class="groups">
				<input
					type="hidden"
					class="groupsselect"
					data-username="<?php p($user['name']) ;?>"
					value="<?php p(implode('|', $user['groups'])) ;?>">
			</td>
			<?php if(is_array($_['subadmins']) || $_['subadmins']): ?>
				<td class="subadmins">
					<input
						type="hidden"
						class="subadminsselect"
						data-username="<?php p($user['name']) ;?>"
						value="<?php p(implode('|', $user['subadmin']));?>"
					</select>
				</td>
			<?php endif;?>
			<td class="quota">
				<select class='quota-user' data-inputtitle="<?php p($l->t('Please enter storage quota (ex: "512 MB" or "12 GB")')) ?>">
					<option
						<?php if($user['quota'] === 'default') print_unescaped('selected="selected"');?>
							value='default'>
						<?php p($l->t('Default'));?>
					</option>
					<option
					<?php if($user['quota'] === 'none') print_unescaped('selected="selected"');?>
							value='none'>
						<?php p($l->t('Unlimited'));?>
					</option>
					<?php foreach($_['quota_preset'] as $preset):?>
					<option
					<?php if($user['quota']==$preset) print_unescaped('selected="selected"');?>
						value='<?php p($preset);?>'>
						<?php p($preset);?>
					</option>
					<?php endforeach;?>
					<?php if($user['isQuotaUserDefined']):?>
					<option selected="selected" value='<?php p($user['quota']);?>'>
						<?php p($user['quota']);?>
					</option>
					<?php endif;?>
					<option value='other' data-new>
						<?php p($l->t('Other'));?>
						...
					</option>
				</select>
			</td>
			<td class="storageLocation"><?php p($user["storageLocation"]); ?></td>
			<?php
			if($user["lastLogin"] === 0) {
				$lastLogin = $l->t('never');
				$lastLoginDate = $lastLogin;
			} else {
				$lastLogin = relative_modified_date($user["lastLogin"]);
				$lastLoginDate = \OC_Util::formatDate($user["lastLogin"]);
			}
			?>
			<td class="lastLogin" title="<?php p('<span class="usersLastLoginTooltip">'.$lastLoginDate.'</span>'); ?>"><?php p($lastLogin); ?></td>
			<td class="remove">
				<?php if($user['name']!=OC_User::getUser()):?>
					<a href="#" class="action delete" original-title="<?php p($l->t('Delete'))?>">
						<img src="<?php print_unescaped(image_path('core', 'actions/delete.svg')) ?>" class="svg" />
					</a>
				<?php endif;?>
			</td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>
