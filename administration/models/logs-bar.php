				<div class="dashboard__logs">
					<h1>Logs</h1>

					<?php
					$logs = $bdd->query('SELECT * FROM logs ORDER BY date DESC LIMIT 50');
					while($logs_infos = $logs->fetch()) {
						$userLogs = $bdd->prepare('SELECT * FROM users WHERE id = ?');
						$userLogs->execute(array($logs_infos->user_id));
						$userLogs_infos = $userLogs->fetch();
					?>
					<div class="logs">
						<h2><?= formater_date($logs_infos->date); ?></h2>
						<p><?= $userLogs_infos->username; ?> <?= $logs_infos->logs; ?></p>
					</div>
					<?php } ?>
				</div>