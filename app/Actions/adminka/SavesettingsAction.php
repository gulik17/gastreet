<?php
/**
 * Действие БО сохранение основных настроек системы
 */

class SavesettingsAction extends AdminkaAction
{
	public function execute()
	{
		$st = new SettingsManager();		
		$fullList = $st->getSettingsList();
		// сохраним все остальные параметры
		foreach ($fullList as $key => $value)
		{
			$choosen = FilterInput::add(new StringFilter("{$key}", false, ""));
			$choosen = str_replace('"', "&lt;", $choosen);
			$st->updateValue($key, $choosen);
		}
				
		Adminka::redirect("settingsmanager", "Настройки успешно сохранены");

	}

}
